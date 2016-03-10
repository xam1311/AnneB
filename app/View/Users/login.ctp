<?php $this->set('title_for_layout','Connexion - anne-B'); ?>
<div class="row headerPage loginPage">
	<div class="col-lg-2 col-md-3 col-xs-12">
			<i class="sprite sprite-woman">
			</i>
	</div>
	<div class="col-lg-6 col-md-6 col-xs-12 text-left">
		<div class="title-page">
				<h1>Connexion</h1>
		</div><!-- .title-page -->
	</div>
</div>

<div class="row text-left">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

	<?php echo $this->Session->flash('auth'); ?>
	<?php echo $this->Form->create('User');?>

	<?php echo $this->Form->input('username',array('label'=>'Identifiant','class'=>'form-control','div'=>array('class'=>'form-group')));?>

	<?php echo $this->Form->input('password',array('label'=>'Mot de passe','class'=>'form-control','div'=>array('class'=>'form-group')));?>

	<?php echo $this->Html->link('> Mot de passe oublié',array('controller'=>'users','action'=>'password'),array('class'=>'')); ?>
	</div>
	<div class="col-lg-12 col-md-12 col-xs-12 text-center">
		<?php echo $this->Form->button('Se connecter',array('class'=>'btn-send-form')); ?>
		<?php echo $this->Form->end(); ?>
	</div>

</div>
