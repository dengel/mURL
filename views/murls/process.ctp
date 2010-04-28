<?
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
<?php if ($searchbox): ?>
<form action="http://www.google.com/cse" id="cse-search-box">
  <div><nobr>
      <input type="hidden" name="cx" value="partner-pub-8660589795501578:5nb6bu5ljm9" />
      <input type="hidden" name="ie" value="ISO-8859-1" />
      <input type="text" name="q" size="31" /><input type="submit" name="sa" value="Search" />
      </nobr>
  </div>
</form>
<script type="text/javascript" src="http://www.google.com/cse/brand?form=cse-search-box&amp;lang=en"></script>
<?php endif; ?>
