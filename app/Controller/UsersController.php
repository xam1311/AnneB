<?php

class UsersController extends AppController {

public $name  = 'Users';
public $uses  = array('User','Invitation');
public $helpers = array('Paginator');

        public function login() {
            $this->set('title_for_layout','Connexion');
		    if ($this->request->is('post')) {
		        if ($this->Auth->login()) {
                    $this->User->id = $this->Auth->user("id");
                    $this->User->saveField('lastlogin',date('Y-m-d H:i:s'));
                    if($this->Auth->user("role")!= "admin"):
                        $this->Session->setFlash('Vous êtes connecté avec les accès aux projets privés, bonne visite','front_notif',array('type'=>'success'));
                        $this->redirect($this->Auth->redirectUrl($this->referer()));
                        else:
                        $this->Session->setFlash('Vous êtes maintenant connecté à l\'administration','notif',array('type'=>'success'));
                        $this->redirect($this->Auth->redirectUrl(array('controller'=>'options','action'=>'index','admin'=>true)));
                    endif;

		        } else {
		            $this->Session->setFlash('Nom d\'user ou mot de passe invalide, réessayer','front_notif',array('type'=>'danger'));
		        }
		    }
            if(!empty($this->params->params['named']['token']))
            {
                $token = $this->params->params['named']['token'];
                $token = explode('-',$token);
                $user = $this->User->find('first',array('conditions'=>array('id'=>$token[0],'MD5(User.password)'=>$token[1],'active'=>1)));
                    if(!empty($user))
                    {
                       $this->Auth->login();

                    }else{
                        $this->Session->setFlash("Le lien n'est pas valide ", 'front_notif',array('type'=>'danger'));

                    }
            }
		}

		public function logout() {
            $this->Session->setflash('Vous êtes maintenant déconnecté','front_notif');
            $this->redirect($this->Auth->logout());
		}

        public function password()
        {
            if(!empty($this->params->params['named']['token']))
            {
                $token = $this->params->params['named']['token'];
                $token = explode('-',$token);
                $user = $this->User->find('first',array('conditions'=>array('id'=>$token[0],'MD5(User.password)'=>$token[1],'active'=>1)));
                    if(!empty($user))
                    {
                        $this->User->id = $user['User']['id'];
                        $password = substr(md5(uniqid(rand(),true)),0,8);
                        /* Envoi du mot de passe en mail à l'utilisateur */
                        $this->User->saveField('password',$password);
                        App::uses('CakeEmail','Network/Email');
                        $mail = new CakeEmail();
                                    $mail ->from('nepasrepondre@anne-b.fr')
                                         ->config('smtp')
                                         ->to($user['User']['email'])
                                         ->subject('Anne-b : Votre nouveau mot de passe')
                                         ->emailFormat('html')
                                         ->template('renewmdp','general')
                                         ->viewVars(array('username'=>$user['User']['username'],'password'=>$password))
                                         ->send();
                        $this->Session->setFlash("Votre mot de passe a bien été réinitialisé, voici votre
                            nouveau mot de passe : $password , un email de confirmation vient de vous être envoyé ",'front_notif',array('type'=>'success'));
                        $this->redirect(array('controller'=>'pages','action'=>'home'));
                    }else{
                        $this->Session->setFlash("Le lien n'est pas valide ", 'front_notif',array('type'=>'danger'));

                    }
            }
            if($this->request->is('post'))
            {
            $v = current($this->request->data);
                    if(isset($v['email'])and !empty($v['email'])):
                    $user= $this->User->find('first',array('conditions'=>array('email'=>$v['email'],'active'=>1)));

                            if(empty($user))
                            {
                                $this->Session->setFlash("Aucun utilisateur ne correspond à ce mail" ,"front_notif",array('type'=>'danger'));

                            }else{
                                App::uses('CakeEmail','Network/Email');
                                $link= array('controller'=>'users','action'=>'password','full_base'=>true,'token'=>$user['User']['id'].'-'.md5($user['User']['password']));
                                    $mail = new CakeEmail();
                                    $mail ->from('nepasrepondre@anne-b.fr')
                                         ->config('smtp')
                                         ->to($user['User']['email'])
                                         ->subject('Anne-b : Oubli de mot de passe')
                                         ->emailFormat('html')
                                         ->template('mdp','general')
                                         ->viewVars(array('username'=>$user['User']['username'],'link'=>$link))
                                         ->send();
                                    $this->request->data['User']['email']=null;
                                    $this->Session->setFlash("Un email de réinitialisation mot de passe vous a été envoyé" ,"front_notif");

                                 }
                    else:
                    $this->Session->setFlash('Vous devez entrer un email','front_notif',array('type'=>'danger'));
                    $this->request->data['User']['email']=null;
                    $this->redirect(array('controller'=>'users','action'=>'password'));

                    endif;
            }

        }

        /*Function accès du visiteur en invitation ou visiteur en dmd après validation 'active' admin */
        public function access()
        {
            $token = $this->params->params['named']['token'];
            $token = explode('-',$token);
            $user = $this->User->find('first',array('conditions'=>array('id'=>$token[0],'MD5(User.password)'=>$token[1],'active'=>1)));
            if(!empty($user)){
                            if($this->Auth->login($user['User'])){
                            $this->User->id = $this->Auth->user("id");
                            $this->User->saveField('lastlogin',date('Y-m-d H:i:s'));
                            $this->redirect($this->Auth->redirect());
                            $this->Session->setFlash('Vous êtes connecté à la partie privée de mon site','front_notif');
                        }
                    }else{
                        $this->Session->setFlash('Le lien est invalide','front_notif',array('type'=>'danger'));
                        $this->redirect('/');
                    }

        }

        public function activate()
        {
            $token = $this->params->params['named']['token'];
            $token = explode('-',$token);
            $user = $this->User->find('first',array('conditions'=>array('id'=>$token[0],'MD5(User.password)'=>$token[1],'active'=>0)));
            $mailAdmin='anne@anne-b.fr';
            if(!empty($user)):
                    $this->User->id = $user['User']['id'];
                    if($this->User->saveField('active','1')):
                     $this->Session->setFlash('Le visiteur a été activé pour l\'accès privé','notif');
                      /* on réattribue un mot de passe pour que le visiteur y a accès*/
                     $password = substr(md5(uniqid(rand(),true)),0,8);
                     $this->User->saveField('password',$password);


                    $user= $this->User->read();
                    /*Envoi mail au visiteur pour l'accès privé */
                            App::uses('CakeEmail','Network/Email');
                                    $link= array('controller'=>'users','action'=>'access','full_base'=>true,'token'=>$user['User']['id'].'-'.md5($user['User']['password']));
                                    $mail = new CakeEmail();
                                             $mail->config('smtp')
                                             ->to($user['User']['email'])
                                             ->subject('Anne-B : Découvrez mon book')
                                             ->readReceipt($mailAdmin)
                                             ->emailFormat('html')
                                             ->template('invitation','general')
                                             ->viewVars(array('name'=>$user['User']['username'],'link'=>$link,'lien'=>'Découvrez mon book','password'=>$password,'identifiant'=>$user['User']['username']));
                                    $mail->send();
                            if($mail):
                                $this->Session->setFlash('Un mail a été envoyé à '.$user['User']['username'],'notif');
                            else:
                                $this->Session->setFlash('Un problème est arrivé l\'email n\'a pas été envoyé ','notif',array('type'=>'danger'));
                            endif;


                    else:
                    $this->Session->setFlash('Un problème est arrivé le visiteur ne peut pas avoir l\'accès privé','notif');
                    endif;

            else:
                $this->Session->setFlash('Le lien est invalide ou visiteur déjà activé','notif',array('type'=>'danger'));
            endif;
            $this->redirect('/');
        }


    public function admin_index() {
        $visitors=$this->paginate('User', array('User.role' => 'visitor'));
        $this->set('visitors',$visitors);
    }


    public function admin_add() {
        if ($this->request->is('post')) {
            $this->User->create();
            $d=$this->request->data['User'];
            $d['role']='visitor';
            $d['active']='1';
            $password = substr(md5(uniqid(rand(),true)),0,8);
           if ($this->User->save($d)) {
                $this->User->saveField('password',$password);
                $this->Session->setFlash('Le visiteur a été sauvegardé, son mot de passe est '.$password,'notif');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Le visiteur n\'a pas été sauvegardé. Merci de réessayer.','notif',array('type'=>'danger'));
            }
        }
    }

