<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php
if (isset($_GET["id"])) {
	$IdFromURL=$_GET["id"];
	$Connection;
		$Query = "DELETE FROM registration WHERE id='$IdFromURL'";
		$Execute = mysqli_query($Connection,$Query);
		if ($Execute) {
			$_SESSION["SuccessMessage"] = "Admin delete Successfully";
			Redirect_to("users.php");

		}else{
			$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again";
			Redirect_to("users.php");
		}
}
?>

