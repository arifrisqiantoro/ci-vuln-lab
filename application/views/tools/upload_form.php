<!DOCTYPE html>
<html>
<head><title>Upload File</title></head>
<body>
<h2>Upload File</h2>
<form action="<?php echo base_url('upload/do_upload'); ?>" method="post" enctype="multipart/form-data">
	<input type="file" name="userfile">
	<input type="submit" value="Upload">
</form>
<p>Tidak ada validasi ekstensi -> coba upload file .php.</p>
</body>
</html>
