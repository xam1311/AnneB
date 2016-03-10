<?php 
class TermsController extends AppController {


	function admin_search(){
		$terms = $this->Term->find('list',array(
			'conditions' => array(
				'name LIKE'=>'%'.$_GET['term'].'%',
				'type' => $_GET['type']
			),
			'fields' => array('id','name'))
		);
		$json = array(); 
		foreach($terms as $id=>$name){
			$json[] = array('id'=>$id,'label'=>$name);
		}
		die(json_encode($json)); 
	}

	
 	function admin_delete($id)
 	{
 		$this->Term->TermR->delete($id);
 		$term_id = $this->Term->TermR->field('term_id');
		$this->Term->TermR->delete($id); 

		// On supprime le term si plus utilisé
		$count = $this->Term->TermR->find('count',array(
			'conditions' => array('term_id'=>$term_id)
		));
		if($count == 0){
			$this->Term->delete($term_id); 
		}
		/*die(); */
		$this->redirect($this->referer());


 	}

 	function admin_add($ref,$ref_id,$type)
 	{
 		if(isset($_GET['name']))
 		{
 			$d = array(
 				'name'=> trim($_GET['name']),
 				'type'=>$type
 				);
 			$term = $this->Term->find('first',array('conditions'=>$d,'fields'=>'id'));
 			if(empty($term))
 			{
 			$this->Term->save($d);
 			$term_id = $this->Term->id;
 			}
 			else{
 				$term_id = $term['Term']['id'];

 			}

 		}
 		$d = array(
 			'ref'=>$ref,
 			'ref_id' => $ref_id,
 			'term_id' => $term_id
 			);
 		$count = $this->Term->TermR->find('count', array('conditions'=>$d));
 		if($count == 0)
 		{
 			$this->Term->TermR->save($d);
 			$url = Router::url(array('action'=>'delete',$this->Term->TermR->id,'admin'=>true));
 			die('<span class="label label-primary"">'.$_GET['name'].'<a href="'.$url.'" class="delTaxo">x</a></span>');
 		}

 	}

}

 ?>