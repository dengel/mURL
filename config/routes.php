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

/* Admin stuff */
//Router::connect('/login', array('controller' => 'users','action'=>'login'));
//Router::connect('/logout', array('controller' => 'users','action'=>'logout'));
Router::connect('/admin/:controller/:action/*', array('prefix' => 'admin', 'admin' => true));


/* Murl stuff */
Router::connect('/view/*', array('controller' => 'murls', 'action' => 'view'));
Router::connect('/top/*', array('controller' => 'murls', 'action' => 'top'));
Router::connect('/random/*', array('controller' => 'murls', 'action' => 'random'));
Router::connect('/search/*', array('controller' => 'murls', 'action' => 'search'));
Router::connect('/info/*', array('controller' => 'murls', 'action' => 'info'));
#Router::connect('/info/*', array('controller' => 'murls', 'action' => 'closed'));
Router::connect('/reverse/:code', array('controller' => 'murls', 'action' => 'reverse'),array('code'=>'[0-9a-zA-Z]+'));

/* API */
Router::connect('/api/random', array('controller' => 'apis', 'action' => 'random'));
Router::connect('/api/last', array('controller' => 'apis', 'action' => 'last'));

Router::connect('/mofo/create/:uri/:destruct/:private/:protect',array('controller' => 'apis', 'action' => 'create'),array('destroy'=>'(0|1)','private'=>'(0|1)'));
Router::connect('/mofo/create/:uri/:destruct/:private',array('controller' => 'apis', 'action' => 'create'),array('destroy'=>'(0|1)','private'=>'(0|1)'));
Router::connect('/mofo/create/:uri/:destruct',array('controller' => 'apis', 'action' => 'create'),array('destroy'=>'(0|1)'));
Router::connect('/mofo/create/:uri',array('controller' => 'apis', 'action' => 'create'));

Router::connect('/create', array('controller' => 'murls', 'action' => 'add'));
Router::connect('/', array('controller' => 'murls', 'action' => 'add'));
#Router::connect('/create', array('controller' => 'murls', 'action' => 'closed'));
#Router::connect('/', array('controller' => 'murls', 'action' => 'view'));
Router::connect('/*', array('controller' => 'murls', 'action' => 'process'));
?>
