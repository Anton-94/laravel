<?php

namespace App\Services;

class StringService
{
    public function calculateLength(array $data): int
    {
        $string = '';
        foreach ($data as $datum) {
            $string .= $datum;
        }

        return strlen($string);
    }
}