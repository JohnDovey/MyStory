<?php
// include_once ("include/Functions.php");
include_once ("include/dbconnect.php");
?>
<?
function alertAndRedirect() {
    
?>
<script>
    <!--
    alert("You could not be logged in. Please ensure your password and user name are correct! Then try again.");
    location.href = "index.php";
    // -->
</script>
<?
} // End function

	setcookie("AuthorID", "");
	$UserName=$_REQUEST['Username'];
	$UserPassword=$_REQUEST['UserPassword'];
    //$query = "Select * from Author where Author_Username='" . $UserName . "'";
	$query = "SELECT * FROM `Author` WHERE `Author_Username` = '$UserName'";
	$result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
	$TotRecords = mysql_num_rows($result);
	$row=$authorRS = mysql_fetch_array($result);
	
    if ($TotRecords > 0) {
        	setcookie("AuthorID",$row['idAuthor']);
			setcookie("UserName", $row['Author_UserName']);
			setcookie("UserPassword", $row['Author_Password']);
			$szUpdate = "Update Author Set Author_Last_Login = '" . date("r") . "' Where idAuthor=" . $row['idAuthor'];
			$Insert_Result = mysql_query($szUpdate) or die(mysql_error());
        	$RedirectURL="/story/index.php";
    		// if ($_REQUEST['SourcePage'] !=""){
    		//	$RedirectURL=$_REQUEST['SourcePage'];
    		// } // end if
    		header("Location: " .$RedirectURL); 
        } else {
        	 alertAndRedirect();
			//echo "<h1>Debug</h1>";
			//echo "<p>Author_Username: ". $UserName;
			//echo "<p> Tot Records = " . $TotRecords; 
			//echo "<p> Result: ";
			//print_r( $result );
        } // end if
?>
<html>
    <head>
        <title>User Login</title>
    </head>
    <body>
        <?php
        include_once ("footer.php");
        ?>
    </body>
</html>
