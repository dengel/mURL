
<?php
if (isset($code)) {
    echo "<div class='result'>";
    echo $html->link("http://murl.net/".$code, "/".$code, array('class' => 'result_text'));
    echo "</div>";
}
?>

<?php echo $this->element('murlForm'); ?>

<div class="toright">
    <? echo $this->Html->link("Options","javascript:void(0);",array('id'=>"showOptions",'title'=>'Show Options')); ?>
</div>