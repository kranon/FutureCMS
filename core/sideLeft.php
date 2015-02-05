<?php
$result = mysqli_query("SELECT * FROM `page` WHERE `link`='LeftSideBar'");
while ($row = mysqli_fetch_array($result, MYSQL_BOTH)){
	echo $row['text_'.$lang];
}
?>