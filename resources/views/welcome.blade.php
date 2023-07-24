<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iBank - Welcome</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f7fafc;
        }

        .content {
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .logo {
            width: 200px;
            height: 200px;
            margin-bottom: 1.5rem;
            background-color: #101011;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 2rem;
            font-weight: bold;
        }

        .links a {
            color: #4a5568;
            text-decoration: none;
            margin: 0 0.5rem;
        }

        .links a:hover {
            color: #718096;
        }

        .text-container {
            text-align: justify;
            padding: 1rem;
            line-height: 1.5;
            margin: 0 auto;
            max-width: 1200px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="logo">iBank</div>
        <div>
            <h1 class="title">Welcome to iBank</h1>
        </div>
        <div class="text-container">
            <p>
                As Albert Einstein once said, "The only source of knowledge is experience." iBank embraces this
                philosophy by creating a seamless online banking experience
                that empowers customers to manage their finances with ease and confidence. By harnessing the power of
                technology and innovation,
                iBank takes Albert Einstein's words to heart and goes beyond traditional banking boundaries. We
                understand that true knowledge comes from firsthand experience,
                and that's why we have designed our online banking platform to be user-friendly, intuitive, and
                feature-rich. With just a few clicks, customers can access a wealth of financial tools and services,
                including seamless money transfers, detailed transaction histories, customizable budgeting tools, and
                real-time account monitoring. We believe that by providing a seamless online banking experience,
                we empower our customers to make informed financial decisions, take control of their money, and embark
                on a path towards financial success.
                At iBank, we strive to create a banking experience that not only meets our customers' needs but exceeds
                their expectations, paving the way for a brighter financial future.
            </p>
        </div>
        <div class="links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    </div>
</div>
</body>
</html>
