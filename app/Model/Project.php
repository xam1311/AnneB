<?php

class Project extends AppModel {
	public $name = 'Project';
	public $belongsTo = 'Category';
	public $hasMany = "Media";

	public $actsAs = array(
        'Containable',
        'Taxonomy.Taxonomy',
        'Media.Media' => array(
        )
    );
     public $validate = array(
        'name' => array(
           'minLength'=>array(
            'rule'=>array('minLength','3'),
            'message'=>'3 caractères minimum'
            )
        ),
        'website' => array(
             'url'=>array(
                    'rule' =>array('url',true),
                    'message' => 'le Format n\'est pas valide',
                    'allowEmpty' =>true
                    )
            ),
        'hidden'=>array(
            'rule'=>'boolean',
            'message'=>'Seulement activé ou désactivé'
        ),
        'favorite'=>array(
            'rule'=>'boolean',
            'message'=>'Seulement activé ou désactivé'
        ),
        'published'=>array(
            'rule'=>'boolean',
            'message'=>'Seulement activé ou désactivé'
        ),
        'category_id'=>array(
          'rule'=>'numeric',
          'required'   => true,
          'allowEmpty' => false,
          'message'=>'Veuillez choisir une catégorie'
          ),
        'short_description'=>array(
            /*'allowEmpty'=>true*/
          )


    );
    function afterFind($results,$primary=false){

      foreach($results as $k => $v):

                  if(isset($results[$k]['Project']['slug']) and isset($results[$k]['Category']['slug'])):

                     $results[$k]['Project']['link']=array('controller'=>'projects','action'=>'view','id'=>$v['Project']['id'],'slug'=>$v['Project']['slug'],'categorySlug'=>$v['Category']['slug']);


                  endif;

                  if(!empty($v['Tags'])):

                           $results[$k]['tags'] = Hash::format($v['Tags'],array('{0}'),array('tags.{n}.name'));

                  endif;
                  if(isset($v['Project']['params']) and !empty($v['Project']['params'])):

                      $params = json_decode($v['Project']['params'],true);

                       if(is_array($params['params'])):

                          $hashTags = '';

                           foreach ($params['params'] as $key => $v) :

                              $params['params'][$key]=array('id'=>$key,'name'=>$v,'slug'=>strtolower(Inflector::slug($v)),'link'=>array('controller'=>'projects','action'=>'showType','type'=>strtolower(Inflector::slug($v))));

                                $hashTags .= rawurlencode($v);

                                if($key+1 != count($params['params'])):

                                  $hashTags .= ',';

                                endif;

                            endforeach;

                        endif;

                        if(isset($hashTags) and !empty($hashTags)):

                        $results[$k]['Project']['hashTags'] = '&hashtags='.$hashTags;

                        endif;

                        $results[$k]['Params']['terms']     = $params['params'];
                        $results[$k]['Params']['type']      = $params['type'];

                  endif;
        endforeach;
      return $results;
    }

    function viewProject($id){

      $project = $this->find('first',array('conditions'=>array('Project.published'=>1,'Project.id'=>$id)));
      return $project;
    }

    function lastProjects($catid,$hidden)
     {
       $fields = array('Project.media_id','Project.hidden','Project.published','Project.slug','Project.order','Project.short_description','Project.name','Project.created','Project.website','Project.id','Category.id','Category.name','Category.slug','Thumb.file','Thumbnail.file');
       if($hidden == 1):
        $lastProjects = $this->find('all',array('conditions' => array('Project.published'=>'1','Category.published'=>'1',/*'media_id !='=>null,*/'Category.id'=>$catid),
      'fields' => $fields,'order'=>array('Project.order ASC','created')));
       else:
        $lastProjects = $this->find('all',array('conditions' => array('Project.hidden' => '0','Project.published'=>'1','Category.published'=>'1',/*'media_id !='=>null,*/'Category.id'=>$catid),
      'fields' => $fields,'order'=>array('Project.order ASC','created')));
       endif;
      return $lastProjects;
     }


     function projectsType($type,$hidden)
     {
       $fields = array('Project.media_id','Project.hidden','Project.published','Project.slug','Project.short_description','Project.name','Project.created','Project.id','Project.category_id','Category.id','Category.name','Category.slug','Thumb.file','Thumbnail.file','Project.params');
       if($hidden == 1):
       $projects = $this->find('all',array('conditions' => array('Project.published'=>'1','Category.published'=>'1'),
      'fields' => $fields,'order'=>array('Project.order ASC','created')));
       else:
       $projects = $this->find('all',array('conditions' => array('Project.published'=>'1','Category.published'=>'1','Project.hidden'=>0),
      'fields' => $fields,'order'=>array('Project.order ASC','created')));
       endif;
                   foreach($projects as $d):
                            if(!empty($d['Params']['terms'])):
                                $params = Hash::extract($d['Params']['terms'],'{n}.slug');
                                if(in_array($type, $params)):
                                  $projectsType[] = $d;
                                endif;
                            endif;
                    endforeach;
                    if(isset($projectsType) and !empty($projectsType)):
                       return $projectsType;
                    else:
                      return false;
                    endif;
     }

		 public function afterSave($created,$options= array())
		 {
			 Cache::clear();
	     clearCache();
	     $files = array();
	     $files = array_merge($files, glob(CACHE . '*')); // remove cached css
	     $files = array_merge($files, glob(CACHE . 'css' . DS . '*')); // remove cached css
	     $files = array_merge($files, glob(CACHE . 'js' . DS . '*'));  // remove cached js
	     $files = array_merge($files, glob(CACHE . 'models' . DS . '*'));  // remove cached models
	     $files = array_merge($files, glob(CACHE . 'persistent' . DS . '*'));  // remove cached persistent
	     foreach ($files as $f) {
	             if (is_file($f)) {
	                 unlink($f);
	             }
	     }

	     if(function_exists('apc_clear_cache')):
	         apc_clear_cache();
	         apc_clear_cache('user');
	     endif;
	     if(function_exists('Memcached::flush')):
	        Memcached::flush();
	     endif;
		 }
}
