<?php
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [ \App\Http\Controllers\Admin\AuthController::class, 'loginView' ])
	->name('admin.login');
Route::name('admin.')
	->prefix('admin')
	->middleware("authorized" )
	->group(function () {
//		Route::get('preview/{image}', [ \App\Http\Controllers\Admin\ImageController::class, 'compileImage' ])->name('image');
		Route::get('/', \App\Http\Livewire\Admin\Pages\Dashboard::class)->name('home');

        Route::get('settings', \App\Http\Livewire\Admin\Pages\Settings::class)->name('settings');
        Route::get('languages', \App\Http\Livewire\Admin\Pages\Language::class)->name('languages');

		Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
	});
