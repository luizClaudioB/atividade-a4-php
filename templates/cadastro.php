<?php

echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="default.css">
        <script src="index.js"></script>
        <title>Cadastro</title>
    </head>
    <body onload="Layout.getInstance().getBrokersForm()">
        <nav style="background: #e3d2b6">
            <h2 style="margin-left: 40%;">Admin - Só Seguros</h2>
            <div class="menu-item" style="width:5%; color:white; background:#ff8d03; margin-left:10px" onclick="Session.getInstance().logout()">Logout</div>
        </nav>
        <main>

            <div style="background: #f1e3cb; border: 20px solid #e3d2b6;" class="form-wrapper">
                <form id="broker-form">
                <label style="color: #ff8d03; font-size:20px; 
                font-weight:bold; text-decoration: underline;">Corretores</label>
                    <div class=\'form-control\'>
                        <label style="color: #ff8d03" for="email">Nome</label>
                        <input id="broker-name">
                    </div>
                    
                    <div class=\'form-control\'>
                        <label style="color: #ff8d03" for="password">Tipo de Seguro</label>
                        <input type="text" id="insurance-type">
                    </div>

                    <div class=\'form-control\'>
                        <button class="btn btn-login" onclick="Session.getInstance().sendCRUDRequest(\'create\', \'broker\')">Cadastrar</button>
                        <button class="btn btn-login" onclick="Session.getInstance().sendCRUDRequest(\'query\', \'broker\')">Consultar</button>
                    </div>
                </form>
        
                <form id="admin-form">
                <label style="color: #ff8d03; font-size:20px; 
                font-weight:bold; text-decoration: underline;">Administradores</label>
                    <div class=\'form-control\'>
                        <label style="color: #ff8d03" for="email">Usuario (E-mail)</label>
                        <input type="email" id="admin_name">
                    </div>
                    
                    <div class=\'form-control\'>
                        <label style="color: #ff8d03" for="password">Senha</label>
                        <input type="password" id="password">
                    </div>

                    <div class=\'form-control\'>
                        <button class="btn btn-login" onclick="Session.getInstance().sendCRUDRequest(\'create\', \'admin\')">Cadastrar</button>
                        <button class="btn btn-login" onclick="Session.getInstance().sendCRUDRequest(\'query\', \'admin\')">Consultar</button>
                    </div>
                </form>
        
                <form id="customer-form">
                <label style="color: #ff8d03; font-size:20px; 
                font-weight:bold; text-decoration: underline;">Compradores</label>
                    <div class=\'form-control\'>
                        <label style="color: #ff8d03" for="email">Nome</label>
                        <input type="text" id="customer-name">
                    </div>
                    
                    <div class=\'form-control\'>
                        <label style="color: #ff8d03" for="password">Localidade</label>
                        <input type="text" id="customer-location">
                    </div>

                    <div class=\'form-control\'>
                        <button class="btn btn-login" onclick="Session.getInstance().sendCRUDRequest(\'create\', \'customer\')">Cadastrar</button>
                        <button class="btn btn-login" onclick="Session.getInstance().sendCRUDRequest(\'query\', \'customer\')">Consultar</button>
                    </div>
                </form>
            </div>
        </main>
    </body>
    </html>
';