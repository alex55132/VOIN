<div id="backgroundLogin" class="backgroundLogin hidden"></div>

<div id="loginFormContainer" class="loginForm hidden">
    <h1>IDENTIFICATE</h1>
    <form id="loginForm" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <label class="labelTextInput" for="email">Correo electrónico:</label>
        <input id="email" type="text" placeholder="Email" name="corr_usu">
        <label class="labelTextInput" for="password">Contraseña: </label>
        <input id="password" type="password" placeholder="Password" name="contr_usu">
        <div class="rememberCheckBoxContainer">
            <input class="rememberCheckBox" id="rememberCheckBox" name="rememberCheckBox" type="checkbox" value="remember"/>
            <label for="rememberCheckBox">Recuérdame</label>
        </div>

        <a class="forgotPassLink link" href="#">He olvidado mi contraseña</a>
        <p class="registerLink">¿No tienes cuenta? <a class="link" href="#" id="registerLink">Regístrate</a></p>
        <button class="submitBtn" type="button" onclick="login()">LOG-IN</button>
    </form>
    <div class="clearDiv"></div>
</div>

<div id="registerFormContainer" class="loginForm hidden">
    <h1>REGÍSTRATE</h1>
    <form id="registerForm" action="#">
        <label class="labelTextInput" for="usernameRegister">Nombre de usuario:</label>
        <input id="usernameRegister" type="text" placeholder="Username" name="registerUsername">
        <label class="labelTextInput" for="emailRegister">E-mail</label>
        <input id="emailRegister" type="text" placeholder="E-mail" name="registerEmail">
        <label class="labelTextInput" for="passwordRegister">Contraseña: </label>
        <input id="passwordRegister" type="password" placeholder="1 Mayuscula, 1 Minuscula, un numero y minimo 8 caracteres" name="password">
        <label class="labelTextInput" for="passwordRegister">Confirmar contraseña: </label>
        <input id="confirmPasswordRegister" type="password" placeholder="1 Mayuscula, 1 Minuscula, un numero y minimo 8 caracteres" name="registerConfirmPassword">

        <div class="termsConditionsCheckBoxContainer">
            <input class="termsConditionsCheckBox" id="termsConditionsCheckBox" name="termsConditionsCheckBox" type="checkbox" value="accept"/>
            <label for="termsConditionsCheckBox">Acepto los <span class="link">términos y condiciones </span> y la <span class="link">Política de Privacidad</span></label>
        </div>

        <button class="submitBtn" type="button" onclick="registro()">REGISTRARSE</button>
    </form>
    <div class="clearDiv"></div>
</div>
