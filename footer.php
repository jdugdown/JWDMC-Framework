			<footer id="site-footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">

				<div id="widget-footer" class="clearfix row">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
					<?php endif; ?>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
					<?php endif; ?>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
					<?php endif; ?>
				</div>

				<?php jwdmc_footer_links(); // Adjust using Menus in Wordpress Admin ?>

				<div class="row">
					<div class="col-md-6 col-md-push-6">
						<p class="footer-right">Developed by <a href="http://www.jenniferwebdesignlasvegas.com" target="_blank">Jennifer Web Design</a></p>
					</div>
					<div class="col-md-6 col-md-pull-6">
						<p class="footer-left">&copy; <?php bloginfo('name'); ?></p>
					</div>
				</div>

			</footer> <!-- end footer -->

		</div> <!-- end #container -->

		<!--[if lt IE 7 ]>
			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->

		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>