<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuenti</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <section class="login">
        <form class="form-login" action="#" method="post">
            <label class="label-email" for="email">Email</label> <label class="label-contrasenya" for="contrasenya">Contraseña</label><br>
            <input type="text" name="email" placeholder="Email">
            <input type="password" name="contrasenya" placeholder="Contraseña">
            <input class="boton-entrar" type="submit" value="Entrar">
            <div class="bajo-inputs">
                <div class="div-recordar">
                    <input type="checkbox" name="recordar" id="recordar">
                    <label id="label-recordar" class="label-recordar" for="recordar">Recordarme</label>
                </div>
                <div class="div-olvidado-contrasenya">
                    <a href="#">¿Has olvidado tu contraseña?</a>
                </div>
            </div>
        </form>
    </section>
    <main>
        <section class="que-es-tuenti">
            <div class="tuenti-contenido">
                <h1><img src="img/tuenti.png" alt="logo">tuenti</h1>
                <h2>¿Qué es Tuenti?</h2>
                <p>Tuenti es una plataforma social privada, a la que
                    se accede únicamente por invitación. Cada día la 
                    usan millones de personas para comunicarse 
                    entre ellas y compartir información.
                </p>
            </div>
        </section>
        <section class="social-local-movil">
            <div class="social-contenido">
                <img src="img/social.png" alt="social">
                <h5>Social</h5>
                <p>Conéctate, comparte y comunícate con tus amigos, compañeros de trabajo y familia.</p>
                <img src="img/local.png" alt="local">
                <h5>Local</h5>
                <p>Descubre servicios locales y participa con las marcas que realmente te importan</p>
            </div>
        </section>
    </main>
</body>
</html>