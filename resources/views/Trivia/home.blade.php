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
        @if(!empty($error))
            <a class="error">{{$error}}</a>
        @endif
        <h2>Start New Game</h2>
        <a href="{{ url('/game') }}" class="button">Start</a>
    </div>
</div>
</body>
</html>
