<div class="row justify-content-md-center mt-5">
	<div class="col-md-6">
		<?php echo $this->Form->create(null, ['class' => 'text-center border border-light p-5']); ?>
			<p class="h4 mb-4">Submit Feedback</p>
			<blockquote class="blockquote bq-success">
			  <p>We will try our very best to consider each and every valuable suggestions from you and have it implemented.
			  </p>
			</blockquote>
			<br />
			<?php
				echo $this->Form->control(
					'name', [
					'label' =>false,
					'class' => 'form-control mb-4',
					'placeholder'=>'Name',
					'required'
				]);
			?>
			<?php
				echo $this->Form->control(
					'email', [
					'label' =>false,
					'class' => 'form-control mb-4',
					'placeholder'=>'E-mail',
					'required'
				]);
			?>
			<?php
				echo $this->Form->control(
					'feedback', [
					'label' =>false,
					'type' => 'textarea',
					'rows' => 4,
					'class' => 'form-control mb-4',
					'placeholder'=>'Feedback',
					'required'
				]);
			?>
			<div class="form-group">
				<?php echo $this->Form->button(__('Submit'), ['class' =>'btn btn-info my-4 btn-block']); ?>
			</div>
		<?php echo $this->Form->end() ?>
	</div>
</div>
