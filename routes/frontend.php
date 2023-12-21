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

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
