<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="login.css">
    <title>Login Page</title>
</head>

<body class="bg-white dark:bg-gray-800">
    <style>
        .title-admin {
            display: flex;
            justify-content: center;
            margin-top: 100px;
        }

        .title-admin h1 {
            font-size: clamp(2.1875rem, 1.0156rem + 3.75vw, 3.125rem);
        }

        .admin-login-header {
            display: flex;
            justify-content: center;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            margin-top: 50px;
            box-shadow: 10px;
            padding: 20px;
        }

        .admin-content-login {
            width: 100%;
            max-width: 500px;
            padding: 20px;
        }

        .textbox input {
            margin-bottom: 10px;
            width: 100%;
            max-width: 300px;
            padding: 10px;
            border-radius: 5px;
        }

        .admin-content-login img {
            width: 100%;
            max-width: 300px;
            margin: auto 80px;

        }

        .admin-content-login h1 {
            font-size: clamp(1.875rem, 1.0938rem + 2.5vw, 2.5rem);

        }

        label {
            display: block;
        }
    </style>


    <div class="admin-login-header">
        <div class="admin-image">
            <img src="./images/admin.png" alt="">
        </div>
        <div class="admin-content-login">
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
            <form action="validate.php" method="post">
                <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Admin Login</h1>
                <div class="textbox ">
                    <label for="" class="mb-2 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-2xl dark:text-white"><i class="fa fa-user text-gray-900 dark:text-white" aria-hidden="true"></i> Username </label>
                        <input type="text" placeholder="Username" class="" name="username" value="" class="">
            

                    <label for="" class="mb-2 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-2xl dark:text-white"><i class="fa fa-lock text-gray-900 dark:text-white" aria-hidden="true"></i> Password</label>
                        <input type="password" placeholder="Password" name="password" value="">
                


                    <input
                        class="button text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                        type="submit" name="login" value="Sign In">
                </div>
            </form>
        </div>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="script/indexs.js"></script>
</body>

</html>