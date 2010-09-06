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
        "Have you hugged a robot today?"
);

echo $form->create();
echo $form->input('Murl.uri', array('label' => 'Insert URL below:<br />','class' => 'mtext'));
echo "<div id='options_div' class='options'>";
echo $form->input('Murl.protect');
echo $form->input('Murl.private');
echo $form->input('Murl.destruct');
echo "</div>";

echo "<div class='tocenter'>";
echo $form->end($submit[array_rand($submit)]);
echo "</div>";

?>
