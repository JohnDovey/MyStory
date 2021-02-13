<?php
include_once ("auth.php");
include_once ("include/Functions.php");
include_once ("include/dbconnect.php");
?>
<html>
    <head>
        <?
        $AuthorID = $_REQUEST['AuthorID'];
        if ($AuthorID < 1) {
            header("Location: list_authors.php"); //Stop direct access.
        }
        $AuthorName = GetAuthorName($AuthorID);
        $dummyBreadcrumb = BreadCrumb($AuthorID, 0, 0);
        ?>
        <title>Stories by 
            <?= $AuthorName?>
        </title>
        <link rel="stylesheet" type="text/css" href="story.css">
    </head>
    <body>
        <?php
        include_once ("menu.php");
        ?>
        <h2>Author Info</h2>
        <?php
        $query = "Select * from Author where idAuthor=".$AuthorID;
        $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
        $rowcount = mysql_num_rows($result);
        $TotRecords = $rowcount;
        while ($authorRS = mysql_fetch_array($result)) {
            
        ?>
        <h3>
            <?= $authorRS['Author_nondeplume']?>
        </h3>
        <div class="notice" align="center" style="width:75%;text-align:justify;margin-right:auto;margin-left:auto">
            <?= $authorRS['Author_About']?>
        </div>
        <table>
            <tr>
                <td>
                    Date Joined
                </td>
                <td>
                    <?= $authorRS['Author_Date_Joined']?>
                </td>
            </tr>
            <tr>
                <td>
                    Public Email
                </td>
                <td>
                    <a href="Mailto:<?=$authorRS['Author_Public_Email']?>">
                        <?= $authorRS['Author_Public_Email']?>
                    </a>
                </td>
            </tr>
        </table>
        <ul>
            <?php
            //$query = "Select * from Author_Story where idAuthor=".$AuthorID;
            //$result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
            //while ($AuthorStoryRS = mysql_fetch_array($result)) {
                $query = "Select * from Story where idAuthor=".$AuthorID;
                $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
                while ($StoryRS = mysql_fetch_array($result)) {
                    
            ?>
            <li>
                <div class="notice">
                    <a href="story.php?StoryID=<?=$StoryRS['idStory']?>">
                        <?= $StoryRS['Story_Title']?>
                    </a>
                    <br>
                    <p>
                        <?= $StoryRS['Story_Description']?>
                    </p>
                </div>
            </li>
            <? } // StoryRS loop
                                                
              //              } //AuthorStoryRS loop
                           $count_author_access= Update_Author_Count($AuthorID);
                        
            ?>
        </ul>
        <h5 class="end">Author's Page has been accessed 
            <?= GetAuthorAccessCount($AuthorID)?>
            times</h5>
        <?
        } // authorRS loop
        ?>
        </ul>
        <?php
        $LogAuthorID = $_COOKIE['AuthorID'];
        If ($LogAuthorID = $AuthorID) {
            
        ?>
        <hr><h3>Stats</h3>
        <div align="center">
            <table class="bor">
                <tr>
                    <td>
                        Author Page
                    </td>
                    <td>
                        <?= GetAuthorAccessCount($LogAuthorID)?>
                    </td>
                </tr>
                <?
                $query = "Select * from Story where idAuthor=".$LogAuthorID." order by Story_Access_Count Desc;";
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
                        <?= $StoryRS['Story_Access_Count']?>
                        &nbsp;
                    </td>
                </tr>
                <?
                } //StoryRS loop
                ?>
            </table>
        </div>
        <a href="submit.php">New Submission</a>
        <?
        } // End If
        ?>
        <?php
        include_once ("footer.php");
        ?>
    </body>
</html>
