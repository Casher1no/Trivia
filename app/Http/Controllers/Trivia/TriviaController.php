<?php

namespace App\Http\Controllers\Trivia;

use App\Http\Controllers\Trivia\Services\CreateTriviaQuestionsService;
use App\Models\FactsInterface;
use Exception;


class TriviaController
{
    private FactsInterface $facts;
    private CreateTriviaQuestionsService $createTriviaQuestionsService;

    public function __construct(FactsInterface $facts, CreateTriviaQuestionsService $createTriviaQuestionsService)
    {
        $this->facts = $facts;
        $this->createTriviaQuestionsService = $createTriviaQuestionsService;
    }

    public function index()
    {
        return view('Trivia/home');
    }

    public function startGame()
    {
        try {
             $questions = $this->createTriviaQuestionsService->__invoke(
                $this->facts->getRandomTrivia(1, 100, 20)->json()
            );
        } catch (Exception $e) {
            return view('Trivia/home', ['error' => 'Something went wrong!']);
        }

        return view('Trivia/game', ['questions' => $questions]);
    }
}
