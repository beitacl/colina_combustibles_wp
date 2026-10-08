<?php
    $title_animation = '';
    if( $settings['enable_title'] === 'yes' ) {
        if($settings['enable_title_anim'] === 'yes') {
            $title_animation = 'fti-split-text '.$settings['title_animation'];
        } else {
            $title_animation = '';
        }
    } else {
        $title_animation = '';
    }
?>
<div class="services-title-wrap tx-heading-section">
    <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
    <h5 class="fti-subtitle-5 tx-subTitle"><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></h5>
    <?php endif;
        $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-5 '.esc_attr($title_animation).'' );
        if($settings['enable_title'] === 'yes') {
            printf('<%1$s %2$s>%3$s</%1$s>',
                tag_escape($settings['title_tag']),
                $this->get_render_attribute_string('title'),
                elh_element_kses_basic( $settings['title'] )
            );
        }
    ?>
    <?php if( $settings['enable_description'] === 'yes' ) : ?>
    <p class="tx-description fti-para-4 disc">
        <?php echo elh_element_kses_intermediate($settings['description']); ?>
    </p>
    <?php endif; ?>
</div>