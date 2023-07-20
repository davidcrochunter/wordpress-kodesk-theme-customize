<div id="v4-map-view-area" class="col-lg-5 col-md-12 col-sm-12 sidebar-side map-sticky" >
    <!-- <div data-elementor-type="wp-page" data-elementor-id="1052" class="elementor elementor-1052">
        <section class="elementor-section elementor-top-section elementor-element elementor-element-6a9981c elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="6a9981c" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-f970834" data-id="f970834" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-f7b4e11 elementor-widget elementor-widget-google_maps" data-id="f7b4e11" data-element_type="widget" data-widget_type="google_maps.default">
                            <div class="elementor-widget-container">
                                <style>
                                    /*! elementor - v3.13.3 - 28-05-2023 */
                                    .elementor-widget-google_maps .elementor-widget-container {
                                        overflow: hidden
                                    }

                                    .elementor-widget-google_maps .elementor-custom-embed {
                                        line-height: 0
                                    }

                                    /* .elementor-widget-google_maps iframe {
                                                height: 900px
                                            } */
                                </style>
                                <div class="elementor-custom-embed">
                                    <iframe loading="lazy" src="https://maps.google.com/maps?q=London%20Eye%2C%20London%2C%20United%20Kingdom&#038;t=m&#038;z=10&#038;output=embed&#038;iwloc=near" title="London Eye, London, United Kingdom" aria-label="London Eye, London, United Kingdom"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div> -->

    <?php

        $args = array(
            'post_type'      => 'workspace',
            'posts_per_page' => -1,
            'paged'          => 1
        );

        if( kodesk_set( $settings, 'query_category' ) ) {
            $args['workspace_cat'] = kodesk_set( $settings, 'query_category' );
        }

        /**
         * Add v4-filters to query args
         */
        $district_cat = '';
        if ( isset( $_GET['district'] ) && $_GET['district'] ) { 
            $district_cat = $_GET['district'];
        }
        $usetype_cat = '';
        if ( isset( $_GET['usetype'] ) && $_GET['usetype'] ) { 
            $usetype_cat = $_GET['usetype'];
        }
        $addcondition_cat = '';
        if ( isset( $_GET['addcondition'] ) && $_GET['addcondition'] ) { 
            $addcondition_cat = $_GET['addcondition'];
        }

        $tax_query = array();

        if( $district_cat ) {
            array_push($tax_query, array(
                'taxonomy' => 'district_cat',
                'field' => 'slug',
                'terms' => $district_cat
            ));
        }
        if( $usetype_cat ) {
            array_push($tax_query, array(
                'taxonomy' => 'usetype_cat',
                'field' => 'slug',
                'terms' => $usetype_cat
            ));
        }
        if( $addcondition_cat ) {
            array_push($tax_query, array(
                'taxonomy' => 'addcondition_cat',
                'field' => 'slug',
                'terms' => $addcondition_cat
            ));
        }
        if( !empty($tax_query) ) {
            $tax_query['relation'] = 'ADD';
            $args['tax_query'] = $tax_query;
        }

        $query = new \WP_Query( $args ); 
    ?>
    <div id="v4-latlng-names" style="display: none">
        <?php
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) : $query->the_post(); ?>
                <div data-url="<?php the_permalink(); ?>"><?php echo wp_kses(get_post_meta( get_the_id(), 'address', true ), true); ?></div>
            <?php endwhile; 
            wp_reset_postdata();
        }
        ?>










    </div>
    <div class="map-wrapper">
        <div id="map"></div>
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
            </div><div class="upper-box">
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
            </div><div class="upper-box">
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
            </div><div class="upper-box">
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
            </div><div class="upper-box">
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