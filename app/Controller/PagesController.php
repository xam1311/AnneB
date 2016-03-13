<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Project','Option','Category');

	public $helpers = array('Cache');

  	public $cacheAction = array(
 	'home'=>'+1 month',
 	'footerIndex' =>'+1 month',
 	'display'=>'+1 month'
 	);
/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}

	public function home() {

		 $slider = $this->Option->find('first',array('condition'=>array('name'=>'slideProject')));

         /* Extraction id pour sélection slider */
         $ids = Hash::extract(json_decode($slider['Option']['value'],true),'{n}.id');

         $fields = array('Project.media_id','Project.hidden','Project.published','Project.slug','Project.order','Project.short_description','Project.name','Project.created','Project.website','Project.id','Category.id','Category.name','Category.slug','Thumb.file','Thumbnail.file');
         if(!$ids):

         $nbrSlide = Hash::extract(json_decode($slider['Option']['value'],true),'{n}.nbrSlide');
         $portfolioHome = $this->Project->find('all',array('conditions'=>array('Project.hidden'=>0,'Project.published'=>1),'fields'=>$fields,'order'=>array('Project.created DESC'),'contain'=>array('Category','Thumbnail','Thumb'),'limit'=>$nbrSlide[0]));
         else:
         $nbrSlide = Hash::extract(json_decode($slider['Option']['value'],true),'{n}.nbrSlide');


     	 /* on récupère les slides sélectionnés */
         $portfolioHome = $this->Project->find('all',array('conditions'=>array(
    	'Project.id'=>$ids,'Project.hidden'=>0,'Project.published'=>1),'fields'=>$fields,'contain'=>array('Category','Thumbnail','Thumb'),'limit'=>$nbrSlide[0]));

         /* Condition pour vérifier le nombre de projets à ajouter si le choix en nombre est supérieur au nombre de projets sélectionnés dans le slider */
         $nbrReste = $nbrSlide[0]-count($ids);

				 if($nbrReste > 0 ) :

		         $slidesReste = $this->Project->find('all',array('conditions'=>array(
		    	'Project.id NOT'=>$ids,'Project.hidden'=>0,'Project.published'=>1 ),'fields'=>$fields,'contain'=>array('Category','Thumbnail','Thumb'),'order'=>array('Project.created DESC'),'limit'=>$nbrReste));

			         foreach($slidesReste as $data):
			         	 array_push($portfolioHome,$data);
			         endforeach;

		         endif;


        endif;
        $this->set(compact('portfolioHome'));


        $homeParams = $this->Option->find('first',array('conditions'=>array('name'=>'homeParams')));

        /*debug($homeParams);*/
        if(!empty($homeParams)):
            $data = json_decode($homeParams['Option']['value'],true);
            /* On extrait l'array indexé en chiffre slides pour formater le set */
            $slidesDesc =Hash::extract($data,'{n}');
            $this->set('slides',$slidesDesc);
            $this->set('titreSite',$data['titreSite']);
            $this->set('sloganSite',$data['sloganSite']);
         endif;





	}

	public function footerIndex()
	{

		if (empty($this->request->params['requested'])) {
            throw new ForbiddenException();
        }

		$footerParams = $this->Option->find('first',array('conditions'=>array('name'=>'FooterParams')));

        if(!empty($footerParams)):
            return $data = json_decode($footerParams['Option']['value'],true);
        endif;


	}

	public function download($filename)
	{
		$this->response->file(WWW_ROOT.'files'.DS.$filename,array('download'=>true,'name'=>'cv_anne_berland.pdf'));
		return $this->response;
	}
	public function admin_upload()
	{

		$this->autoRender = false;

		App::uses('Folder', 'Utility');
		App::uses('File', 'Utility');

        if ($this->request->is('post') ):

        			$arbo = $this->request->data['Option']['arbo'];
        			$nameFile = $this->request->data['Option']['nameFile'];

					if (!empty($_FILES)):

						$extension = explode(".", strtolower($_FILES['file']['name']));

						$folderOrig = explode(DS, strtolower($arbo));

						$dir = new Folder(WWW_ROOT . $folderOrig[0]);

						$folder = $dir->cd($folderOrig[1]);

						if(!$folder):

							$folder = new Folder(WWW_ROOT . $folderOrig[0]. DS . $folderOrig[1] ,true,0755);


						endif;

			        	$files = $dir->find('.*\.'.$extension[1]);

			        	if( !empty($files) and isset($files) ):

				        	foreach($files as $v):

						        	$file = new File(WWW_ROOT . DS . $folderOrig[1]. DS . $v, false, 0777);

											debug($file);

						        	$name = $file->name($file);

						        		if($name == $nameFile):

							        		$pathFile = $file->pwd($file);

							        		$file->delete();

						        		endif;

				        	endforeach;
				        endif;

			        $path = Folder::addPathElement(WWW_ROOT, $folderOrig[0] . DS . $folderOrig[1] );

					    $tempFile = $_FILES['file']['tmp_name'];

					    move_uploaded_file($tempFile,$path.DS. $nameFile .'.'. $extension[1]);

							$this->redirect(array('controller'=>'options','action'=>'index'));

					endif;
		endif;


	}
}
