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
import { PanelBody, TextControl, ToggleControl} from '@wordpress/components';

import image1 from "./dagensbibelord_default.jpg";
/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */

export default function Edit( {attributes, setAttributes}) {
	const year = new Date().getFullYear();
	const month = (parseInt(new Date().getMonth())+1).toString().padStart(2, '0');
	const day = new Date().getDate().toString().padStart(2, '0');
	const fulldate = `${year}-${month}-${day}`;
	
	const { imgLink, width } = attributes;

	var editStyle = {
		maxWidth: width,
		height: "auto"
	}

	return (
		<>
			<InspectorControls>
				<PanelBody title={__( 'Inställningar', 'dagens-bibelvers' ) }>
					<ToggleControl
						label={ __('Länk', 'dagens-bibelvers') }
						checked={ !! imgLink}
						onChange={ () =>
							setAttributes( { imgLink: ! imgLink })
						}
					/>
					<TextControl
						label={ __('Bredd')}
						value={ width || "100%" }
						onChange={(value)=> setAttributes({width: value})}
					/>
				</PanelBody>
			</InspectorControls>
			<p { ...useBlockProps() }>
				<img className="dagens-bibelvers-image" style={editStyle} src={image1}></img>
			</p>
		</>
	);
}
