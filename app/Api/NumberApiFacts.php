<?php

namespace App\Api;


use App\Models\FactsInterface;
use Exception;
use Illuminate\Support\Facades\Http;

class NumberApiFacts implements FactsInterface
{
    private const apiUrl = 'http://numbersapi.com/';

    public function getRandomTrivia(int $min, int $max, $count)
    {
        if ($count > ($max - $min + 1)) {
            throw new Exception('Cannot generate more numbers than the range allows.');
        }

        $numbers = range($min, $max);
        shuffle($numbers);

        $selectedNumbers = array_slice($numbers, 0, $count);

        $url = self::apiUrl . implode(',', $selectedNumbers);

        return Http::get($url);
    }
}
