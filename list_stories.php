<?php
include_once ("auth.php");
include_once ("include/Functions.php");
include_once ("include/dbconnect.php");
?>
<html>
    <head>
        <title>List of Stories</title>
        <link rel="stylesheet" type="text/css" href="story.css">
    </head>
    <body>
        <?php
        include_once ("menu.php");
        ?>
        <h1>Stories List</h1>
        <div align="center">
            <table border=".8" class=bor" style="background-color:#f5faff">
                <tr>
                <th>
                    Story Name
                </th>
                <th>
                Author Name</a>
            </th>
            <th>
                Description
            </th>
            <th>
                Downloads
            </th>
            </td>
        </tr>
        <?php
        $query = "Select * from Story order by Story_Title;";
        $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
        $rowcount = mysql_num_rows($result);
        $TotRecords = $rowcount;
        while ($StoryRS = mysql_fetch_array($result)) {
            
        ?>
        <tr>
            <td>
                <a href="story.php?StoryID=<?=$StoryRS['idStory']?>">
                    <?= $StoryRS['Story_Title']?>
                </a>&nbsp;
            </td>
            <td>
                <a href="author.php?AuthorID=<?=$StoryRS['idAuthor']?>">
                    <?= GetAuthorName($StoryRS['idAuthor'])?>
                </a>&nbsp;
            </td>
            <td>
                <?= $StoryRS['Story_Description']?>
                &nbsp;
            </td>
            <td style="text-align:right">
                <?= $StoryRS['Story_Access_Count']?>
                &nbsp;
            </td>
        </tr>
        <?
        } //loop
        ?>
        </table>
    </div>
    <?php
    include_once ("footer.php");
    ?>
    </body>
</html>
