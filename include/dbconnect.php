<?php
// Online MySql
// $link=mysql_connect("sql1.nur4.host-h.net", "justdo","shiya30") or
//	die ("Could not connect to database");
// mysql_select_db("story_db") or
//	die ("Could not select database");
?>
<?php
// Establish Database Connection

class DB extends SQLite3
{
        function __construct( $file )
        {
            $this->open( $file );
        }
}

$link = new DB('./myStory.db');
if(!$link){
    echo "<h1>" . $links->lastErrorMsg() . "</h1>";
 } else {
    // echo "<h1>Opened database successfully</h1>\n";
 }
?>