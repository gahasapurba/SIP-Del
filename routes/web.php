<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function(){
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/welcome', 'HomeController@welcome')->name('welcome');

    Route::resource('pengumuman', 'PengumumanController');
    Route::get('/search/pengumuman', 'PengumumanController@search')->name('pengumuman.search');

    Route::resource('pembayaran', 'PembayaranController');
    Route::get('/search/pembayaran', 'PembayaranController@search')->name('pembayaran.search');

    Route::resource('pesan', 'PesanController');
    Route::get('/search/pesan', 'PesanController@search')->name('pesan.search');

    Route::resource('account', 'AccountController');
});

Route::group(['middleware' => ['auth','staff']], function(){
    Route::resource('manajemenpembayaran', 'ManajemenPembayaranController');
    Route::post('/pembayaran/update/{id}', 'PembayaranController@updatePembayaran')->name('pembayaran.updatepembayaran');
    Route::get('/invoice/pembayaran/{id}', 'PembayaranController@invoice')->name('pembayaran.invoice');
    Route::post('/pembayaran/item/add', 'PembayaranController@addItem')->name('pembayaran.additem');
    Route::get('/pembayaran/item/edit/{id}', 'PembayaranController@editItem')->name('pembayaran.edititem');
    Route::post('/pembayaran/item/update/{id}', 'PembayaranController@updateItem')->name('pembayaran.updateitem');
    Route::get('/pembayaran/item/delete/{id}', 'PembayaranController@deleteItem')->name('pembayaran.deleteitem');
});

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['admin'])
    ->group(function() {
        Route::get('/', 'DashboardController@index')->name('admin-dashboard');
        
        Route::get('/trash', 'ArsipController@trash')->name('admin-trash');
        Route::get('/trash/kategori', 'ArsipController@trashKategori')->name('admin-trash-kategori');
        Route::get('/trash/pengumuman', 'ArsipController@trashPengumuman')->name('admin-trash-pengumuman');
        Route::get('/trash/pesan', 'ArsipController@trashPesan')->name('admin-trash-pesan');
        Route::get('/trash/pengguna', 'ArsipController@trashPengguna')->name('admin-trash-pengguna');
        Route::get('/trash/pembayaran', 'ArsipController@trashPembayaran')->name('admin-trash-pembayaran');
        Route::get('/trash/item', 'ArsipController@trashItem')->name('admin-trash-item');

        Route::resource('category', 'CategoryController');
        Route::get('/category/restore/{id}', 'CategoryController@restore')->name('category.restore');
        Route::delete('/category/kill/{id}', 'CategoryController@kill')->name('category.kill');

        Route::resource('announcement', 'AnnouncementController');
        Route::get('/announcement/restore/{id}', 'AnnouncementController@restore')->name('announcement.restore');
        Route::delete('/announcement/kill/{id}', 'AnnouncementController@kill')->name('announcement.kill');

        Route::get('/purchase/restore/{id}', 'PurchaseController@restore')->name('purchase.restore');
        Route::delete('/purchase/kill/{id}', 'PurchaseController@kill')->name('purchase.kill');
        Route::get('/purchase/item/restore/{id}', 'PurchaseController@restoreItem')->name('purchase.restoreItem');
        Route::delete('/purchase/item/kill/{id}', 'PurchaseController@killItem')->name('purchase.killItem');
        
        Route::get('/message/restore/{id}', 'MessageController@restore')->name('message.restore');
        Route::delete('/message/kill/{id}', 'MessageController@kill')->name('message.kill');

        Route::resource('user', 'UserController');
        Route::get('/user/role/staff', 'UserController@roleStaff')->name('admin-role-staff');
        Route::get('/user/role/user', 'UserController@roleUser')->name('admin-role-user');
        Route::get('/user/change/staff/{id}', 'UserController@change_role_staff')->name('user.change_role_staff');
        Route::get('/user/change/user/{id}', 'UserController@change_role_user')->name('user.change_role_user');
        Route::get('/user/restore/{id}', 'UserController@restore')->name('user.restore');
        Route::delete('/user/kill/{id}', 'UserController@kill')->name('user.kill');
    });

Auth::routes(['verify' => true]);