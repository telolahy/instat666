<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion - INSTAT</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
        <style>
            body {
                font-weight: lighter;
                font-family: Poppins, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                background-color: #f9f9f9;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
    
            .container {
                background-color: #f9f9f9;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: center;
                width: 500px;
            }
    
            .logo img {
                max-width: 120px;
                margin-bottom: 5px;
            }
    
            h2 {
                font-weight: lighter;
                margin-bottom: 20px;
                font-size: 20px;
            }
    
            h6 {
                font-weight: lighter;
                margin-bottom: 20px;
                font-size: 12px;
            }
    
            .form-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: 100%;
            }
    
            .form-container p {
                margin: 10px 0;
                font-size: 15px;
            }
    
            .btn {
                display: block;
                width: 100%;
                padding: 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
                margin-top: 10px;
                text-decoration: none;
                text-align: center;
            }
    
            .btn-secondary {
                width: 15%;
                padding: 10px;
                margin-top: 0;
                background-color: #000000;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 14px;
            }
    
            .btn-secondary:hover {
                background-color: #454444;
            }
        </style>
    
    </head>
    
    <body>
        <div>
            <div class="logo">
                <img src="{{ asset('assets/images/instat-logo.png') }}" alt="INSTAT Logo">
            </div>
            <div>
                <h2>Bienvenue sur la portail de Fichier des Etablissements</h2>
            </div>
            <div class="container">
                <div class="form-container">
                    <p>Identifiez-vous si vous avez un compte</p>
                    <a href="{{ route('login') }}" class="btn btn-secondary">Connexion</a>
                </div>
            </div>
            <div>
                <h6>Institut National de la Statistique - Madagascar
                    <a href="https://www.instat.mg"> www.instat.mg </a>
                </h6>
            </div>
        </div>
    </body>
    
    </html>