<?php $this->set('title_for_layout','Me connaître : Anne Berland'); ?>
<?php $this->start('og'); ?>
		<?php echo $this->Html->meta(array('property'=>'og:title'
		,'block'=>'og'
		,'type'=>'meta'
		,'rel'=>null
		,'content'=>'Contact Anne Berland'
		,'inline'=>false)); ?>
		<?php echo $this->Html->meta(array('property'=>'og:url'
		,'block'=>'og'
		,'type'=>'meta'
		,'rel'=>null
		,'content'=>$this->Html->url(array('controller'=>'pages','action'=>'display','know'))
		,'inline'=>false)); ?>
		<?php echo $this->Html->meta(array('property'=>'og:type'
		,'block'=>'og'
		,'type'=>'meta'
		,'rel'=>null
		,'content'=>'article'
		,'inline'=>false)); ?>
<?php $this->end(); ?>
<div class="pageContent">
	<div class="row headerPage knowPage-title">
		<div class="col-lg-2 col-md-3 col-xs-12">
				<i class="sprite sprite-woman">
				</i>
		</div>
		<div class="col-lg-6 col-md-5 col-xs-12">
			<div class="title-page">
					<h1>Me connaître</h1>
					<h2>Une passion qui dure</h2>
			</div><!-- .title-page -->
		</div>
		<div class="col-lg-4 col-md-4 col-xs-12">
				<div class="header-contact hidden-xs">
							<?php echo $this->Html->link('Contactez-moi',array('controller'=>'contact','action'=>'index'),array('class'=>'contactMe hidden-xs')); ?>

				</div>
				<div class="header-social">
					<?php echo  $this->Html->link('<i class="icon-twitter icon-2xl"></i>','https://twitter.com/CreaAnneb',array('escape'=>false,'class'=>'social-button','target'=>'_blank','title'=>'Suivre @CreaAnneb '));?>

					<?php echo  $this->Html->link('<i class="icon-pinterest icon-2xl"></i>','https://www.pinterest.com/',array('escape'=>false,'class'=>'social-button','target'=>'_blank','title'=>'Suivre le Pinterest Anne-b'));?>
				</div>
		</div>
	</div>
	<section>
	<div class="row knowPage-content">

			<div class="col-lg-12 col-md-12 col-xs-12 knowPage-content-illus">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<p>La découverte des feutres, des crayons et de la peinture lorsque j’étais enfant, fut pour moi une révélation. C’est tout naturellement que je m’orienta vers des <strong>études en design graphique.</strong></p>
								<p>Pendant mon année de prépa en école d’art, je découvris un outil qui me sembla révolutionnaire : Photoshop. Grâce à cet outil, je fis un <strong>DNAP en design graphique</strong>. Ces études me donnèrent également quelques bases en <strong>webdesign</strong> qui me sembla plus passionnant que le print. Je me tourna donc vers une spécialisation en alternance en webdesign à <strong>l’école des Gobelins</strong> où je fis une Licence professionnelle. Cette formation m’a permis de me perfectionner et d’acquérir des réflexes professionnels en design web.</p>
						</div>

						 <div class="col-lg-4 col-lg-offset-1 col-md-5 col-md-offset-1 col-sm-10 col-xs-12 svg-wrap">
							<?php echo $this->element('animsvg'); ?>

						</div>
						<!-- à retirer ou non -->
						<div class="col-xs-12 hidden-lg hidden-md hidden-sm hidden-xs">
							<?php echo $this->Html->image('front/knowIllus.jpg',array('title'=>'Processus créatif','alt'=>'Illustration texte processus créatif','class'=>'img-responsive')); ?>
						</div>
					</div>
			</div>

	</div>

	</section>

	<div class="row wallpaper knowPage-wallpaper hidden-xs">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?php echo $this->Html->image('front/wallpaperknow.svg',array('class'=>'img-responsive','title'=>'Mon bureau !','alt'=>'Image d\'illustration page me connaître')); ?>
		</div>
	</div>
</div><!-- pageContent-->
<section class="knowPage-outside">
	<div class="row bg-blue">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>J'aime</h3>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			  			<figure>
			    			<i class="icon-series icon-4x"></i>
			                <figcaption><h4>Les séries</h4>
			                <small>Adepte de séries, je les regarde en VO sous-titré</small>
			                </figcaption>
			          		</figure>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						  <figure>
				              <i class="icon-pencil icon-4x"></i>
				              <figcaption><h4>Les arts graphiques</h4>
				              <small>Connectée une grosse partie de la journée, j’effectue une veille constante en design graphique</small>
				              </figcaption>
			         	   </figure>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						 <figure>
				              <i class="icon-note icon-4x"></i>
				              <figcaption><h4>La musique</h4>
				              <small>Une bonne bande son m’accompagne aussi bien dans mon travail qu’à la maison</small>
				              </figcaption>
			          	 </figure>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						 <figure>
				              <i class="icon-cookie icon-4x"></i>
				              <figcaption>
				              <h4>La cuisine</h4>
				              <small>Bonne vivante, j’aime faire partager à mon entourage de bons desserts</small>
				              </figcaption>
			          	 </figure>
		</div>
	 </div><!-- fin .row -->

	 <div class="row hidden-md hidden-sm hidden-lg">
			<div class="col-xs-12">
						<div class="header-contact">
							<?php echo $this->Html->link('Contactez-moi',array('controller'=>'contact','action'=>'index'),array('class'=>'contactMe')); ?>
						</div>
			</div>
	</div>
</section>
<?php echo $this->Html->scriptStart(array('inline'=>false));?>
jQuery(function($){
  $pen = jQuery('#pen');
	$arrow1 = jQuery('#arrow1');
	$psd = jQuery('#psd');
	$arrow2 = jQuery('#arrow2');
	$screen = jQuery('#screen');
var sequenceFade = [
    { e: $pen, p: {  opacity: 1 , display:"block"}, o:{duration :1000}},
    { e: $arrow1, p: {  opacity: 1 , display: "block"}, o: {duration: 1000}},
	{ e: $psd, p: {  opacity: 1 , display: "block"}, o: {duration: 1000}},
	{ e: $arrow2, p: {  opacity: 1 , display: "block"}, o: {duration: 1000}},
	{ e: $screen, p: {  opacity: 1 , display: "block"}, o: {duration: 1000}}
  ];
$.Velocity.RunSequence(sequenceFade);

});
<?php echo $this->Html->scriptEnd(); ?>
