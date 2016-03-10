<?php


class ContactController extends AppController {

 public $name  = 'Contact';
 public $uses  = array('Contact','User');
 public $components = array('Security');


public function index()
{
	if($this->request->is('post')):
		$d = $this->request->data('Contact');
		$this->Contact->set($d);
		if($this->Contact->validates(array('fieldlist'=>array('username','email','message','phone','society')))):
						if($this->Contact->sendMail($d)):
							$this->Session->setFlash('Votre email a bien été envoyé','front_notif');
							$this->request->data= array();
						else:
							$this->Session->setFlash('Votre email a rencontré un problème','front_notif',array('type'=>'error'));
						endif;
			endif;
	endif;


	
}

}
?>