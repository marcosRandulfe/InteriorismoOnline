<?php
if(!isset($_SESSION['user'])){
header("HTTP/1.0 401 Unauthorized");
}else{
  readfile('header.html');
  echo <<<HTML
  <body>
    <!-- Navigation -->
<nav class="navbar navbar-light bg-light static-top">
  <div class="container">
    <a class="navbar-brand" href="#">Carpinteria online</a>

  </div>
</nav>


  </body>
  </html>
HTML;
}
