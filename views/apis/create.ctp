<?php
if($error == 0) {
    echo "http://".Configure::read('murl.domain')."/".$code;
}
else {
    echo $error;
}
?>
