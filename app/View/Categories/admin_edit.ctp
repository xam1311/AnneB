<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
     <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
        <?php if(!empty($this->data['Category']['name'])): ?>
        <?php echo $this->Html->link('Edition catégorie '.$this->data['Category']['name'],'#',array('class'=>'navbar-brand')); ?>
      <?php else: ?>
        <a class="navbar-brand" href="#">Nouvelle Catégorie</a>
      <?php endif; ?>
    </div>
  <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
           <li><a href="#"><?php echo $this->data['Category']['published']==1? '<span class="label label-success">Publié</span>' :'<span class="label label-error">Dépublié</span>' ?></a></li>
            <li><a href="#"><?php echo $this->data['Category']['menu']==1 ? '<span class="label label-info">Menu activé</span>':'' ;?></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
             <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-off" aria-hidden="true"></span> Retour',array('action'=>'index','controller'=>'categories'), array('escape'=>false)); ?></li>
          </ul>
  </div><!--/.nav-collapse -->
</nav>
<div class="container-fluid">
  <div class="row">
    <?php echo $this->Form->create('Category',array('class'=>'form-horizontal')); ?>

		<div class="col-lg-10 col-lg-offset-1 col-md-12 col-xs-12">

         <div class="row">
           <div class="col-lg-6 col-sm-6 col-xs-6">
              <?php echo $this->Form->input('name',array('label'=>'Nom','class' =>'form-control','div' => array(
              'class' => 'form-group'))); ?>

              <?php echo $this->Form->input('summary',array('label'=>'Sous-titre','type'=>'text','class' =>'form-control','div' => array(
              'class' => 'form-group'))); ?>
           </div>
           <div class="col-lg-5 col-lg-offset-1 col-sm-6 col-xs-6">
             <?php echo $this->Form->input('slug',array('label'=>'url / Slug','class' =>'form-control','div' => array(
             'class' => 'form-group'))); ?>
              <?php echo $this->Form->input('published', array('div' => array('class'=>'checkbox'),'label'=>false,'type'=>'checkbox','before'=>'<label>','after'=>'Publié </label>')); ?>
              <?php echo $this->Form->input('menu', array('div' => array('class'=>'checkbox'),'label'=>false,'type'=>'checkbox','before'=>'<label>','after'=>'Présent dans Menu ?</label>')); ?>
          </div>
         </div>
        <?php echo $this->Form->input('description',array('label'=>'Description','type'=>'textarea','class' =>'form-control','div' => array(
              'class' => 'form-group'))); ?>
        <div class="form-group">
          <div class="col-lg-12 col-md-12 col-xs-12 text-center">
            <?php echo $this->Form->button('Enregistrer',array('class'=>'btn btn-primary','type'=>'submit','label'=>false,'div'=>false)); ?>
            <?php echo $this->Html->link($this->Form->button('Retour', array('class' => 'btn','type'=>'button')),array('action'=>'index','controller'=>'categories'),array('escape'=>false)); ?>
            <?php echo $this->Form->end(); ?>
          </div>
        </div>


      </div>
    </div>
  </div>
<?php $this->Form->end(); ?>
<?php echo $this->Html->script(array('tinymce/tinymce.min.js'),array('inline'=>true)); ?>
<?php echo $this->Html->scriptStart(array('inline'=>true));?>

function generateSlug (value) {
  return value.toLowerCase().replace(/-+/g, '').replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
};
jQuery(document).ready(function(){

var $slug = jQuery('#CategorySlug');
var $categoryName = jQuery('#CategoryName');

$slug.on('change',function() {
      if( $slug.val() == '')
      {

        if( $categoryName != '')
        {
          $newSlug = generateSlug($categoryName.val());
          $slug.val($newSlug);
        }

        else
        {
           $categoryName.on('keyup change', function() {

             $newSlug = generateSlug(jQuery(this).val());
             $slug.val($slug);

           });
        }

      }

});
$categoryName.on('keyup change', function() {
             $newSlug = generateSlug(jQuery(this).val());
             $slug.val($newSlug);

           });

});
tinymce.init({
    theme: "modern",
    mode : "textareas",
    menubar:false,
    language_url : '<?php echo $this->webroot; ?>js/tinymce/langs/fr_FR.js',
    language:'fr_FR',
    paste_word_valid_elements: "b,strong,i,em,h1,h2,h3",
    entity_encoding : "raw",
    content_css : '<?php echo $this->webroot; ?>/js/tinymce/bootstrap.css',
    height:300,
    resize:true,
    fontsize_formats: "10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 22pt 24pt 26pt 28pt 30pt",
    style_formats: [
        {title: 'Header h2', block: 'h2', styles: {'color': '#624Cac', 'font-weight':'200'}},
        {title: 'Header h3', block : 'h3', styles: {'color': '#ff2178','font-size':'14pt'}},
        {title: 'Header h4', block : 'h4', styles: {'color': '#808080','font-size':'11pt','font-weight':'700','margin-top':'10px'}},
        {title: 'Intro p', block :'p', styles :{'color':'#624cac','font-size':'14pt'}}
    ],
    image_class_list: [
        {title: 'img-responsive', value: 'img-responsive'},
        {title: 'Block-center', value: 'block-center'},
        {title: 'Sans', value: ''}
    ],
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save contextmenu template paste textcolor colorpicker responsivefilemanager template"
   ],
   templates : [
    {
            title : "Bootstrap Largeur Max",
            url : "<?php echo $this->webroot; ?>js/tinymce/templates/col12.htm",
            description : "Inclu une largeur complète Bootstrap 12 colonnes"
    },
    {
            title : "Bootstrap 2 colonnes identiques",
            url : "<?php echo $this->webroot; ?>js/tinymce/templates/col6.htm",
            description : " deux colonnes boostrap de 50 % - largeur entière pour mobile"
    },
    {
            title : "Bootstrap 2 colonnes 75% - 25 %",
            url : "<?php echo $this->webroot; ?>js/tinymce/templates/col8.htm",
            description : " deux colonnes boostrap 75% -25% - largeur entière pour mobile"
    }
   ],
   relative_urls:false,
   remove_script_host : false,
   external_filemanager_path:"<?php echo $this->webroot; ?>js/filemanager/",
   filemanager_title:"Filemanager" ,
   external_plugins: { "filemanager" : "<?php echo $this->webroot; ?>js/filemanager/plugin.min.js"},
   image_title:true,
   image_advtab:true,
   toolbar1: "undo redo | image link | bold  italic | underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |",
   toolbar2:" forecolor backcolor | formatselect fontsizeselect| styleselect | code | visualblocks | template"
 });

<?php echo $this->Html->scriptEnd();?>
