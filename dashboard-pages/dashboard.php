<?php
require '../config.php'; // Adjust the path as per your file structure
if (!isset($_SESSION['login_id'])) {
    header('Location: login.php');
    exit;
}
$id = $_SESSION['login_id'];
$get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `google_id`='$id'");
if (mysqli_num_rows($get_user) > 0) {
    $user = mysqli_fetch_assoc($get_user);
} else {
    header('Location: logout.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../images/logow.png" type="image/x-icon">
    <link rel="stylesheet" href="../dashboard-pages/dashboard-css/dashboards.css">
    <title>Introduction</title>
</head>

<body class="bg-white dark:bg-gray-800">
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                    <a href="../index.php" class="flex ms-2 md:me-24">
                        <img src="../images/logow.png" class="h-8 me-3" alt="FlowBite Logo" />
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">TechTool</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div class="dark-mode mr-5">
                            <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                </svg>
                                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <div>
                            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" src="<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>">
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <span class="block text-sm text-gray-900 dark:text-white"><?php echo $user['name']; ?></span>
                                <span class="block text-sm  text-gray-500 truncate dark:text-gray-400"><?php echo $user['email']; ?></span>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Earnings</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <p class="text-gray-600 dark:text-gray-300">Getting Started</p>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ms-3">Introduction</span>
                    </a>
                </li>
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="color-system" data-collapse-toggle="color-system">
                        <i class="fa-solid fa-palette flex-shrink-0 w-5 h-5 "></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Color</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="color-system" class="hidden py-2 space-y-2">
                        <li>
                            <a href="../dashboard-pages/color/adobecolor.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Adobe Color</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/color/colorsinpo.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Coloorsinpo</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/color/coolors.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Coloors</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/color/colorhunt.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Color Hunt</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/color/dou.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Dou</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/color/happyhues.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Happy Hues</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/color/khroma.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Khroma</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/color/lolcolors.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">LOL Colors</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/color/sip.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Sip</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="framewrok-system" data-collapse-toggle="framework-system">
                        <i class="fa-brands fa-css3-alt  w-5 h-5"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">CSS Frameworks</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="framework-system" class="hidden py-2 space-y-2">
                        <li>
                            <a href="../dashboard-pages/css-framework/tailwindcomponents.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Tailwind Components</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/css-framework/tailwindcheat.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Tailwind Cheat</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <i class="fa-solid fa-swatchbook w-5 h-5"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Design Tools</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-example" class="hidden py-2 space-y-2">
                        <li>
                            <a href="../dashboard-pages/designtools/abstract.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Abstract</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/designtools/figma.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Figma</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/designtools/lottie.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Lottie</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/designtools/maze.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Maze</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/designtools/overflow.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Overflow</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/designtools/sketch.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Sketch</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/designtools/ziplin.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Ziplin</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="design-system" data-collapse-toggle="design-system">
                        <i class="fa-solid fa-swatchbook w-5 h-5"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Design System</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="design-system" class="hidden py-2 space-y-2">
                        <li>
                            <a href="../dashboard-pages/designsystem/adele.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"> Adele</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/designsystem/atlassian.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"> Atlassian</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/designsystem/carbonsystem.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Carbon Design System</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/designsystem/evergreen.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"> Evergreen</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/designsystem/polaries.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Polaris</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/designsystem/futurelearn.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Future Learn</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/designsystem/githubprimer.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Github Primer</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/designsystem/marvelstyle.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Marvel Style Guide</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/designsystem/mixpanel.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Mixpanel</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/designsystem/spectrumadobe.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Spectrum by Adobe</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/designsystem/zendeskgarden.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Zendesk Garden</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="database-system" data-collapse-toggle="database-system">
                        <i class="fa-solid fa-database w-5 h-5"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Database System</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="database-system" class="hidden py-2 space-y-2">
                        <li>
                            <a href="../dashboard-pages/database/datacamp.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Data Camp</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/database/dbdiagram.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">DB Diagram</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/database/geeksforgeeks.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Geeks for Geeks</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/database/mode.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Mode</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/database/mysqldocument.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">MySQL Documentation</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/database/mongodb.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">MongoDB Documentation</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/database/redash.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Redash</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/database/sqlpad.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">SQL Pad</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/database/sqlzoo.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">SQL Zoo</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="prototype-system" data-collapse-toggle="prototype-system">
                        <i class="fa-brands fa-medium w-5 h-5"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Prototyping Tools</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="prototype-system" class="hidden py-2 space-y-2">
                        <li>
                            <a href="../dashboard-pages/prototyping-tools/flinto.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Flinto</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/prototyping-tools/framer.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Framer</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/prototyping-tools/invision.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Invision</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/prototyping-tools/marvel.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Marvel</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/prototyping-tools/protopie.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Protopie</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="vision-system" data-collapse-toggle="vision-system">
                        <i class="fa-solid fa-code-compare w-5 h-5"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Version Control</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="vision-system" class="hidden py-2 space-y-2">
                        <li>
                            <a href="../dashboard-pages/version-control/github.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Github</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/version-control/gittea.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Gitea</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="wireframe-system" data-collapse-toggle="wireframe-system">
                        <i class="fa-solid fa-network-wired w-5 h-5"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Wireframing</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="wireframe-system" class="hidden py-2 space-y-2">
                        <li>
                            <a href="../dashboard-pages/wireframing/useflowkit.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">flowKit</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/wireframing/sneakpeekit.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">SneakPeeKit</a>
                        </li>
                        <li>
                            <a href="../dashboard-pages/wireframing/mockflow.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Mockflow</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>
    <section class="sm:ml-64">
        <div class="introduction-header">
            <div class="introduction-content">
                <h1 class="text-gray-900 dark:text-white">Quick Start Guide</h1>
                <p class="text-gray-600 dark:text-gray-300">Welcome to the IT/CS Toolbox Quick Start Guide! Whether you're a seasoned professional or just starting out,
                    this guide will provide you with a comprehensive introduction to the essential tools and concepts you'll encounter on a daily basis.</p>
            </div>
        </div>
        <div class="explore-title">
            <div class="explore-title-content">
                <h1 class="text-gray-900 dark:text-white">Explore Essential Tools</h1>
                <p class="text-gray-600 dark:text-gray-300">Get started by familiarizing yourself with our essential tools such as:Get started by familiarizing yourself with our essential tools such as:
                </p>
            </div>
        </div>
        <div class="figma-header">
            <div class="figma-content">
                <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[8px] rounded-t-xl h-[172px] max-w-[301px] md:h-[294px] md:max-w-[512px]">
                    <div class="rounded-lg overflow-hidden bg-white dark:bg-gray-800">
                        <img src="../dashboard-pages/dash-images/example-2.gif" class="dark:hidden h-[156px] md:h-[278px] w-full rounded-xl" alt="">
                        <img src="../dashboard-pages/dash-images/example-2.gif" class="hidden dark:block h-[156px] md:h-[278px] w-full rounded-lg" alt="">
                    </div>
                </div>
                <div class="relative mx-auto bg-gray-900 dark:bg-gray-700 rounded-b-xl rounded-t-sm h-[17px] max-w-[351px] md:h-[21px] md:max-w-[597px]">
                    <div class="absolute left-1/2 top-0 -translate-x-1/2 rounded-b-xl w-[56px] h-[5px] md:w-[96px] md:h-[8px] bg-gray-800"></div>
                </div>
            </div>
            <div class="figma-text">
                <h1 class="text-gray-900 dark:text-white">Figma</h1>
                <p class="text-gray-600 dark:text-gray-300"> A powerful design tool that enables collaborative interface design, prototyping, and user testing. Create visually stunning and intuitive user experiences with ease</p>
            </div>

            <!---------------------------------- Bootstrap ------------------------------------------->

            <div class="figma-content">
                <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[8px] rounded-t-xl h-[172px] max-w-[301px] md:h-[294px] md:max-w-[512px]">
                    <div class="rounded-lg overflow-hidden bg-white dark:bg-gray-800">
                        <img src="../dashboard-pages/dash-images/tailwind-animation.gif" class="dark:hidden h-[156px] md:h-[278px] w-full rounded-xl" alt="">
                        <img src="../dashboard-pages/dash-images/tailwind-animation.gif" class="hidden dark:block h-[156px] md:h-[278px] w-full rounded-lg" alt="">
                    </div>
                </div>
                <div class="relative mx-auto bg-gray-900 dark:bg-gray-700 rounded-b-xl rounded-t-sm h-[17px] max-w-[351px] md:h-[21px] md:max-w-[597px]">
                    <div class="absolute left-1/2 top-0 -translate-x-1/2 rounded-b-xl w-[56px] h-[5px] md:w-[96px] md:h-[8px] bg-gray-800"></div>
                </div>
            </div>
            <div class="figma-text">
                <h1 class="text-gray-900 dark:text-white">Tailwind CSS and Bootstrap:</h1>
                <p class="text-gray-600 dark:text-gray-300"> Popular CSS frameworks that streamline front-end development by providing pre-designed components, responsive layouts, and utility classes. Build modern, responsive web applications faster and more efficiently.</p>
            </div>


            <!----------------------------------------- ReactJS framework: ----------------------------------------->
            <div class="figma-content">
                <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[8px] rounded-t-xl h-[172px] max-w-[301px] md:h-[294px] md:max-w-[512px]">
                    <div class="rounded-lg overflow-hidden  bg-white dark:bg-gray-800">
                        <img src="../dashboard-pages/dash-images/react-ui.gif" class="dark:hidden h-[156px] md:h-[278px] w-full rounded-xl" alt="">
                        <img src="../dashboard-pages/dash-images/react-ui.gif" class="hidden dark:block h-[156px] md:h-[278px] w-full rounded-lg" alt="">
                    </div>
                </div>
                <div class="relative mx-auto bg-gray-900 dark:bg-gray-700 rounded-b-xl rounded-t-sm h-[17px] max-w-[351px] md:h-[21px] md:max-w-[597px]">
                    <div class="absolute left-1/2 top-0 -translate-x-1/2 rounded-b-xl w-[56px] h-[5px] md:w-[96px] md:h-[8px] bg-gray-800"></div>
                </div>
            </div>
            <div class="figma-text">
                <h1 class="text-gray-900 dark:text-white">ReactJS framework:</h1>
                <p class="text-gray-600 dark:text-gray-300"> A JavaScript library for building dynamic user interfaces.
                    React allows you to create reusable UI components, manage state efficiently, and optimize performance for complex web applications.</p>
            </div>
        </div>


        <section>
            <!--------- . Dive into Development Resources: -------------------->
            <div class="dive-into-title-header">
                <div class="dive-into-title-content">
                    <h1 class="text-gray-900 dark:text-white"> Dive into Development Resources:</h1>
                    <p class="text-gray-600 dark:text-gray-300">Delve deeper into our collection of development resources, including:</p>
                </div>
            </div>

            <div class="development-header">
                <div class="development-content">
                    <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[8px] rounded-t-xl h-[172px] max-w-[301px] md:h-[294px] md:max-w-[512px]">
                        <div class="rounded-lg overflow-hidden  bg-white dark:bg-gray-800">
                            <img src="../dashboard-pages/dash-images/axios.gif" class="dark:hidden h-[156px] md:h-[278px] w-full rounded-xl" alt="">
                            <img src="../dashboard-pages/dash-images/axios.gif" class="hidden dark:block h-[156px] md:h-[278px] w-full rounded-lg" alt="">
                        </div>
                    </div>
                    <div class="relative mx-auto bg-gray-900 dark:bg-gray-700 rounded-b-xl rounded-t-sm h-[17px] max-w-[351px] md:h-[21px] md:max-w-[597px]">
                        <div class="absolute left-1/2 top-0 -translate-x-1/2 rounded-b-xl w-[56px] h-[5px] md:w-[96px] md:h-[8px] bg-gray-800"></div>
                    </div>
                </div>
                <div class="development-text">
                    <h1 class="text-gray-900 dark:text-white"> Dive into Development Resources:</h1>
                    <p class="text-gray-600 dark:text-gray-300">Explore a variety of JavaScript libraries such as jQuery, lodash, and Axios, which offer additional functionality and simplify common tasks in web development.</p>
                </div>

                <!------------------------- code editorss ----------------------------------->
                <div class="development-content">
                    <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[8px] rounded-t-xl h-[172px] max-w-[301px] md:h-[294px] md:max-w-[512px]">
                        <div class="rounded-lg overflow-hidden  bg-white dark:bg-gray-800">
                            <img src="../dashboard-pages/dash-images/vscode.gif" class="dark:hidden h-[156px] md:h-[278px] w-full rounded-xl" alt="">
                            <img src="../dashboard-pages/dash-images/vscode.gif" class="hidden dark:block h-[156px] md:h-[278px] w-full rounded-lg" alt="">
                        </div>
                    </div>
                    <div class="relative mx-auto bg-gray-900 dark:bg-gray-700 rounded-b-xl rounded-t-sm h-[17px] max-w-[351px] md:h-[21px] md:max-w-[597px]">
                        <div class="absolute left-1/2 top-0 -translate-x-1/2 rounded-b-xl w-[56px] h-[5px] md:w-[96px] md:h-[8px] bg-gray-800"></div>
                    </div>
                </div>
                <div class="development-text">
                    <h1 class="text-gray-900 dark:text-white"> Code Editors:</h1>
                    <p class="text-gray-600 dark:text-gray-300">Choose from a range of code editors like Visual Studio Code, Sublime Text, and Atom, equipped with features such as syntax highlighting, code completion, and version control integration to enhance your coding experience.</p>
                </div>

                <!------------------------- version control -------------------------------------->
                <div class="development-content">
                    <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[8px] rounded-t-xl h-[172px] max-w-[301px] md:h-[294px] md:max-w-[512px]">
                        <div class="rounded-lg overflow-hidden  bg-white dark:bg-gray-800">
                            <img src="../dashboard-pages/dash-images/flow.gif" class="dark:hidden h-[156px] md:h-[278px] w-full rounded-xl" alt="">
                            <img src="../dashboard-pages/dash-images/flow.gif" class="hidden dark:block h-[156px] md:h-[278px] w-full rounded-lg" alt="">
                        </div>
                    </div>
                    <div class="relative mx-auto bg-gray-900 dark:bg-gray-700 rounded-b-xl rounded-t-sm h-[17px] max-w-[351px] md:h-[21px] md:max-w-[597px]">
                        <div class="absolute left-1/2 top-0 -translate-x-1/2 rounded-b-xl w-[56px] h-[5px] md:w-[96px] md:h-[8px] bg-gray-800"></div>
                    </div>
                </div>
                <div class="development-text">
                    <h1 class="text-gray-900 dark:text-white"> Version Control Systems:</h1>
                    <p class="text-gray-600 dark:text-gray-300"> Learn how to use version control systems like Git and GitHub to track changes in your codebase, collaborate with team members, and maintain a centralized repository for your projects.</p>
                </div>
            </div>
        </section>

        <!-----------------------------------  Master Database Management: -------------------------->
        <section>
            <div class="database-title">
                <div class="database-title-content">
                    <h1 class="text-gray-900 dark:text-white"> Master Database Management:</h1>
                    <p class="text-gray-600 dark:text-gray-300"> Unlock the power of efficient database management with tools such as:</p>
                </div>
            </div>

            <div class="database-header">
                <div class="database-content">
                    <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[8px] rounded-t-xl h-[172px] max-w-[301px] md:h-[294px] md:max-w-[512px]">
                        <div class="rounded-lg overflow-hidden bg-white dark:bg-gray-800">
                            <img src="../dashboard-pages/dash-images/mode.gif" class="dark:hidden h-[156px] md:h-[278px] w-full rounded-xl" alt="">
                            <img src="../dashboard-pages/dash-images/mode.gif" class="hidden dark:block h-[156px] md:h-[278px] w-full rounded-lg" alt="">
                        </div>
                    </div>
                    <div class="relative mx-auto bg-gray-900 dark:bg-gray-700 rounded-b-xl rounded-t-sm h-[17px] max-w-[351px] md:h-[21px] md:max-w-[597px]">
                        <div class="absolute left-1/2 top-0 -translate-x-1/2 rounded-b-xl w-[56px] h-[5px] md:w-[96px] md:h-[8px] bg-gray-800"></div>
                    </div>
                </div>
                <div class="database-text">
                    <h1 class="text-gray-900 dark:text-white"> Mode.com </h1>
                    <p class="text-gray-600 dark:text-gray-300"> A comprehensive platform for SQL analysis and visualization, allowing you to query databases, create interactive dashboards, and share insights with stakeholders. Gain valuable insights from your data and make data-driven decisions with confidence.</p>
                </div>
                <div class="database-content">
                    <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[8px] rounded-t-xl h-[172px] max-w-[301px] md:h-[294px] md:max-w-[512px]">
                        <div class="rounded-lg overflow-hidden  bg-white dark:bg-gray-800">
                            <img src="../dashboard-pages/dash-images/mysql-php.gif" class="dark:hidden h-[156px] md:h-[278px] w-full rounded-xl" alt="">
                            <img src="../dashboard-pages/dash-images/mysql-php.gif" class="hidden dark:block h-[156px] md:h-[278px] w-full rounded-lg" alt="">
                        </div>
                    </div>
                    <div class="relative mx-auto bg-gray-900 dark:bg-gray-700 rounded-b-xl rounded-t-sm h-[17px] max-w-[351px] md:h-[21px] md:max-w-[597px]">
                        <div class="absolute left-1/2 top-0 -translate-x-1/2 rounded-b-xl w-[56px] h-[5px] md:w-[96px] md:h-[8px] bg-gray-800"></div>
                    </div>
                </div>
                <!------------------------------  Database Utilities: -------------------------------->
                <div class="database-text">
                    <h1 class="text-gray-900 dark:text-white"> Database Utilities </h1>
                    <p class="text-gray-600 dark:text-gray-300"> Explore a variety of database utilities for tasks such as data modeling, schema management, and performance optimization. Whether you're working with relational databases like MySQL and PostgreSQL or NoSQL databases like MongoDB, these tools will streamline your database management tasks.</p>
                </div>
            </div>
        </section>
        <!------------generators -------------->
        <section>
            <div class="generator-title">
                <div class="generator-title-content">
                    <h1 class="text-gray-900 dark:text-white"> Spark Creativity with Generators</h1>
                    <p class="text-gray-600 dark:text-gray-300"> Fuel your creativity with our selection of generators, including:</p>
                </div>
            </div>
            <div class="generator-header">
                <div class="generator-content">
                    <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[8px] rounded-t-xl h-[172px] max-w-[301px] md:h-[294px] md:max-w-[512px]">
                        <div class="rounded-lg overflow-hidden bg-white dark:bg-gray-800">
                            <img src="../dashboard-pages/dash-images/shape-gene.gif" class="dark:hidden h-[156px] md:h-[278px] w-full rounded-xl" alt="">
                            <img src="../dashboard-pages/dash-images/shape-gene.gif" class="hidden dark:block h-[156px] md:h-[278px] w-full rounded-lg" alt="">
                        </div>
                    </div>
                    <div class="relative mx-auto bg-gray-900 dark:bg-gray-700 rounded-b-xl rounded-t-sm h-[17px] max-w-[351px] md:h-[21px] md:max-w-[597px]">
                        <div class="absolute left-1/2 top-0 -translate-x-1/2 rounded-b-xl w-[56px] h-[5px] md:w-[96px] md:h-[8px] bg-gray-800"></div>
                    </div>
                </div>
                <div class="generator-text">
                    <h1 class="text-gray-900 dark:text-white"> Shape Generators:</h1>
                    <p class="text-gray-600 dark:text-gray-300"> Experiment with geometric shapes, patterns, and textures to create visually appealing design elements for your projects.</p>
                </div>

                <!------------------ color palettes ---------------------->

                <div class="generator-content">
                    <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[8px] rounded-t-xl h-[172px] max-w-[301px] md:h-[294px] md:max-w-[512px]">
                        <div class="rounded-lg overflow-hidden bg-white dark:bg-gray-800">
                            <img src="../dashboard-pages/dash-images/accessible-palette.gif" class="dark:hidden h-[156px] md:h-[278px] w-full rounded-xl" alt="">
                            <img src="../dashboard-pages/dash-images/accessible-palette.gif" class="hidden dark:block h-[156px] md:h-[278px] w-full rounded-lg" alt="">
                        </div>
                    </div>
                    <div class="relative mx-auto bg-gray-900 dark:bg-gray-700 rounded-b-xl rounded-t-sm h-[17px] max-w-[351px] md:h-[21px] md:max-w-[597px]">
                        <div class="absolute left-1/2 top-0 -translate-x-1/2 rounded-b-xl w-[56px] h-[5px] md:w-[96px] md:h-[8px] bg-gray-800"></div>
                    </div>
                </div>
                <div class="generator-text">
                    <h1 class="text-gray-900 dark:text-white"> Color Palettes:</h1>
                    <p class="text-gray-600 dark:text-gray-300">Explore curated color palettes and color scheme generators to find the perfect combination of colors for your designs. Create harmonious color schemes that evoke the desired mood and enhance user experience.</p>
                </div>
            </div>
        </section>
        <section>
            <div class="stay-inform-title">
                <div class="stay-inform-title-content">
                    <h1 class="text-gray-900 dark:text-white"> Stay Informed with Educational Content:</h1>
                    <p class="text-gray-600 dark:text-gray-300"> Stay ahead of the curve with our curated articles, tutorials, and guides covering a wide range of topics such as:</p>
                </div>
            </div>
            <div class="stay-inform-header">
                <div class="stay-inform-content">
                    <h1 class="text-gray-900 dark:text-white">Latest Technology Trends:</h1>
                    <p class="text-gray-600 dark:text-gray-300"> Stay updated on the latest advancements in technology, including emerging programming languages, frameworks, and tools shaping the future of IT and CS.</p>
                </div>
                <div class="stay-inform-content">
                    <h1 class="text-gray-900 dark:text-white">Software Development Best Practices:</h1>
                    <p class="text-gray-600 dark:text-gray-300"> Learn industry-proven techniques and strategies for writing clean, maintainable code, optimizing performance, and following agile development methodologies.</p>
                </div>
                <div class="stay-inform-content">
                    <p class="text-gray-600 dark:text-gray-300"> Connect with fellow enthusiasts, share insights, and collaborate on projects within our vibrant community forum. Engage in discussions on topics ranging from technical challenges and project ideas to career advice and industry trends. Forge valuable connections with peers who share your passion for IT and CS and embark on collaborative ventures that push the boundaries of innovation.</p>
                </div>
            </div>
        </section>
        <!-----------------foooter--------------------------->
        <footer class="bg-white dark:bg-gray-900">
            <div class="mx-auto w-full p-4 py-6 lg:py-8">
                <div class="md:flex md:justify-between">
                    <div class="mb-6 md:mb-0">
                        <a href="https://flowbite.com/" class="flex items-center">
                            <img src="dash-images/logow.png" class="h-8 me-3" alt="FlowBite Logo" />
                            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">TechTool</span>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Resources</h2>
                            <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                <li class="mb-4">
                                    <a href="https://flowbite.com/" class="hover:underline">Flowbite</a>
                                </li>
                                <li>
                                    <a href="https://tailwindcss.com/" class="hover:underline">Tailwind CSS</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Follow us</h2>
                            <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                <li class="mb-4">
                                    <a href="https://github.com/themesberg/flowbite" class="hover:underline ">Github</a>
                                </li>
                                <li>
                                    <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Discord</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                            <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                <li class="mb-4">
                                    <a href="#" class="hover:underline">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <div class="sm:flex sm:items-center sm:justify-between">
                    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
                    </span>
                    <div class="flex mt-4 sm:justify-center sm:mt-0">
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                                <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Facebook page</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 21 16">
                                <path d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z" />
                            </svg>
                            <span class="sr-only">Discord community</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 17">
                                <path fill-rule="evenodd" d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Twitter page</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">GitHub account</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.094 20.094 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM8 1.707a8.821 8.821 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.758 45.758 0 0 0 8 1.707ZM1.642 8.262a8.57 8.57 0 0 1 4.73-5.981A53.998 53.998 0 0 1 9.54 7.222a32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.64 31.64 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM10 18.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 13.113 11a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Dribbble account</span>
                        </a>
                    </div>
                </div>
            </div>
        </footer>



    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="../dashboard-pages/dashboard-js/dashboard.js"></script>
</body>

</html>