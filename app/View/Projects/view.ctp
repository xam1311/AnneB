
<div>
<div class="row headerPage pageContent">
	<div class="title-page">
			<div class="col-lg-12 col-md-12 col-xs-12">
				<?php echo '<h1>'.$project['Project']['name'].'</h1>'; ?>
			</div>

			<?php if(isset($project['Project']['short_description'])and !empty($project['Project']['short_description'])): ?>
			<div class="col-lg-9 col-md-9 col-xs-12">

									 <?php echo '<h2>'.$project['Project']['short_description'].'</h2>'; ?>
			</div>

			<?php endif; ?>

			<?php if($project['Project']['hidden'] == 0): ?>
				<div class="col-lg-3 col-md-3 col-xs-12 pageprojet-social">
					<?php	$linkTwitter = 'https://twitter.com/intent/tweet?url='.rawurlencode($this->Html->url($project['Project']['link'],true)).'&text='.rawurlencode('@CreaAnneb - Projet '.$project['Project']['name']);

							if(!empty($project['Project']['hashTags']) and isset($project['Project']['hashTags'])):

								$linkTwitter .= $project['Project']['hashTags'];

							endif;

							$linkPinterest = 'http://www.pinterest.com/pin/create/button/?url='.rawurlencode($this->Html->url($project['Project']['link'],true)).'&media='.rawurlencode($this->Html->url($project['Thumbnail']['file'],true)).'&description='.rawurlencode('Anne-b.fr '.$project['Project']['name']);  ?>

						<?php echo  $this->Html->link('<i class="icon-twitter icon-2xl"></i>',$linkTwitter,array('escape'=>false,'class'=>'social-button','data-pin'=>'buttonPin','target'=>'_blank','data-pin-config'=>'above','title'=>'Twitter ce beau projet !'));?>

						<?php echo  $this->Html->link('<i class="icon-pinterest icon-2xl"></i>',$linkPinterest,array('escape'=>false,'class'=>'social-button','target'=>'_blank','title'=>'Mettre un pin sur ce beau projet !'));?>



				</div>
			<?php endif; ?>
		</div><!-- .title-page -->
</div><!-- .headerPage -->
<div class="row pageprojet-infos bg-black">

						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

								<?php if(!empty($project['Tags'])): ?>

								<ul class="tagsProject">

									<?php foreach ($project['Tags']['tags'] as $v): ?>
										<li><?php echo $this->Html->link($v['name'],array('controller'=>'projects','action'=>'showTag','id'=>$v['id'],'name'=>strtolower(Inflector::slug($v['name'])))); ?></li>
									<?php endforeach; ?>

								</ul>
								<?php endif; ?>

								<?php if(isset($project['Params']['terms']) and !empty($project['Params']['terms'])): ?>
									<ul class="paramsProject">

										<?php foreach ($project['Params']['terms'] as $v): ?>
											<?php $name = strtolower(Inflector::slug($v['name'])); ?>
										    <?php if(strpos($v['name'],' ') != false):?>
										    <?php $nameHtml = str_replace(' ','<br/>',$v['name']); ?>
										    <?php $nameHtml = $v['name']; ?>
											<?php endif; ?>
											<li class="<?php echo 'project_'.$v['slug']; ?>">

											<?php echo $this->Html->link(isset($nameHtml)?'<i class="icon-'.$name.' icon-2xl"></i><span class="hidden-xs">'.$nameHtml.'</span>':'<i class="icon-2xl icon-'.$name.'"></i><span class="hidden-xs">'.$v['name'].'</span>',$v['link'],array('escape'=>false,'title'=>'Voir tous les projets '.$v['name']));?></li>
											<?php unset($nameHtml); ?>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>



						</div>
						<?php if(!empty($project['Project']['website'])): ?>

						<div class="col-lg-3 col-md-3 col-xs-12">

								<?php echo $this->Html->link('Voir le site',$project['Project']['website'],array('class'=>'linkProject','escape'=>false,'target'=>'_blank','rel'=>'nofollow')); ?>
						</div>
						<?php endif; ?>
</div><!-- fin .row -->

<div class="row pageContent">
		<section class="pageprojet-content text-left">
				<article>
				<?php if(isset($project['Params']['type'])and !empty($project['Params']['type'])): ?>
				<div class="col-lg-12 col-md-12 col-xs-12">
				<header>
							<?php echo '<p>'.$project['Params']['type'].'</p>'; ?>
				</header>
				</div>
				<?php endif; ?>
				<?php if(!empty($project['Project']['description'])): ?>

				<div class="col-lg-12 col-md-12 col-xs-12 pageprojet-content-description">

					<?php echo $project['Project']['description']; ?>
				</div>
				<?php endif; ?>
			</article>
		</section>
</div>

<?php if( isset($project['Media']) and !empty($project['Media'])): ?>


		<div class="row pageprojet-contentslider pageContent">
			 <div class="col-lg-12 col-md-12 col-xs-12">


			<?php if(count($project['Media']) > 1 ) : ?>
				<div id="carousel-project" class="carousel slide" data-ride="carousel">
								  <ol class="carousel-indicators">
								    <?php for( $i = 1; $i<= count($project['Media']); $i++): ?>
									<li data-target="#carousel-project" data-slide-to="<?php echo $i; ?>" class="active"></li>
								    <?php endfor; ?>
								  </ol>
								  <div class="carousel-inner" role="listbox">

								    <?php foreach ($project['Media'] as $k =>$v): ?>

												<div class="item <?php echo ($k==0) ?'active' : '';?>">

												<?php echo $this->Html->image($v['file'],array('width'=>1200,'height'=>645,'class'=>'','fullBase'=>true,'style'=>'margin: 0 auto;')); ?>
														<div class="carousel-caption">

														</div>
												</div>

									  <?php endforeach; ?>

								  </div>
								  <!-- Controls -->
								  <a class="left carousel-control" href="#carousel-project" role="button" data-slide="prev">
								    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								    <span class="sr-only">Previous</span>
								  </a>
								  <a class="right carousel-control" href="#carousel-project" role="button" data-slide="next">
								    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								    <span class="sr-only">Next</span>
								  </a>
				 </div>
				<?php else: ?>
							<?php echo $this->Html->image($project['Media'][0]['file'],array('width'=>1200,'height'=>645,'class'=>'','fullBase'=>true,'style'=>'display:block;max-width:100%; height:auto; margin:0 auto;','alt'=>'Image projet '.$project['Project']['name'],'title'=>'Anne-b projet: '.$project['Project']['name'])); ?>
				<?php endif; ?>
			 </div>


		</div><!-- fin .pageprojet-contentslider -->

