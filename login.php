<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: pagina_usuario.php");
}
$mensaje="";
if (isset($_POST['user']) or isset($_POST['passwd'])) {
    if (isset($_POST['user']) and isset($_POST['passwd'])) {
        require_once 'bd.php';
        $bd = new Bd();
        $resultado=$bd->validUser($_POST['user'], $_POST['passwd']);
        error_log("VarDump usuario valido".var_export($resultado,true));
        if ($resultado != false) {
            $_SESSION['user']= serialize($resultado);
            $_SESSION['nombre']=$resultado->getNombre();
            header("Location: pagina_usuario.php");
        } else {
            $mensaje= "Usuario o contraseña incorrecto";
        }
    } else {
        $mensaje = "Debe de completar todos los campos";
    }
}
readfile('header.html');
echo <<<EOF
<section class="hero map">
EOF;
require_once('./menu/menu.php');
if ($mensaje!="") {
  echo <<<HTML
    <div data-alert class="alert-box">
        $mensaje
      <a href="#" class="close">&times;</a>
    </div>
HTML;
}
echo <<<HTML
<!-- Formulario nuevo -->
<div class="hero-background">
      <div class="row">
        <div class="columns small-12 medium-8">
        </div>
        <div class="columns small-12 medium-4">
          <div class="translucent-form-overlay">
            <form action="#" method="post">
              <h3>Log in</h3>
              <div class="row columns">
                <label>Usuario
                  <input type="text" name="user" placeholder="Nombre">
                </label>
              </div>
              <div class="row columns">
                <label>Contraseña
                  <input type="password" name="passwd" placeholder="Password">
                </label>
              </div>
              <button type="submit" class="primary button expanded search-button">
                Iniciar sesión
              </button>
           </form>
          </div>
        </div>
      </div>
    </div>
  <div class="shadow"></div>
</section>
HTML;
readfile('footer.html');
?>

