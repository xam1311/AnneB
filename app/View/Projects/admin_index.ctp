<?php $this->extend('/Common/adminnav');?>

<?php $this->assign('title','Projets'); ?>

<?php echo $this->Session->read('Config.language'); ?>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
      <h3 class="well well-sm"><?php echo $this->fetch('title'); ?></h3>
        <div class="row">

          <div class="col-lg-4 col-md-6 col-xs-6">
                 <?php echo $this->Form->create(null, array( 'url' => array('controller' => 'projects', 'action' => 'index'),'class'=>'form')); ?>
                    <div class="input-group">

                    <?php echo $this->Form->input('search',array('label'=>'Recherche','class'=>'form-control','placeholder'=>'Rechercher...','aria-label'=>'Text input with segmented button dropdown','label'=>false,'div'=>false)); ?>
                      <div class="input-group-btn">

                          <?php echo $this->Form->button('Rechercher',array('class'=>'btn btn-default','type'=>'submit','label'=>false,'div'=>false)); ?>
                      </div>

                  </div>
                  <?php echo $this->Form->end(); ?>
          </div><!-- lg-4 -->
          <div class="col-lg-8 col-md-6 col-xs-6">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                     <?php if(isset($this->params['pass']) and !empty($this->params['pass'])):?>
                    <?php echo 'Catégorie '.$this->params['pass'][0] ; ?>
                     <?php else: ?>
                     Toutes les catégories
                    <?php endif; ?>
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><?php echo $this->Html->link('Toutes les catégories',array('action'=>'index'),array()); ?></li>
                      <?php foreach ($category as $v): ?>
                        <li><?php echo $this->Html->link($v['Category']['name'],array('action'=>'index',$v['Category']['name']),array()); ?></li>
                      <?php endforeach ?>
                    </ul>
                  <div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <?php echo 'Classement '; ?><span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><?php echo $this->Paginator->sort('Project.order', 'Par ordre'); ?></li>
                            <li><?php echo $this->Paginator->sort('Project.created','Par date de création'); ?></li>
                            <li><?php echo $this->Paginator->sort('Project.name','Par nom de projet'); ?></li>
                          </ul>
                  </div><!-- .btn-group -->
                   <div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                           <?php $pag= Set::classicExtract($this->Paginator->params(),'limit'); ?>
                            <?php echo $pag.' résultats par page '; ?><span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><?php echo $this->Paginator->link('5 résultats par page',array('limit'=>5,'page'=>1)); ?></li>
                            <li><?php echo $this->Paginator->link('10 résultats par page',array('limit'=>10,'page'=>1)); ?></li>
                            <li><?php echo $this->Paginator->link('15 résultats par page',array('limit'=>15,'page'=>1)); ?></li>
                            <li><?php echo $this->Paginator->link('20 résultats par page',array('limit'=>20,'page'=>1)); ?></li>
                            <li><?php echo $this->Paginator->link('30 résultats par page',array('limit'=>30,'page'=>1)); ?></li>
                          </ul>
                  </div><!-- .btn-group -->
          </div>
        </div><!-- Fin .row -->
  <?php if(isset($projects) and !empty($projects)): ?>
      <?php echo $this->Form->create('Project',array('url'=>array('controller'=>'projects','action'=>'update'))); ?>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-xs-12">
          <div class="btn-group">
              <button type="button" class="btn btn-primary">Actions</button>
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-pencil"></span> Nouveau Projet',array('controller'=>'projects','action'=>'edit'),array('escape'=>false)) ; ?></li>
                <li><?php echo $this->Form->button('<span class="glyphicon glyphicon-ok"></span> Publier projets',array('name'=>'buttonSubmit','value'=>'publishSelected','escape'=>false)); ?></li>
                <li><?php echo $this->Form->button('<span class="glyphicon glyphicon-remove"></span> Dépublier projets',array('name'=>'buttonSubmit','value'=>'unpublishSelected','escape'=>false,'type'=>'submit'));?></li>
                <li class="divider"></li>
                <li><?php echo $this->Form->button('<span class="glyphicon glyphicon-trash"></span> Supprimer projets',array('name'=>'buttonSubmit','value'=>'deleteSelected','escape'=>false,'type'=>'submit'));?></li>
              </ul>
            </div>


          </div>
        </div>
        <div class="row">
        <?php // debug(Configure::read('Config.language')); ?>
           <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="table-responsive">
                         <table class="table table-hover table-striped">
                          <thead>
                            <tr>
                              <th><input type="checkbox" id="allcheckbox"></th>
                              <th><?php echo $this->Paginator->sort('Project.name','Nom projet'); ?></th>
                              <th><?php echo $this->Paginator->sort('Thumb.file','Image Appel'); ?></th>
                              <th><?php echo $this->Paginator->sort('Project.hidden','Accès'); ?></th>
                              <th><?php echo $this->Paginator->sort('Project.published','En ligne'); ?></th>
                              <th><?php echo $this->Paginator->sort('Category.name','Catégorie'); ?></th>
                              <th><?php echo $this->Paginator->sort('Project.created','Date création'); ?></th>
                              <th><?php echo $this->Paginator->sort('Project.order','Ordre'); ?></th>
                              <th><?php echo $this->Paginator->sort('Project.modified','Modifié'); ?></th>
                              <th>Actions</th>
                              <th><?php echo $this->Paginator->sort('Project.id','Id'); ?></th>
                            </tr>
                          </thead>
                          <tbody id="tbodyProjects">
                                <?php foreach ($projects as $k =>$d): ?>
                                <tr>
                                  <?php echo $this->Form->hidden($d['Project']['id'],array('value'=>$d['Project']['order'],'name'=>'order['.$d['Project']['id'].']')); ?>
                                  <td><?php echo $this->Form->checkbox('id.'.$d['Project']['id'],array('value'=>$d['Project']['id'],'hiddenField'=>false)); ?></td>
                                  <td><?php echo $this->Html->link($d['Project']['name'],array('action'=>'edit',$d['Project']['id'])); ?></td>
                                  <td><?php echo $this->Html->link($this->Html->image(isset( $d['Thumb']['file']) ?$d['Thumb']['file']:'http://placehold.it/80x80',array('title'=>'Projet '.$d['Project']['name'],'width'=>80,'height'=>80 ,'class'=>'img-thumbnail')),isset( $d['Thumb']['file']) ? $d['Thumb']['file']:'http://placekitten.com/1280/1024',array('escape'=>false,'class'=>'lightbox')); ?>
                                  </td>
                                  <td><?php echo $d['Project']['hidden'] == '1' ? '<span class="label label-danger">Privé</span>' : '<span class="label label-success">Public</span>'; ?></td>
                                  <td><?php echo $this->Html->link($d['Project']['published']== 0? '<span class="label label-danger">Hors ligne</span>' : '<span class="label label-success">En ligne</span>',array('action'=>'publish','controller'=>'projects',$d['Project']['id']),array('escape'=>false),"Voulez vous vraiment publier/dépublier ce projet ?"); ?></td>
                                  <td><?php echo $this->Html->link($d['Category']['name'],array('controller'=>'categories','action'=>'edit',$d['Category']['id'])); ?></td>
                                  <td><?php echo __($this->Time->format($d['Project']['created']),'%j %F %Y'); ?></td>
                                  <td><?php echo $d['Project']['order']; ?></td>
                                  <td><?php echo __($this->Time->format($d['Project']['modified']),'%j %F %Y');?></td>

                                  <td><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus-sign"></span>',array('controller'=>'projects','action'=>'edit','admin'=>'true',$d['Project']['id']),array('escape'=>false,'class'=>'btnClass','title'=>'éditer le projet'),"Voulez vous vraiment éditer ce projet ?");

                                  echo $this->Html->link('<span class="glyphicon glyphicon-remove-sign"></span>',array('controller'=>'projects','action'=>'delete','admin'=>true,$d['Project']['id']),array('escape'=>false,'class'=>'btnClass','title'=>'Supprimer le projet '),__("Voulez vous vraiment effacer le projet %s ?",$d['Project']['name']));

                                echo $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>',array('controller'=>'projects','action'=>'view','id'=>$d['Project']['id'],'slug'=>$d['Project']['slug'],'categorySlug'=>$d['Category']['slug'],'admin'=>false),array('escape'=>false,'class'=>'btnClass','target'=>'_blank','title'=>'Voir le projet')); ?></td>
                                  <td><?php echo $d['Project']['id']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php echo $this->Form->end(); ?>
                              </tbody>
                            </table>
                         </div><!-- Table responsive -->
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-xs-12 text-center">
                      <ul class="pagination">
                          <?php echo $this->Paginator->prev(__('Précédent'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
                          <?php echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1)); ?>
                          <?php echo $this->Paginator->next(__('Suivant'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));?>
                      </ul>
                </div>
              </div>

              <?php else: ?>
                        <h3 class="well well-sm">Aucun projet</h3>
              <?php endif; ?>
           </div>

        </div><!-- Fin .row -->
    </div><!-- fin lg-12-->
