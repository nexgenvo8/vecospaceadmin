<?php

if (!function_exists('encodeStr')) {
    function encodeStr($id)
    {
        // 👉 Example: simple base64 encode with some twist
        return base64_encode($id); 

        // OR if you already have your own encoding logic, paste here
        // return (($id * 12345) + 6789); 
    }
}

if (!function_exists('decodeStr')) {
    function decodeStr($encodedId)
    {
        return base64_decode($encodedId);

        // OR reverse your custom logic
        // return (($encodedId - 6789) / 12345);
    }
}
