<?php
header_remove();
function notify()
{
	if (isset($_GET['t'])) {
		$Type = $_GET['t'];
		$Msg = $_GET['m'];
		$Txt = $_GET['a']; ?>
<div class="alert alert-<?php echo $Type; ?> alert-dismissible " role="alert" id="MsgArea">
	<button type="button" class="close" onclick="remove_msg()" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<strong><?php echo $Msg; ?> : </strong> <?php echo $Txt; ?>
</div>
<?php
	} else {
	}
}
function notification()
{
	if (isset($_GET['t'])) {
		$Type = $_GET['t'];
		$Msg = $_GET['m'];
		$Txt = $_GET['a']; ?>
<div class="alert alert-<?php echo $Type; ?> alert-dismissible text-white" role="alert" id="MsgArea">
	<button type="button" class="close" onclick="remove_msg()" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<strong><?php echo $Msg; ?> : </strong> <?php echo $Txt; ?>
</div>
<?php
	} elseif (isset($_GET['msg']) or isset($_GET['err'])) {
	if (isset($_GET['msg'])) {
		$MSGTYPE = "alert-info";
		$NOTE = "Notification";
		} else {
		$MSGTYPE = "alert-danger";
		$NOTE = "Failed";
	} ?>
<div class="alert <?php echo $MSGTYPE;?> alert-dismissible text-white" role="alert" id="MsgArea">
	<button type="button" class="close" onclick="remove_msg()" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<strong><?php echo $NOTE;?> :</strong>
	<?php if (isset($_GET['msg'])) {
		echo $_GET['msg'];
		} else {
		echo $_GET['err'];
	} ?>
</div>
<?php }
}
function message($Type, $Msg, $Txt)
{ ?>
<div class="alert alert-<?php echo $Type; ?> alert-dismissible text-white" role="alert" style='color:white;' id="MsgArea">
	<button type="button" class="close" onclick="remove_msg()" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<strong><?php echo $Msg; ?> : </strong> <?php echo $Txt; ?>
</div>
<?php
}
?>

<script>
setTimeout(function() {
	$("#MsgArea").fadeOut("slow");
}, 2500); // <-- time in milliseconds
</script>
