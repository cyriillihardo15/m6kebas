<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "m6kebas";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to search data based on user input
function searchKaryawan($keyword) {
    global $conn;
    $sql = "SELECT * FROM karyawan WHERE nama LIKE '%$keyword%' OR email LIKE '%$keyword%' OR jabatan LIKE '%$keyword%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Jabatan</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id_karyawan"] . "</td><td>" . $row["nama"] . "</td><td>" . $row["email"] . "</td><td>" . $row["jabatan"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYSQL DATA | Test</title>
</head>
<body>
<h1>DATA KARYAWAN</h1>
<div>
    <!-- Add a search form -->
    <div class="form">
      <form method="POST">
          <input type="text" name="search" placeholder="cari nama, email, atau jabatan">
          <input type="submit" value="Search">
      </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $searchKeyword = $_POST["search"];
        echo "<h2>Hasil Pencarian '$searchKeyword':</h2>";
        searchKaryawan($searchKeyword);
    }
    ?>
    <br>
    <h2>Tabel Karyawan:</h2>
    <?php
    $sql = "SELECT * FROM karyawan";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Jabatan</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id_karyawan"] . "</td><td>" . $row["nama"] . "</td><td>" . $row["email"] . "</td><td>" . $row["jabatan"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</div>
</body>
<style>
        /* CSS styles for form and table */
        h1 {
            text-align: center;
        }

        .container {
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 10px;
            width: 250px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff; /* Blue color for the button */
            color: white;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue color on hover */
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #007bff; /* Blue color for table header */
            color: white;
        }

        th, td {
            min-width: 15%; /* Set a minimum width for table cells */
        }

        .form{
          padding :10px;
        }
    </style>
</html>
