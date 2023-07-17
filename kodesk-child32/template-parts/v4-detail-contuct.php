<div class="form-inner v4-detail-contuct-form">
    <div class="sec-title">
        <h6>Send Message</h6>
    </div>
    <div id="contact-form" class="default-form"> 
        <?php
        $form_id = 2473; // The ID of your contact form
        $shortcode = '[contact-form-7 id="' . $form_id . '" title="workspace-contact-form"]';

        // Execute the shortcode
        echo do_shortcode($shortcode);
        ?>
    </div>
</div>
