<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <style>
        body {
            box-sizing: border-box;
        }

        .btn {
            flex: 1;
            border: 1px solid;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
        }
    </style>
</head>
<body>
<main style="height: 100vh; display: flex;justify-content: center;align-items: center; text-align: center">
    <section>
        <h2 style="margin:0; text-transform: uppercase; font-size: 35px">
            Sample Laravel Application
        </h2>
        <div style="display: block; margin-top: 20px">
            <a class="btn" href="{{url('user')}}"> User List </a>
        </div>
    </section>
</main>
</body>
</html>
