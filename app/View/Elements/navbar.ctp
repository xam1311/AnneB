<?php $navmenu = $this->requestAction(array('controller'=>'projects','action'=>'navmenu')); ?>
<div class="side-menu">  
    <nav class="navbar navbar-inverse" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <div class="brand-wrapper">
            <!-- Hamburger -->
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Brand -->
            <div class="brand-name-wrapper">
                  <?php echo $this->Html->link($this->Html->image('front/logoab.svg',array('alt'=>'Anne-b - directrice artistique web','width'=>110,'height'=>110)),array('controller'=>'pages','action'=>'home'),array('escape'=>false,'class'=>'navbar-brand text-center img-responsive','title'=>'Directrice artistique web- Création de chartes graphiques - Webdesign - Graphisme - Anne-b')); ?>
                  <p class="slogan hidden-xs"><span>anne berland</span><br>Directrice artistique - UI designer</p>  
                  <p class="slogan hidden-md hidden-sm hidden-lg"><span>anne berland</span><br>DA - UI designer</p>  
            </div>
        </div>

    </div>
   <!-- Main Menu -->
    <div class="side-menu-container">
        <ul class="nav navbar-nav">
              <?php foreach ($navmenu as $key => $d): ?>
              <li
              <?php if($this->params['controller']=='projects' && $this->params['action']=='index' && $this->params['slug']==$d['Category']['slug']): echo 'class="active"'; endif; ?>
              <?php if($this->params['controller']=='projects' && $this->params['action']=='view' && $this->params['pass'][2]==$d['Category']['slug']): echo 'class="active"'; endif; ?>><?php  echo $this->Html->link($d['Category']['name'],$d['Category']['link']); ?></li>
              <?php endforeach;?>
              <li <?php if($this->params['controller']=='pages' && $this->params['action']=='display' && $this->params['pass'][0]=='cv'): echo 'class="active"'; endif; ?>><?php echo $this->Html->link('CV',array('controller'=>'pages','action'=>'display','cv')); ?></li>
              <li <?php if($this->params['controller']=='contact' && $this->params['action']=='index'): echo 'class="active"'; endif; ?>><?php echo $this->Html->link('Contact',array('controller'=>'contact','action'=>'index')); ?></li>
              <li <?php if($this->params['controller']=='pages' && $this->params['action']=='display' && $this->params['pass'][0]=='know'): echo 'class="active"'; endif; ?>><?php echo $this->Html->link('Me connaître',array('controller'=>'pages','action'=>'display','know')); ?></li>
              <!--nocache-->
               <?php if($this->Session->read("Auth.User.role")=='admin'):?>
              <li><?php echo $this->Html->link('Administration',array('controller'=>'projects','action'=>'index','admin'=>true),array('target'=>'_blank')); ?></li>
              <?php endif; ?>
              <!--/nocache-->          
        </ul>
        <div class="clearfix visible-lg-block visible-xs-block"></div>
    </div><!-- /.navbar-collapse -->
</nav>
</div>


  


