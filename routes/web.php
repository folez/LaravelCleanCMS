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
Route::get('change-lang/{lang}', [\App\Http\Controllers\HelperController::class, 'changeLang'])->name('changeLang');

/*if(\Illuminate\Support\Facades\Schema::hasTable(\App\Models\Language::TABLE_NAME)) {
    foreach (\App\Models\Language::all() as $lang){
        Route::middleware('locale')->prefix(( $lang->is_default ? '/' : $lang->code ))->group(function () use ($lang) {
            foreach (\App\Models\Page::languageCode()->get() as $page){
                Route::get("{$page->slug}", function () use ($page) {
                    return view('welcome', [ 'page' => $page ]);
                });
            }
        });
    }
}*/

Route::get('preview-gallery/{image}', [ \App\Http\Controllers\Admin\ImageCompileController::class, 'renderGalleryAdminPreview' ])->name('renderGalleryAdminPreview');
