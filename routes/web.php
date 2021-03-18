<?php


Route::group(['prefix' => 'panel', 'middleware' => ['auth']], function () {

    Route::get('/', 'Panel\HomeController@index')->name('panel.index');

    //abre ticket
    Route::post('ticket/store/{id}', 'Panel\Ticket\TicketController@store')->name('ticket.store');

    // finaliza ticket
    Route::get('ticket/finaliza/{id}', 'Panel\Ticket\TicketController@finaliza')->name('ticket.finaliza');
    Route::get('ticket/print/{id}', 'Panel\Ticket\TicketController@print')->name('ticket.print');

    // Editar profile 
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'Auth\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'Auth\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'Auth\ProfileController@password']);


    //Controle financeiro
    Route::get('account/', 'Panel\Admin\AccountController@index')->name('account.index');
    Route::post('account/store/', 'Panel\Admin\AccountController@store')->name('account.store');
    Route::post('account/update/{id}', 'Panel\Admin\AccountController@update')->name('account.update');
    Route::get('account/delete/{id}', 'Panel\Admin\AccountController@delete')->name('account.delete');
    Route::get('account/zerar/', 'Panel\Admin\AccountController@zerar')->name('account.zerar');
});

//admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    //Gerenciar users
    Route::get('users/', 'Panel\Admin\UsersController@index')->name('admin.users.index');
    Route::get('user/edit/{id}', 'Panel\Admin\UsersController@edit')->name('admin.user.edit');
    Route::post('user/store/', 'Panel\Admin\UsersController@store')->name('admin.user.store');
    Route::post('user/update/{id}', 'Panel\Admin\UsersController@update')->name('admin.user.update');
    Route::get('user/delete/{id}', 'Panel\Admin\UsersController@delete')->name('admin.user.delete');
    Route::put('user/password', 'Panel\Admin\UsersController@password')->name('admin.user.password');

    Route::get('ticket/delete/{id}', 'Panel\Ticket\TicketController@delete')->name('admin.ticket.delete');

    Route::get('agenda/', 'Panel\Admin\AgendaController@index')->name('agenda.index');
    Route::post('agenda/store/', 'Panel\Admin\AgendaController@store')->name('agenda.store');
    Route::post('agenda/update/{id}', 'Panel\Admin\AgendaController@update')->name('agenda.update');
    Route::get('agenda/delete/{id}', 'Panel\Admin\AgendaController@delete')->name('agenda.delete');
    Route::get('agenda/search/', 'Panel\Admin\AgendaController@search')->name('agenda.search');

    //produtos
    Route::get('products/', 'Panel\Admin\ProductController@index')->name('admin.product.index');
    Route::get('product/create/', 'Panel\Admin\ProductController@create')->name('admin.product.create');
    Route::get('product/edit/{id}', 'Panel\Admin\ProductController@edit')->name('admin.product.edit');
    Route::post('product/store/', 'Panel\Admin\ProductController@store')->name('admin.product.store');
    Route::post('product/update/{id}', 'Panel\Admin\ProductController@update')->name('admin.product.update');
    Route::get('product/delete/{id}', 'Panel\Admin\ProductController@destroy')->name('admin.product.delete');
    Route::get('products/list/', 'Panel\Admin\ProductController@list')->name('admin.products.list');
    Route::get('product/search/', 'Panel\Admin\ProductController@search')->name('admin.product.search');
    Route::post('product/add/item/{id}', 'Panel\Admin\ProductController@addItem')->name('admin.product.addItem');

    //cart produto
    Route::get('cart/', 'Panel\Admin\CartController@index')->name('panel.cart.index');
    Route::get('cart/delete/item/{id}', 'Panel\Admin\CartController@deleteItem')->name('panel.cart.delete.item');
    Route::get('cart/finalizar/', 'Panel\Admin\CartController@finalizar')->name('panel.cart.finalizar');
    Route::get('cart/print/{cart}', 'Panel\Admin\CartController@print')->name('panel.cart.print');
    

});

// Caixa
Route::group(['prefix' => 'caixa', 'middleware' => ['auth']], function () {
    Route::get('/', 'Panel\Caixa\CaixaController@index')->name('caixa.index');
    Route::get('tickets/{id}/add/itens/', 'Panel\Ticket\TicketController@index')->name('ticket.itens');
    Route::post('tickets/add/itens/', 'Panel\Ticket\TicketController@addItens')->name('ticket.itens.store');
    Route::get('tickets/delete/item/{id}', 'Panel\Ticket\TicketController@deleteItem')->name('ticket.item.delete');
});
// clientes
Route::group(['prefix' => 'clientes', 'middleware' => ['auth']], function () {
    Route::get('/', 'Panel\Clientes\ClientesController@index')->name('clientes.index');
    Route::post('store/', 'Panel\Clientes\ClientesController@store')->name('cliente.store');
    Route::post('update/{id}', 'Panel\Clientes\ClientesController@update')->name('cliente.update');
    Route::get('delete/{id}', 'Panel\Clientes\ClientesController@delete')->name('cliente.delete');
    Route::get('search/', 'Panel\Clientes\ClientesController@search')->name('clientes.search');
});

//serviços
Route::group(['prefix' => 'servicos', 'middleware' => ['auth']], function () {
    Route::get('/', 'Panel\Admin\ServicosController@index')->name('servicos.index');
    Route::post('store/', 'Panel\Admin\ServicosController@store')->name('servico.store');
    Route::post('update/{id}', 'Panel\Admin\ServicosController@update')->name('servico.update');
    Route::get('delete/{id}', 'Panel\Admin\ServicosController@delete')->name('servico.delete');
});

//relatorios 
Route::group(['prefix' => 'relatorios', 'middleware' => ['auth']], function () {
    Route::get('/', 'Panel\Admin\RelatoriosController@index')->name('relatorios.index');
    Route::get('day/', 'Panel\Admin\RelatoriosController@day')->name('relatorios.day');
    Route::get('month/', 'Panel\Admin\RelatoriosController@month')->name('relatorios.month');
    Route::get('year/', 'Panel\Admin\RelatoriosController@year')->name('relatorios.year');
    Route::get('personalizado/', 'Panel\Admin\RelatoriosController@personalizado')->name('relatorios.personalizado');
});

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
