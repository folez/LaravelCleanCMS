<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;

class LocaleMiddleware
{
    public function handle( Request $request, Closure $next )
    {
        if(\Route::current()->getPrefix() == '/en'){
            if($request->session()->get('locale')){
                $locale = $request->session()->get('locale') ?? 'en';
                app()->setLocale($locale);
            } else {
                app()->setLocale('en');
            }
            return $next( $request );
        }

        //        return $result;
        if($request->session()->get('locale')){
            $locale = $request->session()->get('locale');
            app()->setLocale($locale);
        }
        if($request->session()->get('locale') == 'en'){
            $segment = $request->segment(1);
            $segments = $request->segments();
            $locale = 'en';
            app()->setLocale($locale);
            array_unshift($segments, $locale);

            return redirect()->to(implode('/',$segments));
        }
        return $next( $request );

        /*foreach (Language::where('is_default', '=',false)->get() as $lang){
            if(\Route::current()->getPrefix() == "/{$lang->code}"){
                if($request->session()->get('locale')){
                    $locale = $request->session()->get('locale') ?? $lang->code;
                    app()->setLocale($locale);
                } else {
                    app()->setLocale($lang->code);
                }
//                app()->setLocale($lang->code);
                return $next( $request );
            }
        }
        //        return $result;
        if($request->session()->get('locale')){
            $locale = $request->session()->get('locale');
            app()->setLocale($locale);
        }
		return $next( $request );*/
    }
}
