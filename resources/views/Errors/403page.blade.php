<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Raleway:700);

        *,
        *:before,
        *:after {
            box-sizing: border-box;
        }

        html {
            height: 100%;
        }

        body {
            font-family: "Raleway", sans-serif;
            background-color: #342643;
            height: 100%;
            padding: 10px;
        }

        a {
            color: #ee4b5e !important;
            text-decoration: none;
        }

        a:hover {
            color: #ffffff !important;
            text-decoration: none;
        }

        .text-wrapper {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .title {
            font-size: 5em;
            font-weight: 700;
            color: #ee4b5e;
        }

        .subtitle {
            font-size: 40px;
            font-weight: 700;
            color: #1fa9d6;
        }

        .isi {
            font-size: 18px;
            text-align: center;
            margin: 30px;
            padding: 20px;
            color: white;
        }

        .buttons {
            margin: 30px;
            font-weight: 700;
            border: 2px solid #ee4b5e;
            text-decoration: none;
            padding: 15px;
            text-transform: uppercase;
            color: #ee4b5e;
            border-radius: 26px;
            transition: all 0.2s ease-in-out;
            display: inline-block;
        }

        .buttons:hover {
            background-color: #ee4b5e;
            color: white;
            transition: all 0.2s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="text-wrapper">
        <div class="title" data-content="404">
            403 - ACCESS DENIED
        </div>

        <div class="subtitle">
            Oops, You don't have permission to access this page.
        </div>
        {{-- <div class="isi">
            A web server may return a 403 Forbidden HTTP status code in response to a request from a client for a web
            page or resource to indicate that the server can be reached and understood the request, but refuses to take
            any further action. Status code 403 responses are the result of the web server being configured to deny
            access, for some reason, to the requested resource by the client.
        </div> --}}

        {{-- <div class="buttons">
            <a class="button" href="https://www.brodroid.com">Go to homepage</a>
        </div> --}}
    </div>
</body>

</html>
