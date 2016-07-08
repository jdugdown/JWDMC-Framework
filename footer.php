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

		<?php wp_footer(); ?>

	</body>

</html>
