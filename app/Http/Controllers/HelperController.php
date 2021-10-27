<?php

namespace App\Http\Controllers;

class HelperController extends Controller
{
    public function changeLang(\Illuminate\Http\Request $request, $lng)
    {
        $langs = \App\Models\Language::all()->map( fn($x) => $x->code )->toArray();
        $l = array_search($lng, $langs);
        unset($langs[$l]);
        $referrer = str_replace(asset(''),'',$request->header('referer'));
        $referrer = explode('/', $referrer);
        //    dd($referrer);
        $t = array_needle_array_search($langs, $referrer);
        if(count($referrer) > 1) {
            unset($referrer[$t]);
        } else {
            array_unshift($referrer, $lng);
        }
        //        $referrer = end( $referrer);
        \App::setLocale($lng);
        \Session::put('locale', $lng);
        return redirect()->to(implode('/',$referrer));
    }
}
