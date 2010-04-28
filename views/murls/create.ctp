<!-- File: /app/views/posts/create.ctp -->	
	
<?php
if ($code) {
echo "<div class='result'>";
    echo $html->link("http://murl.net/".$code, "/".$code, array('class' => 'result_text'));
echo "</div>";
}
?>
<?php
$submit = array("Go, damn it!", 
                "Follow the white rabbit", 
                "Is it crunched yet?", 
                "Are we there yet?", 
                "Let's do this!", 
                "Submit", 
                "Enter", 
                "Press with your mind", 
                "Return", 
                "I *can* do that Dave", 
                "Vamos, vamos!", 
                "Oh, boy...", 
                "You can do it!", 
                "Squeeze it!", 
                "In mURL we trust", 
                "Make it so", 
                "I'm glad I'm not Rigo", 
                "Do the needful", 
                "I'm a good button.", 
                "You want to click me", 
                "Don't click me!", 
                "Am I becoming aware?", 
                "Click at own risk", 
                "Beware of the button",
                "Does not hurt any :)", 
                "Punch it, Chewy!", 
                "Have you hugged a robot today?");
echo $form->create('Murl', array('type' => 'post'));
echo $form->input('url', array('label' => 'Insert URL below:'));
echo "<div id='options_div' style='display:none;'>";
echo $form->input('protect', array('div' => 'small'));      
echo $form->input('private', array('div' => 'small'));      
echo $form->input('destruct', array('div' => 'small'));  
echo "</div>";
echo $form->end($submit[array_rand($submit)]);
?>
<?php
	echo $html->charset("UTF-8");
	$javascript->link("prototype",false);
	$javascript->link("scriptaculous",false);

	$opt = array(
		"complete" => "Effect.toggle('options_div','slide',{duration: 0.2})"
	);

   echo "<div class='toright'>";
   echo $ajax->link('Options',"",$opt);
   echo " | ";
   echo $html->link('Archive','/Murls/view');
   echo " &nbsp; &nbsp; ";
   echo "</div>";
?>
<br>
