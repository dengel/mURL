<?php
if($error == 0) {
    echo "http://".$app_domain."/".$code;
}
else {
    echo "Error $error: $error_msg \n";
}
?>
