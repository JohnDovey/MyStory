<!-- Start Menu -->
<link rel="stylesheet" type="text/css" href="jq/jqueryslidemenu.css">
<!--[if lte IE 7]>
    <style type="text/css">
    html .jqueryslidemenu{height: 1%;} /*Holly Hack for IE7 and below*/
    </style>
<![endif]-->
<script type="text/javascript" src="jq/jquery-1.3.2.min.js">
</script>
<script type="text/javascript" src="jq/jqueryslidemenu.js">
</script>
<script type="text/javascript" src="jq/jquery.lightbox-0.5.pack.js">
</script>
<div id="myslidemenu" class="jqueryslidemenu" align="center">
    <ul>
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="list_authors.php">Author List</a>
        </li>
        <li>
            <a href="list_stories.php">Story List</a>
        </li>
        <? 
		$ProfileAuthorID=$_COOKIE['AuthorID'];
        if ($ProfileAuthorID < 1){
        }else{ ?>
        <li>
            <a href="author.php?AuthorID=<?=$ProfileAuthorID?>">Profile</a>
        </li>
        <?php } // end if ?>
    </ul>
    <br style="clear: left"/>
</div>
<!-- End Menu -->
<!-- REST OF BODY CONTENT BELOW HERE -->
