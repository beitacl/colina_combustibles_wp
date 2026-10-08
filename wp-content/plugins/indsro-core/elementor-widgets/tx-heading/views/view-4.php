<div class="fti-client-1-wrap">
    <div class="client-title-wrap">
        <span class="title-shape-1 subtitle-line-1"></span>
        <?php
            $this->add_render_attribute( 'title', 'class', 'tx-title fti-heading-1 client-title fti-split-text fti-split-in-right-1' );
            if($settings['enable_title'] === 'yes') {
                printf('<%1$s %2$s>%3$s</%1$s>',
                    tag_escape($settings['title_tag']),
                    $this->get_render_attribute_string('title'),
                    elh_element_kses_basic( $settings['title'] )
                );
            }
        ?>
        <span class="title-shape-2 subtitle-line-2"></span>
    </div>
</div>