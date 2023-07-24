<?php

namespace App\Http\Controllers\Trivia\Services;

use App\Models\Trivia\Question;

class CreateTriviaQuestionsService
{
    public function __invoke(array $questions)
    {
        foreach ($questions as &$question) {
            $words = explode(' ', $question);

            $words[0] = '?';

            $question = implode(' ', $words);
        }

        $keys = array_keys($questions);
        shuffle($keys);
        $result = [];
        foreach ($keys as $key) {
            $result[$key] = $questions[$key];

            $answers = $this->generateAnswers($key);

            $result[$key] = new Question($result[$key], $key,$answers);
        }

        return $result;
    }

    private function generateAnswers(int $inputNumber, int $count = 4, int $range = 3)
    {
        $randomArray = [];

        $randomArray[] = $inputNumber;

        for ($i = 1; $i < $count; $i++) {
            $offset = rand(-$range, $range);

            $randomArray[] = $inputNumber + $offset;
        }

        shuffle($randomArray);

        return $randomArray;
    }
}
