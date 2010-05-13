<?php
/**
 * Short description for file.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
 */
/**
 * ...and connect the rest of 'Pages' controller's urls.
 * NOT NEEDED FOR MURL
 */
/* Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display')); */

/* Murl stuff */
Router::connect('/view/*', array('controller' => 'murls', 'action' => 'view'));
Router::connect('/top/*', array('controller' => 'murls', 'action' => 'top'));
Router::connect('/random/*', array('controller' => 'murls', 'action' => 'random'));
Router::connect('/search/*', array('controller' => 'murls', 'action' => 'search'));
Router::connect('/reverse/:code', array('controller' => 'murls', 'action' => 'reverse'),array('code'=>'[0-9a-zA-Z]+'));

/* API */
Router::connect('/api/random', array('controller' => 'apis', 'action' => 'random'));
Router::connect('/api/create/:uri',
        array('controller' => 'apis', 'action' => 'create')
        /*array(
            'url'=>'^(?:[A-Za-z0-9+/]{4})*(?:[A-Za-z0-9+/]{2}==|[A-Za-z0-9+/]{3}=)?$'
        )*/
        );


Router::connect('/create', array('controller' => 'murls', 'action' => 'add'));
Router::connect('/', array('controller' => 'murls', 'action' => 'add'));
Router::connect('/*', array('controller' => 'murls', 'action' => 'process'));
?>
