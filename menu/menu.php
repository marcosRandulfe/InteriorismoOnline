<?php

function navlogon() {
    if (!isset($_SESSION['user'])) {
        echo <<<EOF
                <li><a href="./login.php">Iniciar sesión</a></li>
                <li><a href="./singup.php">Registrar cuenta</a></li>
EOF;
    } else {
        require_once 'usuario.php';
        require_once 'Cliente.php';
        $usuario=unserialize($_SESSION['user']);
        /* @var $usuario Cliente */
        echo '<li><a href="./pagina_usuario.php">'.$usuario->getNombre().'</a></li>';
    }
}
?>
<header>
    <nav>
        <div class="responsive-nav-social-mobile" data-responsive-toggle="responsive-nav-social" data-hide-for="medium">
            <div class="responsive-nav-social-mobile-left">
                <ul class="menu menu-hover-lines">
                    <?php   
                      navlogon();
                    ?>
                </ul>
            </div>
            <div class="responsive-nav-social-mobile-right">
                <button class="menu-icon" type="button" data-toggle="responsive-nav-social"></button>
            </div>
            </div>
            <div data-sticky-container>
                <div class="responsive-nav-social" id="responsive-nav-social"  data-options="marginTop:0;">
                    <div class="row align-justify align-middle" id="responsive-menu">
                        <div class="responsive-nav-social-left">
                            <ul class="menu menu-hover-lines vertical medium-horizontal">
                                <li class="active name">
                                    <a href="./index.php" class="">
                                        INTERIORISMO<span class="tld">online</span>
                                    </a>
                                </li>
                                <li><a href="./sobre-nosotros.php">Sobre nosotros</a></li>
                                <li><a href="./contacto.php">Contacto</a></li>
                            </ul>
                        </div>
                        <div class="responsive-nav-social-right hide-for-small-only">
                            <ul class="menu menu-hover-lines">
                               <?php
                                    navlogon();
                               ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </nav>
</header>
