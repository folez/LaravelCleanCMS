<?php
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [ \App\Http\Controllers\Admin\AuthController::class, 'loginView' ])
	->name('admin.login');
Route::name('admin.')
	->prefix('admin')
	->middleware("authorized" )
	->group(function () {
//		Route::get('preview/{image}', [ \App\Http\Controllers\Admin\ImageController::class, 'compileImage' ])->name('image');
		Route::get('/', function () {
            return 123;
        })->name('home');

		Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
	});
