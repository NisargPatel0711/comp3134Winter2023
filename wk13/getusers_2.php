<!DOCTYPE html>
<html>
<head>
        <title>Get Users</title>
</head>
<body>
        <form method="GET">
                <label for="firstname">Enter First Name:</label>
                <input type="text" name="firstname" id="firstname">
                <input type="submit" value="Search">
        </form>
        <?php
                // check if form is submitted
                if (isset($_GET['firstname'])) {
                        // get search query
                        $firstname = $_GET['firstname'];
                        // connect to database
                        $host = "localhost";
                        $username = "root";
                        $password = "SecurePassword";
                        $dbname = "lab9";
                        $conn = mysqli_connect($host, $username, $password, $dbname);
                        if (mysqli_connect_errno()) {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            exit();
                        }

                        // query database for matching rows
                        $query = "SELECT * FROM lab9.users WHERE firstname LIKE $firstname and active=1";
                        echo $query;
                        $result = mysqli_query($conn, $query);
                        // check if any rows were returned
                        if (mysqli_num_rows($result) > 0) {
                                // display table with results
                                echo "<table>";
                                echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>First Name</th><th>Last Name</th><th>Active</th></tr>";
                                while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['username'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['firstname'] . "</td>";
                                        echo "<td>" . $row['lastname'] . "</td>";
                                        echo "<td>" . $row['active'] . "</td>";
                                        echo "</tr>";
                                }
                                echo "</table>";
                        } else {
                                echo "No results found.";
                        }

                        // close database connection
                        mysqli_close($conn);
                }
        ?>
</body>
</html>
