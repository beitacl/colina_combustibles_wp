<?php if(!empty( $settings['video_link']['url'] )) : ?>
<div class="fti-intro-video-1-area">
    <div class="fti-intro-video-1-wrap">
        <video src="<?php echo esc_url($settings['video_link']['url']); ?>" autoplay loop muted></video>
    </div>
</div>
<?php endif; ?>