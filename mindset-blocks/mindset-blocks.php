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

