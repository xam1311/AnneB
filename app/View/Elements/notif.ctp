<div class="alert alert-<?php echo isset($type)? $type: 'success'; ?>" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="$(this).parent().slideUp();">&times;</button>
  <strong>Attention:</strong>
  <p><?php echo $message; ?></p>
</div>