<?php $this->extend('/Common/js/form');?>
<?php $this->assign('textarea','#ProjectDescription'); ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
 <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php echo $this->Html->link('Projet '.$this->data['Project']['name'],'#',array('class'=>'navbar-brand')); ?>
        </div>
        <div class="navbar-collapse collapse">

          <ul class="nav navbar-nav">
            <?php echo $this->Form->create('Project',array('role'=>'form-horizontal')); ?>
            <li>
                 <a href="#"><?php echo $this->Form->button('Enregistrer',array('type'=>'submit','name'=>'data[Project][valueSubmit]','class'=>"btn btn-success",'value'=>"saveexit",'div'=>false)); ?></a>
            </li>
            <li>
                <a href="#"><?php echo $this->Form->button('Valider',array('type'=>'submit','name'=>'data[Project][valueSubmit]','class'=>"btn btn-primary",'value'=>"savestay",'div'=>false)); ?></a>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><?php echo $this->data['Project']['hidden']==1 ? 'Projet privé' :'Projet public';?></li>
            <?php if(isset($this->data['Project']['id']) && !empty($this->data['Project']['id'])):?>
            <li><?php echo $this->Html->link('Voir le projet',array('controller'=>'projects','action'=>'view','id'=>$this->data['Project']['id'],'slug'=>$this->data['Project']['slug'],'categorySlug'=>$this->data['Category']['slug'],'admin'=>false),array('target'=>'_blank')); ?></li>
          <?php endif; ?>
            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-off" aria-hidden="true"></span> Retour',array('action'=>'index','controller'=>'projects'), array('escape'=>false)); ?></li>
          </ul>
        </div><!--/.nav-collapse -->
</nav>
<div class="container-fluid">
  <div class="row">
      <div class="col-lg-10 col-lg-offset-1 col-md-12 col-xs-12">

        <div class="row">
               <div class="col-lg-6 col-md-6 col-xs-12">
                        <?php echo $this->Form->input('name',array('label'=>'Nom projet','class' =>'form-control','div' => array(
                              'class' => 'form-group'),
                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')))); ?>
                        <label for="ProjectWebsite">Site web projet</label>
                        <?php echo $this->Form->input('website',array('label'=>false,'placeholder'=>'http://....','title'=>'Mettre le site web avec http://','class' =>array('form-control','btnClass'),'aria-described'=>'website-addon','div' => array(
                              'class' => 'input-group'),'after'=>' <span class="input-group-addon" id="website-addon">http://www.example.com</span>',
                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')))); ?>
              </div>
              <div class="col-lg-6 col-md-6 col-xs-12">
                  <?php echo $this->Form->input('slug',array('label'=>'Url - Slug','class' =>'form-control','disabled' =>false,'div' => array('class' => 'form-group'),
                  'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')))); ?>
                  <?php echo $this->Form->input('meta_description',array('type'=>'textarea','label'=>'Meta description','class' =>'form-control mce-simple','disabled' =>false,'div' => array('class' => 'form-group'),
                  'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')))); ?>
              </div>
        </div><!-- fin .row-->


        <div class="row">
         <!-- <div class="panel panel-info">
                  <div class="panel-heading">
                    <h3 class="panel-title">Paramètres</h3>
                  </div>
          <div class="panel-body">-->
               <div class="col-lg-6 col-md-6 col-xs-12">
                  <?php echo $this->Form->input('category_id', array('label'=>'Catégorie','empty' => 'Choisissez une catégorie','class'=>'form-control','div'=>array('class'=>'form-group'))); ?>

                  <!-- Voir pour modification after / before label-disable -->
                <div class="form-group">
                    <?php echo $this->Form->select('params',array('Webdesign'=>'Webdesign', 'Identité visuelle'=>'Identité visuelle','Mobile'=>'Mobile','Newsletter'=>'Newsletter','Encart Pub'=>'Encart Pub','Responsive Design'=>'Responsive Design'),array('multiple' => 'checkbox','label'=>false,'before'=>'<label>','separator'=>'<label class="truc">','value'=>$params,'div'=>array('class'=>'checkbox')));?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('type', array('type'=>'radio', 'options'=>array('Réalisé en agence'=>'Réalisé en agence', 'Projet personnel'=>'Projet personnel'),'legend'=>false,'label'=>false,'value'=>$type[0],'div'=>array('class'=>'radio'),'before'=>'<label>','separator'=>'</label></div><div class="radio"><label>')); ?>
                </div>

                    <!--<div class="well well-sm">

                      <label for="bgColor">Couleur Background</label>
                      <?php //echo $this->ColorPicker->input('bgColro',array('value'=>$bgColor[0],'class'=>'form-control','label'=>false,'before'=>'','after'=>'<span class="input-group-addon"><i></i></span>','div'=>array('class'=>'input-group bgColor'))); ?>

                      <label for="txtColor">Couleur Texte</label>
                      <?php //echo $this->ColorPicker->input('txtColor',array('value'=>$txtColor[0],'class'=>'form-control','label'=>false,'after'=>'<span class="input-group-addon"><i></i></span>','div'=>array('class'=>'input-group txtColor'))); ?>
                    </div>-->

              </div>
               <div class="col-lg-6 col-md-6 col-xs-12">

                    <?php echo $this->Taxonomy->input('tags',array('class' =>'form-control','div' => array('class' => 'form-group'))); ?>

                    <?php echo $this->Form->input('hidden', array('div' => array('class'=>'checkbox'),'label'=>false,'type'=>'checkbox','before'=>'<label>','after'=>'Privé </label>')); ?>

                    <?php echo $this->Form->input('published', array('div' => array('class'=>'checkbox'),'label'=>false,'type'=>'checkbox','before'=>'<label>','after'=>'Publié </label>')); ?>

               </div>

             <!-- </div>
          </div>-->
        </div><!-- fin .row -->
               <?php echo $this->Form->input('short_description',array('label'=>'Description courte','class' =>'form-control','div' => array(
              'class' => 'form-group'))); ?>

              <?php echo $this->Form->input('description',array('label'=>'Description longue','class'=>'mce-complete')); ?>
      		    <?php if(isset($this->data['Project']['id']) && !empty($this->data['Project']['id'])):

                   echo '<br/><label>Fichiers images attachés</label>';
                   echo $this->Media->iframe('Project',$this->data['Project']['id']);
              endif;?>
        </div>

        <div class="form-group">
          <div class="col-lg-12 col-md-12 col-xs-12 text-center">
              <?php echo $this->Form->button('Enregistrer',array('class'=>'btn btn-primary','type'=>'submit','label'=>false,'div'=>false)); ?>
              <?php echo $this->Html->link($this->Form->button('Retour', array('class' => 'btn','type'=>'button')),array('action'=>'index','controller'=>'projects'),array('escape'=>false)); ?>
              <?php echo $this->Form->end(); ?>
          </div>
        </div>

      </div>
    </div>
