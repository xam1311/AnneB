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
	,'content'=> $this->Html->url(Hash::extract($lastProjects,'0.Thumbnail.file'),true)
		,'inline'=>false)); ?>



<?php if(!empty($category['Category']['description']) and $category['Category']['description'] != ''): ?>
	<?php $description = $category['Category']['description'];?>

		<?php echo $this->Html->meta(array('property'=>'og:description'
		,'block'=>'og'
		,'type'=>'meta'
		,'rel'=>null
		,'content'=> htmlspecialchars(strip_tags($category['Category']['description']))
		,'inline'=>false));
		 ?>

<?php endif; ?>

<?php $this->end(); ?>

<div class="pageContent">
			<div class="row headerPage">
				<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
					<div class="title-page">
						<h1><?php echo $category['Category']['name']; ?></h1>
						<?php if(!empty($category['Category']['summary']) and $category['Category']['summary'] != ''): ?>

							<?php echo '<h2>'.$category['Category']['summary'].'</h2>'; ?>

						<?php endif; ?>
					</div><!-- .title-page -->
				</div>
				<div class="col-lg-3 col-md-4 col-sm-12 hidden-xs">
						<div class="header-contact">
							<?php echo $this->Html->link('Contactez-moi',array('controller'=>'contact','action'=>'index'),array('class'=>'contactMe')); ?>
						</div>
				</div>
			</div><!-- .headerPage -->

			<?php echo $this->element('portfolio',array('tags'=>$tags,'projects'=>$lastProjects,'private'=>$private,'description'=>$description)); ?>
			<div class="row hidden-md hidden-sm hidden-lg">
					<div class="col-xs-12 col-sm-12">
						<div class="header-contact">
							<?php echo $this->Html->link('Contactez-moi',array('controller'=>'contact','action'=>'index'),array('class'=>'contactMe')); ?>
						</div>
					</div>
			</div>
</div><!-- pageContent-->
<?php echo $this->Html->meta('canonical',$this->Html->url($canonical,true),array('rel'=>'canonical','type'=>null, 'title'=>'Anne-b Catégorie '.$category['Category']['name'],'inline'=>false)); ?>
<?php if( isset($description) and !empty($description) ): ?>

	<?php echo $this->Html->meta('description','Catégorie -'.$category['Category']['name'].'-'.htmlspecialchars(strip_tags($category['Category']['description'])),array('inline'=>false)); ?>

<?php endif; ?>

<?php if(isset($tags) and !empty($tags)): ?>

	<?php echo $this->Html->meta('keywords',strtolower($category['Category']['name']).','.$category['Category']['name'].','.strtolower($this->Text->toList($tags,',')),array('inline'=>false)); ?>

<?php endif; ?>
<?php echo $this->Html->script(array('front/jquery.mixitup.min','front/portfolio.js'),array('inline'=>false)); ?>
<?php echo $this->Html->css(array('front/portfolio.css'),array('inline'=>false)); ?>
