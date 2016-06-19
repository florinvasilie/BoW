<!DOCTYPE html>
<html>
<body>

<form action="test2.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload[]" id="fileToUpload"  accept="image/*" multiple="" required>
    <input type="submit" value="Upload Image" name="submit">
</form>
</body>
</html>
<?php 
	$ceva=md5(htmlspecialchars('laaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'));
	echo  strlen($ceva);

 ?>