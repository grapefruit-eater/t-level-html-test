<?php

if (is_numeric ($_GET[‘pid’])) {

$pid = $GET[‘pid’];

$page_title = ‘Add to Cart’;

include_once (‘includes/header.html’);

if (isset ($_SESSION[‘cart’][$pid])) {

$qty = $_SESSION[‘cart’][$pid] + 1;

} else {

$qty = 1;

}

$_SESSION[‘cart’][$pid] = $qty;

echo ‘<p>The print has been added to your shopping cart.</p>’;

include_once (‘includes/footer.html’);

} else {

header (“Location: http://” . $_SERVER[‘HTTP_HOST’] . dirname($_SERVER[‘PHP_SELF’]) . “index,php”);

exit();

}

?>