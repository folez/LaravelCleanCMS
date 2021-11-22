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

        if(env('use_language')){
            Route::get('languages', \App\Http\Livewire\Admin\Pages\Language::class)->name('languages');
        }

        Route::prefix('pages')->name('pages.')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Pages\PageList::class)->name('list');
            Route::get('{id:int?}', \App\Http\Livewire\Admin\Pages\PageEdit::class)->name('edit');
        });

		Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

        Route::group(['prefix' => 'filemngr', 'middleware' => ['web', 'auth']], function () {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });

        /*Route::prefix('filemngr')->group(function () {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });*/
    });
