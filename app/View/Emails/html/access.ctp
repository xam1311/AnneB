<div class="text"><div class="faux_p " style="color: #000000 !important; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 13px; line-height: 17px; margin-bottom: 0; margin-left: 0; margin-right: 0; margin-top: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; padding-top: 0"><span class="faux_p_color">Bonjour ,</span></div>
<div class="faux_p " style="color: #000000 !important; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 13px; line-height: 17px; margin-bottom: 0; margin-left: 0; margin-right: 0; margin-top: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; padding-top: 0"><span class="faux_p_color">Une demande d'accès a été formulée par <?php echo $username; ?> veuillez cliquer sur le lien ci-dessous si vous souhaitez lui donner l'accès:</span></div>
<div class="faux_p " style="color: #000000 !important; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 13px; line-height: 17px; margin-bottom: 0; margin-left: 0; margin-right: 0; margin-top: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; padding-top: 0"><span class="faux_p_color"><span style="color:#F18F48">&gt;&gt;</span> 
<?php echo $this->Html->link('Activer ',$link,array('full_base'=>true,'target'=>'_blank','style'=>'color: #000000!important; margin-bottom: 0; margin-left: 0; margin-right: 0; margin-top: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; padding-top: 0')); ?></div>
<?php if(isset($message)&&!empty($message)): ?>
<div class="faux_p " style="color: #000000 !important; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 13px; line-height: 17px; margin-bottom: 0; margin-left: 0; margin-right: 0; margin-top: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; padding-top: 0"><span class="faux_p_color">Message :</span></div>
<div class="faux_p " style="color: #000000 !important; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 13px; line-height: 17px; margin-bottom: 0; margin-left: 0; margin-right: 0; margin-top: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; padding-top: 0"><span class="faux_p_color"><?php echo h($message); ?></span></div>
<?php endif; ?>
</div>
</div>


<?php $this->start('infos');?>
<tr align="left" style="border-bottom-width: 0; border-collapse: collapse; border-left-width: 0; border-right-width: 0; border-spacing: 0; border-top-width: 0">
<td width="700">
			<table width="700" cellspacing="0" cellpadding="0" border="0" style="border-bottom-width: 0; border-collapse: collapse; border-left-width: 0; border-right-width: 0; border-spacing: 0; border-top-width: 0; margin-top: 0px !important; padding-top: 0px !important"><tbody><tr style="border-bottom-width: 0; border-collapse: collapse; border-left-width: 0; border-right-width: 0; border-spacing: 0; border-top-width: 0">
<td width="225" align="left" valign="top" height="58">
		<?php echo $this->Html->image('mail/images/clear.gif',array('fullBase'=>true,'height'=>58,'width'=>1,'style'=>'border-bottom-width: 0; border-left-width: 0; border-right-width: 0; border-top-width: 0; display: block; margin-bottom: 0; margin-left: 0; margin-right: 0; margin-top: 0; opacity: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; padding-top: 0'));?>

</td>

<td width="475" align="left" valign="top" style="padding-left: 10px; padding-top: 5px" height="58">
	<div class="text">
	<?php if($society): ?>
	<div class="faux_p " style="color: #000000 !important; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 13px; line-height: 17px; margin-bottom: 0; margin-left: 0; margin-right: 0; margin-top: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; padding-top: 0">
	<span class="faux_p_color" style="text-decoration:none"><b>Société :</b> <?php echo $society; ?></span></div>
	<?php endif; ?>
	<?php if($phone): ?>
	<div class="faux_p " style="color: #FFFFFF !important; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 13px; line-height: 17px; margin-bottom: 0; margin-left: 0; margin-right: 0; margin-top: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; padding-top: 0"><span class="faux_p_color"><b>Téléphone :</b> <?php echo $phone; ?></span>
	</div>
	<?php endif; ?>
</div>
</td>
</tr></tbody></table>
</td>
  </tr>
<?php $this->end(); ?>