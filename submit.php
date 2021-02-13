<?php
include_once ("auth.php");
include_once ("include/Functions.php");
include_once ("include/dbconnect.php");
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<?php
$LogAuthorID=$_REQUEST['AuthorID'];
if ($LogAuthorID < 1) {
	header ("Location: list_authors.php"); // Stop direct access.
} // End if
$AuthorName=GetAuthorName($LogAuthorID);
?>
<title>New Submission by <?=$AuthorName?></title>
<link rel="stylesheet" type="text/css" href="story.css">
</head>

<body>
<?php
        include_once ("menu.php");
        ?>
<h2>New Submission</h2>
<ul>
<li><a href="submit_new_story.php">New Story</a></li>
<li>
<% 
%>
<a href="submit_new_chapter.php">New Chapter</a></li>
</ul>
<?php
        include_once ("footer.php");
        ?>
</body>

</html>