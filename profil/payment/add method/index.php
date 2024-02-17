<?php
session_start();

$VISA_REGEX = "^4[0-9]{6,}$";
$MASTERCARD_REGEX = "^5[1-5][0-9]{5,}|222[1-9][0-9]{3,}|22[3-9][0-9]{4,}|2[3-6][0-9]{5,}|27[01][0-9]{4,}|2720[0-9]{3,}$";
$AMERICAN_EXPRESS_REGEX = "^3[47][0-9]{5,}$";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add payment method</title>
</head>

<body>
    <form method="post">
        <label for="form-card-number">Card number:</label><br>
        <input type="text" id="form-card-number" name="form-card-number"><br>
        <label for="form-card-expiration-date">Expiration date:</label><br>
        <input type="month" id="form-card-expiration-date" name="form-card-expiration-date"><br>
        <label for="form-card-cvv">CVV:</label><br>
        <input type="text" id="form-card-cvv" name="form-card-cvv"><br><br>
        <input type="submit">
    </form>
</body>

</html>