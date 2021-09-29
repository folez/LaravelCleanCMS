<?php

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

foreach (\App\Models\Language::all() as $lang){
    Route::middleware('locale')->prefix(( $lang->is_default ? '/' : $lang->code ))->group(function () {
        foreach (\App\Models\Page::languageCode() as $page){
            Route::get("{$page->slug}", function () use ($page) {
                return 'this is a '.$page->name;
            });
        }
        Route::get('/', function () {
            var_dump(app()->getLocale());
        });
    });
}
