<?php
include_once ("include/Functions.php");
include_once ("include/dbconnect.php");
?>
<html>

<head>
<title>My Story Registration</title>
<link rel="stylesheet" type="text/css" href="story.css">
</head>

<body>
<?php
        include_once ("menu.php");
        ?>
<h1>Registration</h1>

  <div class="mystory">
  <form name="registration_form" method="POST" action="register.php">
  <table border="0" cellpadding="2" id="Registration_Table">
    <tr>
      <td>Pen Name <i>(nom de plume)</i></td>
      <td><input type="text" name="frmnomdeplume" size="20" value="<?=$_REQUEST['frmnomdeplume']?>"></td>
		<? if ($_REQUEST['btnRegister'] > "") {
      			if (strlen($_REQUEST['frmnomdeplume']) < 3) { ?>
      				<td class="error">Pen name must be longer than three characters</td>
      		<? 	$ErrorFlag = 1;
      			} //end if ?>
		<? } // end if ?>
    </tr>
    <tr>
      <td>Email Address</td>
      <td><input type="text" name="frmEmailAddress" size="41" value="<?=$_REQUEST['frmEmailAddress']?>"></td>
      <? if ($_REQUEST['btnRegister'] > "") {
      			if (strlen($_REQUEST['frmEmailAddress']) < 5) { ?>
      				<td class="error">Invalid Email Address</td>
      		<? 	$ErrorFlag = 1;
      			} // end if ?>
		<? } // end if ?>
    </tr>
    <tr>
      <td>Public Email Address</td>
      <td><input type="text" name="frmPublicEmailAddress" size="41" value="<?=$_REQUEST['frmPublicEmailAddress']?>"></td>
            <? if ($_REQUEST['btnRegister'] > "") {
      			if (strlen($_REQUEST['frmPublicEmailAddress']) < 5) { ?>
      				<td class="error">Invalid Email Address</td>
      		<? 	$ErrorFlag = 1;
      			} // End If ?>
		<? } // End If ?>
    </tr>
    <tr>
      <td>About You</td>
      <td><textarea rows="8" name="frmAbout" cols="75"><?=$_REQUEST['frmAbout']?></textarea></td>
            <? if ($_REQUEST['btnRegister'] > "") {
      			if (strlen($_REQUEST['frmAbout']) < 40) { ?>
      				<td class="error">You need to write SOMETHING about yourself...</td>
      		<? 	$ErrorFlag = 1;
      			} // End If ?>
		<? } // End If ?>
    </tr>
    <tr>
      <td>Username</td>
      <td><input type="text" name="frmUserName" size="20"  value="<?=$_REQUEST['frmUserName']?>"></td>
      <? if ($_REQUEST['btnRegister'] > "") {
      			$tmpUserName=$_REQUEST['frmUserName'];
      			$ValidUsername=CheckValidUserName($tmpUserName);
      			if  ($ValidUsername == false) {
      				$ErrorFlag=1;
      				?><td class="error"><font color="Red">User name already in Use. Please select Another</font></td><?
      			}else{
      				?><td class="copy"><font color="Blue">User name Approved</blue></td><?
      			} //End If 					
      			if (strlen($_REQUEST['frmUserName']) < 4) { ?>
      				<td class="error">Username too short</td>
      		<? 	$ErrorFlag = 1;
      			} // End If ?>
		<? } // End If ?>
    </tr>
    <tr>
      <td>Password</td>
      <td><input type="password" name="frmPassword" size="20"  value="<?=$_REQUEST['frmPassword']?>"></td>
            <? if ($_REQUEST['btnRegister'] > "") {
      			if (strlen($_REQUEST['frmPassword']) < 4) { ?>
      				<td class="error">Password too short</td>
      		<? 	$ErrorFlag = 1;
      			} // End If ?>
		<? } // End If ?>
    </tr>
  </table>
  <p><input type="submit" value="Register" name="btnRegister"></p>
</form>
</div>
<?
if ($_REQUEST['btnRegister'] > "") {
	If ($ErrorFlag==0) {
		// Update Fields
		
		//szUpdate= "Update Author Set Author_nondeplume = '" & $_REQUEST['frmnomdeplume'] & ', Author_Email='" & $_REQUEST['frmEmailAddress'] & "', Author_Public_Email='" & $_REQUEST['frmPublicEmailAddress'] & "', Author_About='" & $_REQUEST['frmAbout'] & "', Author_Password='" & $_REQUEST['frmPassword'] & "', Author_Username='" & $_REQUEST['frmUserName'] & "', Author_Date_Joined='" & GetDateNow(now) & "' where idAuthor=xxxx""
		$szInsert = "Insert INTO Author ";
		$szInsert .= "(Author_nondeplume, Author_Email, Author_Public_Email, Author_About, Author_Password, Author_Username,  Author_Date_Joined) ";
		$szInsert .= "VALUES ";
		$szInsert .= "('" . $_REQUEST['frmnomdeplume'] . "','" . $_REQUEST['frmEmailAddress'] . "', '" . $_REQUEST['frmPublicEmailAddress'] . "', '" . $_REQUEST['frmAbout'] . "', '" . $_REQUEST['frmPassword'] . "', '" . $_REQUEST['frmUserName'] . "', Now())";
 $Insert_Result = mysql_query($szInsert) or die(mysql_error());   	
?>
	<h3>No Errors</h3>
    <p>You have been registered. Please <a href="login.php">log in</a> and use the site.</p>
    
<?}	else {?>
	<h3>Errors found: Not updated</h3>
	<p>Please try again, fixing the issues listed. Thank you.</p>
<?	} // end if
} //end If
	  
?> 
 <?php
        include_once ("footer.php");
        ?>
</body>

</html>