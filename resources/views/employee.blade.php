<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Employee Data</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


    </head>
    <body>
        <form action="{{ route('storeData') }}" enctype="multipart/form-data" method="post">
            @csrf
            <input type="file" name="file" id="">
            <input type="submit" value="submit">
        </form>
    </body>
</html>
