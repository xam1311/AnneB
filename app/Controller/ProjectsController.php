<?php

App::uses('AppController','Controller');

class ProjectsController extends AppController {

 public $name  = 'Projects';
 public $paginate = array(
        'limit' => 15,
        'fields'=> array('Project.id','Project.name','Project.slug','Project.created','Project.media_id','Project.modified','Project.order',
        'Project.hidden','Project.published','Thumb.file','Category.name','Category.slug'),
        'contain'=>array('Category','Thumb','Media'),
        'order' => array(
            'Project.order' => 'asc'
        ),
        'paramType' => 'querystring'
    );
 public $helpers = array('Media.Media','Paginator','Text','Taxonomy.Taxonomy','Cache','Time');

 public $cacheAction = array(
'navmenu'=>'+1 month',
'index'=>'+1 day',
'view'=>3600
);

 public $uses =array('Project','Category','Taxonomy.Term');

 public $components = array('RequestHandler');

    public function navmenu()
    {
         /* on détermine le menu activé et publié */

         if (empty($this->request->params['requested'])) {
            throw new ForbiddenException();
        }
        $this->Project->Category->recursive = -1;
        $navmenu = $this->Project->Category->find('all',array('fields'=>array('Category.name','Category.published','Category.id','Category.slug','Category.order'),'conditions'=>array('Category.published'=>1,'Category.menu'=>1),'order'=>'order ASC'));
        if ( isset($this->params['requested']) && $this->params['requested'] == 1){
          return $navmenu;
        }else
        {
        $this->set('navmenu',$navmenu);
        }
    }


    public function sitemap()
    {

            if (!$this->RequestHandler->isXml()) {
                throw new MethodNotAllowedException();
            }
                $this->RequestHandler->setContent('xml');
                $this->RequestHandler->respondAs('xml');

            $this->Project->Category->recursive = -1;

            $projects =$this->Project->find('all',array('conditions'=>array( 'Project.hidden' => 0,'Project.published'=>1,'Category.published'=>1)));

            $categories = $this->Category->find('all',array('conditions'=>array('Category.published'=>1 )));

            $this->set(compact('projects','categories'));

    }


    public function index($catid = null ,$slug = null)

    {
        $this->Project->contain(array('Term','Category','Thumbnail','Thumb'));

        $private = '';
        if(!$catid):

            throw new NotFoundException('Aucune catégorie ne correspond à cet ID');

        else:

            if($catid and $slug):

            $role =$this->Auth->user('role');
            $category= $this->Project->Category->find('first',array('conditions'=>array('id'=>$catid),'fields'=>array('Category.name','Category.description','Category.summary','Category.slug')));

            if(!$category):

            throw new NotFoundException('Aucune catégorie ne correspond à cet ID');

            else:
                        if($slug != $category['Category']['slug']):
                            $this->redirect($category['Category']['link'],301);
                        endif;
                        $private = 0;
                        $hidden = 0;
                        $canonical = $category['Category']['link'];
                            if($role=='visitor' || $role=='admin')
                                {
                                $hidden = 1;

                                }
                            $lastProjects=$this->Project->lastProjects($catid,$hidden);
                            foreach ($lastProjects as $k => $v) :
                                    if($v['Project']['hidden']==1):
                                        $private = 1;
                                     endif;
                                     if(!empty($v['Tags']) and isset($v['Tags'])):
                                            if(isset($tags)and !empty($tags)):
                                                $needle=Hash::extract($v['Tags'],'tags.{n}.name');
                                                $tags=array_merge($tags,$needle);
                                            else:
                                                $tags=Hash::extract($v['Tags'],'tags.{n}.name');
                                            endif;
                                    endif;
                            endforeach;

                            if(isset($tags) and !empty($tags)):
                                 $tags=array_unique($tags);
                            else:
                               $tags ='';
                            endif;

                        $this->set(compact('lastProjects','private','category','tags','canonical'));
                        $this->set('title_for_layout','Anne-b - Catégorie '.$category['Category']['name']);
                        endif;
                endif;
        endif;

    }

