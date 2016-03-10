<?php $this->set('title_for_layout','Page introuvable - Anne-b'); ?>
<div class="row headerPage">
	<div class="title-page text-left">
			<div class="col-lg-12 col-md-12 col-xs-12">
				 <?php echo '<h1>La page '.$url.' est '.$message.' </h1>';?>
			</div>
		</div><!-- .title-page -->
</div><!-- .headerPage -->

<?php
if (Configure::read('debug') > 0):
	echo $this->element('exception_stack_trace');
endif;
?>
