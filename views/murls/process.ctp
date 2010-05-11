<?php
   $searchbox=0;
   if ($error == 401) {
      if ($this->data) {
         $code=$this->data['Murl']['code'];
      } else {
         $code=$this->params['url']['url'];
      }
      echo $form->create('Murl', array('url' => 'Murls/process'));
      echo $form->input('code', array('value' => $code, 'type' => 'hidden'));
      echo $form->input('protect', array('label' => 'Insert key below:'));
      echo $form->end('Try now');
   } elseif ($error == 410) {
      echo "All gone :(<br><br>";
      $searchbox++;
   } elseif ($error == 404) {
      echo "Maybe search for it?";
      $searchbox++;
   } else {
      echo "$code ($error)";
      $searchbox++;
   }
?>
<?php
if ($searchbox) {
    echo $this->element('gsearch');
}
?>