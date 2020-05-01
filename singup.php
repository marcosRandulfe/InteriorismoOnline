<?php
session_start();
if (isset($_POST['dni'])
         and isset($_POST['nombre'])
         and isset($_POST['apellidos'])
         and isset($_POST['calle'])
         and isset($_POST['numero'])
         and isset($_POST['piso'])) {
    if (isset($_POST['num_tarjeta'])) {
        $num_tarjeta= $_POST['num_tarjeta'];
    } else {
        $num_tarjeta="-1";
    }
    require_once 'usuario.php';
    require_once 'bd.php';
    /*@var $usuario Usuario*/

    $usuario= new Usuario(
        $_POST['dni'],
        $_POST['passwd'],
        $_POST['nombre'],
        $_POST['apellidos'],
        $_POST['calle'],
        $_POST['numero'],
        $_POST['piso'],
        $num_tarjeta
      );
    if ($usuario->valido()) {
        var_dump($usuario);
    } else {
        echo  "usuario invalido";
    }

    $bd = new Bd();
    $bd->crearUsuario($usuario);
    $_SESSION['user']= json_encode($usuario);
    header('Location: ./pagina_usuario.php');
} else {
    if (isset($_POST['dni']) or isset($_POST['nombre']) or isset($_POST['apellidos']) or isset($_POST['calle']) or isset($_POST['numero']) or isset($_POST['piso'])) {
        $formularioIncorrecto=true;
    }
    readfile('header.html');
    echo <<<HTML
<body>
  <nav class="navbar navbar-light bg-light static-top">
    <div>
      <a class="navbar-brand" href="#">Carpinteria online</a>
    </div>
  </nav>
HTML;
    if (isset($formularioIncorrecto) and $formularioIncorrecto==true) {
        echo <<<HTML
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Error!</strong> Debe de completar correctamente todos los datos
  <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
HTML;
    }
    echo <<<HTML
  <main class="container seccion">
  <section class="row">

   <div id="logo" class="col-sm">
         <h1>Formulario de registro</h1>
   </div>
   <div id="formulario" class="col-sm">
  <form class="form container" name="singup" action="singup.php" method="post">
    <div class="form-group">
      <label for="dni">DNI</label>
    <input class="form-control form-control-sm" type="text" id="dni" name="dni" placeholder="Ej.: 33838338a"/>
    </div>
    <div class="row">
        <div class="form-group col">
            <label for="passwd">Contraseña</label>
            <input class="form-control form-control-sm" type="password" id="passwd" name="passwd" />
        </div>
        <div class="form-group col">
            <label for="passwd_check">Repita contraseña</label>
            <input class="form-control form-control-sm" type="text" id="confirm" name="confirm"/>
        </div>
    </div>
    <div class="row">
    <div class="form-group col">
      <label for="nombre">Nombre</label>
    <input class="form-control form-control-sm" type="text" id="nombre" name="nombre" placeholder="Introduzca su nombre"/>
    </div>
    <div class="form-group col">
      <label for="apellidos">Apellidos</label>
      <input type="text" class="form-control form-control-sm" name="apellidos" id="apellidos"/>
    </div>
  </div>
  <div class="row">
    <div class="form-group col">
      <label for="calle">Calle</label>
      <input type="text" id="calle" class="form-control form-control-sm"  name="calle"/>
    </div>
    <div class="form-group col">
        <label for="numero">Número</label>
        <input type="number" id="numero" class="form-control form-control-sm"  name="numero"/>
    </div>
    <div class="form-group col">
        <label for="piso">Piso</label>
        <input type="text" id="piso"  name="piso" class="form-control form-control-sm"/>
    </div>
  </div>
      <button class="btn btn-primary btn-lg btn-block" type="submit">Registro</button>
  </form>
  </div>
</section>
</main>
HTML;
}
readfile('footer.html');
