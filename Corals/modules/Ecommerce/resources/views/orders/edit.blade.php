@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($order, ['url' => url($resource_url.'/'.$order->hashed_id),'method'=>$order->exists?'PUT':'POST','files'=>false,'class'=>'ajax-form']) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! CoralsForm::select('status','Ecommerce::attributes.order.status_order', $order_statuses ,true) !!}
                        {!! CoralsForm::select('shipping[status]','Ecommerce::attributes.order.shipping_status', $order_statuses ,false, $order->shipping['status'] ?? '',['class'=>'']) !!}
                        {!! CoralsForm::text('shipping[tracking_number]','Ecommerce::attributes.order.shipping_track', false, $order->shipping['tracking_number'] ?? '',['class'=>'']) !!}
                        {!! CoralsForm::text('shipping[label_url]','Ecommerce::attributes.order.shipping_label', false, $order->shipping['label_url'] ?? '',['class'=>'']) !!}
                        {!! CoralsForm::select('billing[payment_status]','Ecommerce::attributes.order.payment_status', $payment_statuses , false, $order->billing['payment_status'] ?? '',['class'=>'']) !!}
                        {!! CoralsForm::text('billing[gateway]','Ecommerce::attributes.order.payment_method', false, $order->billing['gateway'] ?? '',['class'=>'']) !!}
                        {!! CoralsForm::text('billing[payment_reference]','Ecommerce::attributes.order.payment_reference', false, $order->billing['payment_reference'] ?? '',['class'=>'']) !!}

                        {!! CoralsForm::formButtons(trans('Corals::labels.save',['title' => $title_singular]), [], ['show_cancel' => false])  !!}
                    </div>

                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
