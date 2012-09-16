<form enctype="multipart/form-data" action="" method="post" >
	<input type="hidden" name="MAX_FILE_SIZE" value="
		<?php echo $size = return_bytes(ini_get('upload_max_filesize')); ?>" />
    <input name ="file" type ="file" />
    <input type ="submit" name="file_upload" value ="Send" />
</form>
<?php
/**
 * here be process STATUS_CODE
 */