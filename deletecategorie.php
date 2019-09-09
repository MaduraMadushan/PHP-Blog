<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php
if (isset($_GET["id"])) {
	$IdFromURL=$_GET["id"];
	$Connection;
		$Query = "DELETE FROM category WHERE id='$IdFromURL'";
		$Execute = mysqli_query($Connection,$Query);
		if ($Execute) {
			$_SESSION["SuccessMessage"] = "category delete Successfully";
			Redirect_to("categories.php");

		}else{
			$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again";
			Redirect_to("categories.php");
		}
}
?>

