

<div class="pageContent">
<div class="row headerPage tagPage-header">
	<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
		<div class="title-page">
				<?php echo '<h1>'.$layoutTag.'</h1>'; ?>
		</div><!-- .title-page -->
	</div>
	<div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
			<div class="header-contact">
				<?php echo $this->Html->link('Contactez-moi',array('controller'=>'contact','action'=>'index'),array('class'=>'contactMe')); ?>
			</div>
	</div>
</div><!-- .headerPage -->
<?php echo $this->Html->meta('canonical',$this->Html->url($canonical,true),array('rel'=>'canonical','type'=>null, 'title'=>'Anne-b - Tag '.$layoutTag,'inline'=>false)); ?>
<?php $this->start('og'); ?>

	<?php echo $this->Html->meta(array('property'=>'og:url'
	,'block'=>'og'
	,'type'=>'meta'
	,'rel'=>null
	,'content'=>$this->Html->url($canonical,true)
	,'inline'=>false)); ?>
	<?php echo $this->Html->meta(array('property'=>'og:type'
	,'block'=>'og'
	,'type'=>'meta'
	,'rel'=>null
	,'content'=>'article'
	,'inline'=>false)); ?>

	<?php echo $this->Html->meta(array('property'=>'og:image'
	,'block'=>'og'
	,'type'=>'meta'
	,'rel'=>null
	,'content'=> $this->Html->url(Hash::extract($projectsTag,'0.Thumbnail.file'),true)
		,'inline'=>false)); ?>

<?php $this->end(); ?>
<?php echo $this->element('portfolio',array('tags'=>$tags,'projects'=>$projectsTag,'private'=>$private,'description'=>'')); ?>
</div><!-- pageContent-->
<?php echo $this->Html->script(array('front/jquery.mixitup.min','front/portfolio.js'),array('inline'=>false)); ?>
<?php echo $this->Html->css(array('front/portfolio.css'),array('inline'=>false)); ?>
