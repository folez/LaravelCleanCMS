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

        if(env('USE_LANGUAGE')){
            Route::prefix('languages')->name('languages.')->group(function () {
                Route::get('/', \App\Http\Livewire\Admin\Pages\Language::class)->name('list');
                Route::get('{id:int?}/translate', \App\Http\Livewire\Admin\Pages\LanguageTranslate::class)->name('translate');
            });

        }

        Route::prefix('pages')->name('pages.')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Pages\PageList::class)->name('list');
            Route::get('create', \App\Http\Livewire\Admin\Pages\PageEdit::class)->name('create');
            Route::get('{id:int?}', \App\Http\Livewire\Admin\Pages\PageEdit::class)->name('edit');
        });

        Route::get('menu', \App\Http\Livewire\Admin\Pages\MenuList::class)->name('menu.list');

		Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

        Route::group(['prefix' => 'filemngr', 'middleware' => ['web', 'auth']], function () {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });

        /*Route::prefix('filemngr')->group(function () {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });*/
    });
