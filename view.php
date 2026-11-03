<?php

include "database.php";

$result = mysqli_query(
    $conn,
    "SELECT * FROM contacts ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>View Contacts</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<header>

    <h1>Contact Management System</h1>

    <nav>

        <a href="index.html">
            Home
        </a>

        <a href="add.html">
            Add Contact
        </a>

        <a href="view.php">
            View Contacts
        </a>

    </nav>

</header>


<div class="container">

    <h2>All Contacts</h2>

    <br>

    <a href="add.html" class="btn">
        Add New Contact
    </a>


    <br><br>


    <table>

        <tr>

            <th>ID</th>

            <th>Name</th>

            <th>Phone</th>

            <th>Email</th>

            <th>Address</th>

            <th>Action</th>

        </tr>


        <?php

        while ($row = mysqli_fetch_assoc($result)) {

        ?>

        <tr>

            <td>
                <?php echo $row["id"]; ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row["name"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row["phone"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row["email"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row["address"]); ?>
            </td>

            <td>

                <a
                    class="edit"
                    href="edit.php?id=<?php echo $row["id"]; ?>">
                    Edit
                </a>


                <a
                    class="delete"
                    href="delete.php?id=<?php echo $row["id"]; ?>"
                    onclick="return confirmDelete();">
                    Delete
                </a>

            </td>

        </tr>

        <?php

        }

        ?>

    </table>

</div>


<script>

function confirmDelete() {

    return confirm(
        "Are you sure you want to delete this contact?"
    );

}

</script>


</body>
</html>