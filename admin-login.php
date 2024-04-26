<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="login.css">
    <title>Login Page</title>
</head>

<body>
    <style>
        .title-admin{
            display: flex;
            justify-content: center;
            margin-top: 100px;
        }
        .title-admin h1{
            font-size: clamp(2.1875rem, 1.0156rem + 3.75vw, 3.125rem);
        }
        .admin-login-header{
            display: flex;
            justify-content: center;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            margin-top: 50px;
            background: white;
            box-shadow: 10px;
            padding: 20px;
            text-align: center;

        }
        .admin-content-login{
            width: 100%;
            max-width: 500px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
         

        }
        .textbox input{
            margin-bottom: 10px;
            width: 100%;
            max-width: 300px;
            padding: 10px;

        }

        .admin-image{
            padding: 20px;        
            background: skyblue

        }
        .admin-content-login img{
            width: 100%;
            max-width: 300px;
            margin: auto 80px;
          
        }
        .admin-content-login h1{
            font-size: clamp(1.875rem, 1.0938rem + 2.5vw, 2.5rem);
          
        }
        label{
            display: block;
        }

    </style>
 
    <div class="admin-login-header">
        <div class="admin-content-login" >
            <form action="validate.php" method="post">
                <h1 class="">Admin Login</h1>
                    <img src="./images/admin-login.png" alt="">
                    <div class="textbox ">
                        <label for="">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <input type="text" placeholder="Username" name="username" value="" class="">
                        </label>
                   

                        <label for="">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" placeholder="Password" name="password" value="">
                        </label>
                  

                    <input class="button text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" type="submit" name="login" value="Sign In">
                </div>
            </form>
        </div>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>