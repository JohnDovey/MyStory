<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<?php
include_once ("auth.php");
include_once ("include/Functions.php");
include_once ("include/dbconnect.php");
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="story.css">
        <?php
        $LogAuthorID = $_REQUEST['AuthorID'];
        if ($LogAuthorID < 1) {
            header("Location: list_authors.php"); // Stop direct access.
        } // End if
        $AuthorName = GetAuthorName($LogAuthorID);
        ?>
        <title>New Submission by 
            <?= $AuthorName?>
        </title>
		<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
mode : "textareas",
theme : "advanced",
plugins : "safari,spellchecker,pagebreak,style,table,save,advhr,advimage,advlink,emotions,iespell,popups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",
// Theme options
theme_advanced_buttons1 : "save,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,advhr,|,print,|,ltr,|,fullscreen",
theme_advanced_buttons4 : "moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,blockquote",
theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
theme_advanced_statusbar_location : "bottom",
theme_advanced_resizing : true,
});
</script>
    </head>
    <body>
        <?php
        include_once ("menu.php");
        ?>
        <form action="<?=$_SERVER['SCRIPT_NAME']?>" method= "POST" accept-charset="utf-8">
            <table border="1" summary="Add the Meta Information for a new Story">
                <caption align="top">
                    <h2>New Story</h2>
                </caption>
                <tr>
                    <td>
                        Author
                    </td>
                    <td>
                        <a href="author.php?AuthorID=<?=$AuthorID?>">
                            <?= $AuthorName?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Title 
                    </td>
                    <td>
                        <input type="text" name="StoryTitle" value="<?$_REQUEST['StoryTitle']?>" size="85">
                    </td>
                </tr>
                <tr>
                    <td>
                        Description
                    </td>
                    <td>
                        <textarea rows="8" name="StoryDescription" cols="75">
                            <?$_REQUEST['StoryDescription']?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="AuthorID" value="<?=$_COOKIE['AuthorID']?>"><input type="submit" value="Continue">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        include_once ("footer.php");
        ?>
    </body>
</html>