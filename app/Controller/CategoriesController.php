<?php

class CategoriesController extends AppController {

 public $name  = 'Categories';
  public $paginate = array(
        'limit' => 15,
        'fields'=> array('Category.id','Category.name','Category.slug','Category.menu','Category.published','Category.order'),
        'order' => array(
            'Category.order' => 'asc'
        )
    );

 public $helpers = array('Html', 'Form','Paginator');
 public $components = array('RequestHandler');

    public function admin_index() {
        $this->set('title_for_layout', 'Administration Categories');
        $categories = $this->paginate('Category');
        $this->set('categories', $categories);
    }


    public function admin_edit($id = null) {

         $this->Category->id=$id;
         if ($this->request->is('post') || $this->request->is('put')) {
                 $d = $this ->request->data;

                 if( empty($d['Category']['slug']) ):

                 $d['Category']['slug'] = strtolower(Inflector::slug($d['Category']['name'],'-'));

                 else:

                 $d['Category']['slug'] = strtolower(Inflector::slug($d['Category']['slug'],'-'));

                 endif;

                 $this->Category->set($d);
                if ($this->Category->validates(array('fieldList'=>array('name','published','menu'))))
                {
                    if($this->Category->save($d,array('fieldList'=>array('name','summary','description','menu','published','slug'))))
                    {
                        $this->log('La catégorie '.$category['Category']['name'].' a été mis à jour','activity');
                        $this->Session->setFlash('La catégorie "'.$this->Category->field('name'). '" a été mis à jour','notif');
                        $this->redirect(array('action' => 'index'));
                    }
                 else {
                        $this->Session->setFlash('Impossible de mettre à jour la catégorie "'.$this->Category->field('name').'"','notif',array('type'=>'danger'));
                    }
                }
            }

            else
            {
                $this->request->data = $this->Category->read();
                $this->set('title_for_layout','édition catégorie "'.$this->request->data['Category']['name'].'"');
            }

    }

     public function admin_delete($id) {
        if(is_numeric($id)){
                 if ( $this->Category->delete($id)) {
                       $this->log('La catégorie '.$category['Category']['name'].' a été supprimé','activity');
                       $this->Session->setFlash('la catégorie a été supprimé','notif');
                    } else {
                        $this->Session->setFlash('Une erreur est survenue, catégorie non supprimé','notif',array('type'=>'danger'));

                        }
            }
            else{

                 $this->Session->setFlash('Une erreur est survenue','notif',array('type'=>'danger'));
            }
            $this->redirect(array('action' => 'index','controller'=>'categories'));
    }
    function admin_order() {
         if($this->RequestHandler->isAjax()) {
                $this->autoRender = false;
                if(!empty($this->request->query[ 'data' ]['Category'])){
                            foreach($this->request->query[ 'data' ][ 'Category' ] as $k=>$v){
                                $this->Category->id = $k;
                                $this->Category->saveField('order',$v);
                            }
                }
            }
        return false;
    }


    public function admin_publish($id) {
            $this->Category->id = $id;
            $category = $this->Category->read();
            if($this->Category->field('published')==1):
                    if($this->Category->saveField('published',0)):
                    $this->log('La catégorie '.$category['Category']['name'].' a été dépubliée','activity');
                    $this->Session->setFlash('La catégorie '.$category['Category']['name'].' est dépubliée','notif',array('type'=>'success'));
                else:
                    $this->Session->setFlash('La catégorie '.$category['Category']['name'].' n\'a pas pu être dépubliée ','notif',array('type'=>'danger'));
                endif;
            else:
                if($this->Category->saveField('published',1)):
                   $this->log('La catégorie '.$category['Category']['name'].'a été publiée','activity');
                    $this->Session->setFlash('La catégorie '.$category['Category']['name'].' est publiée','notif',array('type'=>'success'));
                else:
                    $this->Session->setFlash('La catégorie '.$category['Category']['name'].' n\'a pas pu être publiée ','notif',array('type'=>'danger'));
                endif;


            endif;

            $this->redirect(array('action' => 'index','controller'=>'categories'));
    }




}
