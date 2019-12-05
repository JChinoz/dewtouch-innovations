
<div class="row-fluid">
	<table class="table table-bordered" id="table_records">
		<thead>
			<tr>
				<th>ID</th>
				<th>NAME</th>	
			</tr>
		</thead>
		<tbody>
			<?php foreach($records as $record):?>
			<tr>
				<td><?php echo $record['Record']['id']?></td>
				<td><?php echo $record['Record']['name']?></td>
			</tr>	
			<?php endforeach;?>
		</tbody>
	</table>
</div>
<?php $this->start('script_own')?>
<script>
$(document).ready(function(){
	var baseUrl = '<?php echo $this->base; ?>'
	var tableRecords = $("#table_records").DataTable({
		// "iDisplayLength": 10,
        // "bProcessing": true,
        // "bServerSide": true,
        // "sAjaxSource": baseUrl+"Record",
	});

	$('select').on("change", function() {
		tableRecords.ajax.reload();
		console.log("TESTING");
    });
})
</script>
<?php $this->end()?>