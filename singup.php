<?php
session_start();
if (isset($_POST['dni'])
         and isset($_POST['alias'])
         and isset($_POST['nombre_completo'])
         and isset($_POST['calle'])
         and isset($_POST['numero'])
         and isset($_POST['piso'])) {
    
    require_once 'Cliente.php';
    require_once 'bd.php';

    $usuario= new Cliente(
            -1,
        $_POST['alias'],
        $_POST['passwd'],
        $_POST['dni'],
        $_POST['nombre_completo'],
        $_POST['calle'],
        $_POST['numero'],
        $_POST['piso']
      );
    if ($usuario->valido()) {
        error_log("Usuario válido: ".var_export($usuario,true));
        $bd = new Bd();
        $usuario=$bd->crearCliente($usuario);
        $_SESSION['user']= serialize($usuario);
        header("Location: pagina_usuario.php");
       error_log("Sesión usuario".$_SESSION['user']);
    } else {
        error_log("usuario invalido");
        $formularioIncorrecto=true;
    }

    
}
    if (isset($_POST['dni']) or isset($_POST['alias']) or isset($_POST['nombre_completo']) or isset($_POST['calle']) or isset($_POST['numero']) or isset($_POST['piso'])) {
        $formularioIncorrecto=true;
    }
    readfile('header.html');
    echo <<<EOF
        <section class="hero map alto">
EOF;
    require_once('./menu/menu.php');
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
<div class="hero-background">
      <div class="row">
        <div class="columns small-12 medium-6">
      </div>
<div class="columns small-12 medium-6 ">
<div class="translucent-form-overlay">
  <form method="post" action="#">
    <h3>Crear cuenta</h3>
    <div class="row">
      <label class="columns">Alias usuario
        <input type="text" name="alias" placeholder="Alias"/>
      </label>
    </div>
    <div class="row">
      <label class="columns">Nombre y apellidos
        <input type="text" name="nombre_completo" placeholder="Nombre completo"/>
      </label>
    </div>
    <div class="row">
        <div class="columns large-6 small-12">
            <label>Contraseña
                <input type="password" name="passwd" placeholder="Contraseña"/>
            </label>
        </div>
        <div class="columns large-6 small-12">
            <label>Repita contraseña
                <input type="password" name="passwd_check" placeholder="Repita Contraseña"/>
            </label>
        </div>
    </div>
    <div class="row">
      <label class="columns">DNI
        <input type="text" name="dni" pattern="\d{8}\w" placeholder="EJ: 00000000A"/>
      </label>
    </div>
    <div class="row medium-unstack">
            <label class="columns">Calle
                <input type="text" name="calle"/>
            </label>
            <label class="columns">Número
                <input type="text" name="numero" />
            </label>
            <label class="columns">Piso
                <input type="text" name="piso"/>
            </label>
    </div>
    <div class="row">
        <div class="columns">
            <button type="submit" class="columns primary button expanded">
            Registrarse
            </button>
        </div>
    </div>
 </form>
</div>
</div>
<div class="shadow"></div>
</section>
HTML;
readfile('footer.html');
