<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function changeLang(Request $request, $lang)
    {
        $host = url('/');

        $url = $request->header('referer');

        if ( strpos( $url, $host ) === false ) {
            return $url;
        }

        $default_uri = str_replace( $host, '', $url );

        $default_uri = $default_uri ? $default_uri : '/';
        $languages   = Language::all();

        $parts       = explode( '/', ltrim( $this->trailingslashit( $default_uri ), '/' ) );

        $url_lang    = $parts[0];
        if ( $languages->contains('code', $url_lang) ) {
            $default_uri = preg_replace( '!^/' . $url_lang . '(/|$)!i', '/', $default_uri );
        }

        $defaultLanguageModel = Language::getDefaultLanguage();

        $default_language = $defaultLanguageModel->code;

        if ( $lang === $default_language ) {
            $new_uri = '/' . $default_uri;
        } else {
            $new_uri = '/' . $lang . $default_uri;
        }

        $new_uri = preg_replace( '/(\/+)/', '/', $new_uri );

        if ( '/' !== $new_uri ) {
            $new_url = $host . $new_uri;
        } else {
            $new_url = $host;
        }
        //        dd(redirect()->to($new_url));
        \App::setLocale($lang);
        \Session::put('locale', $lang);
        return redirect()->to($new_url);
    }

    private function untrailingslashit($string)
    {
        return rtrim( $string, '/\\' );
    }

    private function trailingslashit( $string ) {
        return $this->untrailingslashit( $string ) . '/';
    }
}
