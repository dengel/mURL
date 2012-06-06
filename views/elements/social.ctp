<?php $thisurl = 'http://' . $_SERVER['SERVER_NAME'] . "/" . $code; ?>
<div id="social_div" class="social">
	<a href="http://reddit.com/submit?url=<?php echo $thisurl ?>" class="sb min share_this">Reddit</a>
	<a href="http://twitter.com/home?status=<?php echo $thisurl ?>" class="sb min twitter">Twitter</a>
	<a href="http://www.facebook.com/sharer.php?u=<?php echo $thisurl ?>" class="sb min facebook">Facebook</a>
	<a href="http://www.digg.com/submit?phase=2&url=<?php echo $thisurl ?>" class="sb min star">Digg</a>
	<a href="javascript:if(document.all)window.external.AddFavorite(location.href,document.title); else if(window.sidebar)window.sidebar.addPanel (document.title,location.href,'');" class="sb min heart">Heart</a>
</div>
