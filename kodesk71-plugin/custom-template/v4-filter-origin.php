<?php
/**
 * Catch url params...
 */
// get current district from url
$is_district = true;
$district_cat = '';
if ( isset( $_GET['district'] )) { 
    $district_cat = $_GET['district'];
} else {
    $is_district = false; 
}
function is_district_selected($_c, $cat) {
    if ($_c == $cat) {
        return true;
    } else {
        return false;
    }
}

// get current usetype from url
$is_usetype = true;
$usetype_cat = '';
if ( isset( $_GET['usetype'] )) { 
    $usetype_cat = $_GET['usetype'];
} else {
    $is_usetype = false; 
}
function is_usetype_selected($_c, $cat) {
    if ($_c == $cat) {
        return true;
    } else {
        return false;
    }
}

// get current addcondition from url
$is_addcondition = true;
$addcondition_cat = '';
if ( isset( $_GET['addcondition'] )) { 
    $addcondition_cat = $_GET['addcondition'];
} else {
    $is_addcondition = false; 
}
function is_addcondition_selected($_c, $cat) {
    if ($_c == $cat) {
        return true;
    } else {
        return false;
    }
}

?>

<?php
/**
 * Event handler...
 */
?>
<form class="v4-filter-form" method="get">
    <input type="hidden" name="district" value="" /> 
	<input type="hidden" name="usetype" value="" /> 
	<input type="hidden" name="addcondition" value="" />
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
</form>


<div>



<!-- <div type="text" id="cbox-input" readonly="readonly" role="combobox" aria-labelledby="cbox-label cbox-input" aria-controls="vegetables" aria-haspopup="listbox" aria-expanded="false" aria-autocomplete="none" tabindex="0"></div>
			<button class="toggle" aria-hidden="true" aria-label="Toggle list" tabindex="-1"></button>
			<button class="clear" aria-label="Clear selected favourite vegetables"></button>
			<ul role="listbox" id="vegetables" class="listbox" tabindex="-1">
				<li id="broccoli" role="option" aria-selected="false"><span class="check" aria-hidden="true"></span>Broccoli</li>
				<li id="cabbage" role="option" aria-selected="false"><span class="check" aria-hidden="true"></span>Cabbage</li>
				<li id="onion" role="option" aria-selected="false"><span class="check" aria-hidden="true"></span>Onion</li>
				<li id="radish" role="option" aria-selected="false"><span class="check" aria-hidden="true"></span>Radish</li>
				<li id="spinach" role="option" aria-selected="false"><span class="check" aria-hidden="true"></span>Spinach</li>
			</ul>
		</div>
</div> -->



















<section class="v4-filter-section">
    <div class="auto-container">
        <div class="row v4-filter-panel">
            <div class="col-lg-12 col-md-12" style=" padding: 0px; border-radius: 20px">


<div class="form-inner ">
    <div id="contact-form" class="default-form"> 
        <?php
        $form_id = 7455; // The ID of your contact form
        $shortcode = '[contact-form-7 id="' . $form_id . '" title="v4-workspace-filter"]';

        // Execute the shortcode
        echo do_shortcode($shortcode);
        ?>
    </div>
</div>

</div>
</div>
</div>
</section>









<section class="v4-filter-section">
    <div class="auto-container">
        <div class="row v4-filter-panel">
            <div class="col-lg-12 col-md-12" style="background: #f7f3f4; padding: 0px; border-radius: 20px">


            <div class="row clearfix v4-filter-box">
            <div class="col-lg-4 col-md-12">
                <div class="form-group">
                    <div class="select-box">
                        <p>
                            <span class="wpcf7-form-control-wrap" data-name="menu-552">
                                <select id="district_filter" class="wpcf7-form-control wpcf7-select wide" aria-invalid="false" name="menu-552" onchange="javascript:v4_filtering()">
                                    <option value="DISTRICT">DISTRICT</option>
                                    <?php
                                        // Product category Loop
                                        $terms = get_terms( array(
                                            'taxonomy'   => 'district_cat', 
                                            'hide_empty' => false, 
                                        ));

                                        // Loop through all category with a foreach loop
                                        foreach( $terms as $term ) {
                                            echo '<option value="'.$term->slug.'" ';
                                            if(is_district_selected($term->slug, $district_cat)) {
                                                echo 'selected >';
                                            } else {
                                                echo '>';
                                            }
                                            echo $term->name.'</option>';
                                        }
                                    ?>
                                </select>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="form-group">
                    <div class="select-box">
                        <p>
                            <span class="wpcf7-form-control-wrap" data-name="menu-553">
                                <select id="usetype_filter" class="wpcf7-form-control wpcf7-select wide" aria-invalid="false" name="menu-553" onchange="javascript:v4_filtering()">
                                    <option value="USETYPE">USE TYPE</option>
                                    <?php
                                        // Product category Loop
                                        $terms = get_terms( array(
                                            'taxonomy'   => 'usetype_cat', 
                                            'hide_empty' => false, 
                                        ));

                                        // Loop through all category with a foreach loop
                                        foreach( $terms as $term ) {
                                            echo '<option value="'.$term->slug.'" ';
                                            if(is_usetype_selected($term->slug, $usetype_cat)) {
                                                echo 'selected >';
                                            } else {
                                                echo '>';
                                            }
                                            echo $term->name.'</option>';
                                        }
                                    ?>
                                </select>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="form-group">
                    <div class="select-box">
                        <p>
                            <span class="wpcf7-form-control-wrap" data-name="menu-553">
                                <select id="addcondition_filter" class="wpcf7-form-control wpcf7-select wide" aria-invalid="false" name="menu-553" onchange="javascript:v4_filtering()">
                                    <option value="ADDCONDITION">ADDITIONAL CONDITION</option>
                                    <?php
                                        // Product category Loop
                                        $terms = get_terms( array(
                                            'taxonomy'   => 'addcondition_cat', 
                                            'hide_empty' => false, 
                                        ));

                                        // Loop through all category with a foreach loop
                                        foreach( $terms as $term ) {
                                            echo '<option value="'.$term->slug.'" ';
                                            if(is_addcondition_selected($term->slug, $addcondition_cat)) {
                                                echo 'selected >';
                                            } else {
                                                echo '>';
                                            }
                                            echo $term->name.'</option>';
                                        }
                                    ?>
                                </select>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

















            </div>
        </div>

        
    </div>
</section>