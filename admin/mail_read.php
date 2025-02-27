<html>

<head>How to Retrieve Emails from Gmail using PHP IMAP</head>

<body>
 <h1>Gmail Email Inbox using PHP with IMAP</h1>
 <?php
	if (!function_exists('imap_open')) {
		echo "IMAP is not configured.";
		exit();
	} else {
	?>
 <div class="container">
  <?php
			/* IMAP Connection code with GMAIL IMAP */
			$imap_conn = imap_open('{imap.gmail.com:993/imap/ssl}INBOX', 'gauravwebigc@gmail.com', 'Gsi@9810895713') or die('Cannot connect to Gmail: ' . imap_last_error());

			/* SET email subject filter criteria */
			$inbox = imap_search($imap_conn, 'SUBJECT "A"');

			if (!empty($inbox)) {
			?>
  <table class="table table-striped" style="width:100%;">
   <?php
					foreach ($inbox as $email) {
						// Get email header information
						$overview = imap_fetch_overview($imap_conn, $email, 0);
						// Get email body
						$message = imap_fetchbody($imap_conn, $email, '2');
						$date = date("d F, Y", strtotime($overview[0]->date));
					?>
   <tr>
    <td>
     <?php echo $overview[0]->from; ?>
    </td>
    <td>
     <?php echo $overview[0]->subject; ?> - <?php echo $message; ?>
    </td>
    <td>
     <?php echo $date; ?>
    </td>
   </tr>
   <?php
					}
					?>
  </table>
  <?php
			}
			// Close imap connection
			imap_close($imap_conn);
		}
		?>
 </div>
</body>

</html>