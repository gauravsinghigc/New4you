<?php
require '../require/config.php';
require '../require/common.php';
require '../data/tags.php';
require '../data/pagevariables.php';
require '../require/modules.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | <?php echo $APP_NAME; ?></title>
  <?php
  //header files
  include '../include/header_files.php';
  ?>
</head>

<body>
  <?php include '../include/header.php'; ?>

  <section class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="pt-2 pb-2">
          <div class="flex-s-b">
            <h4 class="pt-2 border-left">Dashboard</h4>
            <?php include '../include/time.php'; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-2 col-sm-3 col-6 mb-2">
        <div class="bg-light pt-4 p-2 br15 sh-1">
          <h5 class="count"><?php echo TOTAL("SELECT * FROM users"); ?></h5>
          <p class="mb-2 text-grey fs-13">Customers</p>
        </div>
      </div>

      <div class="col-lg-2 col-sm-3 col-6 mb-2">
        <div class="bg-light pt-4 p-2 br15 sh-1">
          <h5 class="count"><?php echo TOTAL("SELECT * FROM projects"); ?></h5>
          <p class="mb-2 text-grey fs-13">Projects</p>
        </div>
      </div>

      <div class="col-lg-2 col-lg-2 col-sm-3 col-6 mb-2">
        <div class="bg-light pt-4 p-2 br15 sh-1">
          <h5 class="count"><?php echo TOTAL("SELECT * FROM invoices"); ?></h5>
          <p class="mb-2 text-grey fs-13">Invoices</p>
        </div>
      </div>

      <div class="col-lg-2 col-lg-2 col-sm-3 col-6 mb-2">
        <div class="bg-light pt-4 p-2 br15 sh-1">
          <h5 class="mb-0"><small class="fs-10 text-grey">Rs.</small> <?php echo $TotalReceivable = AMOUNT("SELECT sum(invoice_amount) FROM invoices ", "invoice_amount"); ?></h5>
          <p class="mb-2 text-grey fs-13">Receivable Payment </p>
        </div>
      </div>

      <div class="col-lg-2 col-lg-2 col-sm-3 col-6 mb-2">
        <div class="bg-light pt-4 p-2 br15 sh-1">
          <h5 class="mb-0"><small class="fs-10 text-grey">Rs.</small> <?php echo $TotalReceived =  AMOUNT("SELECT sum(paid_amount) FROM invoices, payments where invoices.invoices_id=payments.invoices_id", "paid_amount"); ?></h5>
          <p class="mb-2 text-grey fs-13">Received Payments</p>
        </div>
      </div>

      <div class="col-lg-2 col-lg-2 col-sm-3 col-6 mb-2">
        <div class="bg-light pt-4 p-2 br15 sh-1">
          <h5 class="mb-0"><small class="fs-10 text-grey">Rs.</small> <?php if ($TotalReceived > $TotalReceivable) {
                                                                        echo 0;
                                                                      } else {
                                                                        echo $TotalReceivable - $TotalReceived;
                                                                      }; ?></h5>
          <p class="mb-2 text-grey fs-13">Pending Payments</p>
        </div>
      </div>

      <div class="col-lg-2 col-lg-2 col-sm-3 col-6 mb-2">
        <div class="bg-light pt-4 p-2 br15 sh-1">
          <h5><?php echo TOTAL("SELECT * FROM credentials"); ?></h5>
          <p class="mb-2 text-grey fs-13">Credentials</p>
        </div>
      </div>

      <div class="col-lg-2 col-sm-3 col-6 mb-2">
        <div class="bg-light pt-4 p-2 br15 sh-1">
          <h5><?php echo TOTAL("SELECT * FROM tasks "); ?></h5>
          <p class="mb-2 text-grey fs-13">Tasks</p>
        </div>
      </div>

      <div class="col-lg-2 col-sm-3 col-6 mb-2">
        <div class="bg-light pt-4 p-2 br15 sh-1">
          <h5><?php echo TOTAL("SELECT * FROM tickets "); ?></h5>
          <p class="mb-2 text-grey fs-13">Tickets</p>
        </div>
      </div>

      <div class="col-lg-2 col-lg-2 col-sm-3 col-6 mb-2">
        <div class="bg-light pt-4 p-2 br15 sh-1">
          <h5><?php echo TOTAL("SELECT * FROM domains "); ?></h5>
          <p class="mb-2 text-grey fs-13">Domains</p>
        </div>
      </div>

      <div class="col-lg-2 col-sm-3 col-6 mb-2">
        <div class="bg-light pt-4 p-2 br15 sh-1">
          <h5 class="mb-0"><small class="fs-10 text-grey">Rs.</small> <?php echo $TotalDevelopmentCost = AMOUNT("SELECT sum(costamount) FROM developmentcost", "costamount"); ?></h5>
          <p class="mb-2 text-grey fs-13">Development Cost</p>
        </div>
      </div>

      <div class="col-lg-2 col-sm-3 col-6 mb-2">
        <div class="bg-light pt-4 p-2 br15 sh-1">
          <h5 class="mb-0"><small class="fs-10 text-grey">Rs.</small> <?php echo $TotalReceived - $TotalDevelopmentCost; ?></h5>
          <p class="mb-2 text-grey fs-13">Revenue</p>
        </div>
      </div>

      <div class="col-lg-2 col-sm-3 col-6 mb-2">
        <div class="bg-light pt-4 p-2 br15 sh-1">
          <h5><?php echo TOTAL("SELECT * FROM files"); ?></h5>
          <p class="mb-2 text-grey fs-13">Files</p>
        </div>
      </div>
      <div class="col-lg-2 col-sm-3 col-6 mb-2">
        <div class="bg-light pt-4 p-2 br15 sh-1">
          <h5><?php echo TOTAL("SELECT * FROM files"); ?></h5>
          <p class="mb-2 text-grey fs-13">Inbox</p>
        </div>
      </div>
      <div class="col-lg-2 col-sm-3 col-6 mb-2">
        <div class="bg-light pt-4 p-2 br15 sh-1">
          <h5><?php echo TOTAL("SELECT * FROM urls"); ?></h5>
          <p class="mb-2 text-grey fs-13">Urls</p>
        </div>
      </div>
      <div class="col-lg-2 col-sm-3 col-6 mb-2">
        <div class="bg-light pt-4 p-2 br15 sh-1">
          <h5><?php echo TOTAL("SELECT * FROM meetings"); ?></h5>
          <p class="mb-2 text-grey fs-13">Meetings</p>
        </div>
      </div>

    </div>
    <div class="flex"></div>
  </section>

  <section class="container-fluid">
    <div class="row p-1">
      <div class="col-md-12 pt-2 pb-2">
        <h4>Top 20 Acitivities</h4>
      </div>
    </div>
    <div class="row">

      <div class="col-md-6 col-lg-6 col-sm-6 col-12 mb-2">
        <div class="bg-light p-2 br10 sh-2">
          <div class="flex-s-b">
            <h6 class="p-1">Meetings</h6>
          </div>
          <table class="table table-striped fs-12">
            <thead>
              <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Type</th>
                <th>Location</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $Checktnotes = CHECK("SELECT * FROM meetings LIMIT 0, 20");
              if ($Checktnotes != 0) {
                $SQLtnotes = SELECT("SELECT * FROM meetings ORDER by meetings.meetingsid DESC LIMIT 0, 20");
                while ($Ftnotes = mysqli_fetch_array($SQLtnotes)) { ?>
                  <tr>
                    <td class="text-info"><?php echo $Ftnotes['Meetingtitle']; ?></td>
                    <td><?php echo $Ftnotes['meetingdate']; ?></td>
                    <td><?php echo $Ftnotes['meetingtype']; ?></td>
                    <td><a href="<?php echo substr(SECURE($Ftnotes['meetingslocationlink'], "d"), 0, 45); ?>" class="text-success" target="_blank">Open Map</a></td>
                    <td><a href="#" class="text-primary">view</a></td>
                  </tr>
              <?php }
              } ?>
            </tbody>
          </table>
        </div>
        <div class="flex"></div>
      </div>

      <div class="col-md-6 col-lg-6 col-sm-6 col-12 mb-2">
        <div class="bg-light p-2 br10 sh-2">
          <div class="flex-s-b">
            <h6 class="p-1">Projects</h6>
          </div>
          <table class="table table-striped fs-12">
            <thead>
              <tr>
                <th>Name</th>
                <th>Start</th>
                <th>Due</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $CheckProjects = CHECK("SELECT * FROM projects ORDER BY projects_id DESC LIMIT 0, 20");
              if ($CheckProjects != 0) {
                $SQLProjects = SELECT("SELECT * FROM projects ORDER BY projects_id DESC LIMIT 0, 20");
                while ($FetchProjects = mysqli_fetch_array($SQLProjects)) { ?>
                  <tr>
                    <td class="text-info"><?php echo $FetchProjects['project_name']; ?></td>
                    <td><?php echo $FetchProjects['start_date']; ?></td>
                    <td><?php echo $FetchProjects['due_date']; ?></td>
                    <td><a href="#" class="text-primary">view</a></td>
                  </tr>
              <?php }
              } ?>
            </tbody>
          </table>
        </div>
        <div class="flex"></div>
      </div>

      <div class="col-md-6 col-lg-6 col-sm-6 col-12 mb-2">
        <div class="bg-light p-2 br10 sh-2">
          <div class="flex-s-b">
            <h6 class="p-1">Domains</h6>
          </div>
          <table class="table table-striped fs-12">
            <thead>
              <tr>
                <th>Name</th>
                <th>Purchase</th>
                <th>Expire</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $CheckDomains = CHECK("SELECT * FROM domains  ORDER BY domains_id DESC LIMIT 0, 20");
              if ($CheckDomains != 0) {
                $SQLDomains = SELECT("SELECT * FROM domains  ORDER BY domains_id DESC LIMIT 0, 20");
                while ($FetchDomains = mysqli_fetch_array($SQLDomains)) { ?>
                  <tr>
                    <td class="text-info"><?php echo $FetchDomains['domain_name']; ?></td>
                    <td><?php echo $FetchDomains['purchase_date']; ?></td>
                    <td><?php echo $FetchDomains['expire_date']; ?></td>
                    <td><a href="#" class="text-primary">view</a></td>
                  </tr>
              <?php }
              } ?>
            </tbody>
          </table>
        </div>
        <div class="flex"></div>
      </div>

      <div class="col-md-6 col-lg-6 col-sm-6 col-12 mb-2">
        <div class="bg-light p-2 br10 sh-2">
          <div class="flex-s-b">
            <h6 class="p-1">Invoices</h6>
          </div>
          <table class="table table-striped fs-12">
            <thead>
              <tr>
                <th>InvoiceNo</th>
                <th>InvoiceDate</th>
                <th>DueDate</th>
                <th>Amount</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $Checkinvoice = CHECK("SELECT * FROM invoices LIMIT 0, 20");
              if ($Checkinvoice != 0) {
                $SQLinvoices = SELECT("SELECT * FROM invoices ORDER BY invoices_id DESC LIMIT 0, 20");
                while ($FInvoices = mysqli_fetch_array($SQLinvoices)) { ?>
                  <tr>
                    <td class="text-info">IN00<?php echo $FInvoices['invoices_id']; ?></td>
                    <td><?php echo $FInvoices['invoice_date']; ?></td>
                    <td><?php echo $FInvoices['due_date']; ?></td>
                    <td class="text-success">Rs.<?php echo $FInvoices['invoice_amount']; ?></td>
                    <td><a href="#" class="text-primary">view</a></td>
                  </tr>
              <?php }
              } ?>
              <tr>
                <td colspan="2"></td>
                <th>Total Invoices :</th>
                <td class="text-info bold fs-14">Rs.<?php echo AMOUNT("SELECT sum(invoice_amount) FROM  invoices Limit 0, 20", "invoice_amount"); ?></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="flex"></div>
      </div>

      <div class="col-md-6 col-lg-6 col-sm-6 col-12 mb-2">
        <div class="bg-light p-2 br10 sh-2">
          <div class="flex-s-b">
            <h6 class="p-1">Payments</h6>
          </div>
          <table class="table table-striped fs-12">
            <thead>
              <tr>
                <th>InvoiceNo</th>
                <th>PaidDate</th>
                <th>Amount</th>
                <th>Mode</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $Checkpayments = CHECK("SELECT * FROM invoices, payments where invoices.invoices_id=payments.invoices_id LIMIT 0, 20");
              if ($Checkpayments != 0) {
                $SQLpayments = SELECT("SELECT * FROM invoices, payments where invoices.invoices_id=payments.invoices_id ORDER by payments_id DESC LIMIT 0, 20");
                while ($Fpayments = mysqli_fetch_array($SQLpayments)) { ?>
                  <tr>
                    <td class="text-info">IN00<?php echo $Fpayments['invoices_id']; ?></td>
                    <td><?php echo $Fpayments['paid_date']; ?></td>
                    <td class="text-success">Rs.<?php echo $Fpayments['paid_amount']; ?></td>
                    <td><?php echo $Fpayments['payment_mode']; ?></td>
                    <td><a href="#" class="text-primary">view</a></td>
                  </tr>
              <?php }
              } ?>
              <tr>
                <td colspan="1"></td>
                <th>Total Payments :</th>
                <td class="text-info bold fs-14">Rs.<?php echo AMOUNT("SELECT sum(paid_amount) FROM  invoices, payments where invoices.invoices_id=payments.invoices_id Limit 0, 20", "paid_amount"); ?></td>
                <td colspan="2"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="flex"></div>
      </div>

      <div class="col-md-6 col-lg-6 col-sm-6 col-12 mb-2">
        <div class="bg-light p-2 br10 sh-2">
          <div class="flex-s-b">
            <h6 class="p-1">Development Costs</h6>
          </div>
          <table class="table table-striped fs-12">
            <thead>
              <tr>
                <th>Name</th>
                <th>Tags</th>
                <th>Amount</th>
                <th>PurchaseDate</th>
                <th>Invoice</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $Checkcosts = CHECK("SELECT * FROM developmentcost LIMIT 0, 20");
              if ($Checkcosts != 0) {
                $SQLcosts = SELECT("SELECT * FROM developmentcost ORDER by development_id  DESC LIMIT 0, 20");
                while ($Fcosts = mysqli_fetch_array($SQLcosts)) { ?>
                  <tr>
                    <td class="text-info"><?php echo $Fcosts['costtitle']; ?></td>
                    <td><?php echo $Fcosts['costtags']; ?></td>
                    <td class="text-success">Rs.<?php echo $Fcosts['costamount']; ?></td>
                    <td><?php echo $Fcosts['purchasedate']; ?></td>
                    <td><a href="<?php echo $DOMAIN; ?>/storage/<?php echo $ViewUserId; ?>/development/invoices/<?php echo $Fcosts['developmentinvoice']; ?>" class="text-success itlalic" target="_blank">Open</a></td>
                    <td><a href="#" class="text-primary">view</a></td>
                  </tr>
              <?php }
              } ?>
              <tr>
                <td colspan="1"></td>
                <th>Total Expanses :</th>
                <td class="text-info bold fs-14">Rs.<?php echo AMOUNT("SELECT sum(costamount) FROM  developmentcost Limit 0, 20", "costamount"); ?></td>
                <td colspan="3"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="flex"></div>
      </div>

      <div class="col-md-6 col-lg-6 col-sm-6 col-12 mb-2">
        <div class="bg-light p-2 br10 sh-2">
          <div class="flex-s-b">
            <h6 class="p-1">Team</h6>
          </div>
          <table class="table table-striped fs-12">
            <thead>
              <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Emailid</th>
                <th>WorkRole</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $Checkteam = CHECK("SELECT * FROM team LIMIT 0, 20");
              if ($Checkteam != 0) {
                $SQLteam = SELECT("SELECT * FROM team ORDER by teamid DESC LIMIT 0, 20");
                while ($Fteam = mysqli_fetch_array($SQLteam)) { ?>
                  <tr>
                    <td class="text-info"><?php echo $Fteam['teamname']; ?></td>
                    <td><a href="tel:<?php echo $Fteam['teamphone']; ?>"><?php echo $Fteam['teamphone']; ?></a></td>
                    <td><a href="mailto:<?php echo $Fteam['teamphone']; ?>"><?php echo $Fteam['teamemail']; ?></a></td>
                    <td><?php echo $Fteam['teamcategory']; ?></td>
                    <td><a href="#" class="text-primary">view</a></td>
                  </tr>
              <?php }
              } ?>
            </tbody>
          </table>
        </div>
        <div class="flex"></div>
      </div>


      <div class="col-md-6 col-lg-6 col-sm-6 col-12 mb-2">
        <div class="bg-light p-2 br10 sh-2">
          <div class="flex-s-b">
            <h6 class="p-1">Tasks</h6>
          </div>
          <table class="table table-striped fs-12">
            <thead>
              <tr>
                <th>Priority</th>
                <th>TaskName</th>
                <th>TasksCategory</th>
                <th>StartDate</th>
                <th>DueDate</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $Checktasks = CHECK("SELECT * FROM tasks LIMIT 0, 20");
              if ($Checktasks != 0) {
                $SQLtasks = SELECT("SELECT * FROM tasks ORDER by taskid DESC LIMIT 0, 20");
                while ($Ftasks = mysqli_fetch_array($SQLtasks)) { ?>
                  <tr>
                    <td><?php if ($Ftasks['taskpriority'] == "Low") {
                          echo "<span class='text-grey'>Low</span>";
                        } else if ($Ftasks['taskpriority'] == "Normal") {
                          echo "<span class='text-success'>Normal</span>";
                        } else if ($Ftasks['taskpriority'] == "High") {
                          echo "<span class='text-warning'>High</span>";
                        } else if ($Ftasks['taskpriority'] == "Urgent") {
                          echo "<span class='text-danger'>Urgent</span>";
                        } ?></td>
                    <td><?php echo $Ftasks['tasksname']; ?></td>
                    <td><?php echo $Ftasks['taskscategory']; ?></td>
                    <td><?php echo $Ftasks['tasksstartdate']; ?></td>
                    <td><?php echo $Ftasks['tasksenddate']; ?></td>
                    <td><?php echo $Ftasks['tasksstatus']; ?></td>
                    <td><a href="#" class="text-primary">view</a></td>
                  </tr>
              <?php }
              } ?>
            </tbody>
          </table>
        </div>
        <div class="flex"></div>
      </div>

      <div class="col-md-6 col-lg-6 col-sm-6 col-12 mb-2">
        <div class="bg-light p-2 br10 sh-2">
          <div class="flex-s-b">
            <h6 class="p-1">Notes</h6>
          </div>
          <table class="table table-striped fs-12">
            <thead>
              <tr>
                <th>Project</th>
                <th>Title</th>
                <th>Value</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $Checktnotes = CHECK("SELECT * FROM notes, projects where notes.projectsid=projects.projects_id LIMIT 0, 20");
              if ($Checktnotes != 0) {
                $SQLtnotes = SELECT("SELECT * FROM notes, projects where notes.projectsid=projects.projects_id ORDER by notes.notesid DESC LIMIT 0, 20");
                while ($Ftnotes = mysqli_fetch_array($SQLtnotes)) { ?>
                  <tr>
                    <td class="text-info"><?php echo $Ftnotes['project_name']; ?></td>
                    <td><?php echo $Ftnotes['notetitle']; ?></td>
                    <td><?php echo substr(SECURE($Ftnotes['notesvalues'], "d"), 0, 45); ?></td>
                    <td><a href="#" class="text-primary">view</a></td>
                  </tr>
              <?php }
              } ?>
            </tbody>
          </table>
        </div>
        <div class="flex"></div>
      </div>

      <div class="col-md-6 col-lg-6 col-sm-6 col-12 mb-2">
        <div class="bg-light p-2 br10 sh-2">
          <div class="flex-s-b">
            <h6 class="p-1">Tickets</h6>
          </div>
          <table class="table table-striped fs-12">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Project</th>
                <th>CreatedAt</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $Checktickets = CHECK("SELECT * FROM tickets, projects where  tickets.projectsid=projects.projects_id LIMIT 0, 20");
              if ($Checktickets != 0) {
                $SQLtickets = SELECT("SELECT * FROM tickets, projects where tickets.projectsid=projects.projects_id ORDER by tickets.ticketsid DESC LIMIT 0, 20");
                while ($Ftickets = mysqli_fetch_array($SQLtickets)) { ?>
                  <tr>
                    <td class="text-info">&hslash;<?php echo $Ftickets['ticketsid']; ?></td>
                    <td><?php echo $Ftickets['ticketname']; ?></td>
                    <td><?php echo $Ftickets['project_name']; ?></td>
                    <td><?php echo $Ftickets['ticketcreatedat']; ?></td>
                    <td><?php echo $Ftickets['ticketstatus']; ?></td>
                    <td><a href="#" class="text-primary">view</a></td>
                  </tr>
              <?php }
              } ?>
            </tbody>
          </table>
        </div>
        <div class="flex"></div>
      </div>

      <div class="col-md-6 col-lg-6 col-sm-6 col-12 mb-2">
        <div class="bg-light p-2 br10 sh-2">
          <div class="flex-s-b">
            <h6 class="p-1">URLs</h6>
          </div>
          <table class="table table-striped fs-12">
            <thead>
              <tr>
                <th>Name</th>
                <th>Type</th>
                <th>ViewLink</th>
                <th>SaveDate</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $Checkfiles = CHECK("SELECT * FROM urls LIMIT 0, 20");
              if ($Checkfiles != 0) {
                $SQLfiles = SELECT("SELECT * FROM urls  ORDER by Urlid DESC LIMIT 0, 20");
                while ($Ffiles = mysqli_fetch_array($SQLfiles)) { ?>
                  <tr>
                    <td class="text-info"><?php echo $Ffiles['urlname']; ?></td>
                    <td><?php echo $Ffiles['urltype']; ?></td>
                    <td><a href="<?php echo SECURE($Ffiles['urllink'], "d"); ?>" target="_blank" class="text-success">Open Url</a></td>
                    <td><?php echo $Ffiles['urlcreatedat']; ?></td>
                    <td><a href="#" class="text-primary">view</a></td>
                  </tr>
              <?php }
              } ?>
            </tbody>
          </table>
        </div>
        <div class="flex"></div>
      </div>

      <div class="col-md-6 col-lg-6 col-sm-6 col-12 mb-2">
        <div class="bg-light p-2 br10 sh-2">
          <div class="flex-s-b">
            <h6 class="p-1">Credentials</h6>
          </div>
          <table class="table table-striped fs-12">
            <thead>
              <tr>
                <th>Name</th>
                <th>UseAt</th>
                <th>Username</th>
                <th>Password</th>
                <th>View</th>
                <th>Login</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $Checkcreden = CHECK("SELECT * FROM credentials LIMIT 0, 20");
              if ($Checkcreden != 0) {
                $SQLcreden = SELECT("SELECT * FROM credentials ORDER BY credentials_id DESC LIMIT 0, 20");
                while ($FetchCRD = mysqli_fetch_array($SQLcreden)) { ?>
                  <tr>
                    <td class="text-info"><?php echo $FetchCRD['credentials_name']; ?></td>
                    <td><?php echo $FetchCRD['credential_access']; ?></td>
                    <td><?php echo $FetchCRD['credentials_username']; ?></td>
                    <td class="code"><code id="pass_<?php echo $FetchCRD['credentials_id']; ?>" class="fs-12">*********</code></td>
                    <td><a class="text-secondary" onclick="show_<?php echo $FetchCRD['credentials_id']; ?>()">view</a></td>
                    <td>
                      <a href="<?php echo $FetchCRD['credentials_url']; ?>" target="_blank" class="text-primary">Login</a>
                    </td>
                  </tr>
                  <script>
                    var pass_<?php echo $FetchCRD['credentials_id']; ?> = document.getElementById("pass_<?php echo $FetchCRD['credentials_id']; ?>");

                    function show_<?php echo $FetchCRD['credentials_id']; ?>() {
                      if (pass_<?php echo $FetchCRD['credentials_id']; ?>.innerHTML === "*********") {
                        pass_<?php echo $FetchCRD['credentials_id']; ?>.innerHTML = "<?php echo $FetchCRD['credentials_password']; ?>";
                      } else {
                        pass_<?php echo $FetchCRD['credentials_id']; ?>.innerHTML = "*********";
                      }
                    }
                  </script>
              <?php }
              } ?>
            </tbody>
          </table>
        </div>
        <div class="flex"></div>
      </div>


      <div class="col-md-6 col-lg-6 col-sm-6 col-12 mb-2">
        <div class="bg-light p-2 br10 sh-2">
          <div class="flex-s-b">
            <h6 class="p-1">Files</h6>
          </div>
          <table class="table table-striped fs-12">
            <thead>
              <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Category</th>
                <th>ViewFile</th>
                <th>UploadDate</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $Checkfiles = CHECK("SELECT * FROM files LIMIT 0, 20");
              if ($Checkfiles != 0) {
                $SQLfiles = SELECT("SELECT * FROM files ORDER by filesid DESC LIMIT 0, 20");
                while ($Ffiles = mysqli_fetch_array($SQLfiles)) { ?>
                  <tr>
                    <td class="text-info"><?php echo $Ffiles['filename']; ?></td>
                    <td><?php echo $Ffiles['filetype']; ?></td>
                    <td><?php echo $Ffiles['filecategory']; ?></td>
                    <td><a href="<?php echo $DOMAIN; ?>/storage/users/<?php echo $ViewUserId; ?>/files/<?php echo $Ffiles['attachedfile']; ?>" target="_blank" class="text-success">Open File</a></td>
                    <td><?php echo $Ffiles['filesavedat']; ?></td>
                    <td><a href="#" class="text-primary">view</a></td>
                  </tr>
              <?php }
              } ?>
            </tbody>
          </table>
        </div>
        <div class="flex"></div>
      </div>
    </div>
  </section>

  <?php

  //message
  include '../include/message.php';

  //footer
  include '../include/footer.php';

  //footer files
  include '../include/footer_files.php';
  ?>
</body>

</html>