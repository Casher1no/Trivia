<?php

namespace App\Http\Controllers\Trivia;

use App\Http\Controllers\Trivia\Services\CreateTriviaQuestionsService;
use App\Models\FactsInterface;

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
        return $this->createTriviaQuestionsService->__invoke($this->facts->getRandomTrivia(1, 100, 20)->json());


        return view('Trivia/game');
    }
}
