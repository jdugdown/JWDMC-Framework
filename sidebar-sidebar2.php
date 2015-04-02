				<div id="sidebar2" class="col-md-4" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">

					<?php if ( is_active_sidebar( 'sidebar2' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar2' ); ?>
					<?php else : ?>
						<div class="alert alert-info">
							<p><?php _e("Please activate some widgets","jwdmc"); ?>.</p>
						</div>
					<?php endif; ?>

				</div>