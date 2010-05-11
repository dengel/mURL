<h2><?php echo $title_for_layout; ?></h2>

<?php echo $this->element('murlTable'); ?>

<p><?php
    echo $this->Paginator->counter(array(
    'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
    ));
    ?>
</p>
<div class="paging">
    <?php echo "\t" . $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class' => 'disabled')) . "\n";?>
	 | <?php echo $this->Paginator->numbers() . "\n"?>
    <?php echo "\t ". $this->Paginator->next(__('next', true) .' >>', array(), null, array('class' => 'disabled')) . "\n";?>
</div>
<br /><br />