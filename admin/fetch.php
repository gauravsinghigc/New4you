<?php

function user_name()
{
    global $con;
    $contact_id = modify($_SESSION['contact_id'], "d");
    $sql = "SELECT * FROM contacts_list where contact_id='$contact_id'";
    $query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($query);
    $contact_fullname = modify($fetch['contact_fullname'], "d");
    echo $contact_fullname;
}
function user_type()
{
    global $con;
    $contact_id = modify($_SESSION['contact_id'], "d");
    $sql = "SELECT * FROM contacts_list where contact_id='$contact_id'";
    $query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($query);
    $contact_type = modify($fetch['contact_type'], "d");
    echo $contact_type;
}

function contact_status()
{
    global $con;
    $contact_id = modify($_SESSION['contact_id'], "d");
    $sql = "SELECT * FROM contacts_list where contact_id='$contact_id'";
    $query = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($query);
    $contact_status = modify($fetch['contact_status'], "d");
    if ($contact_status == "active") {
        echo "<i class='fa fa-check-circle text-success'></i>";
    } elseif ($contact_status == "inactive") {
        echo "<i class='fa fa-warning text-danger'></i>";
    }
}