<?php

namespace App\Http\Controllers\Trivia\Services;

class CheckTriviaAnswerRequest
{
    private string $questionCorrectAnswer;
    private string $userAnswered;

    public function __construct(string $questionCorrectAnswer, string $userAnswered)
    {
        $this->questionCorrectAnswer = $questionCorrectAnswer;
        $this->userAnswered = $userAnswered;
    }

    public function questionCorrectAnswer(): string
    {
        return $this->questionCorrectAnswer;
    }

    public function userAnswered(): string
    {
        return $this->userAnswered;
    }
}
