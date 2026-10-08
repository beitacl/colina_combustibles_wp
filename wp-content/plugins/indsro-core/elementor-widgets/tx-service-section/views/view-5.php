<div class="project-process-bg position-relative tx-section">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
	<span class="section-bg position-absolute">
        <img src="<?php echo esc_url($settings['image_1']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </span>
    <?php endif; ?>

    <?php if(!empty( $settings['image_2']['url'] )) : ?>
	<span class="log-wp-side position-absolute appear_top">
        <img src="<?php echo esc_url($settings['image_2']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
    </span>
    <?php endif; ?>

	<section class="log-project-section-4 pt-120 position-relative">
		<div class="container">
			<div class="log-section-title-3 text-center headline-2 pera-content log-text">
				<?php if(!empty( $settings['enable_sub_title'] )) : ?>
				<div class="subtitle text-uppercase wow fadeInRight tx-subTitle" data-wow-delay="300ms" data-wow-duration="1000ms">
					<span><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
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
		</div>
		<div class="log-project-content-4 mt-50">
			<div class="log-project-content-scoller">
				<?php foreach($settings['service_slide_boxs'] as $lsit ) : ?>
				<div class="log-project-item-4 position-relative">
					<?php if(!empty( $lsit['service_image']['url'] )) : ?>
					<div class="item-img">
						<img src="<?php echo esc_url($lsit['service_image']['url']); ?>"
						alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $lsit['service_image']['url'] ); } ?>">
					</div>
					<?php endif; ?>

					<div class="item-text position-absolute headline-2 ul-li-block">

						<?php if(!empty( $lsit['service_cat'] )) : ?>
						<span class="pro-cate">
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
						<h3 class="project_title href-underline">
							<a
							href="<?php echo esc_url($lsit['button_link']['url']); ?>"
							target="<?php echo esc_attr($lsit['button_link']['is_external'] ? '_blank' : '_self'); ?>"
							rel= "<?php echo esc_attr($lsit['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
							aria-label="name">
								<?php echo elh_element_kses_intermediate( $lsit['title'] ); ?>
							</a>
						</h3>
						<?php endif; ?>

						<?php if( $lsit['enable_feature_lists'] === 'yes' ) : ?>
						<ul>
                            <?php
                                $list_item = $lsit['description'];
                                $list_item = explode("\n", ($list_item));
                                foreach($list_item as $feature_list):
                            ?>
                            <li class="chy-heading-2">
                                <?php \Elementor\Icons_Manager::render_icon( $lsit['feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                <?php echo wp_kses($feature_list, true)?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</div>