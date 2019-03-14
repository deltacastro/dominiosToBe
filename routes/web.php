<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'catalogos'], function () {
        Route::resource('proveedores', 'Admin\Catalogos\ProveedoresController', [
            'names' => [
                'index' => 'admin.catalogo.proveedor.index',
                'store' => 'admin.catalogo.proveedor.store',
                'create' => 'admin.catalogo.proveedor.create',
                'update' => 'admin.catalogo.proveedor.update',
                'edit' => 'admin.catalogo.proveedor.edit',
                'destroy' => 'admin.catalogo.proveedor.destroy',
                'show' => 'admin.catalogo.proveedor.show'
            ],
            'parameters' => [
                'proveedores' => 'proveedor'
            ]
        ]);
        Route::resource('periodicidades', 'Admin\Catalogos\PeriodicidadesController', [
            'names' => [
                'index' => 'admin.catalogo.periodicidad.index',
                'store' => 'admin.catalogo.periodicidad.store',
                'create' => 'admin.catalogo.periodicidad.create',
                'update' => 'admin.catalogo.periodicidad.update',
                'edit' => 'admin.catalogo.periodicidad.edit',
                'destroy' => 'admin.catalogo.periodicidad.destroy',
                'show' => 'admin.catalogo.periodicidad.show'
            ],
            'parameters' => [
                'periodicidades' => 'catalogoPeriodicidad'
            ]
        ]);
    });
});