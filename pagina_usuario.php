<?php
    require_once 'pedido.php';
    readfile('header.html');
?>
<!-- Navigation -->
    <nav class="navbar navbar-light bg-light static-top">
      <div class="container">
        <a class="navbar-brand" href="../index.html">Carpinteria online</a>
      </div>
         <a href="http://a18marcosrg/carpinteria_online/cerrar.php">Cerrar Sesión</a>
    </nav>

<main class="container">
<section>
    <h2>Pedidos</h2>
    <form name='tabla' action='pagina_usuario.php'>
        <table id="pedidos" class="table table-striped">
        <thead>
            <tr>
                <th>Número de pedido</th>
                <th>Nombre</th>
                <th>Estado de diseño</th>
                <th>Estado de fabricación</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
        <?php
             require_once 'bd.php';
             /* @var $bd bd*/
             $bd = new Bd();
             $pedidos = $bd->getPedidos();
             if (is_array($pedidos) and sizeof($pedidos)>0) {
                 foreach ($pedidos as $p) {
                     /* @var $p  pedido */
                     echo "<tr><td>".$p->getNumpedido()."</td>"
                            . "<td>".$p->getNombre()."</td><td>".
                            $p->getDesing_state()."</td><td>".
                            $p->getFactory_state()."</td>"
                             . "<td>"
                                . $p->getPrecio()
                             . "</td></tr>";
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
        <button type="button"class="btn btn-primary btn-lg btn-block" onclick="window.location.assign('http://a18marcosrg/carpinteria_online/pedirMuebles.php')">
            Realizar Pedido
        </button>
</section>
</main>
<?php
readfile('footer.html');
