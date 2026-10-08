<?php
    $title_animation = '';
    if( $settings['enable_title'] === 'yes' ) {
        if($settings['enable_title_anim'] === 'yes') {
            $title_animation = 'fti-split-text fti-split-in-right-3 '.$settings['title_animation'];
        } else {
            $title_animation = '';
        }
    } else {
        $title_animation = '';
    }

    $has_both_shape = $settings['enable_sub_title_shape_2'] === 'yes' ? 'has-both-line' : '';
?>
<div class="services-title-wrap tx-heading-section">
    <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
    <h5 class="fti-subtitle-3 tx-subTitle <?php echo esc_attr($has_both_shape); ?>">
        <?php if( $settings['enable_sub_title_shape_1'] === 'yes' ) : ?>
        <span class="line subtitle-line-1"></span>
        <?php endif;
            echo elh_element_kses_intermediate($settings['sub_title']);
         if( $settings['enable_sub_title_shape_2'] === 'yes' ) : ?>
        <span class="line-2 subtitle-line-2"></span>
        <?php endif; ?>
    </h5>
    <?php endif;
        $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-3 '.esc_attr($title_animation).'' );
        if($settings['enable_title'] === 'yes') {
            printf('<%1$s %2$s>%3$s</%1$s>',
                tag_escape($settings['title_tag']),
                $this->get_render_attribute_string('title'),
                elh_element_kses_basic( $settings['title'] )
            );
        }
    ?>

    <?php if( $settings['enable_description'] === 'yes' ) : ?>
    <p class="fti-para-2 disc tx-description">
        <?php echo elh_element_kses_intermediate($settings['description']); ?>
    </p>
    <?php endif; ?>
</div>