<?php
/**
 * Title: Book Review
 * Slug: mindset-theme/book-review
 * Categories: media, text
 */
?>


<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:image {"id":19,"width":"269px","height":"auto","sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large is-resized"><img src="<?php 
echo esc_url( get_theme_file_uri( 'assets/img/book-cover.jpg' ) )

?>" alt="<?php esc_html_e('Placeholder image og a book', 'mindset-theme');?>" class="wp-image-19" style="width:269px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading {"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size"><?php esc_html_e('Title', 'mindset-theme');?>Title</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Author</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Description</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->