     public function showTag($id,$name)
    {
        $this->Project->contain(array('Term','Category','Thumbnail','Thumb'));
        $canonical = array('controller' => 'projects', 'action' => 'showTag','id'=> $id , 'name'=> $name );
        $private = '';
        $role =$this->Auth->user('role');
            if($role=='visitor' || $role=='admin'):
            $projects=$this->Project->find('all',array('conditions'=>array('Project.published'=>1,'Category.published'=>1)));
            else:
            $projects=$this->Project->find('all',array('conditions'=>array( 'Project.hidden' => 0,'Project.published'=>1,'Category.published'=>1)));
            endif;
        if($projects):
            /*On regarde sur tous les projets si le tag demandé existe */
            foreach ($projects as $k => $v) :
                 if(isset($v['Term']) and !empty($v['Term'])):
                     /* Si un seul résultat de tag on extrait le nom */
                      if(count($v['Term'])== 1):
                         $tagName=Hash::get($v['Term'],'0.name');
                         /* On vérifie suivant le name fourni que le tag est identique en slug et strtolower */
                         if (strtolower(Inflector::slug($tagName))== $name):
                               $projectsTag[]= $v;
                               $layoutTag = $tagName;
                               if($v['Project']['hidden']==1):
                                   $private = 1;
                                endif;
                         endif;
                      else:
                          /* Si plusieurs résultats de tags sur le projet on parcourt le tableau de tag*/
                            $tagsName = Hash::extract($v['Term'],'{n}.name');
                                foreach($tagsName as $d):
                                 /* On vérifie suivant le name fourni que le tag est identique en slug et strtolower */
                                    if(strtolower(Inflector::slug($d))==$name):
                                 /* Si identique on rajoute au tableau de résultat */
                                        $projectsTag[]= $v;
                                        $layoutTag = $d;
                                        if($v['Project']['hidden']==1):
                                           $private = 1;
                                          endif;
                                        endif;
                            endforeach;

                    endif;
                endif;

            endforeach;



            if(isset($projectsTag) and !empty($projectsTag)):
            /* On vérifie si d'autres tags sont présents sur les projets */
            foreach ($projectsTag as $k => $v):
                if(!empty($v['Tags']) and isset($v['Tags'])):
                    if(isset($tags)and !empty($tags)):
                    $needle=Hash::extract($v['Tags'],'tags.{n}.name');
                    $tags=array_merge($tags,$needle);
                    else:
                    $tags=Hash::extract($v['Tags'],'tags.{n}.name');
                    endif;
                endif;
            endforeach;
            if(isset($tags) and !empty($tags)):
            $tags=array_unique($tags);
            foreach ($tags as $k => $v):
                if($name == strtolower(Inflector::slug($v))):
                    $tags= Hash::remove($tags,$k);
                endif;
             endforeach;
            else:
            $tags = '';
            endif;


            $this->set('title_for_layout','Anne-b - Projets Tag '.$layoutTag);
            $this->set(compact('projectsTag','private','layoutTag','tags','canonical'));
            else:
            throw new NotFoundException('Aucun projet n\'est de type '.$name.'');
            endif;
        endif;
    }

