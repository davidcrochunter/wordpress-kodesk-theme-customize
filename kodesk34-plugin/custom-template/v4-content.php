<div class="col-lg-6 col-md-6 col-sm-12 workspaces-block">
    <div class="workspaces-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
        <div class="inner-box">
            <div class="upper-box">
                <?php $post = get_post(); // Get the post object
                        $post_url = get_permalink($post); // Get the permalink for the post
                ?>
                <h3><a href="<?php echo $post_url; ?>"><?php the_title(); ?></a></h3>
                <div class="text workspace-gmap-addr"><i class="flaticon-pointer-inside-a-circle"></i><?php echo wp_kses(get_post_meta( get_the_id(), 'address', true ), true); ?></div>
            </div>
            <div class="image-box">
                <span class="category"><?php echo wp_kses(get_post_meta( get_the_id(), 'feature_tag', true ), true); ?></span>
                <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>
                <div class="view-btn"><a href="<?php echo esc_url($image[0]); ?>"><i class="flaticon-photo-camera"></i></a></div>
                <a href="<?php echo $post_url; ?>"><figure class="image"><?php the_post_thumbnail('kodesk_310x180'); ?></figure></a>
            </div>
            <div class="lower-content">
                <ul class="feature-list clearfix">
                    <?php if (get_post_meta( get_the_id(), 'square_feet', true )){ ?>
                    <li>
                        <i class="flaticon-select"></i>
                        <h6><?php esc_html_e('Total Area', 'kodesk'); ?></h6>
                        <span><?php echo wp_kses(get_post_meta( get_the_id(), 'square_feet', true ), true); ?></span>
                    </li>
                    <?php } ?>
                    
                    <?php if (get_post_meta( get_the_id(), 'users', true )){ ?>
                    <li>
                        <i class="flaticon-user"></i>
                        <h6><?php esc_html_e('Capacity', 'kodesk'); ?></h6>
                        <span><?php echo wp_kses(get_post_meta( get_the_id(), 'users', true ), true); ?></span>
                    </li>
                    <?php } ?>
                </ul>
                <div class="lower-box clearfix">
                    <div class="text"><?php echo wp_kses(get_post_meta( get_the_id(), 'price_package', true ), true); ?></div>
                    <div class="link"><a href="<?php echo esc_url(get_post_meta( get_the_id(), 'ext_url', true )); ?>"><i class="fas fa-angle-right"></i><span><?php esc_html_e('Read More', 'kodesk'); ?></span></a></div>
                </div>
            </div>
        </div>
    </div>
</div>