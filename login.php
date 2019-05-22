<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Página de Login</title>
       <link rel="stylesheet" href="css/login/style.css">

</head>

<body>

    <div class="form">

        <ul class="tab-group">
            <li class="tab active"><a href="#login">Log In</a></li>
            <li class="tab"><a href="#signup">Sign Up</a></li>

        </ul>

        <div class="tab-content">
            <div id="login">
                <h1>Seja Bem Vindo!</h1>

                <form action="/" method="post">

                    <div class="field-wrap">
                        <label>
                            Email<span class="req">*</span>
                        </label>
                        <input type="email" required autocomplete="off" />
                    </div>

                    <div class="field-wrap">
                        <label>
                            Senha<span class="req">*</span>
                        </label>
                        <input type="password" required autocomplete="off" />
                    </div>

                    <p class="forgot"><a href="#">Esqueceu sua senha ?</a></p>

                    <button class="button button-block" />Entrar</button>

                </form>

            </div>
            <div id="signup">
                <h1>Registre-se Já</h1>

                <form action="/" method="post">

                    <div class="top-row">
                        <div class="field-wrap">
                            <label>
                                Primeiro Nome<span class="req">*</span>
                            </label>
                            <input type="text" required autocomplete="off" />
                        </div>

                        <div class="field-wrap">
                            <label>
                                Ultimo Nome<span class="req">*</span>
                            </label>
                            <input type="text" required autocomplete="off" />
                        </div>
                    </div>

                    <div class="field-wrap">
                        <label>
                            Email<span class="req">*</span>
                        </label>
                        <input type="email" required autocomplete="off" />
                    </div>

                    <div class="field-wrap">
                        <label>
                            Senha<span class="req">*</span>
                        </label>
                        <input type="password" required autocomplete="off" />
                    </div>

                    <button type="submit" class="button button-block" />Começe Agora</button>

                </form>

            </div>

        </div>
        <!-- tab-content -->

    </div>
    <!-- /form -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/login/index.js"></script>

</body>

</html>
