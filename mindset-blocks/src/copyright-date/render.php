<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<p 
<?php echo get_block_wrapper_attributes(); ?>>
	<?php esc_html_e( 'Copyright', 'copyright-date' ); ?> © <?php echo date( 'Y' ); ?>
</p>

<!-- 
get_block_wrapper_attributes()
エディター側で設定したクラス名やスタイル（配置など）を、フロントエンド側の <p> タグに自動で出力・付与するためのWordPress関数です。 
	
esc_html_e( 'Copyright', 'copyright-date' );
先ほどReact側でも出てきた「Copyright」という文字を、安全にエスケープ処理しながら翻訳して画面に出力（echo）するための関数です。
esc_html_e を使うことで、セキュリティ上危険なHTMLタグなどが混ざらないように安全に保護しながらテキストを表示できます。-->
