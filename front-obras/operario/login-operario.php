<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link CSS -->
    <link rel="stylesheet" href="css/login-adm-style.css">
    <title>Login Operário</title>
</head>

<body>
    <div class="container-login">
        <div class="img-box">
            <img src="img/adm-login.jpg">
        </div>
        <div class="content-box">
            <div class="form-box">
                <h2>Bem-vindo, Operário!</h2>
                <form action="../controladores/login/loginoperario.php" method="post">
                    <div class="input-box">
                        <span>Usuário</span>
                        <input type="text" placeholder="User" name="usuario">
                    </div>

                    <div class="input-box">
                        <span>Senha</span>
                        <input type="password" placeholder="Senha" name="senha">
                    </div>

                    <div class="remember">
                        <label>
                            <input type="checkbox"> Lembrar sessão
                        </label>
                        <a href="#">Esqueceu a Senha?</a>
                    </div>

                    <div class="input-box">
                        <input type="submit" value="Entrar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
