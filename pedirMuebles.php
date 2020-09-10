<?php
session_start();

$urls_fotos=[];

function random_filename($length, $directory = '', $extension = ''){
    // default to this files directory if empty...
    $dir = !empty($directory) && is_dir($directory) ? $directory : dirname(__FILE__);

    do {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
    } while (file_exists($dir . '/' . $key . (!empty($extension) ? '.' . $extension : '')));

    return $key . (!empty($extension) ? '.' . $extension : '');
}

if (!isset($_SESSION['user'])) {
    header("Location:./login.php");
}

if (isset($_POST['tipo']) and isset($_POST['desc'])) {
    $target_dir = "uploads/";
    for($i=0; $i<count($_FILES["fileToUpload"]["name"]); $i++){
        $foto_subida=$_FILES["fileToUpload"]["name"][$i];
        $nombre_base = basename($_FILES["fileToUpload"]["name"][$i]);
        $uploadOk = 1;
        
        $imageFileType = strtolower(pathinfo($nombre_base, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
        if ($check !== false) {
            error_log("File is an image - " . $check["mime"] . ".");
            $uploadOk = 1;
        } else {
            error_log("El archivo $nombre_base no es una imágen.");
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"][$i] > 500000) {
            echo "Tu foto es muy grande";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" 
                && $imageFileType != "jpeg" && $imageFileType != "gif") {
            error_log("Solo se admiten JPG, JPEG, PNG & GIF.");
        $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            error_log("No se ha podido subir la foto $nombre_base.");
        // if everything is ok, try to upload file
        } else {
            $target = $target_dir.random_filename(20,$target_dir,$imageFileType);
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target)) {
                $urls_fotos[]=$target;
                error_log("The file ". basename($_FILES["fileToUpload"]["name"][$i]). " has been uploaded.");
            } else {
                error_log("Sorry, there was an error uploading your file.");
            }
        }
    }
   
    require_once 'bd.php';
    require_once 'pedido.php';
    require_once 'usuario.php';
    $bd = new Bd();
    /* @var $usuario Usuario*/
    $usuario = unserialize($_SESSION['user']);
    $cliente=$bd->getCliente($usuario);
    new pedido($numpedido, $id_usuario, $id_productor, $nombre, $descripcion,
            $desing_state, $factory_state, $ruta_modelo, $precio, $urls_fotos);
    $pedido = new pedido(-1,$usuario->getId(), -1,$_POST['tipo'],$_POST['desc'], 0, 0,"", 0,$urls_fotos);
    $bd->crearPedidos($usuario,$pedido);
    $bd->close();
    header("Location:pagina_usuario.php");
}
readfile('header.html');
echo '<section class="dark">';
require_once './menu/menu.php';

if (isset($formularioIncorrecto) and $formularioIncorrecto == true) {
    echo <<<HTML
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Error!</strong> Debe de completar correctamente todos los datos
  <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
HTML;
}
?>
    <section>
        <div id="formulario">
            <form class="form container" name="pedidos" action="#" enctype="multipart/form-data"
                  method="post">
                <div class="row">
                    <label class="small-12 medium-12 large-12" for="tipo">Tipo de mueble</label>
                        <input list="tipo" value="" id="tipo" name="tipo" class="small-12 medium-12 large-12"/>    
                            <datalist id="tipo">
                                <option value="mesa">Mesa</option>
                                <option value="Estanteria">Estanteria</option>
                                <option value="Cama">Cama</option>
                            </datalist>
                </div>
                <div class="row colums">
                    <label class="small-12 medium-12 large-12">Descripción
                        <textarea name="desc"></textarea>
                    </label>
                </div>
                <!-- class="show-for-sr" -->
                <div class="row">
                    <span id="imagenes" class="row columns small-12 medium-6 large-8">
                       
                    </span>
                </div>
                <div class="row align-right">
                    <label for="fileUpload" class="small-12 large-4 medium-6 button column">Subir fichero</label>
                    <input type="file" id="fileUpload" name="fileToUpload[]" multiple="multiple" class="show-for-sr"/>
                </div>
                <div class="row">
                    <button class="button secondary small-12 large-12 medium-12" type="submit">Enviar</button>
                </div>
        </form>
        </div>
    </section>
</section>
<?php
readfile('footer.html');
?>