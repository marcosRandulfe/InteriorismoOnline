<?php
    require_once './bd.php';
    readfile('./header.html');
    $bd = new Bd();
    $usuario_valido="";
        if(isset($_POST['delete'])){
            $bd->eliminarUsuario($_POST['delete']);
        }
        if((isset($_POST['name']) AND isset($_POST['passwd']))){
            $usuario_valido=$bd->comprobarAdmin($_POST['name'], $_POST['passwd']);    
        }
        if((isset($_POST['delete']) AND $usuario_valido)
            OR  (isset($_POST['name']) AND isset($_POST['passwd']) AND $usuario_valido)){         
echo  <<<EOF
       <main class="usuarios">
        <form action="#" method="post">
            <table>
                <caption>Usuarios</caption>
                <thead>
                    <tr><th>ID</th><th>Nombre</th><th>Borrar</th></tr>
                <thead>
                <tbody>
EOF;
   
    $bd = new Bd();
    $usuarios = $bd->listarUsuarios();
    /* @var $user Usuario */
    foreach ($usuarios as $user){
        echo '<tr><td>'.$user->getId().'</td><td>'.$user->getNombre()
               .'</td><td><button name="delete" type="submit" value="'.$user->getId().'"/>Borrar</button></td></tr>';
    }
echo '
                </tbody>
            </table>
            </form>
        </main>';

    }else{
 echo   '<main class="admin">
           <form class="callout text-center" action="#" method="post">
             <h2>Acceso administradores</h2>
             <div class="floated-label-wrapper">
               <label for="full-name">Nombre usuarios</label>
               <input type="text" id="full-name" name="name" placeholder="Nombre completo">
             </div>
             <div class="floated-label-wrapper">
               <label for="pass">Password</label>
               <input type="password" id="pass" name="passwd" placeholder="Password">
             </div>
             <input class="button expanded" type="submit" value="Entrar"/>
           </form>
       </main>';
    }
?>
<script type="text/javascript" src="src/assets/js/jquery.js"></script>
<script type="text/javascript" src="./dist/assets/js/app.js"></script>
</body>
</html>