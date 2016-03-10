<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<?php $this->set('title_for_layout','Page introuvable - Anne-b'); ?>
<div class="row headerPage">
	<div class="title-page text-left">
			<div class="col-lg-12 col-md-12 col-xs-12">
				 <?php echo '<h1>La page '.$url.' est '.$message.' </h1>';?>
			</div>
		</div><!-- .title-page -->
</div><!-- .headerPage -->
<?php
if (Configure::read('debug') > 0):
	echo $this->element('exception_stack_trace');
endif;
?>
