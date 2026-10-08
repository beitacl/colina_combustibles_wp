<div class="fti-company-2-wrap d-block">
    <div class="company-2-right">
        <div class="feature d-block m-0">
            <div class="feature-item-2">
                <?php if(!empty( $settings['count_number'] )) : ?>
                <h2 class="fti-heading-2 raing-number"><span class="counter" data-background="<?php echo $settings['count_image']['url'] ? esc_url($settings['count_image']['url']) : ''; ?>"><?php echo esc_html($settings['count_number']); ?></span><?php echo esc_html($settings['count_prefix']); ?></h2>
                <?php endif; ?>

                <?php if( $settings['enable_rating'] === 'yes' ) : ?>
                <div class="rating">
                    <?php
                        $rating = $settings['rating_star'];
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $rating) {
                                echo '<i class="flaticon-star"></i>';
                            } else {
                                echo '<i class="fa-solid fa-star-empty"></i>';
                            }
                        }
                    ?>
                </div>
                <?php endif; ?>

                <?php if(!empty( $settings['count_title'] )) : ?>
                <p class="fti-para-2 rating-text"><?php echo elh_element_kses_intermediate($settings['count_title']); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