    public function showType($type)
    {
        $this->Project->contain(array('Term','Category','Thumbnail','Thumb'));
        $private = '';
        $canonical = array('controller' => 'projects', 'action' => 'showType','type'=> $type );
        $typeHumanize= array('Webdesign', 'Identité visuelle','Mobile','Newsletter','Encart Pub','Responsive Design');
        foreach ($typeHumanize as $v):
            if($type == Inflector::slug(strtolower($v))):
                $typeHumanize = $v;
            endif;
        endforeach;
        $this->set('title_for_layout','Anne-b - Projets '.$typeHumanize);

        $role =$this->Auth->user('role');
        $hidden = 0;
        if($role=='visitor' || $role=='admin')
                {
                $hidden = 1;
                }
        $projectsType=$this->Project->projectsType($type,$hidden);
        if($projectsType):
            foreach ($projectsType as $k => $v) :
                     if($v['Project']['hidden']==1):
                        $private = 1;
                     endif;
                     if(!empty($v['Tags']) and isset($v['Tags'])):
                        if(isset($tags)and !empty($tags)):
                            $needle=Hash::extract($v['Tags'],'tags.{n}.name');
                            $tags=array_merge($tags,$needle);
                        else:
                            $tags=Hash::extract($v['Tags'],'tags.{n}.name');
                        endif;
                    endif;
            endforeach;

            if(isset($tags) and !empty($tags)):
             $tags=array_unique($tags);
            else:
               $tags ='';
            endif;

        $this->set(compact('projectsType','typeHumanize','private','tags','canonical'));
        else:
            throw new NotFoundException('Aucun projet n\'est de type '.$typeHumanize.'');
        endif;


    }

    public function view($id = null ,$slug = null,$categorySlug=null){

        $this->Project->contain(array('Term','Category','Media','Slider','Thumbnail'));
            $project = $this->Project->viewProject($id);
            if(empty($project)):
              throw new NotFoundException('Aucun projet ne correspond à cet ID');
            else:
              if($slug != $project['Project']['slug']):
                $this->redirect($project['Project']['link'],301);
                endif;

                if($project['Project']['hidden']==1 && $this->Auth->loggedIn()==false):
                throw new ForbiddenException('Projet inaccessible - vous devez être connecté');
                else:
                        if(isset($project['Media'])and !empty($project['Media'])):
                            if(!empty($project['Project']['slider_id']) or !empty($project['Project']['thumb_id'])):
                                    foreach ($project['Media'] as $k => $v):
                                         if(in_array($v['id'],array($project['Project']['slider_id'],$project['Project']['thumb_id']))):
                                            $project['Media'] = Hash::remove($project['Media'],$v['id']);
                                         endif;
                                    endforeach;
                            $project['Media'] = Hash::sort($project['Media'], '{n}.position', 'asc');
                            endif;
                        endif;

                        if(!empty($project['Tags']) and isset($project['Tags'])):
                            foreach ($project['Tags'] as $v):
                                    $tags= Hash::extract($v,'{n}.name');
                            endforeach;
                        endif;

                        if(!empty($project['Params']['terms']) and isset($project['Params']['terms'])):
                                foreach ($project['Params']['terms'] as $v):
                                    $terms[] = $v['name'];
                                endforeach;
                        endif;
                        if(!empty($terms)and!empty($tags)):
                            $keywords=array_merge($tags,$terms);
                        else:
                                if(!empty($terms)):
                                    $keywords = $terms;
                                else:
                                    if(!empty($tags)):
                                    $keywords = $tags;
                                    endif;
                                endif;
                            $this->set(compact('keywords'));
                        endif;
                        $this->set('title_for_layout','Anne-b - Projet '.$project['Project']['name']);
                        $this->set(compact('project'));
                endif;
        endif;
    }

    public function admin_index($category = null) {



        $this->set('title_for_layout', 'Administration Projets');

                if(!empty($this->request->data['Project']['search'])):

                     $query = $this->request->data['Project']['search'];
                     $conditionsSearch = array('Project.name LIKE' => '%'.$query.'%');

                endif;

                if(isset($category)):

                    $conditionCategory = array('Category.name' => $category);

                endif;

                if(isset($conditionSearch) and isset($conditionCategory)):

                    $conditions = array_merge($conditionSearch,$conditionCategory);

                elseif(isset($conditionsSearch)):

                    $conditions = $conditionsSearch;

                elseif(isset($conditionCategory)):

                    $conditions = $conditionCategory;

                endif;

                if(isset($conditions)):

                $projects = $this->paginate('Project',$conditions);

                else:

                $projects = $this->paginate('Project');

                endif;

        $this->set('projects', $projects);

        /*Génération select catégories pour pagination */
        $category =$this->Category->find('all',array('contain'=>false,'conditions'=>array('published'=>1),'fields'=>array('id','name','slug')));

        $this->set(compact('category'));
    }

