		<footer id="site-footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">

			<div class="container">

				<div id="widget-footer" class="clearfix row">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
					<?php endif; ?>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
					<?php endif; ?>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
					<?php endif; ?>
				</div>

				<?php jwdmc_footer_links(); ?>

				<div class="row">
					<div class="col-md-6 col-md-push-6 footer-right">
						<p class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.<br class="visible-xs"> Site by <a href="http://www.jenniferwebdesignlasvegas.com" target="_blank">Jennifer Web Design</a>.</p>
					</div>
					<div class="col-md-6 col-md-pull-6 footer-left">
						<p>Lorem ipsum dolor sit amet...</p>
					</div>
				</div>

			</div>

		</footer>

		<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
			<div class="slides"></div>
			<a class="prev">‹</a>
			<a class="next">›</a>
			<a class="close">×</a>
			<a class="play-pause"></a>
			<ol class="indicator"></ol>
		</div>

		<?php wp_footer(); ?>

	</body>

</html>
