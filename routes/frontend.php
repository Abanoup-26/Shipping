<?php
Route::group(['prefix' => 'client', 'as' => 'client.', 'namespace' => 'Client', 'middleware' => ['auth', 'client']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Client Financial
    Route::post('client-financials/media', 'ClientFinancialController@storeMedia')->name('client-financials.storeMedia');
    Route::post('client-financials/ckmedia', 'ClientFinancialController@storeCKEditorImages')->name('client-financials.storeCKEditorImages');
    Route::resource('client-financials', 'ClientFinancialController');

    // Orders
    Route::post('orders/media', 'OrdersController@storeMedia')->name('orders.storeMedia');
    Route::post('orders/ckmedia', 'OrdersController@storeCKEditorImages')->name('orders.storeCKEditorImages');
    Route::get('orders/{order}/print', 'OrdersController@print')->name('orders.print');
    Route::resource('orders', 'OrdersController');

});
