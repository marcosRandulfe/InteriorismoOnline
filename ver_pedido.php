<?php
session_start();
require_once 'pedido.php';
    readfile('header.html');
    echo '<section class="dark">';
    require ('./menu/menu.php');
    if(isset($_POST['pedido'])){
        require_once './bd.php';
        $bd = new Bd();
       $pedido= $bd->getPedido($_POST['pedido']);

  if($pedido!=null){
   echo '
    <div class="row aling-center">
        <div class="column small-12 large-8 card">
            <h1>Detalles del pedido</h1>
            <form action="./modelo3d.php" method="post">
            <ul>
                <li>Nombre:'.$pedido->getNombre().'</li>
                <li>Descripcion: '.$pedido->getDescripcion().'</li>
                <li>Estado diseño:'.$pedido->getDesing_state().'</li>
                <li>Estado de fabricación: '.$pedido->getFactory_state().'</li>
                <li>Ruta modelo:'.$pedido->getRuta_modelo().'<button type="submit" name="ruta" value="'.
                                    $pedido->getRuta_modelo().'">Ver modelo</button></li>
                <li>Precio:'.$pedido->getPrecio().'</li>
            </ul>
            </form>
        </div>
    </div>
   ';
  }
    }else{
        echo '<h1>A ocurrido un error</h1>';
    }

readfile('footer.html');
?>