<?php endif; ?>
</div>

<?php $this->start('twittercard'); ?>

<?php echo $this->Html->meta(array('property'=>'twitter:card'
,'block'=>'twittercard'
,'type'=>'meta'
,'rel'=>null
,'content'=>'summary_large_image'
,'inline'=>false)); ?>
<?php echo $this->Html->meta(array('property'=>'twitter:site'
,'block'=>'twittercard'
,'type'=>'meta'
,'rel'=>null
,'content'=>'@CreaAnneB'
,'inline'=>false)); ?>

<?php ?php echo $this->Html->meta(array('property'=>'twitter:author'
,'block'=>'twittercard'
,'type'=>'meta'
,'rel'=>null
,'content'=>'@CreaAnneB'
,'inline'=>false)); ?> ?>

<?php echo $this->Html->meta(array('property'=>'twitter:title'
,'block'=>'twittercard'
,'type'=>'meta'
,'rel'=>null
,'content'=>$project['Project']['name']
,'inline'=>false)); ?>

<?php echo $this->Html->meta(array('property'=>'twitter:description'
,'block'=>'twittercard'
,'type'=>'meta'
,'rel'=>null
,'content'=>$project['Project']['meta_description']
,'inline'=>false)); ?>

<?php echo $this->Html->meta(array('property'=>'twitter:image'
,'block'=>'twittercard'
,'type'=>'meta'
,'rel'=>null
,'content'=>$this->Html->url($project['Thumbnail']['file'],true)
,'inline'=>false)); ?>

<?php $this->end(); ?>

<?php $this->start('og'); ?>


<?php echo $this->Html->meta('canonical',$this->Html->url($project['Project']['link'],true),array('rel'=>'canonical','type'=>null, 'title'=>'Anne-b - '.$project['Project']['name'],'inline'=>false)); ?>

<?php echo $this->Html->meta(array('property'=>'og:title'
,'block'=>'og'
,'type'=>'meta'
,'rel'=>null
,'content'=>$project['Project']['name']
,'inline'=>false)); ?>

<?php echo $this->Html->meta(array('property'=>'og:type'
,'block'=>'og'
,'type'=>'meta'
,'rel'=>null
,'content'=>'article'
,'inline'=>false)); ?>
<?php echo $this->Html->meta(array('property'=>'og:url'
,'block'=>'og'
,'type'=>'meta'
,'rel'=>null
,'content'=>$this->Html->url($project['Project']['link'],true)
,'inline'=>false)); ?>

<?php echo $this->Html->meta(array('property'=>'og:locale'
,'block'=>'og'
,'type'=>'meta'
,'rel'=>null
,'content'=>'fr_FR'
,'inline'=>false)); ?>

<?php echo $this->Html->meta(array('property'=>'og:image'
,'block'=>'og'
,'type'=>'meta'
,'rel'=>null
,'content'=>$this->Html->url($project['Thumbnail']['file'],true)
,'inline'=>false)); ?>

<?php
if(isset($keywords)and !empty($keywords)):

		echo $this->Html->meta('keywords',strtolower($this->Text->toList($keywords,',')),array('inline'=>false));

endif; ?>

<?php if(isset($project['Project']['meta_description']) and !empty($project['Project']['meta_description'])): ?>

<?php echo $this->Html->meta('description',$project['Project']['meta_description'],array('inline'=>false));?>

<?php echo $this->Html->meta(array('property'=>'og:description'
,'block'=>'og'
,'type'=>'meta'
,'rel'=>null
,'content'=>$project['Project']['meta_description']
,'inline'=>false)); ?>

<?php endif;?>




<?php $this->end(); ?> <!-- Fin de la balise og-->

<?php if($project['Project']['hidden'] == 1):

	echo $this->Html->meta(array('name' => 'robots', 'content' => 'noindex,nofollow'),null,array('inline'=>false));

	else:

	echo $this->Html->meta(array('name' => 'robots', 'content' => 'index,follow'),null,array('inline'=>false));

endif; ?>

<?php if(count($project['Media']) > 1): ?>

<?php endif; ?>
<?php echo $this->Html->css(array('front/project/animate.css'),array('inline'=>false)); ?>
<?php echo $this->Html->script(array('front/jquery.touchSwipe.min.js'),array('inline'=>false)); ?>
<?php echo $this->Html->scriptStart(array('inline'=>false));?>
jQuery(function($){
	jQuery('.carousel').carousel({
	  pause: true,
	  interval:6000
	});

	jQuery(".carousel-inner").swipe( {
						//Generic swipe handler for all directions
						swipeLeft:function(event, direction, distance, duration, fingerCount) {
							$(this).parent().carousel('next');
						},
						swipeRight: function() {
							$(this).parent().carousel('prev');
						},
						//Default is 75px, set to 0 for demo so any distance triggers swipe
						threshold:0
					});
});
<?php echo $this->Html->scriptEnd(); ?>
