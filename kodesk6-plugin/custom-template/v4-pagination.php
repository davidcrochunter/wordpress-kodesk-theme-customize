<?php
global $wp_query;
$max_pages = $wp_query->max_num_pages;
?>

<div class="infinite-scroll-workspace-status">
    <div class="infinite-scroll-workspace-request"></div>
</div>
<div class="infinite-scroll-workspace-action">
    <div class="infinite-scroll-workspace-button button" data-paged="1" data-max-pages="<?php echo $max_pages; ?>">Load more</div>
</div>