</div>
<?php $this->Form->end(); ?>
<?php echo $this->Html->script(array('tinymce/tinymce.min.js'),array('inline'=>true)); ?>
<script type="text/javascript">
function generateSlug (value) {
  return value.toLowerCase().replace(/-+/g, '').replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
};
jQuery(document).ready(function(){

jQuery('.btnClass').tooltip({
  placement:"auto right"
});

var $slug = jQuery('#ProjectSlug');
var $projectName = jQuery('#ProjectName');

$slug.on('change',function() {
      if( $slug.val() == '')
      {

        if( $projectName != '')
        {
          $newSlug = generateSlug($projectName.val());
          $slug.val($newSlug);
        }

        else
        {
           $projectName.on('keyup change', function() {

             $newSlug = generateSlug(jQuery(this).val());
             $slug.val($slug);

           });
        }

      }

});
$projectName.on('keyup change', function() {
             $newSlug = generateSlug(jQuery(this).val());
             $slug.val($newSlug);

           });

});
tinymce.init({
    theme: "modern",
    mode : "textareas",
    menubar:false,
    editor_selector : "mce-complete",
    language_url : '<?php echo $this->webroot; ?>js/tinymce/langs/fr_FR.js',
    language:'fr_FR',
    paste_word_valid_elements: "b,strong,i,em,h1,h2,h3",
    entity_encoding : "raw",
    height:300,
    resize:true,
    fontsize_formats: "12pt 14pt 16pt 18pt 19pt 20pt 21pt 22pt 24pt 26pt 28pt 30pt",
    style_formats: [
        {title: 'Header h2', block: 'h2', styles: {'color': '#624Cac', 'font-weight':'200','font-size':'30pt'}},
        {title: 'Header h3', block : 'h3', styles: {'color': '#ff2178','font-size':'20pt'}},
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
   content_css : '<?php echo $this->webroot; ?>js/tinymce/bootstrap.css',
   external_filemanager_path:"<?php echo $this->webroot; ?>js/filemanager/",
   filemanager_title:"Filemanager" ,
   external_plugins: { "filemanager" : "<?php echo $this->webroot; ?>js/filemanager/plugin.min.js"},
   image_title:true,
   image_advtab:true,
   toolbar1: "undo redo | image link | bold  italic | underline strikethrough | hr | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |",
   toolbar2:" forecolor backcolor | formatselect fontsizeselect | styleselect | code | visualblocks | template"
 });

</script>
