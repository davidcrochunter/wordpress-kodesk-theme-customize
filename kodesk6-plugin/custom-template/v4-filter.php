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
</form>

<section class="v4-filter-section">
    <div class="auto-container">
        <div class="row clearfix">
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
</section>