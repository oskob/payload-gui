<?php
require "init.php";
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
		<title>_-*´´*-_-*´ Steath Ops - Makes Ppl Talk ´*-_-*´´*-_ </title>
		<style type="text/css">
			@import url('mail.css');
		</style>

		
		<script type="text/javascript">

			<?php 
				$sql = "SELECT * FROM mail ORDER BY `date` DESC";
				$res = mysql_query($sql) or die(mysql_error());
			?>

			var mails = 
			[
				<?php 
				while($row = mysql_fetch_assoc($res)) { 
				$message = htmlentities(str_replace("\n", '<br />', $row['message']), ENT_QUOTES);
				?>
				["<?=$row['subject']?>", "<?=$row['from']?>", "<?=$row['to']?>", "<?= date('m/d/Y H:i:s', strtotime($row['date']))?>", "<?= $message ?>"],
				<?php } ?>
				[]
				

			];

			mails.pop();
		

		</script>




		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.ease.js"></script>
		<script type="text/javascript" src="js/tools.js"></script>
		<script type="text/javascript" src="js/mail.js"></script>
	</head>
	<body>
		
		<div class="wrap">
			<div class="top">
				<div class="menu">
					<a href="#" class="compose">Compose</a>
					<a href="#" class="reply">Reply</a>
					<a href="#" class="forward spacer">Forward</a>
					<a href="#" class="archive">Archive</a>
					<a href="#" class="spam">Spam</a>
					<a href="#" class="delete spacer">Delete</a>
					<a href="#" class="print">Print</a>
					<a href="#" class="search spacer">Search</a>
					<a href="#" class="logout">Logout</a>
				</div>
			</div>
			<div class="mid">
				<table class="mails" cellspacing="0" cellpadding="0" border="0">
					<thead>
						<tr class="topbar">
							<th class="padding"></th>
							<th>Subject</th>
							<th>From</th>
							<th>To</th>
							<th>Sent</th>
							<th class="padding"></th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<div class="bot"></div>
		</div>
		<div class="preload"></div>
	</body>
</html>