    function admin_order() {

        debug($this->request);
        if($this->RequestHandler->isAjax()) {
                $this->autoRender = false;
                if(!empty($this->request->query[ 'data' ]['Project'])){
                            foreach($this->request->query[ 'data' ]['Project'] as $k=>$v){
                                $this->Project->id = $k;
                                $this->Project->saveField('order',$v);
                            }
                }
            }
        return false;
    }

      function admin_update() {
        if($this->RequestHandler->isAjax()) {
                $this->autoRender = false;
                if(!empty($this->request->query[ 'order' ])){
                            foreach($this->request->query[ 'order' ] as $k=>$v){
                                $this->Project->id = $k;
                                $this->Project->saveField('order',$v);
                            }
                }

                return false;
            }

        if ($this->request->is('post')) {

               $typeSubmit = $this->request->data['buttonSubmit'];
               $id = $this->request->data['id'];

               if(!empty($id) and isset($id)):
                            if( $typeSubmit == 'deleteSelected' ):

                                foreach ($id as $v) :

                                    $this->Project->delete($v);

                                endforeach;

                            $this->Session->setFlash('Les projets ont été supprimés','notif',array('type'=>'info'));

                            elseif( $typeSubmit == 'unpublishSelected'):

                                foreach ($id as $v) :

                                    $this->Project->id = $v;
                                    $this->Project->saveField('published',0);


                                endforeach;

                            $this->Session->setFlash('Les projets ont été dépubliés','notif',array('type'=>'info'));

                            elseif( $typeSubmit == 'publishSelected'):
                                foreach ($id as $v) :

                                    $this->Project->id = $v;
                                    $this->Project->saveField('published',1);


                                 endforeach;
                            $this->Session->setFlash('Les projets ont été publiés','notif',array('type'=>'info'));

                            endif;
                else:

                    $this->Session->setFlash('Veuillez choisir au moins un projet','notif',array('type'=>'danger'));

                endif;
        }


        return $this->redirect(
            array('controller' => 'projects', 'action' => 'index')
        );
    }


