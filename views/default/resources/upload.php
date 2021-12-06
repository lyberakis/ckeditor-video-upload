<?php

use Elgg\Project\Paths;

elgg_gatekeeper();

$user_guid = elgg_get_logged_in_user_guid();
$response_params = [
	'response_type' => elgg_extract('responseType', $vars, get_input('responseType')),
	'funcNum' => elgg_extract('CKEditorFuncNum', $vars, get_input('CKEditorFuncNum')),
];

$originalFileName = $_FILES['params']['name']['videoFile'];
$filename = Paths::sanitize($originalFileName, false);

$izap_videos = new IzapVideos();
$izap_videos->views = 0;
$izap_videos->last_viewed = (int) time();
$izap_videos->container_guid = $user_guid;
$izap_videos->title = htmlspecialchars($filename, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$izap_videos->access_id = ACCESS_PRIVATE; //ACCESS_PUBLIC;

$videoValues = $izap_videos->input(
	[
		'file' => $_FILE,
		'mainArray' => 'params',
		'fileName' => 'videoFile',
	],
	'file'
);

if (!is_object($videoValues)) {
	$response_params['error'] = elgg_echo('izap_videos:error:code:' . $videoValues);
	echo ckeditor_extended_get_file_upload_response($response_params);
	return;
}

if (empty($videoValues->type) || (!file_exists($videoValues->tmpFile))) {
	$response_params['error'] = elgg_echo('izap_videos:error:notUploaded');
	echo ckeditor_extended_get_file_upload_response($response_params);
	return;
}

$izap_videos->videotype = $videoValues->type;
$izap_videos->imagesrc = elgg_get_simplecache_url('izap_videos/ajax_loader.gif');

// Defining new preview attribute to be saved with the video entity
if ($videoValues->preview) {
	$izap_videos->preview = $videoValues->preview;
}

$izap_videos->converted = 'no';
$izap_videos->videofile = 'nop';
$izap_videos->orignalfile = 'nop';

if (!$izap_videos->save()) {
	return elgg_error_response(elgg_echo('izap_videos:error:save'), REFERER);
}

// save the file info for converting it later in queue
$izap_videos->videosrc = elgg_get_site_url() . 'izap_videos_files/file/' . $izap_videos->guid . '/' . elgg_get_friendly_title($izap_videos->title) . '.mp4';
izapSaveFileInfoForConverting_izap_videos($videoValues->tmpFile, $izap_videos, $izap_videos->access_id);

// CKEditor stuff
$prefix = '';
if ($response_params['response_type'] === 'json') {
	// store pasted videos in different location
	$prefix = 'paste' . DIRECTORY_SEPARATOR;
	// generate random filename for less naming conflicts
	$filename = md5(microtime(true)) . ".{$upload->guessExtension()}";
}

$response_params['uploaded'] = true;
$response_params['filename'] = $originalFileName;
$response_params['url'] = elgg_get_site_url() . 'izap_videos_files/file/' . $izap_videos->getGUID() . '/' . elgg_get_friendly_title($izap_videos->title) . '.mp4';;

echo ckeditor_extended_get_file_upload_response($response_params);

