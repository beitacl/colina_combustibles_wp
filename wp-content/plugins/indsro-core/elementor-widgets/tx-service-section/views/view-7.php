<section class="log-service-section-5 pt-120 pb-165 position-relative tx-section">
	<span class="log-service-shape txt_item_active position-absolute"></span>

	<?php if(!empty( $settings['image_1']['url'] )) : ?>
	<span class="log-service-shape2 position-absolute">
		<img src="<?php echo esc_url($settings['image_1']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
	</span>
	<?php endif; ?>

	<?php if(!empty( $settings['image_2']['url'] )) : ?>
	<span class="log-service-side-2 appear_left position-absolute">
		<img src="<?php echo esc_url($settings['image_2']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
	</span>
	<?php endif; ?>

	<div class="container">
		<div class="log-service-content-5 d-flex">
			<div class="log-service-text-area-5">
				<div class="log-section-title-4 headline-2 pera-content log-text">
					<?php if(!empty( $settings['enable_sub_title'] )) : ?>
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

					<?php if(!empty( $settings['description'] )) : ?>
					<p>
						<?php echo elh_element_kses_intermediate( $settings['description'] ); ?>
					</p>
					<?php endif; ?>
				</div>

				<?php if(!empty( $settings['button_text'] )) : ?>
				<div class="log-btn-5 mt-35 text-uppercase top_view">
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
			<div class="log-service-slider-area-5">
				<div class="log-service-slider-5 swiper-container">
					<div class="swiper-wrapper">
						<?php foreach($settings['service_slide_boxs'] as $lsit ) : ?>
						<div class="swiper-slide">
							<div class="log-service-item-5 position-relative">
								<?php if(!empty( $lsit['service_image']['url'] )) : ?>
								<div class="item-img">
									<img src="<?php echo esc_url($lsit['service_image']['url']); ?>"
									alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $lsit['service_image']['url'] ); } ?>">
								</div>
								<?php endif; ?>

								<div class="item-text headline-2 pera-content">

									<?php if(!empty( $lsit['service_icon'] )) : ?>
									<div class="item-icon d-flex justify-content-center align-items-center">
                                        <?php \Elementor\Icons_Manager::render_icon( $lsit['service_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </div>
                                    <?php endif; ?>

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

				<?php if( $settings['enable_slider_navigation'] === 'yes' ) : ?>
				<div class="log-ser-nav-5 d-flex mt-40">
					<div class="log-ser-prev-5"><i class="far fa-long-arrow-left"></i></div>
					<div class="log-ser-next-5"><i class="far fa-long-arrow-right"></i></div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>