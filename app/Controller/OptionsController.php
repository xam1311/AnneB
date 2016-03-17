<?php
class OptionsController extends AppController {
public $name  = 'Options';
public $uses  = array('Option','Project');



public function admin_index()
{
          App::uses('Folder', 'Utility');
          App::uses('File', 'Utility');

          $dir = new Folder(LOGS);

          /* Voir pour avoir plusieurs logs et scroll */
          $fileActivity = $dir->find('activity.log');

          if($fileActivity):

              $file = new File($dir->pwd() . DS .$fileActivity[0]);
              $activityLog = explode("\n",$file->read(true,'r'));
              $activityLog = implode("\n",array_reverse($activityLog, true));
              $this->set('activityLog',$activityLog);

          endif;

         /* Requète temporaire pour la requète sql Front $ids= implode(",",Hash::extract(json_decode($v['value'],true),'{n}.id'));*/

         $verif= $this->Option->find('first',array('condition'=>array('name'=>'slideProject')));

         if(count($verif['Option']['value'])==1):

           $nbrSlide =Hash::extract(json_decode($verif['Option']['value'],true),'nbrSlide');

         else:

           $nbrSlide =Hash::extract(json_decode($verif['Option']['value'],true),'{n}.nbrSlide');

         endif;

         if(!empty($verif)):

           $slideProject = $this->Project->find('all',array('fields'=>array('Project.id','Project.name','Thumbnail.file','Slider.file'),'conditions'=>array('Project.id'=>Hash::extract(json_decode($verif['Option']['value'],true),'{n}.id'))));

         endif;

         /* On envoit le paramètre par défaut de tabulation sélectionné */
         $this->set('tab','0');

         if ($this->request->is('post') || $this->request->is('put')) :

            $search = $this->request->data['ProjectSearch'];

            if( !empty($search) ){

                $projects = $this->Project->find('all',array('conditions'=>array('Project.hidden'=>false,'Project.published'=>true,'Project.name LIKE'=>'%'.$search.'%')));
                $this->set('projects', $projects);

                $this->set('tab','0');
            }

            $data=$this->request->data['Option'];

            if ( $data['name'] == 'selectProject') :

                    $nbrSlide = $data['nbrSlide'];

                    $v['name'] = $data['name'];

                    /* Vérification si existant */
                    $verif = $this->Option->find('first',array('condition'=>array('name'=>$v['name'])));

                            /* Si pas d'enregistrement précédent on enregistre en bdd */

                            if(empty($verif)):

                            $this->Option->create();

                            /* Enregistrement des ids dans le model option de la bdd */
                            $v['value'] = json_encode(Hash::extract($data,'{n}'));

                            $this->Option->save($v);

                            else:
                             /* Si déjà enregistré extraction des Ids enregistrés en bdd pour comparaison avec ceux envoyé*/
                             $ids=Hash::extract(json_decode($verif['Option']['value'],true),'{n}.id');

                                /* Ids envoyés par le formulaire */
                                $idsSend = Hash::extract($data,'{n}.id');
                                    if(!empty($idsSend)):
                                        foreach($idsSend as $k => $d):
                                                if (!in_array($d, $ids)):
                                                        array_push($ids,$d);
                                                endif;
                                        endforeach;
                                    endif;
                                /* si pas d'ids enregistrés */
                                if(!empty($ids)):
                                        foreach ($ids as $k => $d):
                                            $ids[$k]= array('id'=>$d);
                                        endforeach;
                                     $keys = array_keys($ids);
                                        $last_key = $keys[count($keys)-1];
                                        $ids[$last_key+1]=array('nbrSlide'=>$data['nbrSlide']);
                                else:
                                    $ids[]=array('nbrSlide'=>$data['nbrSlide']);

                                endif;
                                /* on compte le nombre de clés du tableau pour ajouter le nombre de slide*/


                                    $v['value'] = json_encode(Hash::extract($ids,'{n}'));
                                     /* on save le champ avec les nouveaux ids*/

                                    $this->Option->id = $verif['Option']['id'];
                                    $this->Option->saveField('value',$v['value']);
                                    $slideProject = $this->Project->find('all',array('conditions'=>array('Project.id'=>Hash::extract(json_decode($v['value'],true),'{n}.id'))));

                            endif;

            elseif( $data['name'] == 'footerParams'):

                    $v['name']=$data['name'];

                    $verif= $this->Option->find('first',array('conditions'=>array('name'=>$v['name'])));

                    $v['value'] = json_encode($data);

                     /* Si pas d'enregistrement précédent on enregistre en bdd*/
                            if( empty( $verif ) ):

                            $this->Option->create();

                            /* Enregistrement des ids dans le model option de la bdd */

                            $this->Option->save($v);

                            else:

                            $this->Option->id = $verif['Option']['id'];

                            $this->Option->saveField('value',$v['value']);

                            endif;
                    $this->set('tab','2');


            else:

                    $v['name']=$data['name'];

                    /* Vérif si existant */

                    $verif= $this->Option->find('first',array('conditions'=>array('name'=>$v['name'])));

                    /* on retire le name pour éviter l'enregistrement sur value */

                    $data = Hash::remove($data, 'name');

                    $v['value'] = json_encode($data);

                     /* Si pas d'enregistrement précédent on enregistre en bdd*/
                            if( empty( $verif ) ):

                            $this->Option->create();

                            /* Enregistrement des ids dans le model option de la bdd */

                            $this->Option->save($v);

                            else:

                            $this->Option->id = $verif['Option']['id'];

                            $this->Option->saveField('value',$v['value']);

                            endif;
                    $this->set('tab','1');
            endif;

        endif;

        $params =  $this->Option->find('all',array('fields'=>array('Option.name','Option.value')));


        if(!empty($params)):

            foreach ( $params as $v) :


                    $data = json_decode($v['Option']['value'],true);

                    foreach ($data as $k => $dataParam):


                        if(!is_numeric($k)):

                            $this->set($k,$dataParam);

                        else:

                            if( (isset($dataParam['slideTitre']) or !empty($dataParam['SlideTitre'])) or ((isset($dataParam['slideContent']) or !empty($dataParam['SlideContent']))) ):

                            $this->set('slide'.$k.'Titre',$dataParam['slideTitre']);

                            $this->set('slide'.$k.'Content',$dataParam['slideContent']);

                            endif;


                        endif;

                    endforeach;



            endforeach;

        endif;

        /* envoi du nombre de slides possibles sélectionnés */

        $this->set('nbrSlide',$nbrSlide);

        /* Envoi sur la page options des projets sélectionnés */
        $this->set('slideProject', $slideProject);

        $this->set('title_for_layout','Admin -Options');


}

function admin_deleteSlide($id)
{

    if(is_numeric($id)):
    $verif= $this->Option->find('first',array('condition'=>array('name'=>'slideProject')));
    $ids=Hash::extract(json_decode($verif['Option']['value'],true),'{n}.id');
    $nbrSlide=Hash::extract(json_decode($verif['Option']['value'],true),'{n}.nbrSlide');

    foreach($ids as $k => $v):
        $ids[$k]= array('id'=>$v);
        if($v== $id):
            unset($ids[$k]);
        endif;

    endforeach;
            if(!empty($ids)):
            $keys = array_keys($ids);
            $last_key = $keys[count($keys)-1];
            $ids[$last_key+1]=array('nbrSlide'=>$nbrSlide[0]);
            $v = array('value'=>json_encode(Hash::extract($ids,'{n}')));
            $this->Session->setFlash("Le projet a bien été retiré du slider",'notif',array('type'=>'success'));
            else:

            $v = array('value'=>json_encode(array('nbrSlide'=>$nbrSlide[0])));
            $this->Session->setFlash("Il n'y a plus de projet sélectionné pour le slider",'notif',array('type'=>'info'));
            endif;
    /* on save le champ avec les nouveaux ids*/

    $this->Option->id = $verif['Option']['id'];
    $this->Option->saveField('value',$v['value']);
    $this->redirect(array('controller'=>'options','action' => 'index'));
    endif;


}

function admin_deleteSlides()
{

    $verif= $this->Option->find('first',array('condition'=>array('name'=>'slideProject')));

    if($verif):
      $nbrSlide=Hash::extract(json_decode($verif['Option']['value'],true),'{n}.nbrSlide');
      $v = array('value'=>json_encode(array('nbrSlide'=>$nbrSlide[0])));
      $this->Option->id = $verif['Option']['id'];
      $this->Option->saveField('value',$v['value']);
      $this->Session->setFlash("Il n'y a plus de projet sélectionné pour le slider",'notif',array('type'=>'info'));
    endif;

    $this->redirect(array('controller'=>'options','action' => 'index'));

}

function admin_deleteCache()
{
    $this->autoRender = false;
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
    $this->log("Le cache a été rafraîchi",'activity');
    $this->Session->setFlash("Le cache a été rafraïchi",'notif',array('type'=>'info'));
    $this->redirect(array('controller'=>'options','action' => 'index'));
}

function admin_renewProjets(){
         $needle = 'http://anne-b.fr';
         $this->Project->unbindModel(
         array('hasMany' => array('Media'),'hasAndBelongsToMany'=>array('Taxonomy.Taxonomy'))
         );
         $this->Project->Behaviors->unload('Taxonomy.Taxonomy');


         $projets = $this->Project->find('all',array('fields'=>array('Project.description','Project.id')));
         foreach ( $projets as $k => $projet) :
                  $description = $projet['Project']['description'];
                  if( !empty($description)):
                           if( stripos($description, $needle)):
                           $newDescription = str_ireplace($needle,'https://anne-b.fr',$projet['Project']['description'],$count);

                           $this->Project->id = $projet['Project']['id'];
                           $this->Project->saveField('description',$newDescription);

                           endif;
                  endif;
         endforeach;

         $this->redirect(array('controller'=>'options','action' => 'index'));
}
function footerIndex()

{
    $footer = $this->Option->find('first',array('conditions'=>array('name'=>'footerParams'),'fields'=>array('Option.name','Option.value')));

    if ($this->request->is('requested')) {

      return $footer;

    } else {

        $this->set(compact('footer'));
    }


}

}
?>
