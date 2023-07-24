<?php

namespace App\Http\Controllers\Trivia\Services;

class CheckTriviaAnswerService
{
    public function __invoke(CheckTriviaAnswerRequest $request): bool
    {
        if($request->questionCorrectAnswer() != $request->userAnswered()){
            return false;
        }

        return true;
    }
}
