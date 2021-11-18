<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;

class LocaleMiddleware
{
    public function handle( Request $request, Closure $next )
    {
        $host = url('/');
        $url = $request->url();

        $lang = $request->session()->get('locale') ?? app()->getLocale() ?? Language::getDefaultLanguage()->code;

        if ( strpos( $url, $host ) === false ) {
            return $next($request);
        }

        $default_uri = str_replace( $host, '', $url );
        $languages   = Language::all();

        $default_uri = $default_uri ? $default_uri : '/';
        $parts       = explode( '/', ltrim( $this->trailingslashit( $default_uri ), '/' ) );

        $url_lang    = $parts[0];

        $defaultLanguageModel = Language::getDefaultLanguage();

        $default_language = $defaultLanguageModel->code;

        if($url_lang == $lang || ( $lang == $default_language )) {
            return $next($request);
        }

        if ( $languages->contains('code', $url_lang) ) {
            $default_uri = preg_replace( '!^/' . $url_lang . '(/|$)!i', '/', $default_uri );
        }

        if ( $lang === $default_language ) {
            $new_uri = '/' . $default_uri;
        } else {
            $new_uri = '/' . $lang . $default_uri;
        }

        $new_uri = preg_replace( '/(\/+)/', '/', $new_uri );

        if ( '/' !== $new_uri ) {
            $new_url = $host . $new_uri;
        } else {
            $new_uri = '/';
        }


        return redirect()->to($new_uri);
    }

    private function untrailingslashit($string): string
    {
        return rtrim( $string, '/\\' );
    }

    private function trailingslashit( $string ): string
    {
        return $this->untrailingslashit( $string ) . '/';
    }
}
