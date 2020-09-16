<?php
require_once './bd.php';
readfile('./header.html');
$bd = new Bd();
if(isset($_POST['ruta']) AND isset($_POST['precio']) AND isset($_POST['pedido'])){
        $bd->updatePedido($_POST['pedido'],$_POST['ruta'],$_POST['precio']);
}
$pedido=$bd->getPedido($_POST['pedido']);
echo '<h2>Pedido: '.$pedido->getNombre().'</h2>';
echo '<h3>'.$pedido->getDescripcion().'</h3>';
echo '
<main class="usuarios">
        <form action="#" method="post">
                 <label>Ruta modelo</label>
                    <input type = "text" name="ruta" placeholder = "path">
                 </label>
                 <label>precio</label>
                    <input type ="number" name="precio">
                 </label>
                    <input type="hidden" name="pedido" value="'.$_POST['pedido'].'"/>
                <button type="submit" class="button">Enviar</button>
         </form>
         </main>
</body>
</html>';
