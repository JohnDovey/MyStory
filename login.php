<?php
include_once ("include/Functions.php");
include_once ("include/dbconnect.php");
?>
<html>
    <head>
        <title>My Story Login</title>
        <link rel="stylesheet" type="text/css" href="story.css">
    </head>
    <body>
        <?php
        $LogAuthorID = 0;
        $LogAuthorID = $_COOKIE['AuthorID'];
        $Thispage = "http://".$_REQUEST['CGI_SCRIPT'];
        if ($LogAuthorID == "") {
            
        ?>
        <table>
            <tr>
                <td>
                    You are not logged in.
                </td>
            </tr>
            <form method="POST" action="auth_login.php">
                <tr>
                    <td>
                        Username
                    </td>
                    <td>
                        <input type="text" name="Username" size="20" value="<?=$_REQUEST['Username']?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Password
                    </td>
                    <td>
                        <input type="password" name="UserPassword" size="20" value="<?=$_COOKIE['UserPassword']?>"><input type="submit" value="Login" name="btnLogin">
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
                <? } //End If ?>
                <?php
                include_once ("footer.php");
                ?>
            </body>
            </html>
