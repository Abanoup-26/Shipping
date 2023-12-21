<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    $userType = Auth::user()->user_type;
    if (session('status')) {
        $homeRoute = $userType === 'client' ? 'client.home' : 'admin.home';
        return redirect()->route($homeRoute)->with('status', session('status'));
    }
    $homeRoute = $userType === 'client' ? 'client.home' : 'admin.home';
    return redirect()->route($homeRoute);
});

Auth::routes();
// Commercial_record image in Registeration
Route::post('register/media', 'Auth\RegisterController@storeMedia')->name('register.storeMedia');
Route::post('register/ckmedia', 'Auth\RegisterController@storeCKEditorImages')->name('register.storeCKEditorImages');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'staff']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');
    Route::post('user', 'UserController@index')->name('user');


    // Clients
    Route::delete('clients/destroy', 'ClientsController@massDestroy')->name('clients.massDestroy');
    Route::post('clients/media', 'ClientsController@storeMedia')->name('clients.storeMedia');
    Route::post('clients/ckmedia', 'ClientsController@storeCKEditorImages')->name('clients.storeCKEditorImages');
    Route::post('clients/update_statuses', 'ClientsController@update_statuses')->name('clients.update_statuses');
    Route::resource('clients', 'ClientsController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Client Financial
    Route::delete('client-financials/destroy', 'ClientFinancialController@massDestroy')->name('client-financials.massDestroy');
    Route::post('client-financials/media', 'ClientFinancialController@storeMedia')->name('client-financials.storeMedia');
    Route::post('client-financials/ckmedia', 'ClientFinancialController@storeCKEditorImages')->name('client-financials.storeCKEditorImages');
    Route::resource('client-financials', 'ClientFinancialController');

    // Orders
    Route::delete('orders/destroy', 'OrdersController@massDestroy')->name('orders.massDestroy');
    Route::post('orders/media', 'OrdersController@storeMedia')->name('orders.storeMedia');
    Route::post('orders/ckmedia', 'OrdersController@storeCKEditorImages')->name('orders.storeCKEditorImages');
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
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
