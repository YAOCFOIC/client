<?php
$routes = [
    'login'    => 'AuthController@login',
    'register' => 'AuthController@register',
    'logout'   => 'AuthController@logout',

    'products'        => 'ProductController@index',
    'products/create' => 'ProductController@create',
    'products/store'  => 'ProductController@store',
    'products/delete' => 'ProductController@delete',
    'products/edit'   => 'ProductController@edit',

    'cart/index'      => 'OrderController@cart',
    'cart'            => 'OrderController@cart',
    'cart/confirm'    => 'OrderController@confirmarPedido',
    'orders/clear'    => 'OrderController@clear',
    'history'         => 'OrderController@history',
    'orders/removeFromCart' => 'OrderController@removeFromCart',

    'procesos'        => 'ProcesoController@index',
    'procesos/create' => 'ProcesoController@create',
    'procesos/store'  => 'ProcesoController@store',
    'procesos/edit'   => 'ProcesoController@edit',
    'procesos/update' => 'ProcesoController@update',
    'procesos/delete' => 'ProcesoController@destroy',
    'procesos/show'   => 'ProcesoController@show',
    'procesos/exportExcel' => 'ProcesoController@exportExcel',
];
