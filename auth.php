<?php
include_once ("include/Functions.php");
include_once ("include/dbconnect.php");
$LogAuthorID = 0;
$LogAuthorID = $_COOKIE['AuthorID'];
$Thispage = "http://".$_SERVER['SERVER_NAME'].$_SERVER['URL']."?".$_SERVER['QUERY_STRING'];
if ($LogAuthorID == "") {
    
?>
<table>
    <tr>
        <td>
            You are not logged in.
        </td>
        <form method="POST" action="auth_login.php">
            <td>
                Username <input type="text" name="Username" size="20" value="<?=$_COOKIE['Username']?>">Password <input type="password" name="UserPassword" size="20" value="<?=$_COOKIE['UserPassword']?>"><input type="submit" value="Login" name="btnLogin">
            </td><input type="hidden" Value="<?=$Thispage?>" name="SourcePage">
        </form>
        <td>
            or <a href="register.php">Register</a>
        </td>
    </tr>
</table>
<h3>You must register before you can read stories on this site!</h3>
<? } else { ?>
<p>
    You are logged in as : <a href="author.php?AuthorID=<?=$LogAuthorID?>" title="Click here to visit your profile page.">
        <?= GetAuthorName($LogAuthorID)?>
    </a>
    [<a href="logout.php">Log Out</a>]
</p>
<? } //End$NumStories If ?>
