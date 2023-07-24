<?php

namespace App\Http\Controllers\Trivia\Services;

use App\Models\FactsInterface;
use App\Models\Trivia\Question;

class CreateTriviaQuestionsService
{
    private FactsInterface $facts;

    public function __construct(FactsInterface $facts)
    {
        $this->facts = $facts;
    }

    public function __invoke(?CreateTriviaQuestionRequest $request = null): Question
    {
        $numberFactsAnswered = [];
        if (!empty($request)) {
            $numberFactsAnswered = $request->numbers();
        }

        do {
            $number = rand(1, 100);
        } while (in_array((string)$number, $numberFactsAnswered));

        $fact = $this->facts->getFact($number);

        // Converts fact to question
        $words = explode(' ', $fact);
        $correctAnswer = $words[0];
        $answers = $this->generateAnswers($correctAnswer);
        $words[0] = '__';
        $question = implode(' ', $words);

        return new Question($question, $correctAnswer, $answers);
    }

    private function generateAnswers(int $inputNumber, int $count = 4, int $range = 5): array
    {
        $randomArray = [];

        $randomArray[] = $inputNumber;

        $generatedValues = [$inputNumber];

        for ($i = 1; $i < $count; $i++) {
            do {
                $offset = rand(-$range, $range);
                $newNumber = $inputNumber + $offset;
            } while (in_array($newNumber, $generatedValues));

            $randomArray[] = $newNumber;
            $generatedValues[] = $newNumber;
        }

        shuffle($randomArray);

        return $randomArray;
    }
}
