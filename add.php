<?php

include "database.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"] ?? "");

    $phone = trim($_POST["phone"] ?? "");

    $email = trim($_POST["email"] ?? "");

    $address = trim($_POST["address"] ?? "");


    // NAME

    if (
        $name == "" ||
        !preg_match("/^[A-Za-z]+(?: [A-Za-z]+)*$/", $name)
    ) {

        header("Location: add.html");
        exit();

    }


    // MOBILE

    if (!preg_match("/^[6-9][0-9]{9}$/", $phone)) {

        header("Location: add.html");
        exit();

    }


    // EMAIL

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        header("Location: add.html");
        exit();

    }


    // ADDRESS

    if ($address == "") {

        header("Location: add.html");
        exit();

    }


    // INSERT

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO contacts
        (name, phone, email, address)
        VALUES (?, ?, ?, ?)"
    );


    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $name,
        $phone,
        $email,
        $address
    );


    if (mysqli_stmt_execute($stmt)) {

        header("Location: view.php");

        exit();

    }


    mysqli_stmt_close($stmt);

}


mysqli_close($conn);

?>