    public function admin_edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('User Invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $d = $this->request->data['User'];
            if($d['password'] != $d['passwordconfirm']){
                $this->Session->setFlash('Les mots de passes ne correspondent pas','notif',array('type'=>'danger'));
            }
            else{

                    if(!empty($d['password']) and !empty($d['passwordconfirm']) and !empty($d['username'])) {
                            if ($this->User->save($d,array('fieldList'=>array('password','username','email','active')))) {
                                $this->Session->setFlash('Les modifications ont été sauvegardé','notif');
                                $this->redirect(array('controller'=>'users','action'=>'index'));
                            } else {
                               $this->Session->setFlash('Les modifications n\'ont pas été sauvegardé. Merci de réessayer.','notif',array('type'=>'danger'));
                            }
                    }
                    else{
                          $this->Session->setFlash('Les modifications n\'ont pas été sauvegardé. un champ obligatoire est vide.','notif',array('type'=>'danger'));
                    }
                }
        } else {

            $this->request->data = $this->User->read();
            $this->request->data['User']['password'] =$this->request->data['User']['passwordconfirm'] = null;
        }
    }

    public function admin_delete($id) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Visiteur invalide'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash('Visiteur supprimé','notif');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Le visiteur n\'a pas été supprimé','notif',array('type'=>'danger'));
        $this->redirect(array('action' => 'index','controller'=>'users'));
    }

     public function admin_activate($id) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Visiteur invalide'));
        }
        if ($this->User->saveField('active','1')) {
            $this->Session->setFlash('Le visiteur a été activé','notif');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Le visiteur n\'a pas été activé','notif',array('type'=>'danger'));
        $this->redirect(array('action' => 'index','controller'=>'users'));
    }

     public function admin_desactivate($id) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Visiteur invalide'));
        }
        if ($this->User->saveField('active','0')) {
            $this->Session->setFlash('Le visiteur a été désactivé','notif');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Le visiteur n\'a pas été désactivé','notif',array('type'=>'danger'));
        $this->redirect(array('action' => 'index','controller'=>'users'));
    }

}
