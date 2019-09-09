<div class="row justify-content-md-center mt-5">
	<div class="col-md-6">
		<?php echo $this->Form->create($users, ['class' => 'text-center border border-light p-5']); ?>
			<p class="h4 mb-4">Sign up</p>
			<div class="form-row mb-4">
				<div class="col">
					<?php
						echo $this->Form->control(
							'first_name', [
							'label' =>false,
							'class' => 'form-control',
							'placeholder'=>'First name',
							'id'=>'defaultRegisterFormFirstName'
						]);
					?>
				</div>
				<div class="col">
					<?php
						echo $this->Form->control(
							'last_name', [
							'label' =>false,
							'class' => 'form-control',
							'placeholder'=>'Last name',
							'id'=>'defaultRegisterFormLastName'
						]);
					?>            
				</div>
			</div>
			<?php
				echo $this->Form->control(
					'email', [
					'label' =>false,
					'class' => 'form-control mb-4',
					'placeholder'=>'E-mail',
					'id'=>'defaultRegisterFormEmail'
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
					"aria-describedby"=>"defaultRegisterFormPasswordHelpBlock"
				]);
			?> 
			<small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
				At least 8 characters
			</small>

			<?php
				echo $this->Form->control(
					'phone', [
					'label' =>false,
					'class' => 'form-control',
					'placeholder'=>'Phone number',
					'id'=>'defaultRegisterPhonePassword',
					"aria-describedby"=>"defaultRegisterFormPhoneHelpBlock"
				]);
			?>
			<small id="defaultRegisterFormPhoneHelpBlock" class="form-text text-muted mb-4">
				Optional
			</small>

			<p>Already a member?
				<?php echo $this->Html->link('Login', array('action' => 'login', 'controller' => 'users'));?>
			</p>

			<div class="form-group">
				<?php echo $this->Form->button(__('Sign Up'), ['class' =>'btn btn-info my-4 btn-block']); ?>
			</div>

		<?php echo $this->Form->end() ?>
	</div>
</div>