<?php

if (is_numeric ($GET[‘pid’])) {

require_once (‘../mysql_connect.php’);

$query = “SELECT * FROM artists, prints WHERE artists.artist_id = prints.artist_id AND

prints.print_id = {$_GET[‘pid’]}”;

$result = mysql_QUERY ($QUERY);

$row = mysql_fetch_array ($result, MYSQL_ASSOC);

mysql_close();

$page_title = $row[‘print_name’];

include_once (‘includes/header.html’);

echo “<div align=\”center\”>

<b>{$row[‘first_name’]} {$row[‘middle_name’]} {$row[‘last_name’]}

<br />{$row[‘size’]}

<br />\${$row[‘price’]}

<a href=\”add_cart.php?pid={$row[‘print_id’]}\”>Add to Cart</a>

</div><br />”;

if ($image = @getimagesize (“../uploads/{$rwo[‘image_name’]}”)) {

echo “<div align=\”center\”><img src=\”../uploads/{$row[‘image_name’]}\” $image[3] alt=\”{$row[‘print_name’]}\” />”;

} else {

echo “<div align=\”center\”>No image available.”;

}

echo ‘<br />’ . stripslashes($row[‘description’]) . ‘<div’;

include_once (‘includes/footer.html’);

} else {

header (“Location: http://” . $_SERVER[‘HTTP_HOST’] . dirname($_SERVER[‘PHP_SELF’]) . “/index.php”);

exit();

}

?>