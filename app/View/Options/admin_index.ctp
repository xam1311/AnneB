<?php $this->extend('/Common/adminnav');?>
<?php $this->assign('title','Options du site'); ?>
<div class="col-lg-12 col-md-12 col-xs-12 optionsPage">
      <h3 class="well well-sm"><?php echo $this->fetch('title'); ?></h3>
        <div class="row">
          <div role="tabpanel">
              <div class="col-lg-3 col-md-3 col-xs-12">
                   <!-- Nav tabs -->
                  <ul class="nav nav-pills nav-stacked" role="tablist" id="tabSite">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Page d'accueil</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Paramètres site</a></li>
                    <li role="presentation"><a href="#activity" aria-controls="activity" role="tab" data-toggle="tab">Log système</a></li>
                    <li role="presentation"><a href="#cache" aria-controls="cache" role="tab" data-toggle="tab">Cache système</a></li>
                  </ul>
              </div>
              <div class="col-lg-9 col-md-9 col-xs-12">
                    <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="home">

                  <h4 class="well well-sm">Image d'appel de la page d'accueil</h4>
                     <div class="row">
                          <div class="col-lg-4">
                            <h5 class="well well-sm">Wallpaper Sélectionné</h4>
                          </div>
                            <div class="col-lg-4 col-lg-offset-1">
                              <?php  echo $this->Html->image('wallpaper/wallpaperHome.jpg', array('alt' => 'Image de l\'accueil','class'=>'img-responsive img-thumbnail')); ?>
                            </div>
                     </div><!-- Fin de .row-->

                    <?php echo $this->Form->create(null, array('class'=>'dropzone','type' => 'file','url' => array('controller' => 'pages', 'action' => 'upload'))); ?>

                    <?php echo $this->Form->hidden('arbo',array('value'=>'img'.DS.'wallpaper')); ?>
                    <?php echo $this->Form->hidden('nameFile',array('value'=>'wallpaperHome')); ?>

                    <?php echo $this->Form->end(); ?>
                    <?php if(isset($slideProject) and !empty($slideProject)): ?>
                    <h4 class="well well-sm">Projets accueil sélectionnés</h4>
                      <div class="table-responsive">
                        <?php echo $this->Html->link('<span class="glyphicon glyphicon-remove-sign"></span> Retirer tous les projets',array('controller'=>'options','action'=>'deleteSlides','admin'=>true),array('escape'=>false,'title'=>'Retirer tous les projets','class'=>'btnClass')); ?>
                            <table class="table table-hover table-striped">
                              <thead>
                                 <tr>
                                  <th>Action</th>
                                   <th>Projet</th>
                                   <th>Thumbnail</th>
                                 </tr>
                              </thead>
                            <tbody>
                        <?php foreach ($slideProject as $k =>$d): ?>
                              <tr>
                               <td><?php echo $this->Html->link('<span class="glyphicon glyphicon-remove-sign"></span>',array('controller'=>'options','action'=>'deleteSlide','admin'=>true,$d['Project']['id']),array('escape'=>false,'title'=>'Supprimer '.$d['Project']['name'].' du slider','class'=>'btnClass'),__("Voulez vous vraiment retirer le projet %s de l'accueil?",$d['Project']['name'])); ?>
                                   </td>
                                 <td><?php echo $d['Project']['name']; ?></td>
                                 <td>
                                    <?php echo $this->Html->link($this->Html->image($d['Thumbnail']['file'],array('width'=>40,'height'=>40 ,'class'=>'img-thumbnail')),$d['Thumbnail']['file'],array('escape'=>false,'class'=>'lightbox','title'=>'Projet '.$d['Project']['name'])); ?>
                                  </td>
                              </tr>
                        <?php endforeach; ?>
                              </tbody>
                              </table>
                      </div><!-- Table responsive -->
                  <?php endif; ?>
                  <?php echo $this->Form->create('Option'); ?>
                  <div class="row">
                      <div class="col-lg-4 col-md-6 col-xs-6">
                          <?php echo $this->Form->create('Option',array('class'=>'form')); ?>
                                <div class="input-group">
                                  <?php echo $this->Form->input('Option.search',array('class'=>'form-control','placeholder'=>'Rechercher...','aria-label'=>'Text input with segmented button dropdown','label'=>false,'div'=>false,'name'=>'ProjectSearch')); ?>
                                    <div class="input-group-btn">

                                    <?php echo $this->Form->button('Un projet',array('class'=>'btn btn-default','type'=>'submit','label'=>false,'div'=>false)); ?>
                                    </div>

                                </div>
                      </div><!-- lg-4 -->
                      <div class="col-lg-8 col-md-6 col-xs-6">
                            <?php echo $this->Form->input('Option.nbrSlide', array('options' => array('3'=>'3 projets',6=>'6 projets',9=>'9 projets'), 'default' => '3 projets','label'=>false,'selected'=>$nbrSlide,'class' =>'form-control','div' => 'input-group','aria-describedby'=>'nbrslide-sizing','before'=>'<span class="input-group-addon" id="nbrslide-sizing">Nombre de projets </span>')); ?>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-12 text-left">
                        <?php echo $this->Form->button('<span class="glyphicon glyphicon-save"></span> Sauvegarder',array('class'=>'btn btn-medium btn-primary','type'=>'submit'),array('escape'=>false)); ?>
                      </div>
                  </div>
                      <?php if( !empty($projects) ): ?>
                              <div class="table-responsive">
                                  <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th>Action</th>
                                        <th>Projet</th>
                                        <th>Thumbnail</th>
                                      </tr>
                                    </thead>
                                  <tbody id="tbodyProjects">
                                      <?php foreach ($projects as $k =>$d): ?>
                                        <tr id="<?php echo $d['Project']['id'];?>">
                                          <td><?php echo $this->Form->checkbox('Option.'.$k.'.id', array('hiddenField' => false,'value'=>$d['Project']['id'],'title'=>'Choisir ce projet pour la homepage')); ?></td>

                                           <td><?php echo $this->Html->link($d['Project']['name'],array('controller'=>'projects','action'=>'edit',$d['Project']['id'])); ?></td>

                                          <td><?php echo $this->Html->link(isset($d['Thumbnail']['file'])? $this->Html->image($d['Thumbnail']['file'],array('width'=>45,'height'=>84 ,'class'=>'img-thumbnail')):$this->Html->image('http://i.giphy.com/PW24kUmUv3vlm.gif',array('width'=>45,'height'=>84 ,'class'=>'img-thumbnail')),
                                          $d['Thumbnail']['file'],array('escape'=>false,'class'=>'lightbox','title'=>'Projet '.$d['Project']['name'])); ?></td>

                                      </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                  </table>
                                </div><!-- Table responsive -->
                          <?php else: ?>
                              <h4 class="well well-sm">Pas de résultats</h4>
                          <?php endif; ?>

                          <?php echo $this->Form->hidden('name',array('value'=>'selectProject')); ?>
                          <?php echo $this->Form->end(); ?>
                  </div><!-- .tabpanel Home -->
                  <div role="tabpanel" class="tab-pane" id="settings">
                     <h4 class="well well-sm">Fichier CV</h4>
                        <?php echo $this->Form->create(null, array('class'=>'dropzone','type' => 'file','url' => array('controller' => 'pages', 'action' => 'upload'))); ?>
                        <?php echo $this->Form->hidden('arbo',array('value'=>'files'.DS.'cv')); ?>
                        <?php echo $this->Form->hidden('nameFile',array('value'=>'cv')); ?>
                        <?php echo $this->Form->end(); ?>

                    <?php echo $this->Form->create('Option',array('class'=>'form')); ?>

                     <h4 class="well well-sm">Titre et slogan site</h4>

                      <?php echo $this->Form->input('titreSite',array('label'=>'Titre','value'=>isset( $titreSite ) ? $titreSite : '','class' =>'form-control','div' => array(
                              'class' => 'form-group')));?>

                      <?php echo $this->Form->input('sloganSite',array('label'=>'Slogan','value'=>isset( $sloganSite) ? $sloganSite : '','class' =>'form-control','div' => array(
                              'class' => 'form-group')));?>

                      <h4 class="well well-sm">Pied de Page - Footer </h4>

                      <?php echo $this->Form->input('footerSlogan',array('label'=>'Slogan Footer','value'=>isset( $footerSlogan ) ? $footerSlogan : null,'class' =>'form-control','placeholder'=>'Mettre le slogan Footer','div' => array('class' => 'form-group')));?>

                      <?php echo $this->Form->input('footerCopyright',array('label'=>'Copyright Footer','value'=>isset( $footerCopyright ) ? $footerCopyright : null,'class' =>'form-control','placeholder'=>'Mettre le copyright','div' => array(
                                  'class' => 'form-group')));?>

                      <?php echo $this->Form->hidden('name',array('value'=>'ParamsTitle')); ?>

                      <div class="form-group">

                        <div class="text-center">

                          <?php echo $this->Form->button('<span class="glyphicon glyphicon-save"></span> Sauvegarder',array('class'=>'btn btn-medium btn-primary','type'=>'submit'),array('escape'=>false)); ?>

                           <?php echo $this->Form->end(); ?>

                        </div>

                      </div>
                  </div><!-- .tabpanel settings-->
                  <div role="tabpanel" class="tab-pane" id="activity">
                     <h4 class="well well-sm">Log des activités</h4>
                     <div class="row">
                       <div class="col-lg-12 col-md-12 col-sm-12">

                         <div class="panel panel-default">
                          <div class="panel-body" style="max-height:400px; overflow-y:scroll;">
                            <?php if(isset($activityLog)): ?>
                                <?php echo nl2br($activityLog,true); ?>
                            <?php endif; ?>
                          </div>
                        </div>

                       </div>

                     </div>
                  </div><!-- Fin du tab #activity-->
                  <div role="tabpanel" class="tab-pane" id="cache">
                     <h4 class="well well-sm">Rafraîchir le cache du site</h4>
                     <div class="row">
                       <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="panel panel-default">
                          <div class="panel-body">
                            <?php echo $this->Form->postButton('Effacer le cache',array('controller'=>'options','action'=>'deleteCache'),array('class'=>'btn btn-primary','confirm'=>'êtes vous sûr?')); ?>
                          </div>
                        </div>
                       </div>
                     </div>
                  </div><!-- Fin du tab #activity-->
                </div><!-- .tab-content -->
              </div>
          </div>
        </div><!-- .row -->

