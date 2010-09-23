<? if (count($murls) > 0): ?>
<table class="mstyle">
    <thead>
        <tr>
            <th><?php __("Code"); ?></th>
            <th><?php __("Url"); ?></th>
            <th><?php __("Hits"); ?></th>
            <th><?php __("Date");?></th>
            <th><?php __("Social");?></th>
<!--
            <th><?php __("Remote");?></th>
            <th><?php __("Referer"); ?></th>
-->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($murls as $murl): ?>
        <tr>
            <td>
		<?php $reverse = $this->params['action'] == 'reverse' ? "" : "reverse/"; ?>
                <?php echo $html->link("http://".Configure::read('murl.domain')."/".$murl['Murl']['code'], "/".$reverse.$murl['Murl']['code']);  ?>
            </td>

            <td>
                <?php echo substr(urldecode($murl['Murl']['uri']),0,120) ?>
            </td>
            <td>
                <?php echo $murl['Murl']['hits'] ?>
            </td>
            <td nowrap>
                <?php echo $murl['Murl']['created'] ?><br>
                <?php
                if ($murl['Murl']['created'] != $murl['Murl']['modified']) {
                    echo $murl['Murl']['modified'];
                }
                ?>
            </td>
<!--
            <td>
                <?php #echo  $html->link($murl['Murl']['remote'],"http://api.hostip.info/get_html.php?ip=".$murl['Murl']['remote']."&position=true") ?>
            </td>
            <td>
                <?php #echo $murl['Murl']['referer'] ?>
            </td>
-->
<td class="nobr">
<?php $thisurl = 'http://' . $_SERVER['SERVER_NAME'] . "/" . $murl['Murl']['code']; ?>
<a href='http://reddit.com/submit?url=<?php echo $thisurl ?>' title="Submit to Reddit"><img src="http://i.imgur.com/images/reddit.png" alt="Submit to Reddit" /></a>
<a href='http://www.digg.com/submit?phase=2&url=<?php echo $thisurl ?>' title="Submit to Digg"><img src="http://i.imgur.com/images/digg.png" alt="Submit to Digg" /></a>
<a href='http://www.stumbleupon.com/submit?url=<?php echo $thisurl ?>' title="Submit to StumbleUpon"><img src="http://i.imgur.com/images/stumble.png" alt="Submit to StumbleUpon" /></a>
<a href='http://twitter.com/home?status=<?php echo $thisurl ?>' title="Submit to Twitter"><img src="http://i.imgur.com/images/twitter.png" alt="Submit to Twitter" /></a>
<a href='http://www.facebook.com/sharer.php?u=<?php echo $thisurl ?>' title="Submit to Facebook"><img src="http://i.imgur.com/images/facebook.png" alt="Submit to Facebook" /></a>
</td>
        </tr>
        <tr>
            <td>
                <?php
                if ($murl['Murl']['private']) echo "Private ";
                if ($murl['Murl']['destruct']) echo "Destruct ";
                if ($murl['Murl']['protect']) echo "Protect ";
                ?>
            </td>
            <td colspan='5'>
                <small><?php echo $murl['Murl']['agent'] ?></small>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php if (count($murls) == 1): ?>
<h3>Preview:</h3>
<iframe src ="<?php echo urldecode($murls[0]['Murl']['uri']); ?>" width="100%" height="300">
  <p>Your browser does not support iframes.</p>
</iframe>
<?php endif; ?>
<?php else: ?>
<b>No results found.</b><br />
<?php endif; ?>
