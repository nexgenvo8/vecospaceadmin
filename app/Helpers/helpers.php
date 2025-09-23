<?php

function encodeStr($str)
{
    $finalenc = $str + 202565517;

    //$str=base64_encode(base64_encode($str));
    return $finalenc;
}

function decodeStr($str)
{
    $finalenc = $str - 202565517;
    //$str=base64_decode(base64_decode($str));
    return $finalenc;
}


if (!function_exists('hasPermission')) {
    function hasPermission($perm)
    {
        return in_array($perm, session('permissions', []));
    }
}


