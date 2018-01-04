<script type="text-javascript" language="javascript">
function go(){
	box = document.forms[1].tide_drop;
	destination = box.options[box.selectedIndex].value;
	if (destination) location.href = destination;
}
</script>
<div class="tide_drop">
<form name="drop_down">
    <?php echo $data['drop_down']; ?>
</form>
</div>