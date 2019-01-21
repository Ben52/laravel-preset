<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <title>My App</title>

</head>
<body>
<div id="main"></div>
<script src="{{ mix('js/app.js') }}"></script>
<script>
    Elm.Main.init({ node: document.getElementById('main'), flags: { user: @json(auth()->user()), token: "{{ csrf_token() }}" } });
</script>
</body>
</html>
