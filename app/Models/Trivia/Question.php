<?php

namespace App\Models\Trivia;

class Question
{
    private string $question;
    private array $answers;
    private string $correctAnswer;

    public function __construct(string $question, string $correctAnswer, array $answers)
    {
        $this->question = $question;
        $this->answers = $answers;
        $this->correctAnswer = $correctAnswer;
    }

    public function question(): string
    {
        return $this->question;
    }

    public function answers(): array
    {
        return $this->answers;
    }

    public function correctAnswer(): string
    {
        return $this->correctAnswer;
    }
}
