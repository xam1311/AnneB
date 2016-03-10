<?php $footer = $this->requestAction(array('controller'=>'pages','action'=>'footerIndex')); ?>
<footer id="footermain" class="text-left">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			  <section>
			  		<h5>Webdesign</h5>
						<ul>
							<li>Webdesign institutionnel</li>
							<li>Webdesign e-commerce</li>
							<li>Webdesign éditorial/portail</li>
							<li>Site vitrine</li>
							<li>Site évènementiel</li>
							<li>Newsletter</li>
							<li>Jeux concours</li>
							<li>Habillage</li>
						</ul>
			  </section>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			  <section>
			  		<h5>Campagne &#38; Promotion</h5>
						<ul>
							<li>Habillage</li>
							<li>Site évènementiel</li>
							<li>Newsletter</li>
							<li>Jeux concours</li>
							<li>Carte de voeux</li>
							<li>Affiches</li>
						</ul>
			  </section>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<section>
					  	<h5>print</h5>
							<ul>
								<li>Identité visuelle (logo,charte graphique)</li>
								<li>Affiches</li>
								<li>Packaging</li>
							</ul>
						<h5>Illustration</h5>
							<ul>
									<li>Stickers</li>
									<li>Tableaux</li>
							</ul>
			  </section>

			</div>
		</div><!-- fin .row -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center footerSlogan">
				<?php if(!empty ($footer['footerSlogan']) and isset($footer['footerSlogan'])):?>

					<?php echo '<p>'.$footer['footerSlogan'].'</p>'; ?>

					<?php else: ?>
					<p>Conception, création graphique, direction artistique de projets web, identité visuelle, charte graphique.</p>

					<?php endif; ?>
					<p>&copy; <?php echo date('Y');?>
						<?php if(!empty($footer['footerCopyright'])and isset($footer['footerCopyright'])) : ?>
						<?php echo $footer['footerCopyright']; ?>
						<?php else : ?>
						 - <?php echo $this->Html->link('anne-b.fr','http://www.anne-b.fr'); ?>  -Anne Berland : Directrice artistique sénior</p>
						<?php endif; ?>
			</div>
		</div>
</footer>
