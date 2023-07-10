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
 * Console log
 */
function console($log) {

    if( is_array($log) ) {

        $log = json_encode($log);
        $log = str_replace('"', '', $log);

        echo '<script>console.log("array:'.$log.'");</script>';

    } else if( is_object($log) ) {

        $log = json_encode($log);
        $log = str_replace('"', '', $log);

        echo '<script>console.log("object:'.$log.'");</script>';

    } else {

        $log = str_replace('"', '', $log);
        
        echo '<script>console.log("'.$log.'");</script>';
    }
}

function consoleret($log) {

    if( is_array($log) ) {

        $log = json_encode($log);
        $log = str_replace('"', '', $log);

        return '<script>console.log("array:'.$log.'");</script>';

    } else if( is_object($log) ) {

        $log = json_encode($log);
        $log = str_replace('"', '', $log);

        return '<script>console.log("object:'.$log.'");</script>';

    } else {

        $log = str_replace('"', '', $log);
        
        return '<script>console.log("'.$log.'");</script>';
    }
}










/**
 * Elementor button widget.
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class Workspaces_V4 extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  4.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'kodesk_workspaces_v4';
    }

    /**
     * Get widget title.
     * Retrieve button widget title.
     *
     * @since  4.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Workspaces V4', 'kodesk' );
    }

    /**
     * Get widget icon.
     * Retrieve button widget icon.
     *
     * @since  4.0.0
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
     * @since  4.0.0
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'workspaces_v4',
            [
                'label' => esc_html__( 'Workspaces V4', 'kodesk' ),
            ]
        );
        $this->add_control(
            'query_number',
            [
                'label'   => esc_html__( 'Number of post', 'kodesk' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
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
                'options' => get_categories_list('workspace_cat'),
            ]
        );
        $this->end_controls_section();
		
		//Sidebar
		$this->start_controls_section(
            'sidebar_tab',
            [
                'label' => esc_html__('Sidebar', 'kodesk'),
            ]
        );
		$this->add_control(
            'left_right_sidebar',
            [
                'label'   => esc_html__('Sidebar', 'kodesk'),
                'type'    => Controls_Manager::SELECT2,
                'default' => 'right',
                'options' => array(
                    'left' => esc_html__('Left Sidebar', 'kodesk'),
                    'right' => esc_html__('Right Sidebar', 'kodesk'),
                ),
            ]
        );
		$this->add_control(
			'sidebar',
			[
				'label'   => esc_html__('Choose Sidebar', 'kodesk'),
				'separate' => 'before',
				'type'    => Controls_Manager::SELECT,
				'default' => 'Choose Sidebar',
				'options'  => kodesk_get_sidebars(),
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
            'post_type'      => 'workspace',
            'posts_per_page' => 4,//kodesk_set( $settings, 'query_number' ),
            'orderby'        => kodesk_set( $settings, 'query_orderby' ),
            'order'          => kodesk_set( $settings, 'query_order' ),
            'paged'          => $paged
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

        global $wp_query;
        $temp_query = $wp_query;

        $wp_query = new \WP_Query( $args );

        include_once(ABSPATH . 'wp-content/plugins/kodesk54-plugin/custom-template/v4-filter.php');

        if ( /*$query->*/have_posts() ) { ?>

            <!-- workspaces-page-section --> 
            <section class="workspaces-page-section" data-workspace-cat="<?php echo $args['workspace_cat'] ?>">
                <div class="auto-container v4-mini-control-panel">
                    <div id="v4-mini-map-btn" ><i class="fas fa-map"></i>map</div>
                </div>



                <div class="auto-container">
                    <div class="row clearfix">
                        <?php if($settings['left_right_sidebar'] == 'left') { ?>
                        <!-- <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                            <div class="default-sidebar workspaces-sidebar">
                                <?php //dynamic_sidebar($settings['sidebar'] ); ?>
                            </div>
                        </div> -->
                        <?php } ?>

                        <div id="v4-carts-view-area" class="col-lg-7 col-md-12 col-sm-12 content-side">
                            <div class="workspaces-content-side">
                                <div class="row clearfix">
                                    <?php global $post;
                                    while ( /*$query->*/have_posts() ) : /*$query->*/the_post(); ?>
                                        <?php include(ABSPATH . 'wp-content/plugins/kodesk54-plugin/custom-template/v4-content.php'); ?>
                                    <?php endwhile; ?>
                                </div>
                                
                                <?php include_once(ABSPATH . 'wp-content/plugins/kodesk54-plugin/custom-template/v4-pagination.php'); ?>
                                <?php wp_reset_postdata(); ?>
                                <?php $wp_query = $temp_query; ?>

                            </div>
                        </div>
                        
                        <?php include_once(ABSPATH . 'wp-content/plugins/kodesk54-plugin/custom-template/v4-map.php'); ?>

                        <?php if($settings['left_right_sidebar'] == 'right') { ?>
                        <!-- <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                            <div class="default-sidebar workspaces-sidebar">
                                <?php //dynamic_sidebar($settings['sidebar'] ); ?>
                            </div>
                        </div> -->
                        <?php } ?>
                    </div>
                </div>
            </section>
            <!-- workspaces-page-section end -->
        
        <?php wp_reset_postdata(); }
        else {
            ?>
            <section class="v4-filter-section">
                <div class="auto-container">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 v4-no-posts">
                            Sorry, There is not matched data...
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
    }
}
