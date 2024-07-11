<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Poppins, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fc;
            margin: 0;
        }

        .Auteur {
            display: flex; 
            margin-top: 1px;
        }

        h6 {
                font-weight: lighter;
                margin-bottom: 20px;
                font-size: 14px;

                 color: #000000; 
            }

        .label, .value {
            margin: 0; /* Enlève les marges par défaut des paragraphes */
            padding: 0 10px; /* Ajoute un peu de padding horizontal pour l'espacement */
        }


        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        

        .login-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .login-container label {
            display: block;
            margin-bottom: 8px;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #fff;
        }

        .login-container input:focus {
            outline: none;
            background-color: #fff;
        }

        .login-container button {
            width: 30%;
            padding: 10px;
            background-color: #000000;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: lighter;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        .login-container button:hover {
            background-color: #454444;
        }

        .login-container a {
            color: #1a73e8;
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        .logo {
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
        }

        .logo img {
            max-width: 120px;
        }
    </style>
</head>

<body>
    <div class="contenaire">
        <div class="logo">
            <img src="{{ asset('assets/images/instat-logo.png') }}" alt="Logo">
        </div>
        <div class="login-container">
            <div class="" id="erreur">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" id="div_text_error">
                        <span id="text_error" style="font-size: 12px;">{{ $error }}</span>
                    </div>
                @endforeach
            </div>
            <form class="login100-form validate-form" action="{{ route('authenticate') }}" method="get">
                {{ @csrf_field() }}
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700" for="password"><span>Mot de passe</span></label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">
                    Connexion
                </button>
            </form>
        </div>    

        <div class="Auteur">
            <p class="label">
                <h6>
                    Développés par:
                </h6>
            </p>
                
            <p class="value">
                <h6>
                    RAJOHNSON Magdella Emile, Chef SMRI/SEGIW
                    <br> 
                    TIANDRAINY Telolahy Daniel, Informaticien 
                    <br> 
                    NAMBININTSOA Andry Niaina, Informaticien
                </h6>
            </p>
        </div>
    </div>

</body>

</html>