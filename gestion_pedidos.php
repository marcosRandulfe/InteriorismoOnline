<?php
    readfile('./header.html');
    require_once './bd.php';
    require_once './pedido.php';
    $bd = new Bd();
    if(isset($_POST['name']) AND isset($_POST['passwd']) AND $bd->comprobarProductor($_POST['name'], $_POST['passwd'])){
        echo <<<EOF
        <main class="usuarios">
        <form action="./editar_pedido.php" method="post">
            <table>
                <caption>Pedidos</caption>
                <thead>
                    <tr><th>ID</th><th>Nombre</th><th>Descripcion</th><th>Borrar</th></tr>
                <thead>
                <tbody>
EOF;
    $pedidos = $bd->getAllPedidos();
    /* @var $pedido Pedido */
    foreach($pedidos as $pedido){
        echo '<tr><td>'.$pedido->getNumpedido().'</td><td>'.$pedido->getNombre().
         '</td><td>'.$pedido->getDescripcion()
         .'</td><td><button name="pedido" type="submit" value="'.$pedido->getNumpedido().'"/>Procesar</button></td></tr>';
    }
echo '
                </tbody>
            </table>
            </form>
        </main>';      
    }else{
 echo   '<main class="admin">
           <form class="callout text-center" action="#" method="post">
             <h2>Acceso productores</h2>
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
