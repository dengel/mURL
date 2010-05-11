<h2>Murls Reverse Results:</h2>

<?
echo "<div class='reverse'>";
echo "<strong>http://murl.net/{$murl['Murl']['code']}</strong> is:<br /><hr /><br />";
echo $html->link(urldecode($murl['Murl']['uri']), urldecode($murl['Murl']['uri']), array('class' => 'result_text big'));
echo "<br /><br /><hr /><br /></div>";
?>