<?php
header('Content-Type: image/jpeg');
readfile('/tmp/'.$_FILES["file"]["tmp_name"] . jpg);
?>
