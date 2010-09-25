<h2>API Information:</h2>

<p>The mURL API accepts a sinlge URL to be processed. It also returns the single processed mURL.</p>

<p>The URL must be provided <b>base64</b> encoded to the URL:<br /><br /><b>http://<?php echo $app_domain; ?>/api/create/</b></p>

<h2>API Script Example:</h2>

<PRE>
#!/bin/bash

URL="$(echo $URL | base64 --wrap=0 )"
OUT="$(lynx --source "http://<?php echo $app_domain; ?>/api/create/".${URL} | head -1)"
echo $OUT
</PRE>
