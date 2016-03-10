<?php $this->extend('/Common/adminnav');?>

<?php $this->assign('title','Administration Utilisateurs'); ?>
<div class="col-lg-12 col-sm-12 col-xs-12">
      <h3 class="well well-sm"><?php echo $this->fetch('title'); ?></h3> 
                <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                	<?php echo $this->Html->link('Nouvel utilisateur',array('controller'=>'users','action'=>'add'),array('class' =>'btn btn-medium btn-primary')) ;?>
                  <div class="table-responsive">
                   <table class="table table-hover table-striped">
                   	<thead>
                   		<tr>
                  				<th>Nom</th>
                  				<th>Profil</th>
                  				<th>Email</th>
                  				<th>Dernière connexion</th>
                  				<th>Création compte</th>
                  				<th>Date création</th>			
                  				<th>Rôle</th>				
                  				<th>Actions</th>
                   		</tr>
                   	</thead>
                   	<tbody>
                   		<?php foreach ($visitors as $d): ?>
                   		<tr>
                   			<td><?php echo $this->Html->link($d['User']['username'],array('action'=>'edit','controller'=>'users',$d['User']['id'])); ?></td>
                   			<td><?php echo $d['User']['active'] == '0' ? $this->Html->link('<span class="label label-danger">Désactivé</span>',array('action'=>'activate',$d['User']['id']),array('escape'=>false),__("Voulez vous vraiment activer le visiteur %s ?",$d['User']['username'])) : 
                   			$this->Html->link('<span class="label label-success">Activé</span>',array('action'=>'desactivate',$d['User']['id']),array('escape'=>false),__("Voulez vous vraiment désactiver le visiteur %s ?",$d['User']['username']));?></td>
                   			<td><?php echo $d['User']['email']; ?></td>
                   			<td><?php echo $d['User']['lastlogin']!='0000-00-00 00:00:00' ? '<span class="label label-success">'.$this->Time->timeAgoInWords($d['User']['lastlogin'],array('format'=>'F jS, Y')).'</span>' :'<span class="label label-info">Jamais Connecté</span>'; ?></td>
                   			
                   			<td><?php echo !empty($d['Invitations'])  ? '<span class="label label-success">Par invitation :: Mail envoyé '.$this->Time->timeAgoInWords($d['Invitations'][0]['created'], array('format' => 'F jS, Y')).'</span>' :'<span class="label label-info"> Par contact mail ou administration</span>'; ?></td>
                   			
                   			<td><?php echo $d['User']['created']; ?></td>
                   			<td><?php echo $d['User']['role']; ?></td>
                   			<td><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus-sign"></span>',array('action'=>'edit',$d['User']['id']),array('escape'=>false),"Voulez vous vraiment éditer ce visiteur ?");

                   			echo $this->Html->link('<span class="glyphicon glyphicon-remove-sign"></span>',array('controller'=>'users','action'=>'delete',$d['User']['id']),array('escape'=>false),__("Voulez vous vraiment supprimer le visiteur %s ?",$d['User']['username']));
                   			echo $d['User']['active'] == '0' ? $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>',array('action'=>'activate',$d['User']['id']),array('escape'=>false),__("Voulez vous vraiment activer le visiteur %s ?",$d['User']['username'])) : $this->Html->link('<span class="glyphicon glyphicon-eye-close"></span>',array('action'=>'desactivate',$d['User']['id']),array('escape'=>false),__("Voulez vous vraiment désactiver le visiteur %s ?",$d['User']['username']));?></td>
                   		</tr>
                   		<?php endforeach; ?>
                   	</tbody>
                  </table>
                  </div><!-- fin .table-responsive -->
                  <ul class="pagination">
                              <?php
                                  echo $this->Paginator->prev(__('Précédent'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                                  echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                                  echo $this->Paginator->next(__('Suivant'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                              ?>
                  </ul>
                </div><!-- fin .row -->
          </div><!-- fin lg12 -->
    </div><!-- fin md10 -->
</div><!-- fin .row -->
</div><!-- fin .container-fluid -->