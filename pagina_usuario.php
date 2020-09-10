<?php
    session_start();
    if (!isset($_SESSION['user'])) {
    header("Location:./login.php");
}
    require_once 'pedido.php';
    readfile('header.html');
    echo '<section class="dark">';
    require ('./menu/menu.php');
?>
<div class="row">
    <div class="small-12 large-12">
        <form name='tabla' action='./ver_pedido.php' method="post">
            <table id="pedidos" class="table hover striped stack">
              <caption>Pedidos</caption>
            <thead> 
                <tr>
                    <th>Número de pedido</th>
                    <th>Nombre</th>
                    <th>Estado de diseño</th>
                    <th>Estado de fabricación</th>
                    <th>Precio</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
            <?php
                 require_once 'bd.php';
                 /* @var $bd bd*/
                 $bd = new Bd();
                 require_once './usuario.php';
                 $usuario= unserialize($_SESSION['user']);
                 $pedidos = $bd->getPedidos($usuario->getId());
                 if (is_array($pedidos) and sizeof($pedidos)>0) {
                     foreach ($pedidos as $p) {
                         /* @var $p  pedido */
                         echo "<tr><td>".$p->getNumpedido()."</td>"
                                . "<td>".$p->getNombre()."</td><td>".
                                $p->getDesing_state()."</td><td>".
                                $p->getFactory_state()."</td>"
                                . "<td>"
                                . $p->getPrecio()
                    . '</td><td><button class="button secondary" type="submit" name="pedido" value="'.
                                 $p->getNumpedido().'"><i class="fa fa-edit"></i>Detalles</button></td></tr>';
                     }
                 } else {
                     echo <<<HTML
                     <tr>
                        <td colspan="5">Todavía no se ha realizado ningún pedido</td>
                     <tr>                 
HTML;
                 }
            ?>
            </tbody>
        </table>
        </form>
    </div>
</div>
<div class="row">
    <a href="pedirMuebles.php" class="button secondary small-12 large-12">Realizar Pedido</a>
</div>
   <!-- <div class="shadow"></div>-->
</section>
<?php
readfile('footer.html');