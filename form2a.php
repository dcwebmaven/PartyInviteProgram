<?php
require($_SERVER['DOCUMENT_ROOT']."/template_top.inc"); 

if ($_GET['error'] == "1") {
	$error_code = 1;  //this means that there's been an error and we need to notify the customer
}

?>
<body>
<h3>Happenings Event Facilitator</h3>
<? if ($error_code) {
	echo "<font color=red>Please help us with the following:</font>";
} ?>
<form method=GET action="process2a.php">
<table>
<tr>
<td align="right">
Event Title:
</td>
<td align="left">
<input type="text" size="50" max="50" name="subject" value="<? echo $_GET['subject']; ?>">
<?
if ($error_code && !($_GET['subject'])) {
   echo "<b>Please add a subject for your request.</b>";
}
?>
<br/>

<?php
$i=1;
for ($i; $i<=10; $i++){ ?>

	<tr>
		<td align="right">Invitee Name:</td>
		<td align="left">
			<input type="text" size="25" name="name[]" value="">
			<? if ($error_code && !($_GET['name'])) { echo "<b>Please fill in a name for us.</b>"; } ?>
		</td>
	</tr>
	<tr>
		<td align="right">Email:</td><td align="left">
		<input type="text" size="25" name="email[]" value="">
		
	</td>
	</tr>
<? } ?>
	<tr>
		<td colspan="2" align="center">
			<input type="submit" value="SUBMIT">
		</td>
	</tr>
</table>
</form>

<? require($_SERVER['DOCUMENT_ROOT']."/template_bottom.inc"); ?>
</body>
