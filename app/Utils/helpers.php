<?php
if ( ! function_exists('setting')){
    function setting( string $key ) {
        $key = explode('.', $key);
        $settingName = $key[0];
        $settingKey = $key[1];
        return \App\Models\Settings::getByNameAndKey($settingName, $settingKey);
    }
}
