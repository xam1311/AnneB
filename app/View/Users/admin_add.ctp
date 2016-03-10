<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
     <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
        <?php echo $this->Html->link('Nouvel utilisateur','#',array('class'=>'navbar-brand')); ?>
    </div>
  <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
             <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-off" aria-hidden="true"></span> Retour',array('action'=>'index','controller'=>'users'), array('escape'=>false)); ?></li>
          </ul>
  </div><!--/.nav-collapse -->
</nav>
<div class="container">
<div class="row">
<div class="col-md-12">
<?php echo $this->Form->create('User');?>
    <legend><?php echo __('Ajouter un nouveau visiteur'); ?></legend>
<?php echo $this->Form->input('username',array('label'=>'Nom du visiteur','class' =>'form-control','div' => array(
              'class' => 'form-group')));?>
<?php echo $this->Form->input('email',array('label'=>'Email','class' =>'form-control','div' => array(
              'class' => 'form-group')));?>
<?php echo $this->Form->button('Enregistrer',array('class'=>'btn btn-primary','div'=>false,'type'=>'submit')); ?>
  </div>
</div>
<?php echo $this->Form->end(); ?>

  </div>
</div>
</div>