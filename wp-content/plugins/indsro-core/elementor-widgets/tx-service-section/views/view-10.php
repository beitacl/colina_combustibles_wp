<section class="log-service-section-6 position-relative pt-120 pb-120 tx-section">
	<?php if(!empty( $settings['image_1']['url'] )) : ?>
	<div class="log-service-side-img position-absolute appear_left">
		<img src="<?php echo esc_url($settings['image_1']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
	</div>
	<?php endif; ?>

	<?php if(!empty( $settings['image_2']['url'] )) : ?>
	<div class="log-service-bg position-absolute img-parallax">
		<img src="<?php echo esc_url($settings['image_2']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
	</div>
	<?php endif; ?>

	<div class="container">
		<div class="log-service-top-content-6 flex-wrap d-flex align-items-end justify-content-between">
			<div class="log-section-title-5 headline-2 pera-content">

				<?php if(!empty( $settings['sub_title'] )) : ?>
				<div class="subtitle text-uppercase wow fadeInRight tx-subTitle"  data-wow-delay="300ms" data-wow-duration="1000ms">
					<?php echo elh_element_kses_intermediate($settings['sub_title']); ?>
				</div>
				<?php endif; ?>

				<?php
					$this->add_render_attribute( 'title', 'class', 'tx-title section_title tx-split-text split-in-right' );
					if($settings['enable_title'] === 'yes') {
						printf('<%1$s %2$s>%3$s</%1$s>',
							tag_escape($settings['title_tag']),
							$this->get_render_attribute_string('title'),
							elh_element_kses_basic( $settings['title'] )
						);
					}
				?>
			</div>
			<?php if( $settings['enable_slider_navigation'] === 'yes' ) : ?>
			<div class="log-service-arrow-6 d-flex">
				<div class="service-button-prev arrow-nav d-flex justify-content-center align-items-center"><i class="far fa-long-arrow-left"></i></div>
				<div class="service-button-next arrow-nav d-flex justify-content-center align-items-center"><i class="far fa-long-arrow-right"></i></div>
			</div>
			<?php endif; ?>
		</div>
		<div class="log-service-slider-content-6 d-flex position-relative">
			<div class="log-service-text-6 position-relative pera-content txt_item_active">

				<?php if(!empty( $settings['description'] )) : ?>
				<p class="tx-description">
					<?php echo elh_element_kses_intermediate( $settings['description'] ); ?>
				</p>
				<?php endif; ?>

				<?php if( $settings['enable_button'] === 'yes' ) : ?>
				<div class="log-btn-4 text-uppercase">
					<a class="read_more"
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
			<div class="log-service-slider-area-6 pt-40">
				<div class="log-service-slider-6 swiper-container">
					<div class="swiper-wrapper">
						<?php foreach($settings['service_slide_boxs'] as $lsit ) : ?>
						<div class="swiper-slide">
							<div class="log-service-item-6">
								<div class="item-img-icon position-relative">
									<?php if(!empty( $lsit['service_image']['url'] )) : ?>
									<div class="inner-img">
										<img src="<?php echo esc_url($lsit['service_image']['url']); ?>"
										alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $lsit['service_image']['url'] ); } ?>">
									</div>
									<?php endif; ?>

									<div class="inner-icon">
										<i class="flaticon-cargo-van"></i>
									</div>
								</div>
								<div class="item-text position-relative headline-2 pera-content">
									<?php if(!empty( $lsit['title'] )) : ?>
									<h3 class="service_title href-underline">
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
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>