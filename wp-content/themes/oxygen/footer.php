
	
	<?php if( ! defined("NO_FOOTER_MENU")): ?>
	
			<?php get_template_part('tpls/footer-main'); ?>
			
		</div>
		
	</div>
	
	<?php endif; ?>
	
	
	<?php if(isset($post) && in_array($post->page_template, array('contact.php')) && in_array(HEADER_TYPE, array(2,3,4))): ?>
	<div class="wrapper-contact">
		
		<?php define("SHOW_FOOTER", 1); ?>
		
		<div class="main">
			<?php get_template_part('tpls/footer-main'); ?>
		</div>
		
	</div>
	<?php endif; ?>
	
<?php wp_footer();
if(is_front_page()):
?>

    <?php
endif;
?>
    <div class="footer-sidebar-responsive">
        <nav id="network">
            <ul>
                <li><a href="https://www.facebook.com/uniquecondones"><span class="icon-facebook"></span></a></li>
                <li><a href="https://twitter.com/CondonesUnique"><span class="icon-twitter"></span></a></li>

                <li><a href="#"><span class="icon-youtube"></span></a></li>
            </ul>
        </nav>
        <p class="first"> ©Unique Condoms - 2014 </p>

        <p> Todos los derechos reservados </p>

        <p>Diseño y desarrollo web: <a href="http://mi-martinez.com" target="_blank" title="Agencia de publicidad en Bogota" alt="Agencia de publicidad en Bogota"> <span
                    class="icons-fuentelogo"></span></a></p>
    </div>
    <script src="<?php bloginfo('template_directory'); ?>/js/script.js"></script>
    <script>
        var submenu = document.querySelectorAll('.sub-menu li');

        for(i = 0 ; i<submenu.length;i++){
            link = submenu[i].querySelector('a');
            color = link.getAttribute('title');

            link.addEventListener("mouseover", function(){
                color = this.querySelector('div').dataset.color;
                this.style.color = color;
            }, false);
            link.addEventListener("mouseout", function(){this.style.color = '#8f8f8f';}, false);

        }
    </script>

</body>
</html>