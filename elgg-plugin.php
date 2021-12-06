<?php
/**
 * CKEditor Video Upload
 * @package ckeditor_video_upload
 */

use CKEditorVideoUpload\Elgg\Bootstrap;

return [
    'bootstrap' => Bootstrap::class,
    'settings' => [],
    'views' => [],
    'upgrades' => [],
    'routes' => [
        'default:ckeditor_video_upload:upload' => [
			'path' => '/ckeditor_video_upload/upload',
			'resource' => 'upload',
		],
    ],
];
