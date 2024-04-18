<?php
require 'config.php';

// Check if user is logged in
if (!isset($_SESSION['login_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch all users from database
$query_users = "SELECT * FROM `users`";
$result_users = mysqli_query($db_connection, $query_users);

// Count the number of users
$count_query_users = "SELECT COUNT(*) as total FROM `users`";
$count_result_users = mysqli_query($db_connection, $count_query_users);
$count_data_users = mysqli_fetch_assoc($count_result_users);
$total_users = $count_data_users['total'];

// Fetch all reviews from database using PDO
$connect = new PDO("mysql:host=localhost;dbname=google_login", "root", "");

if(isset($_POST['delete_review_id'])) {
    $delete_review_id = $_POST['delete_review_id'];
    
    // Delete from review_tables
    $query_delete = "DELETE FROM review_tables WHERE review_id = :review_id";
    $statement = $connect->prepare($query_delete);
    $statement->execute(array(':review_id' => $delete_review_id));
    
    // Delete from dou
    $query_delete_dou = "DELETE FROM dou WHERE review_id = :review_id";
    $statement_dou = $connect->prepare($query_delete_dou);
    $statement_dou->execute(array(':review_id' => $delete_review_id));

     // Delete from sinpo
     $query_delete_colorsinpo = "DELETE FROM colorsinpo WHERE review_id = :review_id";
     $statement_colorsinpo = $connect->prepare($query_delete_colorsinpo);
     $statement_colorsinpo->execute(array(':review_id' => $delete_review_id));
}

$query_reviews = "SELECT * FROM review_tables ORDER BY review_id DESC";
$result_reviews = $connect->query($query_reviews, PDO::FETCH_ASSOC);

$query_reviews_dou = "SELECT * FROM dou ORDER BY review_id DESC";
$result_reviews_dou = $connect->query($query_reviews_dou, PDO::FETCH_ASSOC);

$query_reviews_colorsinpo = "SELECT * FROM colorsinpo ORDER BY review_id DESC";
$result_reviews_colorsinpo = $connect->query($query_reviews_colorsinpo, PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>

<h1>User List</h1>

<p>Total Users: <?php echo $total_users; ?></p>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Profile Picture</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result_users)): ?>
            <tr>
                <td><?php echo $row['google_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><img src="<?php echo $row['profile_image']; ?>" alt="<?php echo $row['name']; ?>" width="50"></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<h1>Review List from review_tables</h1>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>User Review</th>
            <th>User Rating</th>
            <th>Date Time</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result_reviews->fetch()): ?>
            <tr>
                <td><?php echo $row['review_id']; ?></td>
                <td><?php echo $row['user_name']; ?></td>
                <td><?php echo $row['user_review']; ?></td>
                <td><?php echo $row['user_rating']; ?></td>
                <td><?php echo $row['datetime']; ?></td>
                <td>
                    <form method="post" onsubmit="return confirm('Are you sure you want to delete this review?');">
                        <input type="hidden" name="delete_review_id" value="<?php echo $row['review_id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<h1>Review List from dou</h1>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>User Review</th>
            <th>User Rating</th>
            <th>Date Time</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result_reviews_dou->fetch()): ?>
            <tr>
                <td><?php echo $row['review_id']; ?></td>
                <td><?php echo $row['user_name']; ?></td>
                <td><?php echo $row['user_review']; ?></td>
                <td><?php echo $row['user_rating']; ?></td>
                <td><?php echo $row['datetime']; ?></td>
                <td>
                    <form method="post" onsubmit="return confirm('Are you sure you want to delete this review?');">
                        <input type="hidden" name="delete_review_id" value="<?php echo $row['review_id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>


<h1>Review List from Colorsinpo</h1>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>User Review</th>
            <th>User Rating</th>
            <th>Date Time</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result_reviews_colorsinpo->fetch()): ?>
            <tr>
                <td><?php echo $row['review_id']; ?></td>
                <td><?php echo $row['user_name']; ?></td>
                <td><?php echo $row['user_review']; ?></td>
                <td><?php echo $row['user_rating']; ?></td>
                <td><?php echo $row['datetime']; ?></td>
                <td>
                    <form method="post" onsubmit="return confirm('Are you sure you want to delete this review?');">
                        <input type="hidden" name="delete_review_id" value="<?php echo $row['review_id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="logout.php">Logout</a>

</body>
</html>
