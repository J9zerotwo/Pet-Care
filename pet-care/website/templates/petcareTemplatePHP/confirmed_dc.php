<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Data from Pet Details
    $name = $_POST["name"]; // Pet's Name
    $age = $_POST["age"]; // Pet's Age
    $type = $_POST["type"]; // Pet's Breed
    $gender = $_POST ["gender"]; // Pet's Gender
    $color = $_POST["color"]; //Pet's Color

    // Data from Appointment of Date and Time
    $dropOffDate = $_POST["date"]; // Drop-off Date
    $dropOffTime = $_POST["d_time"]; // Drop-off Time
    $pickUpTime = $_POST["p_time"]; // Pick-up Time

    // Display selected allergies and their specifications
    $food = isset($_POST["food"]) ? $_POST["food"] : ""; // Food Allergy
    $skin = isset($_POST["skin"]) ? $_POST["skin"] : ""; // Skin Allergy
    $med = isset($_POST["med"]) ? $_POST["med"] : ""; // Medicine Allergy
    $none =isset($_POST["none"]) ? $_POST["none"] : ""; // None

    // Flavors
    $flavor = isset($_POST["flavor"]) ? $_POST["flavor"] : "";
    $otherFlavor = isset($_POST["other"]) ? $_POST["other"] : "Not specified";

    $FeedingTime = isset($_POST["FeedingTime"]) ? $_POST["FeedingTime"] : "Not specified";

    // Display Grooming Choices
    $haircut = isset($_POST["haircut"]) ? "Yes" : "No";
    $nails = isset($_POST["nails"]) ? "Yes" : "No"; 
    $ear = isset($_POST["ear"]) ? "Yes" : "No";
    $tooth = isset($_POST["tooth"]) ? "Yes" : "No";

    // Calculate duration
    $dropOffDateTime = new DateTime($dropOffDate . " " . $dropOffTime);
    $pickUpDateTime = new DateTime($dropOffDate . " " . $pickUpTime); 
    $durationInterval = $pickUpDateTime->diff($dropOffDateTime);
    $durationHours = $durationInterval->h + ($durationInterval->days * 24);

    // Maximum 12 hours of stay
    $maxDuration = 12;
    if ($durationHours > $maxDuration) {
    $durationHours = $maxDuration;
    }

    // Total Cost
    $ratePerHour = 20;
    $totalCost = $durationHours * $ratePerHour;

    // Ownner's Data
    $oname = $_POST['oname']; // Owner's Name
    $num = $_POST['num']; // Owner's Number
    $add = $_POST['add']; // Owner's Address

    // Display confirmation message 
    echo "<body style='background-color: LightCyan'>";
    echo "<div style='background-color: LightBlue; padding: 20px; border-radius:10px; text-align:center;'>";
    echo "<img src='petcare_logo.png' alt='Logo' width='150' height='150' style='margin-bottom: 20px;'>"; 
    echo "<h1>Thank you for booking in Waggle & Snuggle Lodge!</h1>"; 
    echo "<h2>Summary of Appointment:</h2>";
    echo "<strong>Pet Informations</strong><br>";
    echo "Pet Name: $name<br>";
    echo "Pet Age: $age<br>";
    echo "Pet Type: $type<br>";
    echo "Pet Gender: $gender<br>";
    echo "Pet Color: $color<br><br>";
 
    echo "<strong>Appointment Date & Time</strong><br>";
    echo "Drop-off Date: $dropOffDate<br>";
    echo "Drop-off Time: $dropOffTime<br>";
    echo "Pick-up Time: $pickUpTime<br>";

    echo "Duration: " . number_format($durationHours, 2) . " hours<br>";
    echo "Total Cost: ₱" . number_format($totalCost, 2) . "<br><br>"; 
    
    echo "<strong>Pet Allergies</strong><br>";
    echo "Food Allergy: $food<br>";
    echo "Skin Allergy: $skin<br>";
    echo "Medicine Allergy: $med<br>";
    echo "No Allergies: $none<br><br>";
 
    echo "<strong>Food Flavors</strong><br>";
    if ($flavor !== "") {
        echo "Flavor: $flavor<br>";
    }
    echo "Other Flavor: $otherFlavor<br><br>";
 
    echo "<strong>Feeding Schedule</strong><br>";
    echo "Feeding Time: " . (isset($FeedingTime) ? $FeedingTime : "Not specified") . "<br>";
 
    echo "<strong>Grooming Choices</strong><br>";
    echo "Hair Cut: $haircut<br>";
    echo "Trim Nails: $nails<br>";
    echo "Ear Cleaning: $ear<br>";
    echo "Tooth Brush: $tooth<br>";

    echo "<strong><br>Emergency Details<br></strong>";
    echo "Owner's Name: $oname<br>";
    echo "Contact Number: $num<br>";
    echo "Address: $add<br>";
 
    echo "<h2>Your appointment has been scheduled. See you!</h2>";
    echo "</div>";
    echo "</body>";
 } else {
    // If the form is not submitted via POST method, redirect to the appointment page
    header("Location: daycare_appointment.php");
    exit;
 }
 ?>
