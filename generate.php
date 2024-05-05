<?php
require 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['login_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch user data
$id = $_SESSION['login_id'];
$get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `google_id`='$id'");
if (mysqli_num_rows($get_user) > 0) {
    $user = mysqli_fetch_assoc($get_user);
} else {
    // Redirect to logout if user not found
    header('Location: logout.php');
    exit;
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "google_login";

// Initialize $recommendations array
$recommendations = [];

// Initialize a flag to check if the form has been submitted
$formSubmitted = false;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted and all required fields are present
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['likes']) && isset($_POST['improvements']) && isset($_POST['toolsNeeded']) && isset($_POST['interests']) && isset($_POST['experience'])) {
    // Set the flag to true
    $formSubmitted = true;

    // Prepare and bind parameters for inserting user preferences
    $stmt = $conn->prepare("INSERT INTO user_prefs (user_id, likes, improvements, tools_needed, interests, experience) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssi", $user_id, $likes, $improvements, $toolsNeeded, $interests, $experience);

    // Set parameters and execute the statement
    $user_id = $user['id']; // Assuming 'id' is the primary key of the 'users' table
    $likes = $_POST['likes'];
    $improvements = $_POST['improvements'];
    $toolsNeeded = $_POST['toolsNeeded'];
    $interests = $_POST['interests'];
    $experience = $_POST['experience'];
    
    $stmt->execute();
    
    $stmt->close();

    // Generate recommendations based on user inputs
    if ($interests == 'Frontend') {
        $recommendations[] = '
                              <div class="web-design">
                              <div class="web-design-content bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                              <h1 class="text-gray-900 dark:text-white">Code Academy</h1>
                              <a href="">
                              <img src="./dashboard-pages/dash-images/codeacademy.png" class="">
                              <p class="text-gray-900 dark:text-white"> Codecademy is an online interactive platform that offers free and paid coding classes in various programming languages and web development technologies. </p>
                              </a>
                             </div>
                             <div class="web-design-content bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                              <h1 class="text-gray-900 dark:text-white">Abstract</h1>
                              <a class="/dashboard-pages/designtools/abstract.php">
                              <img src="./dashboard-pages/dash-images/abstract.png">
                              </a>
                              <p class="text-gray-900 dark:text-white">its a platform that empowers designers to create interactive user flows</p>
                             </div>
                             <div class="web-design-content bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                              <h1 class="text-gray-900 dark:text-white">Lottie</h1>
                              <a href="./dashboard-pages/designtools/lottie.php">
                              <img src="./dashboard-pages/dash-images/lottie.png">
                              </a>
                              <p class="text-gray-900 dark:text-white">revolutionizing how apps engage users with dynamic and captivating visual experiences.</p>
                             </div>
                             </div>
                             ';
    } elseif ($interests == 'Backend') {
        $recommendations[] = '<div class="web-design">
                              <div class="web-design-content bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                              <h1 class="text-gray-900 dark:text-white">Data Camp</h1>
                              <a href="./dashboard-pages/database/datacamp.php">
                              <img src="./dashboard-pages/dash-images/datacamp.png" class="">
                              <p class="text-gray-900 dark:text-white"> Data Camp is your gateway to unlocking the immense potential of data and artificial intelligence through comprehensive learning resources.</p>
                              </a>
                             </div>
                             <div class="web-design-content bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                              <h1 class="text-gray-900 dark:text-white">Mode.com</h1>
                              <a class="/dashboard-pages/designtools/abstract.php">
                              <img src="./dashboard-pages/dash-images/mode-com.png">
                              </a>
                              <p class="text-gray-900 dark:text-white">its a platform that empowers designers to create interactive user flows</p>
                             </div>
                             <div class="web-design-content bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                              <h1 class="text-gray-900 dark:text-white">Mongio DB</h1>
                              <a href="./dashboard-pages/database/mode.php">
                              <img src="./dashboard-pages/dash-images/mogodb.png">
                              </a>
                              <p class="text-gray-900 dark:text-white">revolutionizing how apps engage users with dynamic and captivating visual experiences.</p>
                             </div>
                             </div>';
    } elseif ($interests == 'Full Stack') {
        $recommendations[] = '<div class="recomend-header">
                              <div class="recomend-content">
                              <p class="text-gray-900 dark:text-white">If you’re an aspiring developer or looking to level up your programming game, you need to know which tools to use. 
                              Not only will the most up-to-date software make your job easier, it will also help you to provide higher-quality work. 
                              That means higher paying jobs and faster career growth in web development.</p>

                              <p class="text-gray-900 dark:text-white mt-5">We’ve broken down tons of popular coding languages and frameworks for you so you’ll know their exact purpose. 
                              With this knowledge, you’ll be able to take your full-stack development career a bit farther!</p>
                              </div>
                              </div>
                              <div class="web-design">
                              <div class="web-design-content bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                              <h1 class="text-gray-900 dark:text-white">Spark</h1>
                              <a href="">
                              <img src="./dashboard-pages/dash-images/sparkz.png" class="">
                              <p class="text-gray-900 dark:text-white">Apache Spark is an open source data processing and analytics engine that can handle large amounts of data</p>
                              </a>
                             </div>
                             <div class="web-design-content bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                              <h1 class="text-gray-900 dark:text-white">Abstract</h1>
                              <a class="">
                              <img src="./dashboard-pages/dash-images/d3-js.png">
                              </a>
                              <p class="text-gray-900 dark:text-white">D3.js is a JavaScript library for creating custom data visualizations in a web browser. </p>
                             </div>
                             <div class="web-design-content bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                              <h1 class="text-gray-900 dark:text-white">IBM SPSS</h1>
                              <a href="">
                              <img src="./dashboard-pages/dash-images/ibm.png">
                              </a>
                              <p class="text-gray-900 dark:text-white">IBM SPSS is a family of software for managing and analyzing complex statistical data.</p>
                             </div>
                             </div>';
    } elseif ($interests == 'Data Science') {
        $recommendations[] = '<div class="web-design">
                              <div class="web-design-content bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                              <h1 class="text-gray-900 dark:text-white">Data Science Central</h1>
                              <a href="https://www.datasciencecentral.com" target="_blank">
                              <img src="./dashboard-pages/dash-images/datascience.png" class="">
                              <p class="text-gray-900 dark:text-white"> Data Science Central is a community-based website that provides articles, tutorials, webinars, and resources on various topics related to data science, big data, and AI.</p>
                              </a>
                             </div>
                             <div class="web-design-content bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                              <h1 class="text-gray-900 dark:text-white">KD nuggets</h1>
                              <a class="https://www.kdnuggets.com" target="_blank">
                              <img src="./dashboard-pages/dash-images/kraggle.png">
                              </a>
                              <p class="text-gray-900 dark:text-white">D3.js is a JavaScript library for creating custom data visualizations in a web browser. </p>
                             </div>
                             <div class="web-design-content bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                              <h1 class="text-gray-900 dark:text-white">IBM SPSS</h1>
                              <a href="">
                              <img src="./dashboard-pages/dash-images/ibm.png">
                              </a>
                              <p class="text-gray-900 dark:text-white">IBM SPSS is a family of software for managing and analyzing complex statistical data.</p>
                             </div>
                             </div>';     
    } elseif ($interests == 'Web Design') {
        $recommendations[] = '<div class="web-design">
                              <div class="web-design-content bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                              <h1 class="text-gray-900 dark:text-white">Figma</h1>
                              <a href="./dashboard-pages/designtools/figma.php">
                              <img src="images/figma.png" class="">
                              <p class="text-gray-900 dark:text-white">Figma revolutionizes the design process by enabling teams to work together in real time</p>
                              </a>
                             </div>
                             <div class="web-design-content bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                              <h1 class="text-gray-900 dark:text-white">Abstract</h1>
                              <a class="/dashboard-pages/designtools/abstract.php">
                              <img src="./dashboard-pages/dash-images/abstract.png">
                              </a>
                              <p class="text-gray-900 dark:text-white">its a platform that empowers designers to create interactive user flows</p>
                             </div>
                             <div class="web-design-content bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                              <h1 class="text-gray-900 dark:text-white">Lottie</h1>
                              <a href="./dashboard-pages/designtools/lottie.php">
                              <img src="./dashboard-pages/dash-images/lottie.png">
                              </a>
                              <p class="text-gray-900 dark:text-white">revolutionizing how apps engage users with dynamic and captivating visual experiences.</p>
                             </div>
                             </div>';
    }

    $_SESSION['recommendations'] = $recommendations;
    header('Location: show_recomend.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="images/logow.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style/indexss.css">
    <link rel="stylesheet" href="style/generatez.css">
    <title>Generate recommendation</title>
</head>

<body class="bg-white dark:bg-gray-800">
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="images/logow.png" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">TechTool</span>
            </a>
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <button type="button"
                    class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <div class="avatar-container">
                        <img class="h-8 w-8 rounded-full" src="<?php echo $user['profile_image']; ?>"
                            alt="<?php echo $user['name']; ?>">
                    </div>
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white"><?php echo $user['name']; ?></span>
                        <span
                            class="block text-sm  text-gray-500 truncate dark:text-gray-400"><?php echo $user['email']; ?></span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
                        </li>
                        <li>
                            <a href="logout.php"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                out</a>
                        </li>
                    </ul>
                </div>
                <button data-collapse-toggle="navbar-user" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                <ul
                    class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="index.php"
                            class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500"
                            aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
                    </li>
                    <li>
                        <a href="fqa.php"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">FQA</a>
                    </li>
                    <li>
                        <button id="theme-toggle" type="button"
                            class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                    fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="generate-header">
        <div class="generate-image">
            <blockquote class="text-xl italic font-semibold text-gray-900 dark:text-white">
                <svg class="w-8 h-8 text-gray-400 dark:text-gray-600 mb-4" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                    <path
                        d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z" />
                </svg>
                <p>"Our recommendation engine is made to help you identify the precise tools
                    you need to further your career and keep one step ahead of this always changing industry."</p>
            </blockquote>
            <img src="images/recommendation-img.png" alt="">
        </div>
        <div class="generate-content">
            <form class="p-4 md:p-5" id="recommendationForm"
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="likes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> What do
                            you want to learn?</label>
                        <input type="text" name="likes" id="likes"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type what do you want to learn" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="improvements"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">What do you want to
                            improve in your skills?</label>
                        <input type="text" name="improvements" id="improvements"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type what do you want to improve" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="toolsNeeded"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">What website tools do
                            you need?</label>
                        <input type="text" name="toolsNeeded" id="toolsNeeded"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type what tools do you need" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="interests"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select your
                            interest</label>
                        <select id="category" name="interests"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Select an interest</option>
                            <option value="Frontend">Frontend</option>
                            <option value="Backend">Backend</option>
                            <option value="Full Stack">Fullstack</option>
                            <option value="Data Science">Data Science</option>
                            <option value="Web Design">Web Design</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="experience" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">How
                            many years of experience do you have?</label>
                        <input id="experience" rows="4" name="experience" type="number" min="0" required=""
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Years of experience"></input>
                    </div>
                </div>
                <button type="submit"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Submit
                </button>

        </div>
    </div>

    <!-- Display recommendations -->
    <?php if ($formSubmitted && !empty($recommendations)): ?>
        <div class="mt-3" id="recommendationsContainer">
            <h2>Recommendations</h2>
            <ul>
                <?php foreach ($recommendations as $recommendation): ?>
                    <li class="text-gray-900 dark:text-white"><?php echo $recommendation; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <section>


        <!-- Modal toggle -->


        <!-- Main modal -->
        <div id="default-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Terms of Service
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div>
                        <h2 class="text-lg font-normal text-gray-500 dark:text-gray-400 ">Recommendations</h2>
                        <ul>
                            <?php
                            // Check if recommendations are set in the session
                            if (isset($_SESSION['recommendations']) && !empty($_SESSION['recommendations'])) {
                                foreach ($_SESSION['recommendations'] as $recommendation) {
                                    echo ' <div class="web-design-header">
                           <div class="web-design-content">
                           <li class="text-lg font-normal text-gray-500 dark:text-gray-400 ">' . $recommendation . '</li>
                           </div>
                           </div>
                    ';
                                }
                            } else {
                                echo '<li class="">No recommendations available</li>';
                            }
                            ?>
                        </ul>
                        <a href="generate.php"
                            class="text-lg font-normal text-gray-500 dark:text-gray-400 ">generate</a>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="default-modal" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                            accept</button>
                        <button data-modal-hide="default-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                    </div>
                </div>
            </div>
        </div>

    </section>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="script/indexs.js"></script>
</body>

</html>