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
Route::get('/test', 'Custom\EmailController@build');

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
                'periodicidades' => 'periodicidad'
            ]
        ]);
        Route::resource('dominios', 'Admin\Catalogos\DominiosController', [
            'names' => [
                'index' => 'admin.catalogo.dominio.index',
                'store' => 'admin.catalogo.dominio.store',
                'create' => 'admin.catalogo.dominio.create',
                'update' => 'admin.catalogo.dominio.update',
                'edit' => 'admin.catalogo.dominio.edit',
                'destroy' => 'admin.catalogo.dominio.destroy',
                'show' => 'admin.catalogo.dominio.show'
            ],
            'parameters' => [
                'dominios' => 'dominio'
            ]
        ]);
        Route::resource('hostings', 'Admin\Catalogos\HostingsController', [
            'names' => [
                'index' => 'admin.catalogo.hosting.index',
                'store' => 'admin.catalogo.hosting.store',
                'create' => 'admin.catalogo.hosting.create',
                'update' => 'admin.catalogo.hosting.update',
                'edit' => 'admin.catalogo.hosting.edit',
                'destroy' => 'admin.catalogo.hosting.destroy',
                'show' => 'admin.catalogo.hosting.show'
            ],
            'parameters' => [
                'hostings' => 'hosting'
            ]
        ]);
    });
});