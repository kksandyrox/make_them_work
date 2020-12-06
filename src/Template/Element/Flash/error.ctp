<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div class="row justify-content-md-center">
	<div class="col-xs-4 col-md-4 col-lg-4 flash-message-adjustment">
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<?= $message ?>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	</div>
</div>
