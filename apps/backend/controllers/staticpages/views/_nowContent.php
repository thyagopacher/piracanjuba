<!-- Now Content -->
<div id="nowContent" class="box">
	<h3>{Now}</h3>
	<div>
		<div class="two-cols">
			<div class="col-1">
				<table class="contentCounter">
					<thead>
						<caption>{Content}</caption>
					</thead>
					<tbody>
						<?php if($this->news > 0): ?>
						<tr>
							<td><?php echo($this->news); ?></td>
							<td>{News}</td>
						</tr>
						<?php endif; ?>
						<?php if($this->galeries > 0): ?>
						<tr>
							<td><?php echo($this->galeries); ?></td>
							<td>{Galleries}</td>
						</tr>
						<?php endif; ?>
						<?php if($this->polls > 0): ?>
						<tr>
							<td><?php echo($this->polls); ?></td>
							<td>{Polls}</td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
			<div class="col-2">
				<table class="contentCounter">
					<caption>{Discussion}</caption>
					<tbody>
						<tr>
							<td><?php echo($this->allComments); ?></td>
							<td>{Comments}</td>
						</tr>
						<tr>
							<td><?php echo($this->approvedComments); ?></td>
							<td><span class="approved-color">{Approved}</span></td>
						</tr>
						<tr>
							<td><?php echo($this->penddantComments); ?></td>
							<td><span class="pendant-color">{Pendant}</span></td>
						</tr>
						<tr>
							<td><?php echo($this->excludedComments); ?></td>
							<td><span class="excluded-color">{Excluded}</span></td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>
<!-- /Now Content -->