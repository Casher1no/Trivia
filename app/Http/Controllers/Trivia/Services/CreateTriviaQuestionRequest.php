<?php

namespace App\Http\Controllers\Trivia\Services;

class CreateTriviaQuestionRequest
{
    private array $numbers;

    public function __construct(array $numbers)
    {
        $this->numbers = $numbers;
    }

    public function numbers(): array
    {
        return $this->numbers;
    }

}
