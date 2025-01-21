<?php

namespace App\Traits;

use App\Interfaces\PrintableInterface;
use BackedEnum;

trait PrintableTrait
{
    public function printable(): array
    {
        $data = (array) $this;

        array_walk($data, function (&$element) {
            $this->filter($element);
        });

        return $data;
    }

    public function filter(&$element): void
    {
        if ($element instanceof BackedEnum) {
            $element = $element->value;
        }

        if ($element instanceof PrintableInterface) {
            $element = $element->printable();
        }

        if (is_bool($element)) {
            $element = (int) $element;
        }

        if (is_array($element)) {
            array_walk($element, function (&$subElement) {
                $this->filter($subElement);
            });
        }
    }
}