<?php

if (!function_exists('clg')) {
    function clg(string $message): void {
        \Barryvdh\Debugbar\Facades\Debugbar::info($message);
    }
}
