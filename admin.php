<?php

require "init.php";

$auth = false;

if(isset($_SESSION['auth']) && $_SESSION['auth'] == 'true')
{
	$auth = true;
}

if(isset($_GET['p']) && $_GET['p'] == 'login')
{
	if($_POST['pass'] == 'räfmeisteR990')
	{
		$_SESSION['auth'] = 'true';
		header("Location: admin.php");
	}
	else
	{
		echo "You are not worthy";
		exit;
	}
}
else if(isset($_GET['p']) && $_GET['p'] == 'logout')
{
	$_SESSION['auth'] = '';
	header("Location: admin.php");

}
else if(isset($_GET['p']) && $_GET['p'] == 'save')
{
	if($_POST['id'] == '')
	{
		$sql = "INSERT INTO mail VALUES (
			null, '" . 
			addslashes($_POST['subject']) . "', '" .
			addslashes($_POST['message']) . "', '" .
			addslashes($_POST['date']) . "', '" .
			addslashes($_POST['to']) . "', '" .
			addslashes($_POST['from']) . "'" .
			")";
			
		mysql_query($sql);
		
	}
	else
	{
		$sql = "UPDATE mail SET 
		`subject` = '" . addslashes($_POST['subject']) . "', 
		`message` = '" . addslashes($_POST['message']) . "', 
		`date` = '" . addslashes($_POST['date']) . "', 
		`to` = '" . addslashes($_POST['to']) . "', 
		`from` = '" . addslashes($_POST['from']) . "'
		WHERE id = '" . addslashes((int)$_POST['id']) . "'";

		mysql_query($sql) or die(mysql_error());
	
	}
	header("Location: admin.php");
	exit;

}
else if(isset($_GET['p']) && $_GET['p'] == 'delete')
{
	$sql = "DELETE FROM mail WHERE id = '" . addslashes((int)$_GET['id']) . "'";
	mysql_query($sql);
	header("Location: admin.php");
	exit;
}


?>
<html>
	<head>
		<title>Super Advanced Power Admin Tool</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
		<h1>Super Advanced Power Admin Tool</h2>

		<?php

		if(!$auth)
		{
			?>
			

			<form action="admin.php?p=login" method="post">
				<p>Enter the password of toung and finger splitting:</p>
				<input type="password" name="pass" /><br />
				<input type="submit" value="Authenticate" />
			</form>

			<?php
		}else if(!isset($_GET['p']))
		{



			$res = mysql_query("SELECT * FROM mail ORDER BY `date` DESC");

			echo '<p><a href="admin.php?p=edit">Create message</a></p>';

			if(mysql_num_rows($res) == 0)
			{
				echo "<p>No messages, dawg</p>";
			}
			else
			{
			?>
				<table border="1" cellspacing="0" cellpadding="10">
				<tr>
					<th>Subject</th>
					<th>From</th>
					<th>To</th>
					<th>Sent</th>
					<td></td>
					<td></td>
				</tr>
				<?php
				while($row = mysql_fetch_assoc($res))
				{
					?>
					<tr>
						<td><?= $row['subject'] ?></td>
						<td><?= $row['from'] ?></td>
						<td><?= $row['to'] ?></td>
						<td><?= $row['date'] ?></td>
						<td><a href="admin.php?p=edit&amp;id=<?=$row['id']?>">Edit</a></td>
						<td><a href="admin.php?p=delete&amp;id=<?=$row['id']?>" onclick="return confirm('Are you sure, dawg?');">Delete</a></td>
					</tr>
					<?php
				}
				echo '</table>';

			}

			
		}
		else if($_GET['p'] == 'edit')
		{
			$mail = false;
			if(isset($_GET['id']))
			{
				$res = mysql_query("SELECT * FROM mail WHERE id = '" . addslashes((int)$_GET['id']) . "'");
				$mail = mysql_fetch_assoc($res);
			}

			?>

			<form action="admin.php?p=save" method="post">
				<input type="hidden" name="id" value="<?= $mail ? $mail['id'] : ''?>" />
				<table border="0">
					<tr>
						<td>Subject:</td>
						<td><input type="text" name="subject" value="<?= $mail ? $mail['subject'] : ''?>" /></td>
					</tr>
					<tr>
						<td>From:</td>
						<td><input type="text" name="from" value="<?= $mail ? $mail['from'] : ''?>" /></td>
					</tr>
					<tr>
						<td>To:</td>
						<td><input type="text" name="to" value="<?= $mail ? $mail['to'] : ''?>" /></td>
					</tr>
					<tr>
						<td>Date:</td>
						<td><input type="text" name="date" size="40" value="<?= $mail ? $mail['date'] : ''?>" /></td>
					</tr>
					<tr>
						<td>Message:</td>
						<td><textarea name="message" cols="50" rows="15"><?= $mail ? $mail['message'] : ''?></textarea></td>
					</tr>
				</table>

				<input type="submit" value="<?= $mail ? 'Save' : 'Create'?>" />
			</form>

			<?php
		}
		?>
		<?php if($auth) { ?> <p><a href="admin.php?p=logout">Log out</a></p><?php } ?>
	</body>
</html>