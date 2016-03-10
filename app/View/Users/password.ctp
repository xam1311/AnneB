<?php $this->set('title_for_layout','Mot de passe oublié'); ?>
<div class="row headerPage passwordPage">
	<div class="col-lg-2 col-md-3 col-xs-12">
			<i class="sprite sprite-print">
			</i>
	</div>
	<div class="col-lg-6 col-md-6 col-xs-12 text-left">	
		<div class="title-page">
				<h1>Mot de passe oublié</h1>
		</div><!-- .title-page -->
	</div>
</div>
	
<div class="row text-left">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										<?php echo $this->Form->create('User'); ?>
										<?php echo $this->Form->input('email',array('label'=>'Votre email','class'=>'form-control','div'=>array('class'=>'form-group'))); ?>
	</div>
	<div class="col-lg-12 col-md-12 col-xs-12 text-center">
										<?php echo $this->Form->button('Réinitialiser le mot de passe',array('class'=>'btn ')); ?>
										<?php echo $this->Form->end(); ?>
	</div>
</div>