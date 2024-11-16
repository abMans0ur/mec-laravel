<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MEC BACKEND 113</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background-color: navy;
            color: gold;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 50px;
        }

        form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 20px;

            input,
            select,
            button {
                padding: 14px 25px;
                border: none;
            }
        }
    </style>
</head>

<body>
    <header>Header</header>
    @yield('content')
    <footer>Footer</footer>
</body>

</html>
