
<?php
if (isset($code)) {
    echo "<div class='success'>";
    echo $html->link("http://".Configure::read('murl.domain')."/".$code, "/".$code, array('class' => 'result_text'));
    echo "</div>";
    echo $this->element('social');
}
?>

<?php echo $this->element('murlForm'); ?>

<div class="toright">
    <? echo $this->Html->link("Options","#",array('id'=>"options_link",'title'=>'Show Options')); ?>
</div>
