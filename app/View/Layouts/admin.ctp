<?php echo $this->Html->docType('html5'); ?>
<html lang="fr-fr">
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout; ?></title>
	<?php
		echo $this->Html->meta('favicon-96x96.png','img/icon/favicon-96x96.png',array('type'=>'icon'));
		echo $this->Html->meta('favicon-32x32.png','img/icon/favicon-32x32.png',array('type'=>'icon'));
		echo $this->Html->meta('favicon-16x16.png','img/icon/favicon-16x16.png',array('type'=>'icon'));
		echo $this->Html->meta('favicon-128.png','img/icon/favicon-128.png',array('type'=>'icon'));
		echo $this->fetch('meta');
		echo $this->Html->meta(array('name' => 'robots', 'content' => 'noindex, nofollow'));
		echo $this->Html->meta(array('name' => 'googlebot', 'content' => 'noindex, nofollow'));
		echo $this->fetch('css');
		echo $this->Html->css(array('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css','back/jquery-ui-1.10.3.custom.min','back/jquery.fancybox','back/main.css'));
		echo $this->Html->script(array('https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js','back/jquery-ui-1.10.3.custom.min','back/jquery.fancybox.pack'));?>

</head>
<body style="<?php echo $this->Html->style(array('padding-top' => '60px'),false); ?>">
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); ?>
	<?php echo $this->fetch('script'); ?>
</body>
</html>
