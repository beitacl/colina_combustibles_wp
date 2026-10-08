<div class="log-footer-cta position-relative scale_view" data-background="">
	<?php if(!empty( $settings['image_1']['url'] )) : ?>
	<div class="log-footer-cta-bg img-parallax position-absolute">
		<img src="<?php echo esc_url($settings['image_1']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
	</div>
	<?php endif; ?>

	<div class="log-footer-cta-content d-flex justify-content-between align-items-center">
		<div class="log-footer-cta-text">
			<div class="log-section-title-1 headline pera-content">
				<?php if(!empty( $settings['sub_title'] )) : ?>
				<div class="subtitle tx-subTitle">
					<?php echo elh_element_kses_intermediate($settings['sub_title']); ?>
				</div>
				<?php endif; ?>

				<?php
					$this->add_render_attribute( 'title', 'class', 'tx-title section_title wow' );
					if($settings['enable_title'] === 'yes') {
						printf('<%1$s %2$s>%3$s</%1$s>',
							tag_escape($settings['title_tag']),
							$this->get_render_attribute_string('title'),
							elh_element_kses_basic( $settings['title'] )
						);
					}
				?>

				<?php if(!empty( $settings['description'] )) : ?>
				<p class="tx-description">
					<?php echo elh_element_kses_intermediate( $settings['description'] ); ?>
				</p>
				<?php endif; ?>

				<?php if( $settings['enable_button'] === 'yes' ) : ?>
				<div class="log-btn-1 mt-35">
					<a class="tx-button"
						href="<?php echo esc_url($settings['button_link']['url']); ?>"
						target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
						rel= "<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
						aria-label="name">
						<span><?php echo elh_element_kses_intermediate( $settings['button_text'] ); ?></span>
						<?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</a>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="log-footer-cta-slider">
			<div class="log-cta-slider swiper-container">
				<div class="swiper-wrapper">
					<?php foreach($settings['service_slide_boxs'] as $lsit ) : ?>
					<div class="swiper-slide">
						<div class="log-footer-cta-item">
							<div class="item-icon">
								<img src="<?php echo esc_url($lsit['service_image']['url']); ?>"
								alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $lsit['service_image']['url'] ); } ?>">
							</div>

							<div class="item-text headline">
								<h3>
									<a
									href="<?php echo esc_url($lsit['button_link']['url']); ?>"
									target="<?php echo esc_attr($lsit['button_link']['is_external'] ? '_blank' : '_self'); ?>"
									rel= "<?php echo esc_attr($lsit['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
									aria-label="name">
										<?php echo elh_element_kses_intermediate( $lsit['title'] ); ?>
									</a>
								</h3>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>

			<?php if( $settings['enable_slider_navigation'] === 'yes' ) : ?>
			<div class="log-cta-pagination mt-25 text-center"></div>
			<?php endif; ?>
		</div>
	</div>
</div>