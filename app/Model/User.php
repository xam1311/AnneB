<?php
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {
	public $name = 'User';

    function beforeSave ($options = array())
    {
       if(!empty($this->data['User']['password'])){
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        return true;


    }

    function afterFind($results,$primary =false)
    {

        return $results;
    }

}
