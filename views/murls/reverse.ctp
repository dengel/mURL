<h2>Murls Reverse Results:</h2>

<?
echo "<div class='result'>";
echo "<strong>http://murl.net/{$murl['Murl']['code']}</strong><br />";
echo $html->link(urldecode($murl['Murl']['uri']), urldecode($murl['Murl']['uri']), array('class' => 'result_text'));
echo "</div>";
?>