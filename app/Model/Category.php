<?php

class Category extends AppModel {
	 public $name = 'Category';
	 public $hasMany = array(
        'Project' => array(
            'className'  => 'Project',
            'foreignKey' =>'category_id',
            'order'      => 'Project.created DESC'
        )
    );
     public $actsAs = array('Containable');

	 public $validate  = array(

        'name'=>array(
            'notEmpty'=>array(
            'rule'=>'notEmpty',
            'message'=>'vous devez entrer un nom',
            'required'=>true,
            'last'=>false
            ),
            'isUnique'=>array(
                'rule'=>'isUnique',
                'required'=>true,
                'message'=>'Une catégorie existe déjà avec ce nom'
            )),
        'published'=>array(
            'boolean'=>array(
                'rule'=>'boolean',
                'message'=>'Seulement activé ou désactivé'
	 	)
        ),
         'menu'=>array(
            'boolean'=>array(
                'rule'=>'boolean',
                'message'=>'Seulement activé ou désactivé'
        ))
        );
     function afterFind($results,$primary=false){
      foreach($results as $k => $v):
            if(isset($results[$k]['Category']['slug'])):
            $results[$k]['Category']['link']=array('controller'=>'projects','action'=>'index','catid'=>$v['Category']['id'],'slug'=>$v['Category']['slug']);
            endif; 
        endforeach;
      return $results;
    }
}
