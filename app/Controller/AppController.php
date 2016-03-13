<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

class AppController extends Controller {

	public $helper = array('Html','Form','Session','Cache','Time');
	public function canUploadMedias($ref, $ref_id){
    /*if($ref == 'User' & $ref_id = $this->Session->read('Auth.User.id')){
        return true; // Tout le monde peut éditer les médias de son profil
    }
    return $this->Session->read('Auth.User.role') == 'admin'; // Le reste des média n'est gérable que par l'administrateur
    */
    return true;
	}
	public $components = array(
        'Session',
        'Auth' =>array(
            'authError' => 'Pensiez-vous réellement que vous étiez autorisés à voir cela ?',
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'home')
					),
				'DebugKit.Toolbar' => array(
            'panels' => array(
                'DebugKitPlus.Configure',
                'DebugKitPlus.RequestPlus'
            )
        )
        );

    public function beforeFilter() {

        $this->Auth->loginAction=array('controller'=>'users','action'=>'login','admin'=>false);

        $this->Auth->authorize= array('Controller');

    	 if(!isset($this->request->params['prefix']))
        {
        $this->Auth->allow();

        }
        if(isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin')
		{
		$this->layout='admin';
		}

        $Auth = $this->Auth->user();
        $this->set(compact('Auth'));


    }

    function isAuthorized($user)
    {
        if(!isset($this->request->params['prefix']))
        {
            return true;
        }
        $roles = array(
            'admin' => 10,
            'visitor' =>5
            );
        if(isset($roles[$this->request->params['prefix']]))
        {
            $lvlAction = $roles[$this->request->params['prefix']];
            $lvlUser = $roles[$user['role']];
            if($lvlUser >= $lvlAction){
                return true;
            }
            else{
                return false;
            }
        }
        return true;
    }



}
