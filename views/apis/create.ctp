<?php
if($error == 0) {
    echo "http://".$app_domain."/".$code;
}
else {
    echo $error;
}
?>
