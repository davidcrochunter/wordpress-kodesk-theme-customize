<?php
global $wp_query;
$max_pages = $wp_query->max_num_pages;
?>

<div class="infinite-scroll-workspace-status">
    <div id="v4-ajax-sppiner" class="infinite-scroll-workspace-request" style="text-align: center;">
        <div class="spinner-border text-success" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>
<div class="infinite-scroll-workspace-action" style="display: none">
    <div class="infinite-scroll-workspace-button button" data-paged="1" data-max-pages="<?php echo $max_pages; ?>">Load more</div>
</div>