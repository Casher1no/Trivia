<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Trivia</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>

</head>
<body>
<div class="center-container">
    <form method="post" action="/game">
        <h2 class="question">Question</h2>
        <h4 class="question">{{ $correctAnswered }} / {{ $totalQuestions }}</h4>
        <h3 class="question" style="max-width: 600px">{{$question->question()}}</h3>

        @csrf
        <input type="hidden" name="questionCorrectAnswer" value="{{ $question->correctAnswer() }}">
        <input type="hidden" name="questionAnswers" value="{{ json_encode($question->answers()) }}">
        <input type="hidden" name="alreadyAnswered" value="{{ json_encode($answered ?? null) }}">
        <input type="hidden" name="question" value="{{ $question->question() }}">
        <div class="answers">
            @foreach($question->answers() as $answer)
                <input class="answer" type="submit" name="userAnswered" value="{{$answer}}">
            @endforeach
        </div>
    </form>
</div>

</body>
</html>
