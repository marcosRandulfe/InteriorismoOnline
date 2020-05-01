<?php
  session_start();
  readfile('header.html');
?>
    <!--  Start Hero Section  -->
    <section class="hero">
      <header>
        <div class="row">
          <nav class="top-bar" data-topbar role="navigation">
            <!--    Start Logo    -->
            <ul class="title-area">
              <li class="name">
                <a href="#" class="logo">
                  <h1>CARPÍNTERIA<span class="tld">online</span></h1>
                </a>
              </li>
                <span class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></span>
              </li>
            </ul>
            <!--    End Logo    -->

            <!--    Start Navigation Menu    -->
            <section class="top-bar-section" id="mean_nav">
              <ul class="right">
                <?php if (!isset($_SESSION['user'])): ?>
                  <li><a href="./login.php">Iniciar Sesisón</a></li>
                   <li><a href="./singup.php">Crear cuenta</a></li>
                <?php else:?>
                    <li><a href="./informacion_usuario">Hola: <?=$_SESSION['nombre']?></a></li>
                <?php endif; ?>
                <li><a href="#services">services</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
              </ul>
            </section>
            <!--    End Navigation Menu    -->
          </nav>
        </div>
      </header>

      <!--    Start Hero Caption    -->
      <section class="caption">
        <div class="row">
          <h1 class="mean_cap">Carpinteria online</hA>
          <h2 class="sub_cap">Económico y ecológico</h2>
          <a href="#" class="btn_details"><span>Mas detalles</span> <img src="img/btn_arrow.png" alt="" src="" class="arrow"></a>
        </div>
      </section>
      <!--    End Hero Caption    -->

    </section>
    <!--  End Hero Section  -->

    <section class="testimonials" id="testimonials">
      <div class="row">
        <div class="slider_container">
          <div class="caroufredsel_wrapper" style="display: block; text-align: start; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; z-index: auto; width: 670px; height: 321px; margin: 0px; overflow: hidden; cursor: move;"><div id="carousel" style="text-align: left; float: none; position: absolute; top: 0px; right: auto; bottom: auto; left: 0px; margin: 0px; width: 4690px; height: 321px; opacity: 1; z-index: auto;">

          <div class="tesimonial" style="width: 670px;">
              <img src="img/mashable.jpg" title="" alt="">
              <span class="name">Mashable_3</span>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              <span class="author">Alex Martin - CEO</span>
            </div><div class="tesimonial" style="width: 670px;">
              <img src="img/mashable.jpg" title="" alt="">
              <span class="name">Mashable</span>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              <span class="author">Alex Martin - CEO</span>
            </div><div class="tesimonial" style="width: 670px;">
              <img src="img/mashable.jpg" title="" alt="">
              <span class="name">Mashable_2</span>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              <span class="author">Alex Martin - CEO</span>
            </div></div></div>
        </div>

        <!--    Start Testimonials Pagination    -->
        <nav class="pagination" style="display: block;">

        <a href="#" class=""><span>1</span></a><a href="#" class=""><span>2</span></a><a href="#" class="selected"><span>3</span></a></nav>
        <!--    End Testimonials Pagination    -->

      </div>
    </section>
    <section class="quote map">
        <blockquote>
          <p>Mauris semper <span class="strong">lacus nunc</span> ultrices imperdiet. </p>
          <hr>
          <span class="author">john doe</span>
        </blockquote>
        <div class="shadow"></div>
      </section>
<?php
  readfile('footer.html');
?>