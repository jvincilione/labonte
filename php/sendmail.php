<?php
//Email information
$admin_email = "roger@labontefurnitureserv.com";
$honeypot = strip_tags($_REQUEST['honeypot']);
$honeypot2 = strip_tags($_REQUEST['honeypot2']);
$name = strip_tags($_REQUEST['name']);
$address = strip_tags($_REQUEST['address']);
$address2 = strip_tags($_REQUEST['address2']);
$city = strip_tags($_REQUEST['city']);
$state = strip_tags($_REQUEST['state']);
$zip = strip_tags($_REQUEST['zip']);
$phone = strip_tags($_REQUEST['phone']);
$description = htmlentities($_REQUEST['repair-description']);

$requiredFieldsSet = isset($name) && isset($phone) && isset($description) && isset($zip); 

//send email
if ($honeypot2 === "" && $honeypot === "lfsllc" && $requiredFieldsSet):
    $headers = "From: service@labontefurnitureserv.com\r\n";
    $headers .= "Reply-To: noreply@labontefurnitureserv.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message = "<html><body>";
    $message .= "<h1>Hello Roger!</h1>\r\n";
    $message .= "<h2>A request for service has been submitted.</h2>\r\n";
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $name . "</td></tr>";
    $message .= "<tr><td><strong>Phone:</strong> </td><td>" . $phone . "</td></tr>";
    $message .= "<tr><td><strong>Address:</strong> </td><td>" . $address . "\r\n";
    if (isset($address2)) {
        $message .= $address2 . "\r\n";
    }
    $message .= $city . ", " . $state . " " . $zip . "</td></tr>";
    $message .= "<tr><td><strong>Repair Description:</strong> </td><td>" . $description . "</td></tr>";
    $message .= "</table>";
    $message .= "</body></html>";
    if (mail($admin_email, "A repair request has been submitted!", $message, $headers)):
        echo "Success";
    else:
        echo "Error";
    endif;
else:
    echo "Required fields not set " . ' ' . $name . ' ' . $phone . ' ' . $description . ' ' . $zip;
endif;
?>