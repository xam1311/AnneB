<?php
class Contact extends AppModel
{

 public $useTable = false;
 public $validate = array(
 	'username' =>array(
 		'rule'=> 'notEmpty',
 		'required'=>true,
 		'message'=>'Vous devez entrer votre nom'
 	),
 	'email'=>array(
 		'rule'=>array('email',true),
 		'required'=>true,
 		'message'=>'Vous devez entrer un email valide'
 		),
    'message' =>array(
            'rule'=> array('between', 0 ,500),
            'message'=> ' Pas plus de 500 caractères',
            'allowEmpty'=>true
        ),
    'society'=>array(
            'rule'=>array('alphaNumeric'),
            'allowEmpty'=>true
            
        ),
    'phone'=>array(
            'rule'=>array('phone','`^(0[1-69][-.\s]?(\d{2}[-.\s]?){3}\d{2})$`','fr'),
            'allowEmpty'=>true,
            'message'=>'Merci de mettre un numéro de téléphone valide'
        )
 	);


 	public function sendMail($d)
 	{
 		$this->set($d);
 		if($this->validates())
 		{
            $mailAdmin='anne@anne-b.fr';
 			App::uses('CakeEmail','Network/Email');
  
                            $mail = new CakeEmail();
                           		$mail->config('smtp')
                                 ->from($d['email'])
                                 ->to($mailAdmin)
                                 ->subject('Demande de contact site "Anne-b"')
                                 ->emailFormat('html')
                                 ->template('contact','general')
                                 ->viewVars($d)
                                 ->send();
            if($mail){
                return true;
            }
            else{return false;}
            
 		}else{
 			
            return false;
 		}
 	}

 	public function sendDmd($user,$d)
 	{
 			$link= array('controller'=>'users','action'=>'activate','full_base'=>true,'token'=>$user['User']['id'].'-'.md5($user['User']['password']),'admin'=>false);
 			App::uses('CakeEmail','Network/Email');
                            $mailAdmin = 'anne@anne-b.fr';
                            $mail = new CakeEmail();
                           		$mail->config('smtp')
                                 ->from($d['email'])
                                 ->to($mailAdmin)
                                 ->subject('Demande d\'accès privé au site Anne-b')
                                 ->emailFormat('html')
                                 ->template('access','general')
                                 ->viewVars(array('username'=>$d['username'],'society'=>$d['society'],'phone'=>$d['phone'],'message'=>$d['message'],'link'=>$link))
                                 ->send();
            if($mail):
                return true;
            else:
                return false;
            endif;
 	}
}