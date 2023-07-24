<?php

namespace App\Http\Controllers\Trivia;

use App\Http\Controllers\Trivia\Services\CheckTriviaAnswerRequest;
use App\Http\Controllers\Trivia\Services\CheckTriviaAnswerService;
use App\Http\Controllers\Trivia\Services\CreateTriviaQuestionRequest;
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
            'totalQuestions' => self::QUESTION_COUNT,
            'correctAnswered' => 0
        ]);
    }

    public function submit(Request $request)
    {
        $questionCorrectAnswer = $request->input('questionCorrectAnswer');
        $userAnswered = $request->input('userAnswered');

        // Check if the answer is correct
        $isCorrect = $this->checkTriviaAnswerService->__invoke(
            new CheckTriviaAnswerRequest($questionCorrectAnswer, $userAnswered)
        );

        $alreadyAnswered = $request->input('alreadyAnswered', 'null') !== 'null'
            ? explode(',', $request->input('alreadyAnswered'))
            : [];

        $answeredCount = count($alreadyAnswered);

        if (!$isCorrect) {
            $questionAnswers = explode(',', str_replace(['[', ']'], '', $request->input('questionAnswers')));

            return view('Trivia.lose', [
                'correctAnswered' => $answeredCount,
                'totalQuestions' => self::QUESTION_COUNT,
                'question' => $request->input('question'),
                'userAnswered' => $userAnswered,
                'questionAnswers' => $questionAnswers,
                'questionCorrectAnswer' => $questionCorrectAnswer,
            ]);
        }

        $alreadyAnswered[] = $userAnswered;

        $answeredCount = count($alreadyAnswered);

        if ($answeredCount === self::QUESTION_COUNT) {
            return view('Trivia.won', [
                'correctAnswered' => $answeredCount,
                'totalQuestions' => self::QUESTION_COUNT,
            ]);
        }

        $question = $this->createTriviaQuestionsService->__invoke(
            new CreateTriviaQuestionRequest($alreadyAnswered)
        );

        return view('Trivia.game', [
            'correctAnswered' => $answeredCount,
            'totalQuestions' => self::QUESTION_COUNT,
            'question' => $question,
            'alreadyAnswered' => $alreadyAnswered,
        ]);
    }
}
