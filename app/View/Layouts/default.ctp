<?php echo $this->Html->docType(); ?>
<html lang="fr-fr" prefix="og: http://ogp.me/ns#">
<head>
	<?php echo $this->Html->charset(); ?>

	<title><?php echo $title_for_layout; ?></title>
	<?php echo $this->fetch('og'); ?>
	<?php echo $this->fetch('twittercard'); ?>
	<?php
		echo $this->Html->meta(array('rel'=>'apple-touch-icon-precomposed','sizes'=>'57x57','link'=>'img/icon/apple-touch-icon-57x57.png'));
		echo $this->Html->meta(array('rel'=>'apple-touch-icon-precomposed','sizes'=>'114x114','link'=>'img/icon/apple-touch-icon-114x114.png'));
		echo $this->Html->meta(array('rel'=>'apple-touch-icon-precomposed','sizes'=>'72x72','link'=>'img/icon/apple-touch-icon-72x72.png'));
		echo $this->Html->meta(array('rel'=>'apple-touch-icon-precomposed','sizes'=>'144x144','link'=>'img/icon/apple-touch-icon-144x144.png'));
		echo $this->Html->meta(array('rel'=>'apple-touch-icon-precomposed','sizes'=>'60x60','link'=>'img/icon/apple-touch-icon-60x60.png'));
		echo $this->Html->meta(array('rel'=>'apple-touch-icon-precomposed','sizes'=>'120x120','link'=>'img/icon/apple-touch-icon-120x120.png'));
		echo $this->Html->meta(array('rel'=>'apple-touch-icon-precomposed','sizes'=>'76x76','link'=>'img/icon/apple-touch-icon-76x76.png'));
		echo $this->Html->meta(array('rel'=>'apple-touch-icon-precomposed','sizes'=>'152x152','link'=>'img/icon/apple-touch-icon-152x152.png'));
		echo $this->Html->meta('favicon-196x196.png','img/icon/favicon-196x196.png',array('type'=>'icon'));
		echo $this->Html->meta('favicon-96x96.png','img/icon/favicon-96x96.png',array('type'=>'icon'));
		echo $this->Html->meta('favicon-32x32.png','img/icon/favicon-32x32.png',array('type'=>'icon'));
		echo $this->Html->meta('favicon-16x16.png','img/icon/favicon-16x16.png',array('type'=>'icon'));
		echo $this->Html->meta('favicon-128.png','img/icon/favicon-128.png',array('type'=>'icon'));
		echo $this->Html->meta('sitemap',$this->Html->url('/sitemap.xml',true),array('rel'=>'sitemap','type'=>null,'title'=>'Sitemap'));
		echo $this->fetch('meta');
		echo $this->Html->meta(array('name' => 'google', 'content' => 'notranslate'));
		?>

		<meta name="viewport" content="width=device-width, initial-scale=1">
	 <?php
	  echo $this->Html->css(array('https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,300,200|Montserrat:400,700'));
		echo $this->Html->css(array('front/bootstrap.min.css','front/main.css','front/responsive.css','front/icomoon.css','front/sprite.css'));
		echo $this->fetch('css');
		echo $this->Html->script(array('https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js','front/bootstrap.min.js','front/velocity.js','front/velocityui.js','front/main.js'),array('inline'=>false,'block'=>'bHeadscript'));?>
<?php if(Configure::read('debug') == 0 ):?>
		<!-- Google Analytics -->
		<?php  echo $this->Html->script(array('https://ssl.google-analytics.com/analytics.js','front/analytics.js'),array('inline'=>false,'block'=>'bHeadscript'));?>

<!-- End Google Analytics -->
<?php endif;?>
<?php if(Configure::read('debug') > 0 ):?>

<style media="screen">
	.cake-debug-output{
		color:#ffffff;
		background-color: #303030;
		padding: 10px;
	}
	.cake-debug{
		font-size: 1.1em;
		margin-top:15px;
	}
</style>
<?php endif;?>

</head>
<body>
<div class="row">
<!--nocache-->
<?php echo $this->Session->flash(); ?>
<!--/nocache-->
<?php echo $this->element('navbar');?>
    <div class="container-fluid">
        <div class="side-body">
				<?php echo $this->fetch('content'); ?>
				<?php echo $this->element('footer');?>
			</div><!-- fin de #<?php $this->params->action; ?>Page -->
	  </div>
</div><!-- fin row -->
<?php echo $this->fetch('bHeadscript'); ?>
<?php echo $this->fetch('script'); ?>
</body>
</html>
