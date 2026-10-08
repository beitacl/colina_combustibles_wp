<div class="fti-project-2-area p-0">
    <p class="fti-para-2 bottom-text m-0">
        <?php echo elh_element_kses_intermediate($settings['info_text']); ?>
        <?php if(!empty( $settings['link_label'] )) : ?>
        <a class="link" href="<?php echo esc_url($settings['link_url']['url']); ?>">
            <?php echo elh_element_kses_intermediate($settings['link_label']); ?>
        </a>
        <?php endif; ?>
    </p>
</div>