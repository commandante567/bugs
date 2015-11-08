<header class="main-header">
  <div class="container">
        <div class="row top">
            <div class="col-md-12 city-nav top-item top-border">
                              
            </div>
        </div>
    <div class="row logo-area">
        <div class="col-md-7">
            <div class="logo">
                <h1><a href="/">СЭC.<span class="light-blue">Эксперт</span></a></h1>
                <span>Санкт-Петербургская<br>городская санитарная служба</span>
            </div>
            <div class="res">
                <span>Согласно федеральному закону  "О санитарно-эпидемиологическом благополучии населения"</span>
            </div>
        </div>
        <div class="col-md-5 contacts-main">
        <div class="phones">
                                <ul>
                    <li><a href="tel:88129233323">+7 (812) 925-33-23,</a></li>
			        <li><a href="tel:88129233323">+7 (812) 925-33-83</a></li>
                </ul>          
        </div>
            <div class="callback">
                   <span>Работаем 24 часа 7 дней в неделю</span>
 <a data-toggle="modal" data-target="#myModal" href="#">
                заказать звонок</a>
            </div>
        </div>
    </div>

  </div>
</header>

<div class="affix_place">
<div class="affix-wrap <?php if (is_front_page()) {echo 'front-affix' ;} ?>" id="affix-top-menu" >
    <nav class="main-nav-wrap" role="navigation">
    <div class="container">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav nav-justified main-nav', 'walker' => new Five_Sublevel_Walker]);
      endif;
?>
</div>
    </nav>
</div>
</div>
    
