<?php $this->set('title_for_layout',"Contact Anne-b"); ?>
<?php echo $this->Html->meta('keywords','Directrice artistique, book, portfolio, DA web, webdesign, graphisme, graphiste, direction artistique, ergonomie, design, responsive webdesign, identité visuelle, création graphique, design graphique, interactive art director',array('inline'=>false)); ?>
<?php echo $this->Html->meta('description','Directrice artistique web, je réalise la conception, la création et le suivi de vos projets web et mobile - Anne Berland',array('inline'=>false)); ?>
<div class="<?php echo $this->params->url ?>Page pageContent text-left">
<div class="row headerPage cvPage-header">
	<div class="col-lg-12 col-md-12 col-xs-12">
		<div class="title-page">
				<h1>Contact</h1>
				<h2>N'hésitez pas à me contacter</h2>
		</div><!-- .title-page -->
	</div>
</div>

<?php echo $this->Form->create('Contact',array('class'=>'form')); ?>
<div class="row text-left">
	<div class="col-lg-6 col-md-6 col-xs-12 form-contact-content">
				<?php echo $this->Form->input('username',array('label'=>'Nom/Prénom','class'=>'form-control','placeholder'=>'Nom/prénom','div'=>array('class'=>'form-group'))); ?>
				<?php echo $this->Form->input('society',array('label'=>'Société','class'=>'form-control','placeholder'=>'Votre société','div'=>array('class'=>'form-group'))); ?>
				<?php echo $this->Form->input('email',array('label'=>'Email','class'=>'form-control','placeholder'=>'Votre email',array('class'=>'form-group'))); ?>
				<?php echo $this->Form->input('phone',array('label'=>'Téléphone','class'=>'form-control','placeholder'=>'Votre téléphone','div'=>array('class'=>'form-group'))); ?>
	</div>
	<div class="col-lg-6 col-md-6 col-xs-12 ">
		<?php echo $this->Form->input('message',array('type'=>"textarea",'label'=>'votre Message','rows'=>15,'class'=>'form-control','div'=>array('class'=>'form-group form-textarea'))); ?>
	</div>
	<div class="col-lg-12 col-md-12 col-xs-12 text-center">
		<?php echo $this->Form->button('Envoyez votre message',array('class'=>'btn-send-form')); ?>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
</div>
