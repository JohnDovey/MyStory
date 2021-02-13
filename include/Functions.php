<?php
/* Include this file with the command
 <php include_once ("Functions.php");
?>
John Dovey (john@justdone.co.za)
26 February 2009-2010 */ 

function GetCgiValue($CgiKey) {
    $NewCGIValue = 1;
    if (strlen($_REQUEST['$CgiKey']) > 0) {
        $NewCGIValue = $_REQUEST['CgiKey'];
    }
    return $NewCGIValue;
}
function GetAuthorName2($myidAuthor) {
    $query = "Select * from Author where idAuthor =".$myidAuthor;
    $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
    $rowcount = mysql_num_rows($result);
    $TotRecords = $rowcount;
    if ($TotRecords > 0) {
        $row = mysql_fetch_array($result);
        $GetAuthorName = "No Such Author";
    } else {
        $GetAuthorName = $row['Author_nondeplume'];
    } //end if
    return ($GetAuthorName);
}
function GetAuthorName($myidAuthor) {
    if ($myidAuthor < 1) {
        $GetAuthorName = "#";
        return ($GetAuthorName);
        exit;
    } // end if
    $query = "Select * from Author where idAuthor=".$myidAuthor;
    $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
    $rowcount = mysql_num_rows($result);
    $TotRecords = $rowcount;
    if ($TotRecords > 0) {
        $row = mysql_fetch_array($result);
        $GetAuthorName = $row['Author_nondeplume'];
    } else {
        $GetAuthorName = "##";
    } //end if
    return ($GetAuthorName);
}
function CheckValidUserName($myUserName) {
    if (strlen(trim($myUserName)) < 3) {
        $CheckValidUserName = False;
        return ($CheckValidUserName);
        exit;
    } //end if
    $query = "Select Author_UserName from Author where Author_UserName = '".trim($myUserName)."'";
    $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
    $rowcount = mysql_num_rows($result);
    $TotRecords = $rowcount;
    if ($TotRecords > 0) {
        $CheckValidUserName = False;
    } else {
        $CheckValidUserName = True;
    } //end if
    return ($CheckValidUserName);
}
function GetStoryTitle($myidStory) {
    if ($myidStory < 1) {
        $GetStoryTitle = "#No Title#";
        return ($GetStoryTitle);
        exit;
    } // End if
    $query = "Select * from Story where idStory=".$myidStory;
    $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
    $rowcount = mysql_num_rows($result);
    $TotRecords = $rowcount;
    if ($TotRecords > 0) {
        $row = mysql_fetch_array($result);
        $GetStoryTitle = $row['Story_Title'];
    } else {
        $GetStoryTitle = "##";
    } //end if
    return ($GetStoryTitle);
}
//Breadcrumb function to enable navigation
function BreadCrumb($myAuthorID, $myStoryID, $myChapterID) {
    $BreadCrumb = "-";
    if ($myChapterID > 0) {
        $ChapterID = $myChapterID;
        // Get Story when I have Chapter
        $query = "Select * from Chapter_Story where idChapter=".$myChapterID;
        $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
        $rowcount = mysql_num_rows($result);
        $TotRecords = $rowcount;
        if ($TotRecords > 0) {
            $row = mysql_fetch_array($result);
            $StoryID = $row['idStory'];
            $ChapterNum = $row['Chapter_Num'];
        } else {
            $StoryID = "0";
        } // end if
        //Get Author when I have Story
        $query = "Select * from Author_Story where idStory=".$StoryID;
        $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
        $rowcount = mysql_num_rows($result);
        $TotRecords = $rowcount;
        if ($TotRecords > 0) {
            $row = mysql_fetch_array($result);
            $AuthorID = $row['idAuthor'];
        } else {
            $AuthorID = "0";
        } //end if
    } else {
        $myChapterID = 0;
    } // end if
    if ($myStoryID > 0) {
        $StoryID = $myStoryID;
        // Get Author when I have Story
        $query = "Select * from Author_Story where idStory=".$myStoryID;
        $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
        $rowcount = mysql_num_rows($result);
        $TotRecords = $rowcount;
        if ($TotRecords > 0) {
            $row = mysql_fetch_array($result);
            $AuthorID = $row['idAuthor'];
        } else {
            $AuthorID = "0";
        } // end if
        //Get Chapter when I have Story
        $query = "Select * from Chapter_Story where idStory=".$myStoryID;
        $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
        $rowcount = mysql_num_rows($result);
        $TotRecords = $rowcount;
        if ($TotRecords > 0) {
            $row = mysql_fetch_array($result);
            $ChapterID = $row['idChapter'];
        } else {
            $ChapterID = "0";
        } //end if
    } else {
        $myStoryID = 0;
    } //end if
    if ($myAuthorID > 0) {
        //Get Story when I have Author
        $query = "Select * from Author_Story where idAuthor=".$myAuthorID;
        $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
        $rowcount = mysql_num_rows($result);
        $TotRecords = $rowcount;
        if ($TotRecords > 0) {
            $row = mysql_fetch_array($result);
            $StoryID = $row['idStory'];
        } else {
            $StoryID = "0";
        } // end if
        //Get Chapter when I have Story
        $query = "Select * from Chapter_Story where idStory=".$myStoryID;
        $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
        $rowcount = mysql_num_rows($result);
        $TotRecords = $rowcount;
        if ($TotRecords > 0) {
            $row = mysql_fetch_array($result);
            $ChapterID = $row['idChapter'];
        } else {
            $ChapterID = "0";
        } //end if
    } else {
        $myAuthorID = 0;
    } //end if
    
?>
<div>
    <h5 class="top-header"><a href="../index.php">Home</a> - <a href="author.php?AuthorID=<?=$AuthorID?>">
            <?= GetAuthorName($AuthorID)?>
        </a>- <a href="story.php?StoryID=<?=$StoryID?>">
            <?= GetStoryTitle($StoryID)?>
        </a>- 
        <?= GetChapterTitle($ChapterID)?>
    </h5>
</div>
<?php
} // End function
?>
<?php
function GetChapterTitle($myidChapter) {
    if ($myidChapter < 1) {
        $GetChapterTitle = "# Invalid Chapter ID #";
        return $GetChapterTitle;
        exit;
    } // end if
    $query = "Select * from Chapter where idChapter=".$myidChapter;
    $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
    $rowcount = mysql_num_rows($result);
    $TotRecords = $rowcount;
    if ($TotRecords > 0) {
        $row = mysql_fetch_array($result);
        $ChTitle = $row['Chapter_Number']." : ".$row['Chapter_Title'];
        $GetChapterTitle = $ChTitle;
    } else {
        $GetChapterTitle = "#No Title#";
    } // end if
    return $GetChapterTitle;
}
?>
<?php
function GetStoryComplete($myidStory) {
    if ($myidStory < 1) {
        $GetStoryComplete = "#";
        return ($GetStoryComplete);
        exit;
    } // end if
    $query = "Select * from Story where idStory=".$myidStory;
    $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
    $rowcount = mysql_num_rows($result);
    $TotRecords = $rowcount;
    if ($TotRecords > 0) {
        $row = mysql_fetch_array($result);
        $StoryComplete = $row['Story_Complete'];
        If ($row['Story_Complete']) {
            $StryComplete = "The End";
        } else {
            $StryComplete = "To be continued";
        } //end if
        $GetStoryComplete = $StryComplete;
    } else {
        $GetStoryComplete = "##";
    } // end if
    return ($GetStoryComplete);
}
?>
<?php
function GetNumStories($myidAuthor) {
    $query = "Select * from Author_Story where idAuthor =".$myidAuthor;
    $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
    $GetNumStories = mysql_num_rows($result);
    return $GetNumStories;
}
?>
<?php
function GetChapterAccessCount($myidChapter) {
    $query = "Select * from Chapter where idChapter =".$myidChapter;
    $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
    $rowcount = mysql_num_rows($result);
    $TotRecords = $rowcount;
    if ($TotRecords > 0) {
        $row = mysql_fetch_array($result);
        $GetChapterAccessCount = $row['Chapter_Access_Count'];
    } else {
        $GetChapterAccessCount = 0;
    } // End If
    return ($GetChapterAccessCount);
}
?>
<?php
// Update Chapter Count
function Update_Chapter_Count($myChapterID) {
    $query = "select * from Chapter where idChapter=".$myChapterID;
    $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
    $row = mysql_fetch_array($result);
    $szCount = $row['Chapter_Access_Count']+1;
    $szUpdate = "Update Chapter Set Chapter_Access_Count = ".$szCount." Where idChapter=".$myChapterID;
    $Insert_Result = mysql_query($szUpdate) or die(mysql_error());
} // End Function
?>
<?php
function GetAuthorAccessCount($myidAuthor) {
    $query = "Select * from Author where idAuthor =".$myidAuthor;
    $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
    $row = mysql_fetch_array($result);
    $GetAuthorAccessCount = $row['Author_Access_Count'];
	return $GetAuthorAccessCount;
} //   End function
?>
<?php
//Update Author Page Count
function Update_Author_Count($myAuthorID) {
    $query = "select * from Author where idAuthor=".$myAuthorID;
	$result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
	$row = mysql_fetch_array($result);
    $szCount = $row['Author_Access_Count']+1;
    $szUpdate = "Update Author Set Author_Access_Count = ".$szCount." Where idAuthor=".$myAuthorID;
    $Insert_Result = mysql_query($szUpdate) or die(mysql_error());
	return $szCount;
} // End Function
?>
<?php
function GetStoryAccessCount($myidStory) {
    $query = "Select * from Story where idStory =".$myidStory;
    $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
    $row = mysql_fetch_array($result);
    $GetStoryAccessCount = $row['Story_Access_Count'];
    return ($GetStoryAccessCount);
} //    End function
?>
<?php
// Update Story Page Count
function Update_Story_Count($myStoryID) {
    $query = "select * from Story where idStory=".$myStoryID;
//	echo "Debug:" . $query;
	$result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
	$row = mysql_fetch_array($result);
    $szCount = $row['Story_Access_Count']+1;
    $szUpdate = "Update Story Set Story_Access_Count = ".$szCount." Where idStory=".$myStoryID;
    $Insert_Result = mysql_query($szUpdate) or die(mysql_error());
} // End Function
?>
<?php
function CountStories($myPersonNumber) {
    $query = "select * from rohstory where personNumber =".$myPersonNumber;
    $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
    $CountStories = $mysql_num_rows($result);
    return ($CountStories);
} //End function
?>
<?php
function PageCount($PageTitle) {
    $SQL = "SELECT * FROM pagecount WHERE pagename='".$PageTitle."'; ";
    $query = $SQL;
    $result = mysql_query($query) or die('<h3>Query failed: '.mysql_error().'</h3>');
    $rowcount = mysql_num_rows($result);
    if (($rowcount) < 1) {
        $pagecount = 1;
        $InsertQuery = "INSERT INTO pagecount (pagename, pagecount, lastdate)
                     VALUES ('$PageTitle', '$pagecount',  NOW())";
        $Insert_Result = mysql_query($InsertQuery) or die(mysql_error());
    } Else {
        $row = mysql_fetch_array($result);
        $pagecount = $row['pagecount'] + 1;
        $InsertQuery = "Update pagecount set pagename = '".$PageTitle."', pagecount = '".$pagecount."',  lastdate = NOW() where ID=".$row['ID'].";";
        $Insert_Result = mysql_query($InsertQuery) or die(mysql_error());
    }
    return $pagecount;
}
?>
<?php
function CalcActualAge($DOB) {
    list($year, $month, $day) = explode("-", $DOB);
    $year_diff = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff = date("d") - $day;
    if ($month_diff < 0)
        $year_diff--;
    elseif (($month_diff == 0) && ($day_diff < 0))
        $year_diff--;
    return $year_diff;
} //End function
?>
<?php
function MakeNotNull($MyField) {
    If (!is_Null($MyField)) {
        return $MyField;
    } else {
        return " ";
    } //end if
} //End function
?>
<?
function GetYesNo($InBool) {
    if ($InBool == 1) {
        return "Yes";
    } else {
        return "No";
    } // end if
} //end Function
?>
