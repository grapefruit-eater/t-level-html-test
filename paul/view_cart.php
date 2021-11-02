<?php

$page_title = ‘View Your Shopping Cart’;

include_once (‘includes/header.html’);

if (isset ($_POST[‘submit’])) {

foreach ($_POST[‘qty’] as $key => $value) {

if (($value == 0) AND (is_numeric ($value) {

unset ($_SESSION[‘cart’][$key]) {

} elseif (is_numeric ($value) AND ($value > 0) ) {

$_SESSION[‘cart’}[$key] = $value;

}

}

}

$empty = TRUE;

if (isset ($_SESSION[‘cart’])) {

foreach ($_SESSION[‘cart’] as $key => $value) {

if (isset($value)) {

$empty = FALSE;

}

}

}

if (!$empty) {

require_once (‘../mysql_conect.php’);

$query = ‘SELECT * FROM artists, prints WHERE artists.artist_id = prints.artist_id AND

prints.print_id IN (‘;

foreach ($_SESSION[‘cart’] as $key => $value) {

$query .= $key . ‘,’;

}

$query = substr ($query, 0, -1) . ‘) ORDER BY artists.last_name ASC’;

$result = mysql_query ($query);

echo ‘<table border=”0” width=”90%” cellspacing=”3” align=”center”>

<tr>

<td align=”left” width=”30%”><b> Artist</b></td>

<td align=”left” width=”30%”><b>Print</b></td>

<td align=”right” width=”10%”><b>Price</b></td>

<td align=”center” width=”10%”></b>Qty</b></td>

<td align=”right” width=”10%”><b>Total</b></td>

</tr>

<form action=”view_cart.php” method=”post”>

‘;

$total = 0;

while ($row = mysql_fetch_array ($result, MYSQL_ASSOC)) {

$subtotal = $_SESSION[‘cart’][$row[‘print_id’]] * $row[‘price’];

$total += $subtotal;

echo “ <tr>

<td align=\”left\”>{$row[‘first_name’]} {$row[‘middle_name’]} {$row[‘last_name’]}</td>

<td align=\”left\”>{$row[‘print_name’]}</td>

<td align”\right\”>\${$row[‘price’]}</td>

<td align=\”center\”><input type=\”text\” size=\”3\” name=\”qty[{$row[‘print_id’]}]\” value=\”{$_SESSION[‘cart’][$row[‘print_id’]]}\” /></td>

<td align=\”right\”>$” . number_format ($subtotal, 2) . “</td>

</tr>\n”;

}

echo ‘ <tr>

<td colspan=”4” align=”right”><b>Total:,b></td>

<td align=”right”>$’ . number_format ($total, 2) . ‘</td>

</tr>

<table><div align=”center”><input type=”submit” name=”submit” value=”Update My Cart” /></form><br ><a href=”checkout.php”><font size=”+3”>Checkout<font></a></div>’;

mysql_close();

} else {

echo ‘<p>Your cart is currently empty.</p>;

}

include_once (‘includes/footer,html’);

?>