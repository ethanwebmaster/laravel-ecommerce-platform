<?php

namespace Corals\Modules\Payment\PayPal\Job;


use Corals\Modules\Payment\PayPal\Exception\PayPalWebhookFailed;
use Corals\Modules\Payment\Models\Invoice;
use Corals\Modules\Subscriptions\Models\Subscription;
use Corals\Modules\Payment\Models\WebhookCall;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HandleInvoicePaymentSucceeded implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \Corals\Modules\Payment\Models\WebhookCall
     */
    public $webhookCall;

    /**
     * HandleInvoiceCreated constructor.
     * @param WebhookCall $webhookCall
     */
    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        logger('Invoice Payment Succeeded');

        try {
            if ($this->webhookCall->processed) {
                throw PayPalWebhookFailed::processedCall($this->webhookCall);
            }

            $payload = $this->webhookCall->payload;

            if (is_array($payload) && isset($payload['resource'])) {
                $invoiceObject = $payload['resource'];

                $invoiceCode = $invoiceObject['id'];
                if ($invoiceObject['state'] == "completed") {
                    $invoice = Invoice::whereCode($invoiceCode)->first();
                    if (!$invoice) {
                        throw PayPalWebhookFailed::invalidPayPalInvoice($this->webhookCall);
                    }

                    $invoice->markAsPaid();
                } else {
                    throw PayPalWebhookFailed::invalidPayPalPayload($this->webhookCall);
                }

                $this->webhookCall->markAsProcessed();
            } else {
                throw PayPalWebhookFailed::invalidPayPalPayload($this->webhookCall);
            }
        } catch (\Exception $exception) {
            log_exception($exception);
            $this->webhookCall->saveException($exception);
        }
    }
}