<!-- File: /app/views/posts/add.ctp -->	
	
<h2>Results:</h2>
<?php if(empty($murls)): ?>
   There are no murls in this list.<br>
<?php elseif(isset($domains)): ?>
   <table>
      <tr>
         <th>Domains</th>
         <th>Count</th>
      </tr>
<?php
   $lcv=0;
   $prints=0;
   foreach ($domains as $domain => $count) {
      if ($count > 5) {
         echo "<tr><td class=\"left\">" .$html->link($domain, "/Murls/view?search=".$domain) . "</td><td class=\"right\">[$count]</td></tr>\n";
         $prints++;
      }
      if ($prints >= 20) break;
   }
?>
</table>
<?php else: ?>
   <table>
      <tr>
         <th>Code</th>
         <th>URL</th>
         <th>Hits</th>
         <th>Date</th>
         <th>Remote</th>
         <th>Referer</th>
      </tr>
      <?php foreach ($murls as $murl): ?>
         <tr <?php $lcv=0; echo ($lcv++ % 2) ? "class='altRow'" : "" ?>>

            <td class="left">
               <?php
               $code=$murl['Murl']['code'];
               echo $html->link("http://murl.net/".$code, "/".$code);
               ?>
            </td>

            <td class="left">
               <?php echo substr(urldecode($murl['Murl']['url']),0,120) ?>
            </td>
            <td class="right">
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
            <td>
               <?php echo  $html->link($murl['Murl']['remote'],"http://api.hostip.info/get_html.php?ip=".$murl['Murl']['remote']."&position=true") ?>
            </td>
            <td>
               <?php echo $murl['Murl']['referer'] ?>
            </td>
         </tr>
<?php if ($murl['Murl']['agent']): ?>
         <tr>
            <td>
            <?
                 if ($murl['Murl']['private']) echo "Private ";
                 if ($murl['Murl']['destruct']) echo "Destruct ";
                 if ($murl['Murl']['protect']) echo "Protect ";
            ?>
            </td>
            <td colspan='5'>
               <small><?php echo $murl['Murl']['agent'] ?></small>
            </td>
         </tr>
<? endif; ?>
      <?php endforeach; ?>
   </table>

<br>

<hr>
<?php endif; ?>
<?php
echo $html->link("domains", "/Murls/view?domains=1") . " - ";
echo $html->link("top20", "/Murls/view?top=1") . " - ";
echo $html->link("random", "/Murls/view?random=1") . " - ";
?>
