<div class="row justify-content-md-center mt-5">
	<div class="col-md-6">
		<?php echo $this->Form->create(null, ['class' => 'text-center border border-light p-5']); ?>
			<p class="h4 mb-4">Forgot Password</p>
			<?php
				echo $this->Form->control(
					'email', [
					'label' =>false,
					'class' => 'form-control mb-4',
					'placeholder'=>'E-mail',
					'id'=>'defaultRegisterFormEmail',
					'required'
				]);
			?>
			<div class="form-group">
				<?php echo $this->Form->button(__('Submit'), ['class' =>'btn btn-info my-4 btn-block']); ?>
			</div>
		<?php echo $this->Form->end() ?>
	</div>
</div>
