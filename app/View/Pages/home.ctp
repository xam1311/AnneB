<?php $this->set('title_for_layout','Anne-B Directrice Artistique'); ?>

<?php echo $this->Html->meta('keywords','Directrice artistique, book, portfolio, DA web, webdesign, graphisme, graphiste, direction artistique, ergonomie, newsletter, encart pub, Encart pub, habillage, Habillage,jeux Concours,Jeux concours,Campagne Facebook,campagne facebook, design, responsive webdesign, identité visuelle, création graphique, design graphique,mobile, Mobile, responsive, Responsive, interactive art director,design ui,design ux,Design UX,Design UI,Design ui,Design ux, management, Management',array('inline'=>false)); ?>
<?php echo $this->Html->meta('description','Directrice artistique, webdesigner, UI designer, je réalise le webdesign de vos sites web & mobiles – Besoin d’un directeur artistique : Anne Berland',array('inline'=>false)); ?>
<?php $this->start('og'); ?>

	<?php echo $this->Html->meta(array('property'=>'og:url'
	,'block'=>'og'
	,'type'=>'meta'
	,'rel'=>null
	,'content'=>Router::fullbaseUrl()
	,'inline'=>false)); ?>
	<?php echo $this->Html->meta(array('property'=>'og:type'
	,'block'=>'og'
	,'type'=>'meta'
	,'rel'=>null
	,'content'=>'website'
	,'inline'=>false)); ?>
	<?php echo $this->Html->meta(array('property'=>'og:description'
	,'block'=>'og'
	,'type'=>'meta'
	,'rel'=>null
	,'content'=>'Directrice artistique, webdesigner, UI designer, je réalise le webdesign de vos sites web & mobiles – Besoin d’un directeur artistique : Anne Berland'
	,'inline'=>false)); ?>


	<?php echo $this->Html->meta(array('property'=>'og:image'
	,'block'=>'og'
	,'type'=>'meta'
	,'rel'=>null
	,'content'=> $this->Html->url(Hash::extract($portfolioHome,'0.Thumbnail.file'),true)
		,'inline'=>false)); ?>

<?php $this->end(); ?>

<?php echo $this->Html->css(array('front/portfolio.css'),array('inline'=>false)); ?>
<div class="homePage pageContent text-left">
<div class="row headerPage homePage-header">
	<div class="col-lg-6 col-md-6 col-xs-12">
		<div class="title-page">
				<h1><?php echo $titreSite != '' ?$titreSite :'Anne Berland'; ?></h1>
				<h2><?php echo $sloganSite != '' ? $sloganSite : 'Directrice artistique &amp; UI designer' ?></h2>
		</div><!-- .title-page -->
	</div>
	<div class="col-lg-3 col-lg-offset-3 col-md-3 col-md-offset-3 col-xs-12">
			<div class="header-contact">
						<?php echo $this->Html->link('Télécharger <span>Mon CV</span>',array('controller'=>'pages','action'=>'download','cv.pdf'),array('title'=>'Télécharger mon Cv','escape'=>false,'class'=>'contactMe hidden-xs')); ?>
			</div>
	</div>
</div><!-- Fin homePage-header	-->
<div class="row homePage-pres">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3 class="color-blue">Juste passionnée</h3>
		<p>Depuis 8 ans en tant que directrice artistique au sein d'agences comme de pureplayer, je me passionne à créer des design innovants avec des interfaces efficaces et impactantes</p>
	</div>
 <div class="col-lg-12 col-md-12 col-xs-12">
	 <header>
						 <h4>Quelques réalisations</h4>
						 <span></span>

	 </header>
</div>
</div><!--fin .row-->
<?php echo $this->element('portfolio',array('tags'=>'','projects'=>$portfolioHome,'private'=>0,'home'=>true)); ?>


<div class="row hidden-md hidden-sm hidden-lg">
		<div class="col-xs-12">
					<div class="header-contact">
						<?php echo $this->Html->link('Contactez-moi',array('controller'=>'contact','action'=>'index'),array('class'=>'contactMe')); ?>
					</div>
		</div>
</div>

</div><!-- Fin cv-homeContent-->
<section class="homePage-resumate">
<div class="row bg-blue homePage-resumContent">
				<div class="col-lg-6 col-md-6 col-xs-12">
					     <article>
							     	<header>
											<h4>En résumé</h4>
											<span></span>
							     	</header>
										<p>
										UI designer et directeur artistique digital en poste mais à l’écoute de nouvelles opportunités
										</p>
											<div class="row">
											<div class="homeFooter-contact">
												<div class="col-lg-6 col-md-6 col-xs-12  contactMeFooter">
																<?php echo $this->Html->link('Me contacter',array('controller'=>'contact','action'=>'index'),array('class'=>'contactMe')); ?>
															</div>
												</div>
										</div>
					     </article>
				</div>
				<!--<div class="col-lg-6 col-md-6 col-xs-12">
						<article>
							<header>
								<h4>Dernier tweet</h4>
								<span></span>
							</header>
							<?php echo  $this->Html->link('<i class="icon-twitter icon-2x"></i>','https://twitter.com/CreaAnneb',array('escape'=>false,'class'=>'social-button','target'=>'_blank','title'=>'Suivre @CreaAnneb ','after'=>'Me suivre'));?>
						</article>
				</div>-->
</div><!-- .row -->
</section>
