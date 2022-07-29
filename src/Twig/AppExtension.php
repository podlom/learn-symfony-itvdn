<?php

namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;


class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('custom_name', [$this, 'customName'])
        ];
    }

    public function customName($value)
    {
        return $value . ', hello from a custom_name filter.';
    }
}