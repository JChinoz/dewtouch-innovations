<div class="alert  ">
<button class="close" data-dismiss="alert"></button>
Question: Advanced Input Field</div>

<p>
1. Make the Description, Quantity, Unit price field as text at first. When user clicks the text, it changes to input field for use to edit. Refer to the following video.

</p>


<p>
2. When user clicks the add button at left top of table, it wil auto insert a new row into the table with empty value. Pay attention to the input field name. For example the quantity field

<?php echo htmlentities('<input name="data[1][quantity]" class="">')?> ,  you have to change the data[1][quantity] to other name such as data[2][quantity] or data["any other not used number"][quantity]

</p>



<div class="alert alert-success">
<button class="close" data-dismiss="alert"></button>
The table you start with</div>

<table class="table table-striped table-bordered table-hover">
<thead>
<th><span id="add_item_button" class="btn mini green addbutton" onclick="addToObj=false">
											<i class="icon-plus"></i></span></th>
<th>Description</th>
<th>Quantity</th>
<th>Unit Price</th>
</thead>

<tbody id="dynamic-table">
	<tr id="dynamic-row">
	<td></td>
	<td><p name="data[1][description]" class="dynamic-cells m-wrap  description required" rows="2" data-editable>Click to Edit</p></td>
	<td><p name="data[1][quantity]" class="dynamic-cells" data-editable>Click to Edit</p></td>
	<td><p name="data[1][unit_price]"  class="dynamic-cells" data-editable>Click to Edit</p></td>	
	</tr>
</tbody>

</table>


<p></p>
<div class="alert alert-info ">
<button class="close" data-dismiss="alert"></button>
Video Instruction</div>

<p style="text-align:left;">
<video width="78%"   controls>
  <source src="/video/q3_2.mov">
Your browser does not support the video tag.
</video>
</p>





<?php $this->start('script_own');?>
<script>
$(document).ready(function(){
	// For Question 1
	$('body').on('click', '[data-editable]', function(){
		var $element = $(this);
		var $input
		if($(this).hasClass('m-wrap')){
			$input = $('<textarea/>').val($element.text());
		}else{
			$input = $('<input/>').val($element.text());
		}
		$element.replaceWith($input);
		$input.focus();
		var save = function(){
			$element.text($input.val());
			$input.replaceWith( $element );
		};
		
		$input.one('blur', save);
	});

	// For Question 2
	var current_length = $('#dynamic-table tr').length;
	$("#add_item_button").click(function(){
		var new_row = $('#dynamic-row:last-child').clone();

		new_row.children('td').each(function () {
			if(this.innerHTML != ""){
				this.innerHTML = this.innerHTML.replace(current_length, current_length + 1);
			}
		});

		$('#dynamic-table').append(new_row);
		current_length = current_length + 1;
	});
});
</script>
<?php $this->end();?>

