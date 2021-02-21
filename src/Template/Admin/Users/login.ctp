<div class="row justify-content-md-center mt-5">
	<div class="col-md-6">
		<?php echo 
			$this->Form->create(null, [
				'class' => 'text-center border border-light p-5'
			]); 
		?>
			<p class="h4 mb-4">Admin Login</p>
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
			<?php
				echo $this->Form->control(
					'password', [
					"type" => "password",
					'label' =>false,
					'class' => 'form-control',
					'placeholder'=>'Password',
					'id'=>'defaultRegisterFormPasswordHelpBlock',
					"aria-describedby"=>"defaultRegisterFormPasswordHelpBlock",
					'required'
				]);
			?>
			<div class="form-group">
				<?php echo $this->Form->button(__('Login'), ['class' =>'btn btn-info my-4 btn-block']); ?>
			</div>
		<?php echo $this->Form->end() ?>
	</div>
</div>
