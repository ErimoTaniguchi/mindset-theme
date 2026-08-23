/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */

export default function Edit( { attributes, setAttributes } ) {
	const { startingYear } = attributes;
	const currentYear = new Date().getFullYear().toString();
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Settings', 'copyright-date' ) }>
					<TextControl
						label={ __( 'Starting Year', 'copyright-date' ) }
						value={ startingYear }
						onChange={ ( newStartingYear ) => {
							setAttributes( { startingYear: newStartingYear } );
						} }
					/>
				</PanelBody>
			</InspectorControls>
			<p { ...useBlockProps() }>
				{ __( 'Copyright', 'copyright-date') } © { startingYear } - { currentYear }
			</p>
		</>
	);
}


{/* 
<InspectorControls>（インスペクター・コントロール）:エディターの右側に出てくる「設定用サイドバー」のこと。

<PanelBody>（パネル・ボディ）:そのサイドバーの中にある「Settings」といった名前の折りたたみ式の箱（枠）のこと。

<TextControl>（テキスト・コントロール）:文字をパチパチ入力できる「入力ボックス」のこと。

onChange（オン・チェンジ）:入力ボックスの中身が書き換わった瞬間に、「新しいデータを保存してね！」と命令するための仕組み。 */}