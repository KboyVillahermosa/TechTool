<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
</head>
<body>
    <h2>Contact Us</h2>
    <form action="process.php" method="post">
        <label for="name">Your Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        
        <label for="email">Your Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
