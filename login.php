<?php
require 'config.php';
if (isset($_SESSION['login_id'])) {
    header('Location: index.php');
    exit;
}
require __DIR__ . '/vendor/autoload.php';

// Creating new google client instance
$client = new Google_Client();
// Enter your Client ID
$client->setClientId('929667878021-mfgm5j4ius3c0a5aiuack708vm894ol1.apps.googleusercontent.com');
// Enter your Client Secrect
$client->setClientSecret('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');
// Construct the redirect URI dynamically based on the current file's location
$redirectUri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$client->setRedirectUri($redirectUri);

// Adding those scopes which we want to get (email & profile Information)
$client->addScope("email");
$client->addScope("profile");
if (isset($_GET['code'])):
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($token["error"])) {
        $client->setAccessToken($token['access_token']);
        // getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        // Storing data into database
        $id = mysqli_real_escape_string($db_connection, $google_account_info->id);
        $full_name = mysqli_real_escape_string($db_connection, trim($google_account_info->name));
        $email = mysqli_real_escape_string($db_connection, $google_account_info->email);
        $profile_pic = mysqli_real_escape_string($db_connection, $google_account_info->picture);
        // checking user already exists or not
        $get_user = mysqli_query($db_connection, "SELECT `google_id` FROM `users` WHERE `google_id`='$id'");
        if (mysqli_num_rows($get_user) > 0) {
            $_SESSION['login_id'] = $id;
            header('Location: index.php');
            exit;
        } else {
            // if user not exists we will insert the user
            $insert = mysqli_query($db_connection, "INSERT INTO `users`(`google_id`,`name`,`email`,`profile_image`) VALUES('$id','$full_name','$email','$profile_pic')");
            if ($insert) {
                $_SESSION['login_id'] = $id;
                header('Location: index.php');
                exit;
            } else {
                echo "Sign up failed!(Something went wrong).";
            }
        }
    } else {
        header('Location: login.php');
        exit;
    }
else:
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
        <link rel="shortcut icon" href="images/logow.png" type="image/x-icon">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Techtool Login</title>
        <style>
            *,
            *::before,
            *::after {
                box-sizing: border-box;
                -webkit-box-sizing: border-box;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                padding: 10px;
                margin: 0;

            }

            /* For light mode */
            .bg-white {
                background-color: white;
            }

            /* For dark mode */
            .dark-mode .bg-white {
                background-color: #333;
                /* Example dark background color */
            }

            .dark-mode .dark-bg-gray-800 {
                background-color: #333;
                /* Example dark background color */
            }

            .header {
                align-items: center;
                height: 90vh;
                display: flex;
                justify-content: center;
            }

            .content {
                width: 100%;
                max-width: 600px;
            }

            ._container {
                max-width: 400px;
                padding: 20px;
                margin: 0 auto;
                border: 1px solid #cccccc;
                border-radius: 2px;

            }

            ._container.btn {
                text-align: center;
            }

            .heading {
                text-align: center;
                color: #4d4d4d;
                text-transform: uppercase;
            }

            .login-with-google-btn {
                transition: background-color 0.3s, box-shadow 0.3s;
                padding: 12px 16px 12px 42px;
                border: none;
                border-radius: 3px;
                box-shadow: 0 -1px 0 rgb(0 0 0 / 4%), 0 1px 1px rgb(0 0 0 / 25%);
                color: #ffffff;
                font-size: 14px;
                font-weight: 500;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
                background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMTcuNiA5LjJsLS4xLTEuOEg5djMuNGg0LjhDMTMuNiAxMiAxMyAxMyAxMiAxMy42djIuMmgzYTguOCA4LjggMCAwIDAgMi42LTYuNnoiIGZpbGw9IiM0Mjg1RjQiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik05IDE4YzIuNCAwIDQuNS0uOCA2LTIuMmwtMy0yLjJhNS40IDUuNCAwIDAgMS04LTIuOUgxVjEzYTkgOSAwIDAgMCA4IDV6IiBmaWxsPSIjMzRBODUzIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNNCAxMC43YTUuNCA1LjQgMCAwIDEgMC0zLjRWNUgxYTkgOSAwIDAgMCAwIDhsMy0yLjN6IiBmaWxsPSIjRkJCQzA1IiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNOSAzLjZjMS4zIDAgMi41LjQgMy40IDEuM0wxNSAyLjNBOSA5IDAgMCAwIDEgNWwzIDIuNGE1LjQgNS40IDAgMCAxIDUtMy43eiIgZmlsbD0iI0VBNDMzNSIgZmlsbC1ydWxlPSJub256ZXJvIi8+PHBhdGggZD0iTTAgMGgxOHYxOEgweiIvPjwvZz48L3N2Zz4=);
                background-color: #4a4a4a;
                background-repeat: no-repeat;
                background-position: 12px 11px;
                text-decoration: none;
            }

            .login-with-google-btn:hover {
                box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 2px 4px rgba(0, 0, 0, 0.25);
            }

            .login-with-google-btn:active {
                background-color: #000000;
            }

            .login-with-google-btn:focus {
                outline: none;
                box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 2px 4px rgba(0, 0, 0, 0.25), 0 0 0 3px #c8dafc;
            }

            .login-with-google-btn:disabled {
                filter: grayscale(100%);
                background-color: #ebebeb;
                box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 1px 1px rgba(0, 0, 0, 0.25);
                cursor: not-allowed;
            }

            .image {
                background-repeat: no-repeat;
                background-size: cover;
                width: 100%;
                height: 97vh;
            }
        </style>
    </head>

    <body class="bg-white dark:bg-gray-800">

        <section class="image" style="background-image: url('images/llleaves.svg');">
            <div class="header ">
                <div class="content">
                    <div class="_container border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                        <button id="theme-toggle" type="button"
                            class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                    fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <h2 class="heading text-gray-900 dark:text-white text-3xl md:text-3xl font-bold ">Login to Techtool</h2>
                    </div>
                    <div class="_container btn border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                        <a type="button" class="login-with-google-btn" href="<?php echo $client->createAuthUrl(); ?>">
                            Sign in with Google
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
        <script src="script/indexs.js"></script>
    </body>

    </html>
<?php endif; ?>