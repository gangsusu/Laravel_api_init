<?php

Route::get('/', function () {
    return 'hello';
});
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
