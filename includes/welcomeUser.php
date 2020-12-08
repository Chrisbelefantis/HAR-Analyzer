<?php
    session_start();
    $username = $_SESSION['userName'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome User</title>
</head>
<body>
    <h5>Thank you <?php echo $username; ?>, you have login in our system !</h5>
</body>
</html>