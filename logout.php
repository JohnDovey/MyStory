<?php
include_once ("include/Functions.php");
include_once ("include/dbconnect.php");
setcookie("AuthorID", "", "1970-01-01");
setcookie("UserName", "", "1970-01-01");
setcookie("UserPassword", "", "1970-01-01");
header("Location: index.php");
?>
<html>
    <head>
        <title>Log Out</title>
    </head>
    <body>
    	<h1>Log Out</h1>
    	<?php
include_once ("footer.php");
?>
    </body>
</html>
