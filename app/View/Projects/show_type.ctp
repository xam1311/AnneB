<div class="pageContent">
<div class="row headerPage">
	<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
		<div class="title-page">
						<?php echo '<h1>'.$typeHumanize.'</h1>'; ?>
		</div><!-- .title-page -->
	</div>
	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			<div class="header-contact">
				<?php echo $this->Html->link('Contactez-moi',array('controller'=>'contact','action'=>'index'),array('class'=>'contactMe')); ?>
			</div>
	</div>
</div><!-- .headerPage -->
<?php echo $this->Html->meta('canonical',$this->Html->url($canonical,true),array('rel'=>'canonical','type'=>null, 'title'=>'Anne-b projet du Type'.$typeHumanize,'inline'=>false)); ?>
<?php echo $this->element('portfolio',array('tags'=>$tags,'projects'=>$projectsType,'private'=>$private,'description'=>'')); ?>
</div><!-- pageContent-->
<?php echo $this->Html->script(array('front/jquery.mixitup.min','front/portfolio.js'),array('inline'=>false)); ?>
<?php echo $this->Html->css(array('front/portfolio.css'),array('inline'=>false)); ?>
