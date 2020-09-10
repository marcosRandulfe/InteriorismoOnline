<?php
  session_start();
  readfile('header.html');
?>
<!--  Start Hero Section  -->
<!-- Menú nuevo -->
<!-- Start of body below -->
<section class="hero">
        <?php require_once './menu/menu.php'; ?>
        <!--    Start Hero Caption    -->
        <section class="caption">
            <div class="row columns">
                <h1 class="mean_cap">Interiorismo online</h1>
                <h2 class="sub_cap">Económico y ecológico</h2>
                <a href="#info" class="btn_details"><span class="secondary">Mas detalles</span> <img src="dist/assets/img/btn_arrow.png" alt="" 
                        class="arrow"></a>
            </div>
        </section>
        <!--    End Hero Caption    -->
    </section>
    <!--  End Hero Section  -->
    <!--  Social network section -->
        <div class="social-links">
          <div class="row">
            <div class="small-6 medium-3 columns text-center mobile-stack">
              <a href="https://www.facebook.com/"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a>
            </div>
            <div class="small-6 medium-3 columns text-center mobile-stack">
              <a href="https://www.instagram.com/?hl=en"><i class="fa fa-instagram" aria-hidden="true"></i>Instagram</a>
            </div>
            <div class="small-6 medium-3 columns text-center mobile-stack">
              <a href="https://www.pinterest.com/"><i class="fa fa-pinterest-p" aria-hidden="true"></i>Pinterest</a>
            </div>
            <div class="small-6 medium-3 columns text-center mobile-stack">
              <a href="https://twitter.com/?lang=en"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a>
            </div>
          </div>
        </div>
    <!--  End of social network section -->
    <section id="info" class="quote map">
        <blockquote>
            <p>El buen <span class="strong">diseño</span> consiste en convertir <span class="strong">sueños</span> en realidad</p>
            <hr>
            <span class="author">John Saladino</span>
        </blockquote>
        <div class="shadow"></div>
    </section>
<?php
  readfile('footer.html');
?>
