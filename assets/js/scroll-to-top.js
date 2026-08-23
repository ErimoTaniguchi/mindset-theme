/**
 * 1. 追加するボタンのHTMLを文字列として定義する
 * （SVGの矢印アイコンと、スクリーンリーダー用のテキストを含める）
 */
const button_html = `
<button id="scroll-top" class="scroll-top">
	<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24">
		<path d="M23.677 18.52c.914 1.523-.183 3.472-1.967 3.472h-19.414c-1.784 0-2.881-1.949-1.967-3.472l9.709-16.18c.891-1.483 3.041-1.48 3.93 0l9.709 16.18z"></path>
	</svg>
	<span class="screen-reader-text">Scroll To Top</span>
</button>`;

/**
 * 2. 定義したボタンのHTMLを、bodyタグ内の最後（一番下）に自動で挿入する
 */
document.body.insertAdjacentHTML('beforeend', button_html);

/**
 * 3. 挿入されたボタンの要素をJavaScriptで取得する
 */
const button = document.getElementById('scroll-top');

/**
 * 4. ボタンがクリックされたときの動作を設定する
 * （クリックされたら、ページの一番上（座標 0, 0）に移動する）
 */
button.addEventListener('click', function(){
	window.scrollTo(0, 0);
});

/**
 * 5. ページがスクロールされたときの動作を設定する
 * （一番上にいるときはボタンを隠し、少しでも下にスクロールしたらボタンを表示する）
 */
window.addEventListener('scroll', function(){
	if(window.scrollY == 0){
		button.style.opacity = "0";
	} else {
		button.style.opacity = "1";
	}
});