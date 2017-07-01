<?php
print_r($_FILES); 
print_R($_POST);
?>
<form action='upload.php' method='post' enctype="multipart/form-data">
<input type='file' name='f' id='f' />
<input type='submit' />
</form>
