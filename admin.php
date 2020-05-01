<?php
require_once './header.html';
?>
<main>
    <form name=" login" action="#" method="POST">
        <fieldset>
            <legend>
                Admin
            </legend>
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name"/>
            <label for="passwd">Contraseña</label>
            <input type="password" name="passwd" id="passwd"/>
            <button type="submit" name="submit">Enviar></button>
        </fieldset>
    </form>
</main>
<?php
require_once './footer.html';