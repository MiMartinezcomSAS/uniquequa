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

    <title><?php wp_title('|', true, 'right'); ?></title>

    <?php

    wp_head();
    ?>
</head>
<body <?php body_class(); ?> onLoad="javascript:preloader()">
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

        #aqui juan no trabajo hoy, att maiki(quitado el header del inicio)
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



