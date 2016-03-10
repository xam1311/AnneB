<?php $this->extend('/Common/adminnav');?>
<?php $this->assign('title','Administration catégories'); ?>
    <div class="col-lg-12 col-md-12 col-xs-12">
      <h3 class="well well-sm"><?php echo $this->fetch('title'); ?></h3>

              <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <?php echo $this->Html->link('Nouvelle catégorie',array('controller'=>'categories','action'=>'edit'),array('class' =>'btn btn-medium btn-primary')) ;?>
                    <div class="table-responsive">
                          <table class="table table-hover table-striped">
                         	<thead>
                         		<tr>
                        			<th>Nom catégorie</th>
                        			<th>Publié</th>
                        			<th>Menu</th>
                        			<th>Actions</th>
                        			<th>Id</th>
                         		</tr>
                         	</thead>
                         	<tbody id="tbodyCategories">
                            <?php echo $this->Form->create('Category',array('url'=>array('controller'=>'categories','action'=>'order'))); ?>
                         		<?php foreach ($categories as $d): ?>
                         		<tr>
                            <input type="hidden" value="<?php echo $d['Category']['order']; ?>" name="data[Category][<?php echo $d['Category']['id']; ?>]">
                         		<td><?php echo $this->Html->link($d['Category']['name'],array('action'=>'edit',$d['Category']['id'])); ?></td>
                         		<td><?php echo $this->Html->link($d['Category']['published']== 0? '<span class="label label-danger">Hors ligne</span>' : '<span class="label label-success">En ligne</span>',array('action'=>'publish','controller'=>'categories',$d['Category']['id']),array('escape'=>false),"Voulez vous vraiment publier ou dépublier cette catégorie ?"); ?></td>
                         		<td><?php echo $d['Category']['menu']=='1'? '<span class="label label-info">Activé</span>' : '<span class="label label-success">Désactivé </span>'; ?></td>
                         		<td><?php echo $this->Html->link('<i class="glyphicon glyphicon-plus-sign"></i>',array('action'=>'edit',$d['Category']['id']),array('escape'=>false),"Voulez vous vraiment éditer cette catégorie ?");

                         			echo $this->Html->link('<i class="glyphicon glyphicon-remove-sign"></i>',array('action'=>'delete',$d['Category']['id']),array('escape'=>false),__("Voulez vous vraiment effacer la catégorie %s ?",$d['Category']['name'])); ?></td>
                         			<td><?php echo $d['Category']['id']; ?></td>
                            </tr>
                         		<?php endforeach; ?>
                            <?php echo $this->Form->end(); ?>
                         	</tbody>
                        </table>
                    </div>

             </div><!-- fin .row -->
          </div><!-- fin md12 -->
          <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 text-center">
               <ul class="pagination">
                   <?php echo $this->Paginator->prev(__('Précédent'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
                    <?php  echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1)); ?>
                    <?php echo $this->Paginator->next(__('Suivant'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
                </ul>
            </div>
          </div>

    </div><!-- fin lg-10 -->
</div><!-- fin .container-fluid -->
<?php echo $this->Html->script('back/jquery.form.js',array('inline'=>false)); ?>
<?php echo $this->Html->scriptStart(array('inline' => false));?>
$(document).ready(function(){
$('#tbodyCategories').sortable({
  items: '> tr ',
  cancel:'input',
  update: function() {
      i = 0;
      $('#tbodyCategories>tr').each(function(){
        i++;
        $(this).find('input').val(i);
       });
       data = $('#tbodyCategories>tr>input').fieldSerialize();
       $.ajax({
       url: "<?php echo $this->Html->url(array('controller'=>'categories','action'=>'order')); ?>",
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
