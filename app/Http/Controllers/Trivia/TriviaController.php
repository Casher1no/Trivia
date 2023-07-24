<?php

namespace App\Http\Controllers\Trivia;

use App\Http\Controllers\Trivia\Services\CheckTriviaAnswerRequest;
use App\Http\Controllers\Trivia\Services\CheckTriviaAnswerService;
use App\Http\Controllers\Trivia\Services\CreateTriviaQuestionsService;
use Exception;
use Illuminate\Http\Request;

class TriviaController
{
    private const QUESTION_COUNT = 20;
    private CreateTriviaQuestionsService $createTriviaQuestionsService;
    private CheckTriviaAnswerService $checkTriviaAnswerService;

    public function __construct(CreateTriviaQuestionsService $createTriviaQuestionsService, CheckTriviaAnswerService $checkTriviaAnswerService)
    {
        $this->createTriviaQuestionsService = $createTriviaQuestionsService;
        $this->checkTriviaAnswerService = $checkTriviaAnswerService;
    }

    public function index()
    {
        return view('Trivia/home');
    }

    public function startGame()
    {
        try {
            $questions = $this->createTriviaQuestionsService->__invoke();
        } catch (Exception $e) {
            return view('Trivia/home', ['error' => 'Something went wrong!']);
        }

        return view('Trivia/game', [
            'question' => $questions,
        ]);
    }

    public function submit(Request $request)
    {
        // Check if correct
        $isCorrect = $this->checkTriviaAnswerService->__invoke(
            new CheckTriviaAnswerRequest(
                $request->input('questionCorrectAnswer'),
                $request->input('userAnswered')
            )
        );

        if (!$isCorrect) {
            $correctAnswered = json_decode($request->input('alreadyAnswered'), true) ?? [];
            $correctAnswered = count($correctAnswered);

            $questionAnswers = $request->input('questionAnswers');
            $questionAnswers = explode(',', str_replace(['[', ']'], '', $questionAnswers));


            return view('Trivia/lose',
                [
                    'correctAnswered' => $correctAnswered,
                    'totalQuestions' => self::QUESTION_COUNT,

                    'question' => $request->input('question'),
                    'userAnswered' => $request->input('userAnswered'),
                    'correctAnswer' => $request->input('correctAnswer'),
                    'questionAnswers' => $questionAnswers,
                    'questionCorrectAnswer' => $request->input('questionCorrectAnswer'),
                ]);
        }

        $question = $this->createTriviaQuestionsService->__invoke(json_decode($request->input('questions')));
        $result = json_decode($request->input('questions'));
    }
}
