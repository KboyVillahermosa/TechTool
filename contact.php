<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        #successMessage {
            display: none;
            color: green;
            background-color: #d4edda;
            border-color: #c3e6cb;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid transparent;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contact Us</h1>
        <form id="myForm" action="https://formsubmit.co/5699f1b370fe0eda5f4ed182c0cc2c76" method="POST">
            <label for="sendername">Name</label>
            <input type="text" id="sendername" name="name" placeholder="Enter your name" required>
            <label for="to">Email</label>
            <input type="email" id="to" name="email" placeholder="Enter your email" required>
            <label for="message">Message</label>
            <textarea name="message" id="message" placeholder="Enter your message" required></textarea>
            <button type="submit">Submit</button>
        </form>
        <div id="successMessage">
            Message submitted successfully!
        </div>
    </div>

    <script>
        function showSuccessMessage() {
            document.getElementById('successMessage').style.display = 'block';
            setTimeout(function() {
                document.getElementById('successMessage').style.display = 'none';
            }, 5000); // Hide the message after 5 seconds
        }

        document.getElementById('myForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            var form = event.target;
            var formData = new FormData(form);

            // You can send the form data using AJAX here if you prefer
            // Example using fetch API:
            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    showSuccessMessage();
                    form.reset(); // Reset the form after successful submission
                } else {
                    alert('Failed to submit form. Please try again.'); // Show an error message if submission fails
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to submit form. Please try again.'); // Show an error message if submission fails
            });
        });
    </script>
</body>
</html>

