<?php


if (!function_exists('createDirectory')) {
    function createDirect($path)
    {
        dd($path);
        return storage_path($path);
    }
}
