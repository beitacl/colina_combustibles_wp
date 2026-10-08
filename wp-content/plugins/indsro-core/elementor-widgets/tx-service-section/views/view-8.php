<section class="log-project-section-5 position-relative pt-110">
	<?php if(!empty( $settings['image_1']['url'] )) : ?>
	<div class="project-bg img-parallax position-absolute">
		<img src="<?php echo esc_url($settings['image_1']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
	</div>
	<?php endif; ?>

	<div class="container">
		<div class="log-project-top-content d-flex align-items-end justify-content-between flex-wrap">
			<div class="log-section-title-4 headline-2 pera-content">
				<?php if(!empty( $settings['enable_sub_title'] )) : ?>
				<div class="subtitle text-uppercase wow fadeInRight tx-subTitle" data-wow-delay="300ms" data-wow-duration="1000ms">
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

			<?php if(!empty( $settings['description'] )) : ?>
			<div class="top-text">
				<?php echo elh_element_kses_intermediate( $settings['description'] ); ?>
			</div>
			<?php endif; ?>
		</div>

		<?php if( $settings['enable_slider_navigation'] === 'yes' ) : ?>
		<div class="log-project-arrow-nav mt-40 position-relative d-flex align-items-center justify-content-end">
			<div class="log-pro-nav-5 d-flex">
				<div class="log-pro-prev-5"><i class="far fa-long-arrow-left"></i></div>
				<div class="log-pro-next-5"><i class="far fa-long-arrow-right"></i></div>
			</div>
		</div>
		<?php endif; ?>
		<div class="log-project-slider-area-5 mt-50">
			<div class="log-project-slider-5  swiper-container">
				<div class="swiper-wrapper">
					<?php foreach($settings['service_slide_boxs'] as $lsit ) : ?>
					<div class="swiper-slide">
						<div class="log-project-item-5 position-relative">
							<?php if(!empty( $lsit['service_image']['url'] )) : ?>
							<div class="item-img">
								<img src="<?php echo esc_url($lsit['service_image']['url']); ?>"
								alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $lsit['service_image']['url'] ); } ?>">
							</div>
							<?php endif; ?>
							<div class="item-text position-absolute headline-2">
								<?php if(!empty( $lsit['service_cat'] )) : ?>
								<span class="item-cate">
									<a
										href="<?php echo esc_url($lsit['button_link']['url']); ?>"
										target="<?php echo esc_attr($lsit['button_link']['is_external'] ? '_blank' : '_self'); ?>"
										rel= "<?php echo esc_attr($lsit['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
										aria-label="name">
											<?php echo elh_element_kses_intermediate( $lsit['service_cat'] ); ?>
									</a>
								</span>
								<?php endif; ?>

								<?php if(!empty( $lsit['title'] )) : ?>
								<h3 class="item_title href-undeline">
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
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>