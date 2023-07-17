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


<div>

<section class="v4-filter-section">
    <div class="auto-container">
        <div class="row v4-filter-panel">
            <div class="col-lg-12 col-md-12 v4-filter-wrapper">


<div class="form-inner ">
    <div id="contact-form" class="default-form"> 
        <?php
        $form_id = 5151; // The ID of your contact form
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








