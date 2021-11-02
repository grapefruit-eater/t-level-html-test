<?php

$page_title = ‘Browse the Prints’;

include_once (‘includes/header.html’);

require_once(‘,,/mysql_connect.php’);

if(isset($_GET[‘aid’])) {

query = “SELECT * FROM artists, prints WHERE artists.artist_id = prints.artist_id AND prints.artist_id = {$_GET[‘aid’]} ORDER BY prints.print_name”;

} else {

query = “SELECT * FROM artists, prints WHERE artists.artis_id = prints.artist_id ORDER BY artists.last_name ASC, prints.print_name ASC”;

}

echo ‘<table border=”0” width=”90%” cellspacing=”3” cellpadding=”3” align=”center”>

<tr>

<td align=”left” width=”20%”><b>Artist</td>

<td align=”left” width=”20%”><b>Print Name</td>

<td align=”left” width=”20%”><b>Description</td>

<td align=”left” width=”20%”><b>Price</td>

</tr>;

$result = mysql_query ($query);

while ($row = mysql_fetch_array ($result, MYSQL_ASSOC)) {

echo “ <tr>

<td align=\”left\”><a href=\”browse_prints.php?aid={$row[‘artist_id’]}\”>{$row[‘last_name]},{$row[‘first_name’]} {$row[‘middle_name’]}</a></td>

<td align=\”left\”><a href=\”view.print.php?pid={$row[‘print_id’]}\”>{$row[‘print_name]}</td>

<td align=\”left\”>” . stripslashes($row[‘description’]) . “</td>

<td align=\”right\”>\${$row[‘prince’]}</td>

</tr>\n”;

}

echo ‘</table>’;

mysql_close();

include_once (‘includes/footer.html’);

?>