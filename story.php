<?php
$StoryID = $_REQUEST['StoryID'];
if ($StoryID < 1) {
    header("Location:list_stories.php");
}
?>
<?php
include_once ("auth.php");
include_once ("include/Functions.php");
include_once ("include/dbconnect.php");
$StoryTitle = GetStoryTitle($StoryID);
$dummyBreadcrumb = BreadCrumb(0, $StoryID, 0);
?>
<html>
    <head>
        <title>
            <?= $StoryTitle?>
        </title>
        <link rel="stylesheet" type="text/css" href="story.css">
    </head>
    <body>
        <?php
        include_once ("menu.php");
        ?>
        <h2>
            <?= $StoryTitle?>
            by 
            <a href="author.php?AuthorID=<?=$AuthorID?>"><?= GetAuthorName($AuthorID)?></a>
        </h2>
        <?php
        $query = "Select * from Story where idStory=".$StoryID;
        $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
        $rowcount = mysql_num_rows($result);
        $TotRecords = $rowcount;
        while ($StoryRS = mysql_fetch_array($result)) {
            
        ?>
        <div class="notice">
            <p>
                <?= $StoryRS['Story_Description']?>
            </p>
        </div>
        <?
        } // StoryRS loop
        ?>
        <?php
        $query = "Select * from Chapter_Story where idStory=".$StoryID." Order by Chapter_Num";
        $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
        $rowcount = mysql_num_rows($result);
        $TotRecords = $rowcount;
        while ($ChapterStoryRS = mysql_fetch_array($result)) {
            
        ?>
        <ul>
            <?
            $query = "Select * from Chapter where idChapter=".$ChapterStoryRS['idChapter'];
            $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
            $rowcount = mysql_num_rows($result);
            $TotRecords = $rowcount;
            while ($ChapterRS = mysql_fetch_array($result)) {
                
            ?>
            <li>
                <a href="chapter.php?ChapterID=<?=$ChapterRS['idChapter']?>&StoryID=<?=$StoryID?>">Chapter 
                    <?= $ChapterRS['Chapter_Number']?>
                    &nbsp;
                    <?= $ChapterRS['Chapter_Title']?>
                </a>
            </li>
            <?
            } // ChapterRS loop
            ?>
        </ul>
        <? } // ChapterStoryRS loop
        Update_Story_Count($StoryID);
        ?>
        <h5 class="end">Story's Page has been accessed 
            <?= GetStoryAccessCount($StoryID)?>
            times</h5>
        <?php
        include_once ("footer.php");
        ?>
    </body>
</html>
