<?php

namespace App\Api;


use App\Models\FactsInterface;
use Illuminate\Support\Facades\Http;

class NumberApiFacts implements FactsInterface
{
    private const apiUrl = 'http://numbersapi.com/';

    public function getFact(int $number)
    {
        return Http::get(self::apiUrl . $number);
    }
}
