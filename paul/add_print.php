<!DOCTYPE html PUBLIC “-//W3C//DTD// XHTML 1.0 Transitional//EN” “http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml-transitional.dtd”> <html xmlns=”http://www.w3.org/1999/xhtml” xml:lang=”en” lang=”en”>

<head>

<meta http-equiv=”content-type” content=”text/html; charset=iso-8859-1” />

<title>Add a Print</title>

</head>

<body>

<?php

// page to allow the admin to add a product

require_once (../../mysql_connect.php’);

if (isset($_POST[‘submit’])) {

if (!empty($_POST[‘print_name’])) {

$pn = escape_data($_POST[‘print_name’]);

} else {

$pn = FALSE;

echo ‘<p><font color=”red”>Please enter the print\’s name!</font></p>’;

}

if (is_uploaded_file ($_FILES[‘image’][‘tmp_name’])); {

if (move_uploaded_file(($_FILES[‘image’][‘tmp_name’])),

“../../uploads/{$_FILES[‘image’][‘name’]})) {

echo ‘<p>The file has been upload!</p>’;

} else {

echo ‘<p><font color=”red”>The file could not be moved.</font></p>’;

$i = ‘’;

}

$i = $_FILES[‘image’][‘name’];

} else {

$i = ‘’;

}

if (!empty($_POST[‘size’])) {

$s = escape_data($_POST[‘size’]);

} else {

$s = ‘<i>Size information not available.</i>’;

}

if (is_numeric($_POST[‘price’])) {

$p = $_POST[‘price’];

} else {

$p = FALSE;

echo ‘<p><font color=$red”>Please enter the print\’s price!</font></p>’;

}

if (!empty($_POST[‘description’])) {

$d = escape_data($_POST[‘description’]);

} else {

$d = ‘<i>No description available.</i>’;

}

if ($_POST[‘artist’] == ‘new’) {

$query = ‘INSERT INTO artists (artist_id, first_name, middle_name, last_name) VALUES (NULL, ‘;

if (!empty($_POST[‘first_name’])) {

$query .= “’” . escape_data($_POST[‘first_name’]) . “ ‘, “;

} else {

$query .= ‘NULL’ ‘;

}

if (!empty($_POST[‘middle_name’])) {

$query .= “’” . escape_data($_POST[‘middle_name’]) . “ ‘, “;

} else {

$query .= ‘NULL’ ‘;

}

if (!empty($_POST[‘last_name’])) {

$query .= “’” . escape_data($_POST[‘last_name’]) . “ ‘, “;

$result = @mysql_query ($query);

$a = @mysql_insert_id();

} else {

$a = FALSE;

echo ‘<p><font color=”red”>Please enter the artist\’s last name!</font></p>

}

} else if ( ($_POST[‘artist’] == ‘existing’) && ($_POST[‘existing’] > 0)) {

$a = $_POST[‘existing’];

} else {

$a = FALSE;

echo ‘<p><font color=”red”>Please enter or select the print\’s artist!</font></p>’;

}

if ($pn && $p && $a) {

$query = “INSERT INTO prints (artist_id, print_name, price, size, description,

image_name) VALUES ($a, ‘$pn’, $p, ‘$s’, ‘$d’, ‘$i’)”;

if ($result = @mysql_query ($query)) {

echo ‘<p>The print has been added.</p>’;

} else {

echo ‘<p><font color=”red”>Your submission could not be processed due to

a system error.</font></p>’;

}

} else {

echo ‘<p><font color=”red”>Please click “back” and try again.</font></p>’;

}

} else {

?>

<form enctype=”multipart/form-data” action=”<?php echo $_SERVER[PHP_SELF’]; ?>” method=”post”>

<input type=”hidden” name=”MAX_FILE_SIZE” value=”524288”>

<fieldset><legend>Fill out the form to add a print to the catalog:</legend>

<p><b>Print Name:</b> <input type=”text” name=”print_name” sixe=”30” maxlength=”60” /></p>

<p><b>Image:</b> <input type=”file” name=”image” /></p>

<p><b>Artist:</b>

Existing <input type=”radio” name=”artist” value=”existing” />

<select name=”existing”><option>Select One</option>

<?php

$query = “SELECT artist_id, CONCAT(last_name, ‘, ‘, first_name) AS name FROM artists ORDER BY last_name ASC”;

$result = @mysql_query ($query);

while ($row = mysql_fetch_array ($result, MYSQL_ASSOC)) {

echo “<option value=\”{$row[‘artist_id’]}\”>{$row[‘name’]}</option>\n”;

}

mysql_close();

?>

</select><br />

New <input type=”radio” name=”artist” value=”new” />

First Name: <input type=”text” name=”first_name” size=”10” maxlength=”30” />

Middle Name: <input type=”text” name=”middle_name” size=”10” maxlength=”30” />

Last Name: <input trype=”text” name=”last_name” sixe=”20” maxlength=”30” />

</p>

<p><b>Size: </b> <input type=”text” name=”size” size=”30” maxlength=”60” /></p>

<p><b>Price: </b> <input type=”text” name=”price” size=”10” maxlength=”10” ><br ><small>Do not include the pound sign or commas.<small><p>

<p><b>Description:</b> <textarea name=”description” cols=”40” rows=”5”></textarea></p>

</fieldset>

</form><!--End of form →

<?php

}

?>

</body>

</html>