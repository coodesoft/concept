<nav id="main_menu" class="navbar navbar-expand-md nav-light fixed-top">

    <a class="navbar-brand" href="#"><img class="brand-img  d-sm-block d-md-none" src="<?php echo wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' )[0]; ?>" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse center-margin" id="navbarCollapse">
      <div class="ingreso-registro-link"><a href="<?php echo get_site_url().'/my-account'; ?>">ingresar / registrarse</a></div>
      <img class="brand-img d-none d-md-block" src="<?php echo wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' )[0]; ?>" alt="">
      <?php
        $args = ['post_type' => 'page', 'orderby' => 'menu_order', 'order' => 'ASC'];
        $query = new WP_Query( $args );

        $locations = get_nav_menu_locations();
        $menu      = wp_get_nav_menu_object( $locations[ 'menu-1' ] );
        $menu_opc  = wp_get_nav_menu_items(wp_get_nav_menu_object( $menu->term_id));
      ?>
      <ul id="menu-principal" class="navbar-nav">

        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-20" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20 nav-item"><a title="Home" href="<?php echo get_site_url(); ?>#home" class="nav-link">Home</a></li>

        <?php
          $html = '';
          while ( $query->have_posts() ) : $query->the_post();

            if ($query->post->post_type != 'page')
              echo 'Chan!';
            elseif ($query->post->menu_order != 0){
              if (strpos(strtolower($query->post->post_title), 'oculto') === false){
                $enlace_title = ucfirst($query->post->post_name);
                $html .= '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-22" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-22 nav-item"><a title="'.$enlace_title.'" href="'.get_site_url().'#'.$query->post->post_name.'" class="nav-link">'.$query->post->post_title.'</a></li>';
              }
            }

          endwhile;

          for ($c=0; $c < count($menu_opc); $c++){
            $html .= '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-22" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-22 nav-item"><a title="Nosotros" href="'.$menu_opc[$c]->url.'" class="nav-link">'.$menu_opc[$c]->title.'</a></li>';
          }

          echo $html;
        ?>
      </ul>

    </div>
  </nav>
