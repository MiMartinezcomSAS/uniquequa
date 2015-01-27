<?php
/**
 *	Oxygen WordPress Theme
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

?>
		<!-- Sidebar Menu -->
		<div class="main-sidebar<?php echo get_data('header_menu_search') ? ' has-search' : ''; ?>">
		
			<div class="sidebar-inner">

			    <div class="lang">
        <a href="http://www.condomcard.com/">Español</a>
        <a href="http://en.condomcard.com/">Ingles</a>
   				 </div>
			
				<?php get_template_part('tpls/logo'); ?>
				
				<div class="sidebar-menu<?php echo get_data('sidebar_menu_links_display') == 'Collapsed' ? ' collapsed-subs' : ''; ?>">
				<?php
					$args = array(
						'theme_location' => 'main-menu',
						'container' => '',
						'menu_class' => 'nav',
						'walker' => new Main_Menu_Walker()
					);
					
					wp_nav_menu($args);
				?>
				</div>

				<hr/>
				<div id="shopping">


        <div class="inline"><a href="<?php echo WC()->cart->get_cart_url(); ?>">
            <h4>Carro de compras</h4>
            <div class="cart-sub-total">
   			<?php _e('Subtotal', TD); ?>: 
   			<span><?php echo WC()->cart->get_cart_subtotal(); ?></span>
   		</div>
   		</div>
        <span class="span">►</span></a>
    </div>

    <hr/>
                <div id="subscribe-sidebar" class="subscribe-sidebar">
                    Suscríbete 
                </div>
			</div><!-- /sidebar-inner -->
			
			
			<?php if(get_data('header_menu_search')): ?>
			<form action="<?php echo home_url(); ?>" method="get" class="search" enctype="application/x-www-form-urlencoded">
				<input type="text" class="search_input" name="s" alt="" placeholder="<?php _e('Search...', TD); ?>" value="<?php echo esc_attr(get('s')); ?>" /> 
				<span class="glyphicon glyphicon-search float_right"></span>
			</form>
			<?php endif; ?>
            <div class="footer-sidebar">
                <nav id="network">
                    <ul>
                        <li><a href="https://www.facebook.com/uniquecondones"target="_blank"><span class="icon-facebook"></span></a></li>
                        <li><a href="https://twitter.com/CondonesUnique"target="_blank"><span class="icon-twitter"></span></a></li>
                        <li><a href="https://www.youtube.com/channel/UCFB2bB7TpttDEuuCT4rZSHw"target="_blank"><span class="icon-youtube"></span></a></li>
                    </ul>
                </nav>
                <p class="first"> ©Unique Condoms - 2014 </p>

                <p> Todos los derechos reservados </p>
                <hr/>
                <p>Diseño y desarrollo web: <a href="http://mi-martinez.com" target="_blank" alt="Agencia de publicidad en Bogotá" > <span
                            class="icons-fuentelogo"></span></a></p>
            </div>

		</div><!-- /sidebar -->
		
