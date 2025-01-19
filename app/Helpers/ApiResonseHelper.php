<?php

namespace App\Helpers;

class ApiResonseHelper
{
    public function filterIntFromArray(array $haystack, string $key, mixed $default = null): ?int
    {
        if (isset($haystack[$key])) {
            return (int) $haystack[$key];
        }

        return $default;
    }

    public function filterStringFromArray(array $haystack, string $key, mixed $default = null): ?string
    {
        if (isset($haystack[$key]) && is_string($haystack[$key])) {
            return filter_var($haystack[$key], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        return $default;
    }

    public function filterBoolFromArray(array $haystack, string $key, mixed $default = null): ?bool
    {
        return (isset($haystack[$key]) && is_bool($haystack[$key])) ? $haystack[$key] : $default;
    }

    public function filterEnumFromArray(array $haystack, string $key, array $allowed, mixed $default = null): ?bool
    {
        $map = array_flip(array_map(function ($allowed) {
            return $allowed->value;
        }, $allowed));

        return (isset($haystack[$key]) && array_key_exists($haystack[$key], $map)) ? $haystack[$key] : $default;
    }
}