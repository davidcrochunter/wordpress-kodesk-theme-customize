<?php namespace KODESKPLUGIN\Element;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Plugin;

/**
 * Elementor button widget.
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class Gallery_V1 extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'kodesk_gallery_v1';
    }

    /**
     * Get widget title.
     * Retrieve button widget title.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Gallery V1', 'kodesk' );
    }

    /**
     * Get widget icon.
     * Retrieve button widget icon.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'fa fa-briefcase';
    }

    /**
     * Get widget categories.
     * Retrieve the list of categories the button widget belongs to.
     * Used to determine where to display the widget in the editor.
     *
     * @since  2.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'kodesk' ];
    }

    /**
     * Register button widget controls.
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'gallery_v1',
            [
                'label' => esc_html__( 'Gallery V1', 'kodesk' ),
            ]
        );
		$this->add_control(
            'subtitle',
            [
                'label'       => __( 'Sub Title', 'kodesk' ),
                'type'        => Controls_Manager::TEXT,
				'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'title',
            [
                'label'       => __( 'Title', 'kodesk' ),
                'type'        => Controls_Manager::TEXT,
				'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
		$this->add_control(
            'btn_title',
            [
                'label'       => __( 'Button Title', 'kodesk' ),
                'type'        => Controls_Manager::TEXT,
				'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'btn_link',
            [
                'label' => __( 'Button URL', 'kodesk' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'kodesk' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $this->add_control(
            'query_number',
            [
                'label'   => esc_html__( 'Number of post', 'kodesk' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 8,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
            ]
        );
        $this->add_control(
            'query_orderby',
            [
                'label'   => esc_html__( 'Order By', 'kodesk' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => array(
                    'date'       => esc_html__( 'Date', 'kodesk' ),
                    'title'      => esc_html__( 'Title', 'kodesk' ),
                    'menu_order' => esc_html__( 'Menu Order', 'kodesk' ),
                    'rand'       => esc_html__( 'Random', 'kodesk' ),
                ),
            ]
        );
        $this->add_control(
            'query_order',
            [
                'label'   => esc_html__( 'Order', 'kodesk' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'ASC',
                'options' => array(
                    'DESC' => esc_html__( 'DESC', 'kodesk' ),
                    'ASC'  => esc_html__( 'ASC', 'kodesk' ),
                ),
            ]
        );
        $this->add_control(
            'query_category',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Category', 'kodesk'),
                'options' => get_categories_list('gallery_cat')
            ]
        );
        $this->end_controls_section();
    }

    /**
     * Render button widget output on the frontend.
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $allowed_tags = wp_kses_allowed_html('post');

        $paged = kodesk_set($_POST, 'paged') ? esc_attr($_POST['paged']) : 1;

        $this->add_render_attribute( 'wrapper', 'class', 'templatepath-kodesk' );
        $args = array(
            'post_type'      => 'gallery',
            'posts_per_page' => kodesk_set( $settings, 'query_number' ),
            'orderby'        => kodesk_set( $settings, 'query_orderby' ),
            'order'          => kodesk_set( $settings, 'query_order' ),
            'paged'          => $paged
        );

        if( kodesk_set( $settings, 'query_category' ) ) $args['gallery_cat'] = kodesk_set( $settings, 'query_category' );
        $query = new \WP_Query( $args );

        if ( $query->have_posts() ) { ?>

		<!-- project-section -->
        <section class="project-section sec-pad">
            <div class="auto-container">
                <div class="sec-title">
                    <h6><?php echo wp_kses($settings['subtitle'], $allowed_tags); ?></h6>
                    <h2><?php echo wp_kses($settings['title'], $allowed_tags); ?></h2>
                    
                    <?php if($settings['btn_link']['url'] and $settings['btn_title']) { ?>
                    <div class="btn-box">
                        <a href="<?php echo esc_url( $settings['btn_link']['url'] ); ?>" class="theme-btn btn-one"><span><?php echo wp_kses( $settings['btn_title'], true ); ?></span></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="outer-container">
                <div class="sortable-masonry">
                    <div class="items-container row clearfix">
                        <?php global $post;
						while ( $query->have_posts() ) : $query->the_post();
						$dimention = get_post_meta( get_the_id(), 'dimension', true );
						if($dimention == 'size_415_300'){
							$image_size = 'kodesk_415x300';
						} elseif($dimention == 'size_415_620'){
							$image_size = 'kodesk_415x620';
						} else {
							$image_size = 'kodesk_200x300'; 
						} ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 masonry-item small-column">
                            <div class="project-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><?php the_post_thumbnail($image_size); ?></figure>
                                    <div class="content-box">
                                        <div class="text">
                                            <h3><a href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><?php the_title(); ?></a></h3>
                                        </div>
                                        <div class="link"><a href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><i class="fas fa-angle-double-right"></i><?php esc_html_e('Details', 'kodesk'); ?></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- project-section end -->
        
		<?php }

        wp_reset_postdata();
    }
}
