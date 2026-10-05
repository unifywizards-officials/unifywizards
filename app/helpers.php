<?php

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($routeName) {
        return request()->routeIs($routeName) ? 'active' : '';
    }
}