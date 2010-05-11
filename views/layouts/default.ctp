<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php __('mURL: fast, free and useful.'); ?> -  <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('cake.generic');
        echo $this->Html->css('murl.specific');

        echo $scripts_for_layout;
        ?>
        <!-- dengel: Quisiera mover esto al $scipt_for_layour pero no se como -->
        <script type="text/javascript" src="js/clientcide.js"></script>
        <script type="text/javascript" src="js/murl.js"></script>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1><?php echo $this->Html->link(__('mURL: fast, free and useful.', true), '/'); ?></h1>
            </div>
            <div id="content">

                <?php echo $this->Session->flash(); ?>

                <?php echo $content_for_layout; ?>

                <?php echo $this->element("links"); ?>

                <?php echo $this->element("adsense"); ?>

            </div>
            <div id="footer">
                <?php echo $this->Html->link(
                $this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
                'http://book.cakephp.org/view/875/x1-3-Collection',
                array('target' => '_blank', 'escape' => false)
                );
                ?>
            </div>
        </div>
        <?php
        if(Configure::read('debug')) {
            echo "<small><a href='#' id='beta_link' class='beta'>Version: 0.4 Development.</a></small>";
            echo "<div id='beta_div'>";
            echo $this->element('sql_dump');
            pr($this->params);
            echo "</div>";
        }
        ?>
        </body>
        </html>
