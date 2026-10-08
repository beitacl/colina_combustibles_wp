<div class="log-team-details-info p-0">
    <div class="team-social ul-li tx-listItems">
        <ul>
            <?php foreach( $settings['social_links'] as $list ) : ?>
                <li>
                    <a
                        href="<?php echo esc_url($list['social_link']['url']); ?>"
                        target="<?php echo esc_attr( $list['social_link']['is_external'] ? '_blank' : '_self' ); ?>"
                        rel="<?php echo esc_attr( $list['social_link']['nofollow'] ? 'nofollow' : '' ); ?>">
                        <?php \Elementor\Icons_Manager::render_icon( $list['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>