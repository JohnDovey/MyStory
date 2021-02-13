<?php
include_once ("auth.php");
include_once ("include/Functions.php");
include_once ("include/dbconnect.php");
?>
<html>
    <head>
        <?
        $StoryID = $_REQUEST['StoryID'];
        $StoryTitle = GetStoryTitle($StoryID);
        $ChapterID = $_REQUEST['ChapterID'];
        $ChapterTitle = GetChapterTitle($ChapterID);
        $dummyBreadcrumb = BreadCrumb(0, 0, $ChapterID);
        ?>
        <title>
            <?= $StoryTitle?>
            - Chapter 
            <?= $ChapterTitle?>
        </title>
        <link rel="stylesheet" type="text/css" href="story.css">
    </head>
    <body class="sol-story">
        <?php
        include_once ("menu.php");
        ?>
        <h1>
            <?= $StoryTitle?>
            - Chapter 
            <?= $ChapterTitle?>
        </h1>
        <?
        $query = "Select * from Chapter where idChapter=".$ChapterID;
        $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
        $rowcount = mysql_num_rows($result);
        $TotRecords = $rowcount;
        while ($ChapterRS = mysql_fetch_array($result)) {
            $ChapterNum=$ChapterRS['Chapter_Number'];
        ?>
        <div class="mystory">
            <?= $ChapterRS['Chapter_Content']?>
        </div>
        <table width="100%">
            <tr>
                <?
                //Get Prev Chapter for Navigation
                $ChapterPrev = $ChapterNum - 1;
                $query = "Select * from Chapter_Story where Chapter_Num=".$ChapterPrev." and idStory=".$StoryID;
                $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
                $rowcount = mysql_num_rows($result);
                $TotRecords = $rowcount;
                $tmp1FuncRS = mysql_fetch_array($result);
                if ($TotRecords > 0) {
                    
                ?>
                <?$NewChapterID = $tmp1FuncRS['idChapter']?>
                <td align="Left">
                    <a href="chapter.php?ChapterID=<?=$NewChapterID?>&StoryID=<?=$StoryID?>">
                        <?= GetChapterTitle($NewChapterID)?>
                    </a>&nbsp;
                </td>
                <? } else { ?>
                <td>
                    <div class="left">
                    	<p>First Chapter</p>
                    </div>
                </td>
                <?
                } // end if
                ?>
                <?
                //Get next Chapter for Navigation
                $ChapterNext = $ChapterNum + 1;
                $query = "Select * from Chapter_Story where Chapter_Num=".$ChapterNext." and idStory=".$StoryID;
                $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
                $rowcount = mysql_num_rows($result);
                $TotRecords = $rowcount;
                $tmp1FuncRS = mysql_fetch_array($result);
                if ($TotRecords > 0) {
                    
                ?>
                <?$NewChapterID = $tmp1FuncRS['idChapter']?>
                <td align="Left">
                    <a href="chapter.php?ChapterID=<?=$NewChapterID?>&StoryID=<?=$StoryID?>">
                        <?= GetChapterTitle($NewChapterID)?>
                    </a>&nbsp;
                </td>
                <? } else { ?>
                <td>
                    <div class="right">
                        <?= GetStoryComplete($StoryID)?>
                    </div>
                </td>
                <? } // end if                
                        Update_Chapter_Count($ChapterID);
                ?>
            </tr>
        </table>
        <h5 class="end">This Chapter has been accessed 
            <?= GetChapterAccessCount($ChapterID)?>
            times</h5>
        <?
        } // ChapterRS loop
        ?>
        <?php
        include_once ("footer.php");
        ?>
    </body>
</html>
