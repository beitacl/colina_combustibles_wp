<section class="log-feature-section-5 tx-section">
	<div class="log-feature-content-5 position-relative">
		<?php if(!empty( $settings['image_1']['url'] )) : ?>
		<div class="feature-bg  position-absolute">
			<img src="<?php echo esc_url($settings['image_1']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
		</div>
		<?php endif; ?>

		<div class="log-feature-area-5 d-flex">
			<?php
				$i = 1;
				foreach($settings['service_slide_boxs'] as $lsit ) :

				$anim_class = '';

				if ($i === 1) {
					$anim_class = 'appear_left';
				} elseif ($i === 2) {
					$anim_class = 'appear_top';
				} elseif ($i === 3) {
					$anim_class = 'appear_right';
				}

			?>
			<div class="log-feature-item-5 text-center position-relative <?php echo esc_attr($anim_class); ?>">
				<!-- Here is some masking images -->
				<?php if(!empty( $lsit['service_image']['url'] )) : ?>
				<span class="log-feature-bg position-absolute">
					<img src="<?php echo esc_url($lsit['service_image']['url']); ?>"
					alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $lsit['service_image']['url'] ); } ?>">
				</span>
				<?php endif; ?>

				<?php if(!empty( $lsit['shape_image']['url'] )) : ?>
				<span class="log-feature-border position-absolute">
					<img src="<?php echo esc_url($lsit['shape_image']['url']); ?>"
					alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $lsit['shape_image']['url'] ); } ?>">
				</span>
				<?php endif; ?>

				<?php if(!empty( $lsit['service_icon'] )) : ?>
				<div class="inner-icon d-flex align-items-center justify-content-center">
					<?php \Elementor\Icons_Manager::render_icon( $lsit['service_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</div>
				<?php endif; ?>

				<div class="inner-text headline-2">
					<?php if(!empty( $lsit['title'] )) : ?>
					<h3 class="text-uppercase">
						<a
						href="<?php echo esc_url($lsit['button_link']['url']); ?>"
						target="<?php echo esc_attr($lsit['button_link']['is_external'] ? '_blank' : '_self'); ?>"
						rel= "<?php echo esc_attr($lsit['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
						aria-label="name">
							<?php echo elh_element_kses_intermediate( $lsit['title'] ); ?>
						</a>
					</h3>
					<?php endif; ?>

					<?php if(!empty( $lsit['description'] )) : ?>
					<p>
						<?php echo elh_element_kses_intermediate( $lsit['description'] ); ?>
					</p>
					<?php endif; ?>
				</div>
			</div>
			<?php $i++; endforeach; ?>
		</div>
	</div>
</section>