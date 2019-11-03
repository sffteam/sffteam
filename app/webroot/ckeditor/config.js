/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
//	config.extraPlugins = 'font';
	config.contentsCss = 'fonts.css';
	config.font_names =
    'Arial/Arial, Helvetica, sans-serif;' +
    'Times New Roman/Times New Roman, Times, serif;' +
    'B Bharti/';
	config.font_names = CKEDITOR.config.font_names + "B Bharti" 
};
