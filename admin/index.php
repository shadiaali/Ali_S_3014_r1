<?php
	require_once('scripts/config.php');
	confirm_logged_in();
	setcookie($cookie_query, time());
  date_default_timezone_set("America/Toronto"); //setting default time zone
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Welcome to your admin panel</title>
</head>
<body>
	<h1>Admin Dashboard</h1>
	<h3>Welcome <?php echo $_SESSION['username'];?></h3>
	<p>Welcome to your dashboard</p>

<!-- setting cookie for last user login -->
<?php
$loginTime = ($_COOKIE['user_date']);
$timeQuery = 'SELECT * FROM tbl_users WHERE user_date = '.$loginTime;
if(!isset($_COOKIE[$timeQuery])) {
  echo 'last visit was '.date('l, F j, Y @ g:ia');
  } else {

            echo 'this is your first time visiting';
        }
?>

<hr>
<?php
    $hour = date("H");
    if ($hour < "12") {
        echo "It is before lunch.";
    } else if ($hour >= "12" && $hour < "22") {
        echo "It is after lunch.";
    } else {
        echo "It's late, go to bed.";
    }
    ?>

	<nav>
		<ul>
			<li><a href="scripts/caller.php?caller_id=logout">Sign Out</a></li>
		</ul>
	</nav>
</body>
</html>
