<?php
if(!isset($_SESSION['user'])){
header("HTTP/1.0 401 Unauthorized");
}else{
  readfile('header.html');
  require_once './menu/menu.php';
  //Mostrar la informacion para cada usuario en función del tipo de usuarios que sea 
  readfile('footer.html');
}
