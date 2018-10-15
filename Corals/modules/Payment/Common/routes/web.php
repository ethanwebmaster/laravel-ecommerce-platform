<?php

Route::group(['prefix' => 'payments'], function () {
    Route::get('settings', 'PaymentsController@settings');
    Route::post('settings', 'PaymentsController@saveSettings');
});

Route::get('my-invoices', 'InvoicesController@myInvoices');
Route::resource('invoices', 'InvoicesController');
Route::get('invoices/{invoice}/download', 'InvoicesController@download');
Route::get('webhook-calls', 'WebhooksController@webhookCalls');
Route::post('webhooks/{gateway?}', 'WebhooksController');
Route::resource('currencies' ,'CurrenciesController');

Route::group(['prefix' => 'tax'], function () {
    Route::resource('tax-classes', 'TaxClassesController');
    Route::resource('tax-classes.taxes', 'TaxesController');

});