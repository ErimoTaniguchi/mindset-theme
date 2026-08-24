<?php
function mindset_register_custom_post_types() {
    // Regiser Works type
    $labels = array(
        'name'                     => _x( 'Works', 'post type general name', 'mindset-theme' ),
        'singular_name'            => _x( 'Work', 'post type singular name', 'mindset-theme' ),
        'add_new'                  => _x( 'Add New', 'work', 'mindset-theme' ),
        'add_new_item'             => __( 'Add New Work', 'mindset-theme' ),
        'edit_item'                => __( 'Edit Work', 'mindset-theme' ),
        'new_item'                 => __( 'New Work', 'mindset-theme' ),
        'view_item'                => __( 'View Work', 'mindset-theme' ),
        'view_items'               => __( 'View Works', 'mindset-theme' ),
        'search_items'             => __( 'Search Works', 'mindset-theme' ),
        'not_found'                => __( 'No works found.', 'mindset-theme' ),
        'not_found_in_trash'       => __( 'No works found in Trash.', 'mindset-theme' ),
        'parent_item_colon'        => __( 'Parent Works:', 'mindset-theme' ),
        'all_items'                => __( 'All Works', 'mindset-theme' ),
        'archives'                 => __( 'Work Archives', 'mindset-theme' ),
        'attributes'               => __( 'Work Attributes', 'mindset-theme' ),
        'insert_into_item'         => __( 'Insert into work', 'mindset-theme' ),
        'uploaded_to_this_item'    => __( 'Uploaded to this work', 'mindset-theme' ),
        'featured_image'           => __( 'Work featured image', 'mindset-theme' ),
        'set_featured_image'       => __( 'Set work featured image', 'mindset-theme' ),
        'remove_featured_image'    => __( 'Remove work featured image', 'mindset-theme' ),
        'use_featured_image'       => __( 'Use as featured image', 'mindset-theme' ),
        'menu_name'                => _x( 'Works', 'admin menu', 'mindset-theme' ),
        'filter_items_list'        => __( 'Filter works list', 'mindset-theme' ),
        'items_list_navigation'    => __( 'Works list navigation', 'mindset-theme' ),
        'items_list'               => __( 'Works list', 'mindset-theme' ),
        'item_published'           => __( 'Work published.', 'mindset-theme' ),
        'item_published_privately' => __( 'Work published privately.', 'mindset-theme' ),
        'item_revereted_to_draft'  => __( 'Work reverted to draft.', 'mindset-theme' ),
        'item_trashed'             => __( 'Work trashed.', 'mindset-theme' ),
        'item_scheduled'           => __( 'Work scheduled.', 'mindset-theme' ),
        'item_updated'             => __( 'Work updated.', 'mindset-theme' ),
        'item_link'                => __( 'Work link.', 'mindset-theme' ),
        'item_link_description'    => __( 'A link to a work.', 'mindset-theme' ),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_in_rest'       => true,
        'rewrite'            => array( 'slug' => 'works' ),
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );
    register_post_type( 'fwd-work', $args );

    // Register Testimonials post type
    $labels = array(
        'name'                  => _x( 'Testimonials', 'post type general name', 'mindset-theme' ),
        'singular_name'         => _x( 'Testimonial', 'post type singular name', 'mindset-theme' ),
        'menu_name'             => _x( 'Testimonials', 'admin menu', 'mindset-theme' ),
        'add_new'               => _x( 'Add New', 'testimonial', 'mindset-theme' ),
        'add_new_item'          => __( 'Add New Testimonial', 'mindset-theme' ),
        'new_item'              => __( 'New Testimonial', 'mindset-theme' ),
        'edit_item'             => __( 'Edit Testimonial', 'mindset-theme' ),
        'view_item'             => __( 'View Testimonial', 'mindset-theme'  ),
        'all_items'             => __( 'All Testimonials', 'mindset-theme' ),
        'search_items'          => __( 'Search Testimonials', 'mindset-theme' ),
        'parent_item_colon'     => __( 'Parent Testimonials:', 'mindset-theme' ),
        'not_found'             => __( 'No testimonials found.', 'mindset-theme' ),
        'not_found_in_trash'    => __( 'No testimonials found in Trash.', 'mindset-theme' ),
        'item_link'             => __( 'Testimonial link.', 'mindset-theme' ),
        'item_link_description' => __( 'A link to a testimonial.', 'mindset-theme' ),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_in_rest'       => true,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => array( 'title', 'editor' ),
        'template'           => array( array( 'core/pullquote' ) ),
        'template_lock'      => 'all'
    );
    register_post_type( 'fwd-testimonial', $args );

    // Register Job Posting post type
    $labels = array(
        'name'                  => _x( 'Job Postings', 'post type general name', 'mindset-theme' ),
        'singular_name'         => _x( 'Job Posting', 'post type singular name', 'mindset-theme' ),
        'menu_name'             => _x( 'Job Postings', 'admin menu', 'mindset-theme' ),
        'add_new'               => _x( 'Add New', 'service', 'mindset-theme' ),
        'add_new_item'          => __( 'Add New Job Posting', 'mindset-theme' ),
        'new_item'              => __( 'New Job Posting', 'mindset-theme' ),
        'edit_item'             => __( 'Edit Job Posting', 'mindset-theme' ),
        'view_item'             => __( 'View Job Posting', 'mindset-theme' ),
        'view_items'             => __( 'View Job Posting', 'mindset-theme' ),
        'all_items'             => __( 'All Job Postings', 'mindset-theme'  ),
        'search_items'          => __( 'Search Job Postings', 'mindset-theme' ),
        'parent_item_colon'     => __( 'Parent Job Postings:', 'mindset-theme' ),
        'not_found'             => __( 'No Job Postings found.', 'mindset-theme' ),
        'not_found_in_trash'    => __( 'No Job Postings found in Trash.', 'mindset-theme' ),
        'insert_into_item'      => __( 'Insert into Job Posting', 'mindset-theme' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Job Posting', 'mindset-theme' ),
        'item_link'             => __( 'Job Posting link.', 'mindset-theme' ),
        'item_link_description' => __( 'A link to a job posting.', 'mindset-theme' ),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_in_rest'       => true,
        'rewrite'            => array( 'slug' => 'careers' ),
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 21,
        'menu_icon'          => 'dashicons-megaphone',
        'supports'           => array( 'title', 'editor' ),
        'template'           => array(
            array( 'core/heading', array( 'level' => 3, 'content' => 'Role', ) ),
            array( 'core/paragraph', array( 'placeholder' => 'Describe the role...' ) ),
            array( 'core/heading', array( 'level' => 3, 'content' => 'Requirements' ) ),
            array( 'core/list' ),
            array( 'core/heading', array( 'level' => 3, 'content' => 'Location' ) ),
            array( 'core/paragraph' ),
            array( 'core/heading', array( 'level' => 3, 'content' => 'How to Apply' ) ),
            array( 'core/paragraph' ),
        )
    );
    register_post_type( 'fwd-job-posting', $args );
}

add_action( 'init', 'mindset_register_custom_post_types' );


/**
 * テーマが切り替わったタイミングで実行される関数
 * テーマ有効化時に手動でパーマリンク設定を保存し直す手間を省くための自動化処理です。
 */
function mindset_rewrite_flush() {
    
    // カスタム投稿タイプを登録する関数を呼び出して、投稿タイプの構造を再読み込みさせる
    mindset_register_custom_post_types();
    
    // パーマリンクのルール（リライトルール）を強制的に更新（フラッシュ）し、新しいURLで404エラーが出ないようにする
    flush_rewrite_rules();

}

// テーマが新しく有効化された瞬間（after_switch_themeフック）に、上記の関数を自動実行する
add_action( 'after_switch_theme', 'mindset_rewrite_flush' );