</div><!-- fin .row -->
</div><!-- fin .container-fluid -->

<?php echo $this->Html->script('back/jquery.form.js',array('inline'=>false)); ?>
<?php echo $this->Html->scriptStart(array('inline' => false));?>
$(document).ready(function(){

$('.lightbox').fancybox({
  aspectRatio:true,
  fitToView:true,
  type:'image'
});
$('.btnClass').tooltip({
  placement:"auto right"
});
$('#allcheckbox').click(function()
{

    $('#tbodyProjects tr input:checkbox').each(function()
    {
      if($(this).prop('checked')== false)
      {

          $(this).prop("checked",true);
      }else
      {

          $(this).prop("checked",false);
      }
    });

});
$('#tbodyProjects').sortable({
	items: '> tr ',
	update: function(e,ui) {
			 i = 0;
			 $('#tbodyProjects>tr').each(function(){
				i++;
        $(this).find('input').val(i);
			 });

       data = $('#tbodyProjects>tr>input').fieldSerialize();

       $.ajax({
       url: "<?php echo $this->Html->url(array('controller'=>'projects','action'=>'order')); ?>",
       data:data
       });
       },
     helper: function(e, tr)
  {
    var $originals = tr.children();
    var $helper = tr.clone();
    $helper.children().each(function(index)
    {
      // Set helper cell sizes to match the original sizes
      $(this).width($originals.eq(index).width());
    });
    return $helper;
  }

}).disableSelection();
});
<?php $this->Html->scriptEnd();?>
