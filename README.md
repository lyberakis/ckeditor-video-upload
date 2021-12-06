CKEditor Video Upload
=====================

![Elgg 3.3](https://img.shields.io/badge/Elgg-3.3-orange.svg?style=flat-square)

Add a video upload button on CKEditor using the **Html5video** plugin of CKEditor.

This plugin adds a video button to ckeditor for uploading videos on any entity with a rich editor input, e.g. blog. 

The video uploaded is also available on Videos section in private access mode, so the user is able to edit relevant information.

## Requirements

1. CKEditor core Elgg plugin
2. [iZAP Videos - revised edition by iionly](https://github.com/iionly/izap_videos) plugin
3. [ckeditor_extended](https://github.com/ColdTrick/ckeditor_extended) plugin


## How to use 

1. Add on Elgg site and enable
2. On "CKEditor Extended" plugin settings add the "Html5video" tag as follows:

```js
toolbar: [['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat'], ['NumberedList', 'BulletedList', 'Undo', 'Redo', 'Link', 'Unlink', 'Image', 'Blockquote', 'Paste', 'PasteFromWord','Maximize','Html5video']],
...
extraPlugins: 'html5video',
```

3. On "CKEditor Extended" plugin settings, add the "video" on "HTML elements" field