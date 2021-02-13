<?php
include_once ("auth.php");
include_once ("include/Functions.php");
include_once ("include/dbconnect.php");
?>
<html>
    <head>
        <title>List Authors</title>
        <link rel="stylesheet" type="text/css" href="story.css">
    </head>
    <body>
        <?php
        include_once ("menu.php");
        ?>
        <h1>Author List</h1>
        <div align="center">
            <table border="1">
            <tr>
            <th>
            Author Name</a>
        </th>
        <th>
            Num Stories
        </th>
    </tr>
    <?    $query="Select * from Author order by Author_nondeplume;";
	$result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
    $rowcount = mysql_num_rows($result);
    $TotRecords = $rowcount;
	while($authorRS = mysql_fetch_array($result)){
    $NumStories=GetNumStories($authorRS['idAuthor']);
    //if ($NumStories > 0) { ?>
<tr>
    <td>
        <a href="author.php?AuthorID=<?=$authorRS['idAuthor']?>"><?=$authorRS['Author_nondeplume']?></a>&nbsp;
    </td>
    <td>
        <?=$NumStories?>&nbsp;
    </td>
    </tr>
    <?    //} //end if
    } //loop
?>
</table>
</div>
<?php
include_once ("footer.php");
?>
</body>
</html>
