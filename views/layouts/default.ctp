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

        echo $scripts_for_layout;
        ?>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load("prototype", "1.6.1.0");
            google.load("scriptaculous", "1.8.3");

            google.setOnLoadCallback(function() {
                $('showOptions').observe('click', showOptions);

                function showOptions() {
                    Effect.toggle('options_div','slide',{duration: 0.2});
                }
            });
        </script>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1><?php echo $this->Html->link(__('mURL: fast, free and useful.', true), '/'); ?></h1>
            </div>
            <div id="content">

                <?php echo $this->Session->flash(); ?>

                <?php echo $content_for_layout; ?>

                <ul>
                    <li><?= $this->Html->link("Archive","/view"); ?></li>
                    <li><?= $this->Html->link("Random","/random"); ?></li>
                    <li><?= $this->Html->link("Top","/top"); ?></li>
                    <li><?= $this->Html->link("Search","/search"); ?></li>
                </ul>

                <div class="tocenter">
                    <?php
                    if(Configure::read('debug') == 0) {
                        echo $this->element("adsense");
                    } else {
                        echo "AdSense Place Holder";
                    }

                    ?>
                </div>

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
        <?php echo "<small>Version: 0.4 Development</small>"; ?>
        <?php
        if(Configure::read('debug')) {
            echo $this->element('sql_dump');
            pr($this->params);
        }
        ?>
        </body>
        </html>
