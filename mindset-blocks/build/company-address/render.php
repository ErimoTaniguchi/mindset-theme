<address <?php echo get_block_wrapper_attributes(); ?>>
	<?php if ( $attributes[ 'svgIcon' ] ) : ?>
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" role="img" aria-label="Location Icon">
			<path d="M12 0c-3.148 0-6 2.553-6 5.702 0 3.148 2.602 6.907 6 12.298 3.398-5.391 6-9.15 6-12.298 0-3.149-2.851-5.702-6-5.702zm0 8c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2zm4 14.5c0 .828-1.79 1.5-4 1.5s-4-.672-4-1.5 1.79-1.5 4-1.5 4 .672 4 1.5z"/>
		</svg>
	<?php endif; ?>
	<!-- get_post_meta( 15, 'company_address', true ):
	先ほど保存したカスタムフィールド（company_address）の値をデータベースから引っ張り出してきています -->
	<!-- wp_kses_post( ... ): 取得した文字の中に、もし悪意のあるプログラムコード（怪しいHTMLなど）が混ざっていても、ウェブサイトを守るために安全なタグ以外を取り除いて（サニタイジングして）綺麗に出力してくれるWordPressの安全ガード機能です。 -->
	<p><?php echo wp_kses_post( get_post_meta( 15, 'company_address', true ) ); ?></p>
</address>