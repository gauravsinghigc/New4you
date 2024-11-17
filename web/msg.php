<?php if (isset($_GET['msg'])) {
   $msg = $_GET['msg'];
   if ($msg == "login") {?>
<script src="https://form.jotform.com/static/feedback2.js?3.3.REV" type="text/javascript">
var JFL_63431346590960 = new JotformFeedback({ 
formId: 'YOURFORMID', 
base: 'https://form.jotform.com/',
windowTitle: 'Welcome, <?php echo $customer_name;?>.<br><img src="img/gqKFh.png">',
background: 'Green',
fontColor: 'White',
type: 'false',
height: 0,
width: 300,
openOnLoad: true
});
</script>   
   <?php } elseif($msg == "logout") { ?>
      <script src="https://form.jotform.com/static/feedback2.js?3.3.REV" type="text/javascript">
var JFL_63431346590960 = new JotformFeedback({ 
formId: 'YOURFORMID', 
base: 'https://form.jotform.com/',
windowTitle: 'Logout<br><img src="img/successfulyy-logout-pop-up.png">',
background: 'Green',
fontColor: 'White',
type: 'false',
height: 0,
width: 300,
openOnLoad: true
});
</script> 
 <?php } elseif($msg == "register") { ?>
      <script src="https://form.jotform.com/static/feedback2.js?3.3.REV" type="text/javascript">
var JFL_63431346590960 = new JotformFeedback({ 
formId: 'YOURFORMID', 
base: 'https://form.jotform.com/',
windowTitle: 'Registered Successfully! <br><img src="img/register.png">',
background: 'Green',
fontColor: 'White',
type: 'false',
height: 0,
width: 300,
openOnLoad: true
});
</script> 
<?php } elseif($msg == "updated") { ?>
      <script src="https://form.jotform.com/static/feedback2.js?3.3.REV" type="text/javascript">
var JFL_63431346590960 = new JotformFeedback({ 
formId: 'YOURFORMID', 
base: 'https://form.jotform.com/',
windowTitle: 'Updated Successfully!',
background: 'Green',
fontColor: 'White',
type: 'false',
height: 0,
width: 300,
openOnLoad: true
});
</script>
<?php } elseif($msg == "unmatched") { ?>
      <script src="https://form.jotform.com/static/feedback2.js?3.3.REV" type="text/javascript">
var JFL_63431346590960 = new JotformFeedback({ 
formId: 'YOURFORMID', 
base: 'https://form.jotform.com/',
windowTitle: 'Current Password is Incorrect!',
background: 'RED',
fontColor: 'White',
type: 'false',
height: 0,
width: 300,
openOnLoad: true
});
</script> 
<?php }  } elseif(isset($_GET['err'])) {
$err= $_GET['err'];   ?>
      <script src="https://form.jotform.com/static/feedback2.js?3.3.REV" type="text/javascript">
var JFL_63431346590960 = new JotformFeedback({ 
formId: 'YOURFORMID', 
base: 'https://form.jotform.com/',
windowTitle: '<?php echo $err;?>!',
background: 'RED',
fontColor: 'White',
type: 'false',
height: 0,
width: 300,
openOnLoad: true
});
</script> 
<?php } elseif (isset($_GET['data'])) {
$data= $_GET['data'];   ?>
      <script src="https://form.jotform.com/static/feedback2.js?3.3.REV" type="text/javascript">
var JFL_63431346590960 = new JotformFeedback({ 
formId: 'YOURFORMID', 
base: 'https://form.jotform.com/',
windowTitle: '<?php echo $data;?>!',
background: 'GREEN',
fontColor: 'White',
type: 'false',
height: 0,
width: 300,
openOnLoad: true
});
</script> 
<?php } ?>