    public function admin_edit($id = null) {

       App::uses('Sanitize','Utility','String');
     	 $this->Project->id=$id;
       $this->set('categories', $this->Project->Category->find('list',array(
        'fields' => array('Category.id', 'Category.name','Category.slug'))));


        $this->Project->contain('Term','Category');
         if ($this->request->is('post') || $this->request->is('put')) {


                 $d = $this ->request->data;
                 $this->Project->set($d);
                 /* on récupére les checkbox et les radios et on refait un array avec ces paramètres en json*/
                 $params = array('params'=>$d['Project']['params'],'type'=>$d['Project']['type']);
                if($this->Project->validates(array('fieldList'=>array('name','website','hidden','published','short_description','meta_description','category_id','slug'))))
                {
                         if( empty($d['Project']['slug']) ):

                         $d['Project']['slug'] = strtolower(Inflector::slug($d['Project']['name'],'-'));

                         else:

                         $d['Project']['slug'] = strtolower(Inflector::slug($d['Project']['slug'],'-'));

                         endif;


                         if( !$d['Project']['meta_description'] and !empty($d['Project']['description']) ):
                          $d['Project']['meta_description'] = trim(String::truncate(strip_tags($d['Project']['description'],'<br><br/><hr></hr>'),175,array('ellipsis'=> '...','exact'=>true)));
                        endif;
                         $d['Project']['order']=0;
                         $d['Project']['params']= json_encode($params);

        		         if ($this->Project->save($d,array('fieldList'=>array('name','slug','website','short_description','description','meta_description','category_id','hidden','published','params'))))
                        {
                            if( $d['Project']['valueSubmit']=='saveexit' ):
                              $linkedit = Router::url(array('controller'=>'projects','action'=>'edit',$id));
                              $this->Session->setFlash('Le projet <a href="'.$linkedit.'">'.$d['Project']['name'].'</a> a été mis à jour','notif');
                              $this->redirect(array('action' => 'index'));

                            elseif( $d['Project']['valueSubmit'] == 'savestay'):

                              $data = $this->Project->read();

                              if(!empty($data['Project']['params'])):
                                  /* on envoi le type de projet et les caractéristiques de celui-ci */
                                  $params = Hash::extract(json_decode($data['Project']['params'],true),'params');
                                  $type = Hash::extract(json_decode($data['Project']['params'],true),'type');
                              else:
                                  $params = false;
                                  $type = false;
                              endif;
                                  $this->set(compact('params','type'));
                                  $this->request->data = $this->Project->read();


                            else:
                              $this->redirect(array('action' => 'index'));
                            endif;

                            $this->log("Le projet ".$data['Project']['name'].' a été modifié','activity');

                        } else {
                            $this->request->data = $this->Project->read();
                            $this->log("Impossible de mettre à jour Le projet ".$data['Project']['name'],'activity');
                            $this->Session->setFlash('Impossible de mettre à jour le projet "'.$this->Project->field('name').'"','notif',array('type'=>'danger'));
                        }
                }

		    } else {
                $data =$this->Project->read();
                $this->set('title_for_layout','édition projet "'.$data['Project']['name'].'"');

                if(!empty($data['Project']['params'])):
                    /* on envoi le type de projet et les caractéristiques de celui-ci */
                    $params = Hash::extract(json_decode($data['Project']['params'],true),'params');
                    $type = Hash::extract(json_decode($data['Project']['params'],true),'type');

                else:
                    $params = false;
                    $type = false;
                endif;

                $this->set(compact('params','type'));
                $this->request->data = $this->Project->read();

		    }
            /* Envoi du champ Select des catégories */
            $d['terms'] = $this->Project->Term->find('list',array('fields'=>array('id','name','type')));
            $this->set($d);
    }

     public function admin_delete($id) {
        if(is_numeric($id)){
                 if ( $this->Project->delete($id)) {
                       $this->log('Le projet a été supprimé','activity');
                       $this->Session->setFlash('le Projet a été supprimé','notif');

                    } else {
                        $this->Session->setFlash('Une erreur est survenue, projet non supprimé','notif',array('type'=>'danger'));

                        }
            }
            else{

                 $this->Session->setFlash('Une erreur est survenue','notif',array('type'=>'danger'));
            }
            $this->redirect(array('controller'=>'projects','action' => 'index'));
    }

    public function admin_publish($id) {
            $this->Project->id = $id;
            $project = $this->Project->read();
            if($this->Project->field('published')==1):
                    if($this->Project->saveField('published',0)):
                    $this->log('Le projet '.$project['Project']['name'].' a été dépublié','activity');
                    $this->Session->setFlash('Le projet '.$project['Project']['name'].' est dépublié','notif',array('type'=>'success'));
                else:
                    $this->Session->setFlash('Le projet '.$project['Project']['name'].' n\'a pas pu être dépublié ','notif',array('type'=>'danger'));
                endif;
            else:
                if($this->Project->saveField('published',1)):
                   $this->log('La projet '.$project['Project']['name'].' a été publié','activity');
                    $this->Session->setFlash('Le projet '.$project['Project']['name'].' est publié','notif',array('type'=>'success'));
                else:
                    $this->Session->setFlash('Le projet '.$project['Project']['name'].' n\'a pas pu être publié ','notif',array('type'=>'danger'));
                endif;


            endif;

            $this->redirect(array('action' => 'index','controller'=>'projects'));
    }



}
