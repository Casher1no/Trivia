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
    <div class="centered-content">
        <h2>You answered all questions correctly</h2>
        <h4>{{ $correctAnswered }} / {{ $totalQuestions }}</h4>
        <a href="{{ url('/') }}" class="button">Go Back</a>

    </div>
</div>

</body>
</html>
