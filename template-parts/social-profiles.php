<ul class="social-icon mb-0">
    <?php getOption('defaults', 'facebook'); ?>
    <?php if( getOption('defaults', 'facebook') ) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(getOption('defaults', 'facebook')); ?>" target="_blank">
                <i class="fab fa-facebook-f" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php if( getOption('defaults', 'twitter') ) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(getOption('defaults', 'twitter')); ?>" target="_blank">
                <i class="fab fa-twitter" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php if( getOption('defaults', 'instagram') ) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(getOption('defaults', 'instagram')); ?>" target="_blank">
                <i class="fab fa-instagram" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php if( getOption('defaults', 'youtube') ) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(getOption('defaults', 'youtube')); ?>" target="_blank">
                <i class="fab fa-youtube" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php if( getOption('defaults', 'linkedin') ) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(getOption('defaults', 'linkedin')); ?>" target="_blank">
                <i class="fab fa-linkedin" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php if( getOption('defaults', 'spotify') ) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(getOption('defaults', 'spotify')); ?>" target="_blank">
                <i class="fab fa-spotify" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php if( getOption('defaults', 'github') ) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(getOption('defaults', 'github')); ?>" target="_blank">
                <i class="fab fa-github" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php if( getOption('defaults', 'whatsapp') ) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(getOption('defaults', 'whatsapp')); ?>" target="_blank">
                <i class="fab fa-whatsapp" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php if( getOption('defaults', 'telegram') ) : ?>
        <li class="list-inline-item social-icon">
            <a href="<?php echo esc_url(getOption('defaults', 'telegram')); ?>" target="_blank">
                <i class="fab fa-telegram" aria-hidden="true"></i>
            </a>
        </li>
    <?php endif; ?>
</ul>