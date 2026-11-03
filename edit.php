<?php

include "database.php";


$id = intval($_GET["id"] ?? 0);


$result = mysqli_query(
    $conn,
    "SELECT * FROM contacts WHERE id=$id"
);


$row = mysqli_fetch_assoc($result);


if (!$row) {

    die("Contact not found");

}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);

    $phone = trim($_POST["phone"]);

    $email = trim($_POST["email"]);

    $address = trim($_POST["address"]);


    if (
        $name == "" ||
        !preg_match("/^[A-Za-z]+(?: [A-Za-z]+)*$/", $name)
    ) {

        die("Please enter a valid name");

    }


    if (!preg_match("/^[6-9][0-9]{9}$/", $phone)) {

        die("Please enter a valid mobile number");

    }


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        die("Please enter a valid email address");

    }


    if ($address == "") {

        die("Please enter address");

    }


    $stmt = mysqli_prepare(
        $conn,
        "UPDATE contacts
         SET name=?, phone=?, email=?, address=?
         WHERE id=?"
    );


    mysqli_stmt_bind_param(
        $stmt,
        "ssssi",
        $name,
        $phone,
        $email,
        $address,
        $id
    );


    if (mysqli_stmt_execute($stmt)) {

        header("Location: view.php");

        exit();

    }

}

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Contact</title>

    <link rel="stylesheet" href="style.css">

</head>


<body>

<header>

    <h1>Contact Management System</h1>

    <nav>

        <a href="index.html">Home</a>

        <a href="add.html">Add Contact</a>

        <a href="view.php">View Contacts</a>

    </nav>

</header>


<div class="form-container">

    <h2>Edit Contact</h2>


    <form method="POST">

        <label>Name</label>

        <input
            type="text"
            name="name"
            value="<?php echo htmlspecialchars($row["name"]); ?>"
        >


        <label>Phone</label>

        <input
            type="text"
            name="phone"
            value="<?php echo htmlspecialchars($row["phone"]); ?>"
            maxlength="10"
        >


        <label>Email</label>

        <input
            type="email"
            name="email"
            value="<?php echo htmlspecialchars($row["email"]); ?>"
        >


        <label>Address</label>

        <input
            type="text"
            name="address"
            value="<?php echo htmlspecialchars($row["address"]); ?>"
        >


        <button type="submit">
            Update Contact
        </button>

    </form>

</div>

</body>
</html>