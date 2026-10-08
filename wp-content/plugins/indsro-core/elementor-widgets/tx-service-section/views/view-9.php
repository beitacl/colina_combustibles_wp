<section class="log-feature-section-6 position-relative tx-section">

	<?php if(!empty( $settings['image_1']['url'] )) : ?>
	<div class="feature-side-1 position-absolute appear_left">
		<img src="<?php echo esc_url($settings['image_1']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
	</div>
	<?php endif; ?>

	<?php if(!empty( $settings['image_2']['url'] )) : ?>
	<div class="feature-side-2 position-absolute appear_right">
		<img src="<?php echo esc_url($settings['image_2']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
	</div>
	<?php endif; ?>

	<div class="log-feature-content-6 d-flex justify-content-center">
		<?php foreach($settings['service_slide_boxs'] as $lsit ) : ?>
		<div class="log-feature-item-6 position-relative d-flex">
			<?php if(!empty( $lsit['service_icon'] )) : ?>
			<div class="item-icon">
				<?php \Elementor\Icons_Manager::render_icon( $lsit['service_icon'], [ 'aria-hidden' => 'true' ] ); ?>
			</div>
			<?php endif; ?>

			<div class="item-text headline-2">

				<?php if(!empty( $lsit['service_cat'] )) : ?>
				<span><?php echo elh_element_kses_intermediate( $lsit['service_cat'] ); ?></span>
				<?php endif; ?>

				<?php if(!empty( $lsit['title'] )) : ?>
				<h3 class="href-underline">
						<a
						href="<?php echo esc_url($lsit['button_link']['url']); ?>"
						target="<?php echo esc_attr($lsit['button_link']['is_external'] ? '_blank' : '_self'); ?>"
						rel= "<?php echo esc_attr($lsit['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
						aria-label="name">
						<?php echo elh_element_kses_intermediate( $lsit['title'] ); ?>
					</a>
				</h3>
				<?php endif; ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</section>