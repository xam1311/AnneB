<div class="text"><div class="faux_p " style="color: #000000 !important; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 13px; line-height: 17px; margin-bottom: 0; margin-left: 0; margin-right: 0; margin-top: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; padding-top: 0"><span class="faux_p_color">Bonjour <?php echo $username; ?> ,</span></div>
<div class="faux_p " style="color: #000000 !important; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 13px; line-height: 17px; margin-bottom: 0; margin-left: 0; margin-right: 0; margin-top: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; padding-top: 0"><span class="faux_p_color">Vous avez fait une demande de changement de mot de passe si c'est bien votre demande veuillez cliquez sur le lien ci-dessous:</span></div>
<div class="faux_p " style="color: #000000 !important; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 13px; line-height: 17px; margin-bottom: 0; margin-left: 0; margin-right: 0; margin-top: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; padding-top: 0"><span style="color:#27cece">&gt;&gt;</span> 
<?php echo $this->Html->link('Me donner un nouveau mot de passe',$link,array('full_base'=>true,'target'=>'_blank','style'=>'color: #000000!important; margin-bottom: 0; margin-left: 0; margin-right: 0; margin-top: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; padding-top: 0')); ?>
</span></div>
</div>

<?php $this->start('infos');?>

<?php $this->end(); ?>