<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script src="sample.js" type="text/javascript"></script>
<link href="sample.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
	//<![CDATA[
	
	// This call can be placed at any point after the
	// <textarea>, or inside a <head><script> in a
	// window.onload event handler.
	
	// Replace the <textarea id="editor"> with an CKEditor
	// instance, using default configurations.
 $('textarea.ckeditor').each( function () {
	CKEDITOR.replace( this.id,
	{
		filebrowserBrowseUrl :'http://localhost/asia_travels/cms/includes/js/ckeditor/filemanager/browser/default/browser.html?Connector=http://localhost/asia_travels/cms/includes//js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserImageBrowseUrl : 'http://localhost/asia_travels/cms/includes/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=http://localhost/asia_travels/cms/includes//js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserFlashBrowseUrl :'http://localhost/asia_travels/cms/includes/js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=http://localhost/asia_travels/cms/includes//js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserUploadUrl  :'http://localhost/asia_travels/cms/includes/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
		filebrowserImageUploadUrl : 'http://localhost/asia_travels/cms/includes/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
		filebrowserFlashUploadUrl : 'http://localhost/asia_travels/cms/includes/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
	});
});

	//]]>
	</script>
