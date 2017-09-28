<?php

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        list($namespace, $key) = array_pad(explode('.', $key), -2,'');
        $setting = \App\Setting::whereNamespaceAndKey($namespace, $key)->first();

        return $setting->value ?? $default;
    }
}
if (!function_exists('confirm')) {
    function confirm($message)
    {
        $notifier = app('flash');
        if (! is_null($message)) {
            return $notifier->message($message, 'confirm');
        }
        return $notifier;
    }
}
if (!function_exists('alert')) {
    function alert($message)
    {
        $notifier = app('flash');
        if (! is_null($message)) {
            return $notifier->message($message, 'alert');
        }
        return $notifier;
    }
}


