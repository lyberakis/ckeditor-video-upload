require(['jquery', 'elgg'], function($, elgg) {
	
	elgg.register_hook_handler('config', 'ckeditor', function(hook, type, params, returnValue) {

		// add uploadimage plugin to loaded plugins
		var extraPlugins = returnValue.extraPlugins.split(',');
		if (typeof extraPlugin === null) {
			extraPlugins = [];
		}
		extraPlugins.push('html5video');
		
		// prevent the blockimagepaste plugin from being loaded
		function removeBlockImagePaste(value) {
			return value !== 'blockimagepaste';
		}
		extraPlugins = extraPlugins.filter(removeBlockImagePaste);
		returnValue.extraPlugins = extraPlugins.join(',');
		
		// make sure uploadimage plugin isn't blocked
		var removePlugins = returnValue.removePlugins.split(',');
		if (Array.isArray(removePlugins)) {
			function filterPlugin(value) {
				return value !== 'html5video';
			}
			
			removePlugins = removePlugins.filter(filterPlugin);
			returnValue.removePlugins = removePlugins.join(',');
		}
		
		// set upload url
		returnValue.filebrowserUploadUrl = ((elgg.is_logged_in()) ? elgg.normalize_url('ckeditor_video_upload/upload') + '?uploading' : false);
		returnValue.filebrowserUploadMethod = 'form';
		
		return returnValue;
	});
});
