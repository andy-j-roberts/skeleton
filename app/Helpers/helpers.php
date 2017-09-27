<?php

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        [$namespace, $key] = array_pad(explode('.', $key), -2,'');
        $setting = \App\Setting::whereNamespaceAndKey($namespace, $key)->first();

        return $setting->value ?? $default;
    }
}


