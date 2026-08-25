<?php

/**
 * Registers the block(s) metadata from the `blocks-manifest.php` and registers the block type(s)
 * based on the registered block metadata. Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
 */
function mindset_blocks_mindset_blocks_block_init() {
	wp_register_block_types_from_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
}
add_action( 'init', 'mindset_blocks_mindset_blocks_block_init' );


/**
* Registers the custom fields for some blocks.
*
* @see https://developer.wordpress.org/reference/functions/register_post_meta/
*/

// 「ページごとに異なる会社情報（住所やメールなど）を、本文とは別に管理したい」という課題に対して、「Gutenberg（管理画面のReact）からも扱える専用の保存枠をWordPress上に新しく作る」

function mindset_register_custom_fields() {
	// WordPressに対して「固定ページ（page）に、新しいカスタムフィールド（メタデータ）を追加で保存できるようにしてね」と登録する関数です。
	register_post_meta(
		'page',
		'company_email',
		array(
			// 'type' => 'string': 保存するデータの種類が「文字列」であることを指定しています。
			'type'         => 'string',
			// Gutenberg（ブロックエディター・React）側から、このカスタムフィールドの値を読み書き（取得・保存）できるようにするための設定です。これが true になっていないと、管理画面のReactからデータを操作できません。
			'show_in_rest' => true,
			// 今回の会社情報（メールアドレスや住所）のように、「1つの固定ページにつき、値は必ず1つだけ（上書き保存していく形）」としてシンプルに扱いたいときに指定します。これを true にしておくと、ReactやPHP側でデータを呼び出すときに、配列の余計な階層を気にせず「その値そのもの」をスパッと直接取得しやすくなるため、一般的なカスタムフィールドではほとんどの場合 true に設定します。
			'single'       => true
		)
	);
	register_post_meta(
		'page',
		'company_address',
		array(
			'type'         => 'string',
			'show_in_rest' => true,
			'single'       => true
		)
	);
}
// WordPressが起動・初期化されるタイミング（init）で、この登録処理を一緒に実行してね、というお決いのフック（指示）です。
add_action( 'init', 'mindset_register_custom_fields' );


function mindset_register_php_blocks() {
	// register_block_type で、その保存されたサービス情報を画面の好きな場所にペタッと貼り付けて綺麗に一覧表示できる「ブロック」を用意する。
    register_block_type(
        'mindset-blocks/services',
        array(
            'title'           => __( 'Services', 'services' ),
            'icon'            => 'chart-bar',
            'category'        => 'widgets',
            'description'     => __( 'Output Service posts', 'services' ),
            'keywords'        => array( 'serve', 'service', 'services', 'mindset' ),
            'render_callback' => 'mindset_render_service_posts',
            'supports'        => array(
                'autoRegister' => true,
                'spacing' => array(
                    'margin' => true
                )
            ),
            'attributes' => array(
                'sorting' => array(
                    'type' => 'string',
                    'enum' => array('ASC', 'DESC'),
                    'default' => 'ASC',
                    'label' => 'Sort A-Z or Z-A'
                )
            )
        )
    );
}
add_action( 'init', 'mindset_register_php_blocks' );

// ① ここに今回の「コールバック関数」を書く
function mindset_render_service_posts( $attributes ) {    
    /* 
     * 【ob_start() とは？（出力バッファリングの開始）】
     * 通常、PHPでechoやHTMLタグを直接書くと、その場ですぐに画面に出力されてしまいます。
     * しかし、WordPressのブロック（render_callback）では、生成したHTMLを「ひとつの文字列」として
     * まとめて「return」で返す必要があります。
     * そのため、ob_start() を使って「この下で出力するHTMLを、画面に出さずに一時的にメモリ（バッファ）にため込んでおいてね」
     * という指示を出しています。
     */
    ob_start();
    ?>    
    <div <?php echo get_block_wrapper_attributes(); ?>>        
        <?php        
        // 1. サービスのデータを取得するための条件（引数）を配列で定義する
        $args = array(            
            'post_type'      => 'fwd-service',            
            'posts_per_page' => -1,            // すべての投稿を取得。WordPressの特別なルールで、「件数の制限をなし（無制限）にする＝すべて取得する」という意味
            'orderby'        => 'title',           // タイトル順に並び替え
            'order'          => 'ASC',             // 昇順（A-Z）
        ); 
        
        // WP_Query を使って実際にデータベースからデータを取得
        $query = new WP_Query( $args ); 

        // 2. 【上部】アンカーリンクのナビゲーション（目次）を出力
        if ( $query -> have_posts() ) {
            echo '<nav class="services-nav">';                        
            while ( $query -> have_posts() ) {
				// データベースから WP_Query で複数の記事（今回はすべてのサービス投稿）をまとめて持ってきたあと、「その中から1件ずつ順番に取り出して、使える状態（スタンバイ状態）にする」という役割をしています。
                $query -> the_post();                                
                // 各投稿のID（例: post-123）をアンカーハッシュ（#）としてリンクを生成
                echo '<a href="#'. esc_attr( get_the_ID() ) .'">'. esc_html( get_the_title() ) .'</a>'; 
            }
            wp_reset_postdata(); // 投稿データをリセットして次のクエリに備える
            echo '</nav>';
        } 

        // 3. 同じ条件で再度 WP_Query を定義して取得（本文のループ用）
        $args = array(            
            'post_type'      => 'fwd-service',            
            'posts_per_page' => -1,            
            'orderby'        => 'title',            
            'order'          => 'ASC',            
            // 'order'       => $attributes['sorting']         
        );
                        
        $query = new WP_Query( $args );

        // 4. 【下部】各サービスの詳細コンテンツ本体をセクションとして出力
        if ( $query -> have_posts() ) {
            echo '<section>';
            while ( $query -> have_posts() ) {
                $query -> the_post(); 
                // 各記事のラッパーに、上のリンク先と一致するID（投稿ID）を付与してジャンプできるようにする
                echo '<article id="'. esc_attr( get_the_ID() ) .'">';	
                    echo '<h2>' . esc_html( get_the_title() ) . '</h2>';
                    the_content(); // サービスの本文を出力
                echo '</article>';                            
            }
            wp_reset_postdata(); // 投稿データを完全にリセット
            echo '</section>';
        }
        ?>
    </div>
    <?php
    /* 
     * 【ob_get_clean() とは？】
     * ob_start() からここまでの間にため込んでおいたすべてのHTMLを、
     * 「ひとつのきれいな文字列」として一気に回収し、メモリをクリアにする関数です。
     * これを return することで、WordPressが画面上の正しい位置にHTMLを表示してくれます。
     */
    return ob_get_clean();
}

// ② その下に、先ほどの「ブロック登録のコード」を書く
// Load CSS on front-end if the block is used
// function mindset_blocks_enqueues() {
//     wp_enqueue_block_style( 
//         'mindset-blocks/services',
//         array(
//             'handle' => 'mindset-blocks-css',
//             'src'    => get_theme_file_uri( 'mindset-blocks/blocks.css'),
//             'ver'    => '1.0.0'
//         ) 
//     );
// }
// add_action( 'after_setup_theme', 'mindset_blocks_enqueues' );


// // Load CSS in editor if the block is used
// add_action( 'enqueue_block_editor_assets', function () {
//     wp_enqueue_style(
//         'mindset-blocks-css',
//         get_theme_file_uri( 'mindset-blocks/blocks.css' ),
//         array(),
//         '1.0.0'
//     );
// } );