<?php

namespace App\Helpers;

use App\Factories\CategoryDTOFactory;
use App\Factories\TagDTOFactory;
use App\Interfaces\DTOInterface;
use BackedEnum;

class ApiResonseHelper
{
    public function filterIntFromArray(array $haystack, string $key, mixed $default = null): ?int
    {
        return isset($haystack[$key]) ? (int) $haystack[$key] : $default;
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
        return (
            isset($haystack[$key]) && $this->isBool($haystack[$key])) ? $haystack[$key] : $default;
    }

    public function filterEnumFromArray(array $haystack, string $key, string $enumClass, mixed $default = null): ?BackedEnum
    {
        if (isset($haystack[$key])) {
            $output = $enumClass::tryFrom($haystack[$key]);
        } else {
            $output = $default;
        }

        return $output;
    }

    public function filterCategoryFromArray(array $haystack, string $key): ?DTOInterface
    {
        $factory = app(CategoryDTOFactory::class);

        if (isset($haystack[$key]) && is_array($haystack[$key])) {
            $dto = $factory->createFromArray($haystack[$key]);

            return $dto;
        }

        return null;
    }

    public function filterTagFromArray(array $haystack, string $key, mixed $default = null): ?array
    {
        $factory = app(TagDTOFactory::class);
        $output = [];

        if (isset($haystack[$key]) && is_array($haystack[$key])) {
            foreach ($haystack[$key] as $item) {
                $output[] = $factory->createFromArray($item);
            }
        }

        $output = array_filter($output, fn($value) => $value !== null);

        return (!empty($output)) ? $output : $default;
    }

    public function filterPhotosFromArray(array $haystack, string $key, mixed $default = null): ?array
    {
        $output = [];

        if (isset($haystack[$key]) && is_array($haystack[$key])) {
            foreach ($haystack[$key] as $value) {
                if (!is_string($value)) {
                    continue;
                }

                $output[] = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        return (!empty($output)) ? $output : $default;
    }

    private function isBool(mixed $value): bool
    {
        return $value === 1 || $value === 0 || is_bool($value);
    }
}