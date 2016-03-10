<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
    Router::parseExtensions('xml');
	Router::connect('/admin', array('controller' => 'projects', 'action' => 'index','admin'=>true));

    Router::connect('/cv', array('controller' => 'pages', 'action' => 'display', 'cv','admin'=>false));
    Router::connect('/me-connaitre', array('controller' => 'pages', 'action' => 'display', 'know','admin'=>false));
    Router::connect('/connexion', array('controller' => 'users', 'action' => 'login','admin'=>false));
    Router::connect('/password', array('controller' => 'users', 'action' => 'password','admin'=>false));


    Router::connect('/', array('controller' => 'pages', 'action' => 'home','admin'=>false));

    Router::connect('/CvAnneB', array('controller' => 'pages', 'action' => 'download', 'cv.pdf','admin'=>false));

	Router::connect(
    '/projets/:slug-:catid',
    array('controller' => 'projects', 'action' => 'index'),
    array(
        'pass' => array('catid','slug'),
        'catid' => '[0-9]+',
        'slug' => '[a-zA-Z0-9_-]+'
    )
	);
    Router::connect(
    '/projets/tag-:name/:id',
    array('controller' => 'projects', 'action' => 'showTag'),
    array(
        'pass' => array('id','name'), 
        'id'=>'[0-9]+',
        'name'=>'[a-zA-Z0-9_-]+'
        
    ));
    Router::connect(
    '/projets/:categorySlug/:slug-:id',
    array('controller' => 'projects', 'action' => 'view'),
    array(
        'pass' => array('id','slug','categorySlug'), 
        'id' => '[0-9]+',
        'slug' =>'[a-zA-Z0-9_-]+',
        'categoryslug'=>'[a-zA-Z0-9_-]+'
        
    ));

    Router::connect(
    '/projets/type/:type',
    array('controller' => 'projects', 'action' => 'showType'),
    array(
        'pass' => array('type'), 
        'type'=>'[a-zA-Z0-9_-]+'
        
    ));

     Router::connect(
    '/sitemap',
    array('controller' => 'projects','action'=>'sitemap'),
    array(
        'ext' => 'xml'));

   

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
