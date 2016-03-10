<?php if(!empty($tags) and count($projects)>1 and count($tags)>1): ?>
<div class="row portfolioTags">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<ul id="tags" class="list-inline nav nav-pills hidden-xs">

							<li class="filter active all-categorie " data-filter="all"><span>Tout</span></li>

							<?php foreach($tags as $k => $v): ?>
							<li class='filter hidden-xs' data-filter='.<?php echo strtolower(Inflector::slug($v,'-')); ?>'><span><?php echo $v;?></span></li>
							<?php endforeach; ?>
								<?php if (AuthComponent::user('id') and $private==1):?>
							<li class="filter private" data-filter=".private">Privé</li>
								<?php endif; ?>
							<li class="changeLayout"><i class="icon-justify icon-2x"></i></li>



					</ul>
					<ul class="list-inline nav nav-pills nav-mobile hidden-lg hidden-md hidden-sm">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"> Tous les projets<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li class="filter active all-categorie" data-filter="all"><span>Tous les projets</span></li>
										<?php foreach($tags as $k => $v): ?>
											<li class='filter' data-filter='.<?php echo strtolower(Inflector::slug($v,'-')); ?>'><span><?php echo $v;?></span></li>
										<?php endforeach; ?>
										<?php if (AuthComponent::user('id') and $private==1):?>
											<li class="filter private" data-filter=".private">Privé</li>
										<?php endif; ?>
										<li class="divider"></li>
										 <li class="changeLayout">Affichage Liste</li>
							  </ul>
						</li>
					</ul>

		</div>
	<?php if(!empty($description) and isset($description)): ?>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left center-block portfolioContent-description">
			<?php echo $description; ?>
		</div>
	<?php endif; ?>
</div>
<?php endif; ?>
<div class="row portfolioWrapper">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div id="portfolio" class="row grid">
				<?php foreach($projects as $k => $d): ?>
						<?php if(!empty($d['Tags'])): ?>
							<?php $tag=''; ?>
						<?php foreach ($d['Tags']['tags'] as $v): ?>
						<?php $tag .= ' '.strtolower(Inflector::slug($v['name'],'-')); ?>
						<?php endforeach; ?>
						<?php endif; ?>
							<?php if(isset($d['Project']['hidden'])and $d['Project']['hidden']==1): ?>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mix<?php if(!empty($tag)): echo $tag; endif;?> private" data-name='<?php echo $d['Project']['name']; ?>' >
							<?php else: ?>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mix<?php if(!empty($tag)): echo $tag; endif;?>" data-name='<?php echo $d['Project']['name']; ?>' >
							<?php endif; ?>
							<?php if(isset($d['Project']['hidden'])and $d['Project']['hidden']==1): ?>
									<span class="privateProject"></span>
							 <?php endif; ?>
								 <figure class="effect-jazz">
										<?php if(isset($d['Thumbnail']['file']) and !empty($d['Thumbnail']['file'])): ?>
												<?php echo $this->Html->image($d['Thumbnail']['file'],array('title'=>$d['Project']['name'],'width'=>316,'height'=>249,'alt'=>'Anne-b -'.$d['Category']['name'].'-'.$d['Project']['name'],'class'=>'img-responsive'));?>
										<?php else: ?>
												<?php echo $this->Html->image($d['Thumb']['file'],array('title'=>$d['Project']['name'],'width'=>316,'height'=>249,'alt'=>'Anne-b - '.$d['Category']['name'].' - '.$d['Project']['name'],'class'=>'img-responsive')); ?>

										<?php endif;?>
											<figcaption>
												<?php if(isset($home) and $home==true): ?>
													<?php echo '<h2>'.$d['Category']['name'].'</h2><h3>'.$d['Project']['name'].'</h3>';?>
												<?php else: ?>
													<?php echo '<h2>'.$d['Project']['name'].'</h2>';?>
													<?php echo $d['Project']['short_description'] != '' ?'<p>'.$this->Text->truncate($d['Project']['short_description'],150,array('ellipsis'=>'...','exact'=>true)).'</p>':'' ;?>
												<?php endif; ?>
													<?php echo $this->Html->link('Voir plus',$d['Project']['link'],array('escape'=>false,'class'=>''));?>
											</figcaption>
								</figure>
						</div>
							<?php unset($tag); ?>
				<?php endforeach; ?>
		</div>
	</div>
</div>
