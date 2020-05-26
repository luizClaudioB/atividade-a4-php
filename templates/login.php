<?php

echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <script src="index.js"></script>
        <title>Index</title>
    </head>
    <body style="background-color: #f1e3cb; color: #ff8d03; font-family: Arial, Helvetica, sans-serif; margin: 5px;">
        <form action="index.php" method="POST">

            <h1 style="margin-top: 10%; margin-left: 40%" class="title">Admin - Só Seguros</h1>
            <h2 style="margin-left: 40%" class="title">Login</h2>

            <label style="color: #ff8d03; margin-top: 5%; margin-left: 22%;" for="lblEmail">Email:</label>
            <input style="margin-left: 40%; width: 21%" type="email" name="admin_name" 
            placeholder="Insira seu e-mail" id="txtEmail"/>
            <label id="lbl">

            <br>

            <label style="color: #ff8d03; margin-top: 5%; margin-left: 95%" for="lblPassword">Password:</label>
            <input style="margin-left: 95%; margin-bottom: 10%; width: 102%" type="password" name="password" 
            placeholder="Insira sua senha" id="txtPassword">

            <br>

            <input style="background-color: #ff8d03; color: white; width: 105%; height: 30%;
            margin-left: 96%" type="submit" value="Enter"/>

            <input style="display:none" name="operation" value="login"/>

        </form>
    </body>
    </html>

';
