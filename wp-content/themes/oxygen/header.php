<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52560577-10', 'auto');
  ga('send', 'pageview');

</script>

    <title><?php wp_title('|', true, 'right'); ?></title>

    <?php

    wp_head();
    //número aleatorio para cambiar imagen Background
    //cambiar el numero final con la cantidad de imagenes que se quieran
    $ran =  rand(1,5);
    ?>
    <link rel="shortcut icon" href="http://www.condomcard.com/wp-content/uploads/2014/10/favicon.ico">
</head>
<body <?php body_class(); ?> onLoad="javascript:preloader()" style="background-image: url('<?php echo get_bloginfo('template_url').'/assets/images/background'.$ran.'.jpg'; ?>')">
<div class="wrapper-pop-up">
    <div class="close-contend"></div>
    <span class="nav-close">X</span>
    <div class="contend-pop-up">
        <h2>Suscribete ahora</h2>
        <p>Ingrese sus datos para recibir mas información acerca de nuestros productos, o registrese para acceder a la tienda UNIQUE. </p>
        <form method="post" class="register">

            <?php do_action( 'woocommerce_register_form_start' ); ?>

            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                <p class="form-row form-row-wide">
                    <label for="reg_username">
                        <?php _e( 'Username', 'woocommerce' ); ?>
                        <span class="required red">*</span>
                    </label>

                    <input type="text" class="input-text form-control" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
                </p>

            <?php endif; ?>

            <p class="form-row form-row-wide">
                <label for="reg_email">
                    <?php _e( 'Email address', 'woocommerce' ); ?>
                    <span class="required red">*</span>
                </label>

                <input type="email" class="input-text form-control" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
            </p>

            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                <p class="form-row form-row-wide">
                    <label for="reg_password">
                        <?php _e( 'Password', 'woocommerce' ); ?>
                        <span class="required red">*</span>
                    </label>

                    <input type="password" class="input-text form-control" name="password" id="reg_password" value="<?php if ( ! empty( $_POST['password'] ) ) echo esc_attr( $_POST['password'] ); ?>" />
                </p>

            <?php endif; ?>

            <!-- Spam Trap -->
            <div style="left:-999em; position:absolute;">
                <label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label>
                <input type="text" name="email_2" id="trap" tabindex="-1" />
            </div>

            <?php do_action( 'woocommerce_register_form' ); ?>
            <?php do_action( 'register_form' ); ?>

            <p class="form-row">
                <?php wp_nonce_field( 'woocommerce-register', 'register' ); ?>
                <input type="submit" class="button btn-default btn full-width-btn up" name="register" value="<?php _e( 'Register', 'woocommerce' ); ?>" />
            </p>

            <?php do_action( 'woocommerce_register_form_end' ); ?>

        </form>
    </div>
</div>
<?php if (is_front_page()): ?>
    <div class="preload-home">
        <div class="gif-preload">
            <img src="<?php bloginfo('template_directory'); ?>/images/loader.gif" alt=""/>
        </div>
    </div>
    <div>
        <ul id="slide-mm">
            <?php $home = new WP_Query('category_name=banner');
            $i = 0;
            while ($home->have_posts()) : $home->the_post();
                $select = ($i == 0) ? 'select-li' : '';
                ?>
                <li class="<?php echo($select) ?>" data-background="<?php
                $src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false, '');
                echo $src[0];
                ?>">
                    <!-- <figure  class="logo-fig .show-izq">
                        <img class="logo-q" src="<?php #echo get_post_meta($post->ID, 'logo', true); ?>" alt=""/>
                    </figure> -->
                    <div class="slide-contend show-move">
                        <?php the_content(); ?>
                    </div>
                </li>
                <?php $i++; endwhile; ?>

        </ul>
        <ul id="nav-slide">

        </ul>

    </div>

<?php endif; ?>
<?php if (function_exists('WC')): ?>
    <?php get_template_part('tpls/header-cart'); ?>
<?php endif; ?>

<?php if (!defined("NO_HEADER_MENU")): ?>

<div class="wrapper">

    <?php

    define("HAS_SLIDER", in_array('revslider/revslider.php', apply_filters('active_plugins', get_option('active_plugins'))) && function_exists("register_field_group") && ($revslider_id = get_field('revslider_id')));

    # Menu
    if (HEADER_TYPE == 1) {
        get_sidebar('menu');
    } else
        if (in_array(HEADER_TYPE, array(2, 3, 4))) {

            get_sidebar('menu-top');

            # Slider
            if (HAS_SLIDER) {
                if (is_search())
                    echo "<div style='height: 30px;'></div>";
                else
                    echo putRevSlider($revslider_id);
            }
        }
    if (!is_front_page()):
    ?>
    <?php endif;?>

         <div class="main<?php echo HEADER_TYPE == 1 && HAS_SLIDER ? ' hide-breadcrumb' : ''; ?>">

        <!--aqui juan no trabajo hoy, att maiki(quitado el header del inicio)-->
        <?php 
        if(!is_front_page()){
        get_template_part('tpls/breadcrumb'); }
        ?>

 

        <?php
        # Slider
        if (HEADER_TYPE == 1 && HAS_SLIDER):

            ?>
            <div class="rev-slider-container row">
                <?php echo putRevSlider($revslider_id); ?>
            </div>
        <?php

        endif;



        ?>

        <?php if (is_front_page()): ?>



        <?php endif; ?>
        <?php
        endif;
        ?>



