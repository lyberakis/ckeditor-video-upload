<?php
/**
 * CKEditor Video Upload
 * @package ckeditor_video_upload
 */

namespace CKEditorVideoUpload\Elgg;

use Elgg\DefaultPluginBootstrap;

class Bootstrap extends DefaultPluginBootstrap {
	
	const HANDLERS = [];
	
	/**
	 * {@inheritdoc}
	 */
	public function init() {
		elgg_extend_view('elgg.js', 'js/video_upload.js');
		
		$this->initViews();
	}

	/**
	 * Init views
	 *
	 * @return void
	 */
	protected function initViews() {	
		// register extra css
		elgg_extend_view('elgg.css', 'ckeditor_video_upload/ckeditor_video_upload.css');

	}
}