</div><!-- fin .container-fluid -->
<?php echo $this->Html->scriptStart(array('inline' => false));?>
Dropzone.options.OptionAdminIndexForm = {
  paramName: "file", // The name that will be used to transfer the file
  uploadMultiple:false,
  acceptedFiles:'application/pdf,application/octetstream,.pdf,image/*',
  maxFilesize: 7 , //MB
  forceFallback:false,
  dictCancelUpload:'Annuler le transfert',
  dictCancelUploadConfirmation:'Transfert annulé',
  dictRemoveFile:'Annuler le transfert',
  dictDefaultMessage:'Mettre le fichier ici',
  dictMaxFilesExceeded:'Le fichier doit être inférieur à 3MB',
  sending: function(file, xhr, formData) {
  },
  init: function() {
    this.on("complete", function() {
      if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
        // File finished uploading, and there aren't any left in the queue.
        alert('Fichier remplacé');
      }
    });
  }
  };
$(document).ready(function(){
$('.lightbox').fancybox({
  aspectRatio:true,
  fitToView:true,
  type:'image'
}).tooltip({
  placement:"auto left"
});
$('.collapse').collapse({});
$('.btnClass, .checkClass').tooltip({
  placement:"auto left"
});
/*$('#tabSite a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
});
$('#tabSite a').eq(<?php echo $tab;?>).tab('show');*/
});
<?php $this->Html->scriptEnd();?>
<?php echo $this->Html->css(array('back/basic','back/dropzone'),array('inline'=>false)); ?>
<?php echo $this->Html->script(array('back/dropzone.min'),array('inline'=>true)); ?>
