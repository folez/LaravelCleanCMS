<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;

class LocaleMiddleware
{
	public function handle( Request $request, Closure $next )
	{
        foreach (Language::where('is_default', '=',false)->get() as $lang){
            if(\Route::current()->getPrefix() == "/{$lang->code}"){
                app()->setLocale($lang->code);
                return $next( $request );
            }
        }
        //        return $result;
        if($request->session()->get('locale')){
            $locale = $request->session()->get('locale');
            app()->setLocale($locale);
        }
		return $next( $request );
	}
}
