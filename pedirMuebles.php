<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location:http://a18marcosrg/carpinteria_online/");
}
if (isset($_POST['tipo']) and isset($_POST['desc'])) {
    echo "dhjfhasjdhfahd";
    echo var_dump($_FILES);
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    require_once 'bd.php';
    require_once 'pedido.php';
    require_once 'usuario.php';
    $bd = new Bd();
    /* @var $usuario Usuario*/
    
    $usuario = unserialize($_SESSION['user']);
    echo "<br/>";
    echo "usuario<br/>";
    print_r($_SESSION['user']);
    echo "<br/>";
    $fotos= [];
    $fotos[]=$target_file;
    echo $usuario->getDni();
    $pedido = new pedido($usuario->getDni(), 0, $_POST['tipo'], $_POST['desc'], $fotos, 0, 0, 0);
    $bd->crearPedidos($pedido);
    $bd->close();
    header("Location:pagina_usuario.php");
}
readfile('header.html');
echo
<<<HTML
<body>
  <nav class="navbar navbar-light bg-light static-top">
    <div>
      <a class="navbar-brand" href="#">Carpinteria online</a>
    </div>
    <a href="http://a18marcosrg/carpinteria_online/cerrar.php">Cerrar Sesión</a>
  </nav>
HTML;
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
<main class="container seccion">
    <section class="row">

        <div id="logo" class="col-sm">
            <h1>Formulario pedido</h1>
        </div>
        <div id="formulario" class="col-sm">
            <form class="form container" name="pedidos" action="pedirMuebles.php" enctype="multipart/form-data"  
                  method="post">
                <div class="form-group">
                    <label for="tipo">Tipo de mueble</label>
                    <input list="tipo" value="" name="tipo" class="custom-select custom-select-sm">
                    <datalist id="tipo">
                        <option value="mesa">Mesa</option>
                        <option value="Estanteria">Estanteria</option>
                        <option value="Cama">Cama</option>
                    </datalist>
                    </input>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="desc">Descripción</label>
                        <textarea class="form-control form-control-sm" name="desc">
                
                        </textarea>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="fileToUpload">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="fileToUpload" class="custom-file-input" id="fileToUpload"/>
                        <label class="custom-file-label" for="inputFile">Escoja una foto</label>
                    </div>
                </div>
                <button class="btn btn-primary btn-lg btn-block" type="submit">Enviar</button>
        </div>

        </form>
        </div>
    </section>
</main>
<?php
readfile('footer.html');
?>    