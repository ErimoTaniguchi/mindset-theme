<?php
function mindset_enqueues() {
    
    // Load normalize.css
    wp_enqueue_style( 
        'mindset-normalize',                    // ① ハンドル名（このCSSの登録名）
        get_theme_file_uri( 'assets/css/normalize.css'), // ② ファイルの場所（テーマフォルダの中にある場所を指定）
        array(),                                // ③ 依存関係（今回はなし）
        '20260814'                                // ④ バージョン番号（ファイルのバージョン）
        );
        
    // Load style.css on the front-end
    // Parameters: Unique handle, Source, Dependencies, Version number, Media
    wp_enqueue_style( 
        // ① ハンドル名（システム上のユニークな登録名。他の名前と被らないようにする）
        'mindset-style',
        
        // ② ファイルの場所（現在のテーマの style.css のURLを自動で取得する関数）
        get_stylesheet_uri(),
        
        // ③ 依存関係（このCSSより先に読み込ませたい他のCSSがある場合はここに配列で指定する）
        array(),
        
        // ④ バージョン番号（テーマのバージョンを自動取得。ブラウザのキャッシュ対策に必須！）
        wp_get_theme()->get( 'Version' ),
        
        // ⑤ メディアクエリ（適用範囲。すべてのデバイスで読み込ませる場合は 'all' を指定）
        'all'
    );

        // Scroll to top
    wp_enqueue_script(
        'mindset-scroll-to-top',                   // ① このスクリプト専用のユニークなハンドル名
        get_theme_file_uri( 'assets/js/scroll-to-top.js' ), // ② テーマフォルダ内にあるJSファイルのパス
        array(),                                   // ③ 依存関係（今回は他のJSに依存していないので空）
        wp_get_theme()->get( 'Version' ),          // ④ バージョン番号（テーマのバージョンを自動取得してキャッシュ対策）
        array( 'strategy' => 'defer' )             // ⑤ 読み込み最適化（レンダリングをブロックしないための defer 設定）このJavaScriptファイルをどのような作戦（タイミング）で読み込ませるか。HTMLの読み込みを止めずに裏側でこっそりJSファイルをダウンロードしておいて、ページのHTML解析がすべて終わったあとに実行する
    );

    if ( is_page( 15 ) ) {
        wp_enqueue_script(
            'mindset-contact-scripts',
            get_theme_file_uri('assets/js/contact.js'),
            array( 'mindset-scroll-to-top' ),
            wp_get_theme()->get( 'Version' ),  
            array( 'strategy' => 'defer' )
        );
    }

}
// ⑥ アクションフック（WordPressがスタイルを読み込むタイミングで、上の関数を動かす）wp_enqueue_scripts は、「実際にウェブサイトのページ（フロントエンド）が表示されるときに、CSSファイルやJavaScriptファイルをブラウザに読み込ませる」ための専用のタイミングです。
add_action( 'wp_enqueue_scripts', 'mindset_enqueues' );



function mindset_setup() {
    // Load style.css in Site and Block Editor
    // 編集画面（ブロックエディター・サイトエディター）にも 'style.css' のデザインを適用させる
    add_editor_style( get_stylesheet_uri() );

    // Crop images to 400px by 500px
    add_image_size( '400x500', 400, 500, true );

    // Crop images to 200px by 250px
    add_image_size( '200x250', 200, 250, true );

    add_image_size( '400x200', 400, 200, true );

    add_image_size( '800x400', 800, 400, true );
}

// テーマがセットアップ（初期化）されるタイミングで、上の関数を動かすように登録する。after_setup_theme: テーマの「設計図」や「基本ルール」を決める場所（画像サイズ追加、エディター設定など）
add_action( 'after_setup_theme', 'mindset_setup' );


// Make custom sizes selectable from WordPress admin.
function mindset_add_custom_image_sizes( $size_names ) {
    // 追加したいカスタムサイズの「スラッグ」と「管理画面に表示する名前」の配列を作る
	$new_sizes = array(
		'400x500' => __( '400x500', 'mindset-theme' ),
		'200x250' => __( '200x250', 'mindset-theme' ),
		'400x200' => __( '400x200', 'mindset-theme' ),
		'800x400' => __( '800x400', 'mindset-theme' ),
        
	);
    // 既存の画像サイズ一覧に、新しいカスタムサイズを合体させて返す
	return array_merge( $size_names, $new_sizes );
}
// image_size_names_choose フィルターを使って、WordPressにカスタムサイズを認識させる
add_filter( 'image_size_names_choose', 'mindset_add_custom_image_sizes' );

// Load custom blocks.
require get_theme_file_path() . '/mindset-blocks/mindset-blocks.php';
