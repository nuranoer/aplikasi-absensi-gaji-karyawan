<?php

Route::get('/', function (){
    return to_route('admin.dashboard');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/karyawan.php';