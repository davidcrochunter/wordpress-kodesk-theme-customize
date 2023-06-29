<?php 

//     ████████
//   ██        ▊
//   ██
//   ██
//   ██
//   ██        ▊
//     ████████
// ajax fetch function : Client Side
add_action( 'wp_footer', 'ajax_fetch' );
function ajax_fetch() {
?>
<script type="text/javascript">

    function ajax_send_req(type/*='post'*/, dataType/*='html'*/, action/*='data_fetch'*/, data, callback){

        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type,
            dataType,
            data: {
                action,
                data,
            },
            success: function(res) {
                callback(res);
            },
            error: function() {
                alert('ajax-error!');
            }
        });
    }
</script>

<?php
}


//     ████████
//   ██        ▊
//   ██
//     ████████
//             ██
//   ██        ██      
//    █████████    
// the ajax function : Server Side
add_action('wp_ajax_v4_workspace_data_fetch' , 'v4_workspace_data_fetch');
add_action('wp_ajax_nopriv_v4_workspace_data_fetch','v4_workspace_data_fetch');
function v4_workspace_data_fetch(){

    $args = array(
        'post_type'      => 'workspace',
        'posts_per_page' => 4,//kodesk_set( $settings, 'query_number' ),
        'orderby'        => kodesk_set( $settings, 'query_orderby' ),
        'order'          => kodesk_set( $settings, 'query_order' ),
        'paged'          => $_POST['data']['paged'],
        'workspace_cat'  => $_POST['data']['workspace_cat'],
    );

    /**
     * Add v4-filters to query args
     */
    // $district_cat = $_POST['data']['district'];
    // $usetype_cat = $_POST['data']['usetype'];
    // $addcondition_cat = $_POST['data']['addcondition'];

    // $tax_query = array();

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

    $response = '';

    if(have_posts()) {
        while(have_posts()) : the_post();
            include(ABSPATH . 'wp-content/plugins/kodesk10-plugin/custom-template/v4-content.php');
        endwhile;

        // include_once(ABSPATH . 'wp-content/plugins/kodesk10-plugin/custom-template/v4-pagination.php');
        
        wp_reset_postdata();
        $wp_query = $temp_query;

    } else {
        $response = '';
    }

     echo $response;

    exit;

    // die();
}

/*
add_action( 'wp_ajax_my_action', 'my_action_callback' );

function my_action_callback() {
    // Handle AJAX request here
    wp_send_json( array( 'success' => true ) );
}
*/