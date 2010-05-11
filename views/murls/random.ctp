<h2><?php echo $title_for_layout; ?></h2>

<?php echo $this->element('murlTable'); ?>

<h3>Preview:</h3>

<iframe src ="<?php echo urldecode($murls[0]['Murl']['uri']); ?>" width="100%" height="300">
  <p>Your browser does not support iframes.</p>
</iframe>

<br /><br />