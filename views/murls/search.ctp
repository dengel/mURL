<h2><?php echo $title_for_layout; ?></h2>

<?php echo $this->Form->create(); ?>
<?php echo $this->Form->input("field", array("label" => "Criteria:")); ?>
<?php echo $this->Form->end("Search"); ?>

<?php if(isset($murls)): ?>
<h3>Search Results:</h3>

<?php echo $this->element('murlTable'); ?>

<br />
<i>Paginator?</i>
<br /> <br />
<? endif; ?>