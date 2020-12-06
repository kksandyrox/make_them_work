<div class="mt-5">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title"><a>Potholes Distribution By Constituencies</a></h4>
		<div class="d-none d-sm-block"> <!-- Hide on anything less than md-->
	 		<canvas id="myChart"></canvas>
		</div>
		<div class="d-sm-none"> <!-- Show on anything less than md-->
			<table class="table table-bordered">
				<thead class="black white-text">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Constituency</th>
						<th scope="col">No. of Potholes</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($potholeStatistics as $key => $pothole):?>
						<tr>
							<th scope="row"><?php echo $key + 1;?></th>
							<td><?php echo $pothole['name'];?></td>
							<td><?php echo $pothole['p_count'];?></td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>