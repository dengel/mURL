<?php 
foreach($murls as $murl) {
  echo "http://".Configure::read('murl.domain')."/".$murl['Murl']['code'];
}
?>
