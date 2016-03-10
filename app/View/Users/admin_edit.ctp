<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
     <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
        <?php echo $this->Html->link('Editer utilisateur '.$this->data['User']['username'],'#',array('class'=>'navbar-brand')); ?>
    </div>
  <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
             <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-off" aria-hidden="true"></span> Retour',array('action'=>'index','controller'=>'users'), array('escape' => false)); ?></li>
          </ul>
  </div><!--/.nav-collapse -->
</nav>
<div class="container">
  <div class="row">
      <div class="col-md-12">
<?php echo $this->Form->create('User'); ?>

<?php echo $this->Form->input('username',array('label'=>'Nom','class' =>'form-control','div' => array(
              'class' => 'form-group'))); ?>
<?php echo $this->Form->input('password',array('label'=>'Nouveu mot de passe','class' =>'form-control','div' => array(
              'class' => 'form-group'))); ?>
<?php echo $this->Form->input('passwordconfirm',array('type'=>'password','label'=>'Confirmation nouveau mot de passe','class' =>'form-control','div' => array(
              'class' => 'form-group'))); ?>
<?php echo $this->Form->input('email',array('label'=>'Email','label'=>'Email de contact','class' =>'form-control','div' => array(
              'class' => 'form-group'))); ?>
<div class="checkbox">
<label for="UserActive">Utilisateur activé
<?php echo $this->Form->checkbox('active',array('type'=>'checkbox')); ?></label>
</div>
<?php echo $this->Form->submit('Modifier Profil',array('class'=>'btn btn-primary')); ?>

<?php echo $this->Form->end(); ?>

  </div>
</div>
</div>