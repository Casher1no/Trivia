<?php

namespace App\Http\Controllers\Trivia\Services;

class CreateTriviaQuestionsService
{
    public function __invoke(array $questions)
    {
        foreach ($questions as &$question) {
            $words = explode(' ', $question);

            $words[0] = '?';

            $question = implode(' ', $words);
        }


        return $questions;
    }
}
