
<?php
if (isset($code)) {
    echo "<div class='result'>";
    echo $html->link("http://murl.net/".$code, "/".$code, array('class' => 'result_text'));
    echo "</div>";
    echo $this->element('social');
}
?>

<?php echo $this->element('murlForm'); ?>

<div class="toright">
    <? echo $this->Html->link("Options","#",array('id'=>"options_link",'title'=>'Show Options')); ?>
</div>