<?php
// Meter proteccion contra el robo de sesiones y cookies
session_start();
if (isset($_SESSION['user'])) {
    //header('Location:http://a18marcosrg/carpinteria_online/pagina_usuario.php');
    header("Location: pagina_usuario.php");
  }
$mensaje="";
if (isset($_POST['user']) or isset($_POST['passwd'])) {
    if (isset($_POST['user']) and isset($_POST['passwd'])) {
        require_once 'bd.php';
        /* @var $bd Bd */
        $bd = new Bd();
        $resultado=$bd->validUser($_POST['user'], $_POST['passwd']);
        var_dump($resultado);
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
//readfile('menu/menu.html');

if ($mensaje!="") {
  echo <<<HTML
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
      <strong>Error! </strong>$mensaje
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
HTML;
}
echo <<<HTML
  <main class="container">
    <section class="row">
      <h1>Iniciar sesión:</h1>
      <div id="logo" class="col-sm">
      </div>
      <div class="col-sm">
      <form class="form" action="login.php" method="post">
        <div class="form-group">
          <label for="user" class="control-label">Usuario</label>
          <input type="text" class="form-control" placeholder="Nombre de usuario" name="user" id="user"/>
        </div>
        <div class="form-group">
          <label for="passwd" class="control-label" >Contraseña</label>
          <input type="password" name="passwd" id="passwd" class="form-control"/>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Entrar</button>
      </form>
      </div>
    </section>
   </main>
</body>
HTML;
