 <div class="container-fluid">
 <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php echo $this->Html->link('Administration Anne-b','/admin',array('title'=>'Administration du site','class'=>'navbar-brand')); ?>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?php echo ($this->params['controller']=='projects'&& $this->params['action']=='admin_index')?
            'class="active"' : '';?>><?php echo $this->Html->link('Projets',array('controller'=>'projects','action'=>'admin_index')); ?></li>
            <li <?php echo ($this->params['controller']=='categories'&& $this->params['action']=='admin_index')?
            'class="active"' : '';?>><?php echo $this->Html->link('Catégories',array('controller'=>'categories','action'=>'admin_index')); ?></li>

            <li class="dropdown">
                <?php echo $this->Html->link('Actions <b class="caret"></b>','',array('class'=>'dropdown-toggle','data-toggle'=>"dropdown",'escape'=>false)); ?>
                <ul class="dropdown-menu">
                  <li><?php echo $this->Html->link('Nouveau projet',array('controller'=>'projects','action'=>'edit')); ?>
                  <li><?php echo $this->Html->link('Nouvelle catégorie',array('controller'=>'categories','action'=>'edit')); ?></li>
                </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li><?php echo $this->Html->link('Voir le site','/',array('title'=>'Site front','class'=>'')); ?></li>
               <li <?php echo ($this->params['controller']=='users'&& $this->params['action']=='edit') ? 'class="active"': '';?>>
               <?php echo $this->Html->link('<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Mon profil',array('controller'=>'users','action'=>'edit',$this->Session->read('Auth.User.id')),array('escape'=>false)); ?>
               </li>
              <li <?php echo ($this->params['controller']=='options' && $this->params['action']=='admin_index')?'class="active"': '';?>>
              <?php echo $this->Html->link('<span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Options',array('controller'=>'options','action'=>'admin_index'),array('escape'=>false)); ?>
              </li>
              <li class="navbar-right"><?php echo $this->Html->link('<span class="glyphicon glyphicon-off" aria-hidden="true"></span> Déconnexion',array('controller'=>'users','action'=>'logout','admin'=>false),array('escape'=>false)); ?>
              </li>
          </ul>
        </div> <!--/.nav-collapse -->
</div>
<?php echo $this->fetch('content'); ?>
