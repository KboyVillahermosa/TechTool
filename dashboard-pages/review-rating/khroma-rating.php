<?php
$connect = new PDO("mysql:host=localhost;dbname=google_login", "root", "");

if(isset($_POST["rating_data"], $_POST["user_name"], $_POST["user_review"])) {
    // Sanitize user input
    $rating_data = $_POST["rating_data"];
    $user_name = $_POST["user_name"];
    $user_review = $_POST["user_review"];

    // Perform database insert operation
    $query = "INSERT INTO khroma(user_name, user_review, user_rating, datetime) VALUES (:user_name, :user_review, :user_rating, NOW())";
    $statement = $connect->prepare($query);
    $statement->execute(array(
        ':user_name' => $user_name,
        ':user_review' => $user_review,
        ':user_rating' => $rating_data
    ));

    echo "Review submitted successfully!";
    exit;
}

if(isset($_POST["action"]))
{
    $average_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    $review_content = array();

    $query = "
    SELECT * FROM khroma
    ORDER BY review_id DESC
    ";

    $result = $connect->query($query, PDO::FETCH_ASSOC);

    foreach($result as $row)
    {
        $review_content[] = array(
            'user_name'     =>  $row["user_name"],
            'user_review'   =>  $row["user_review"],
            'rating'        =>  $row["user_rating"],
            'datetime'      =>   $row["datetime"]
        );

        if($row["user_rating"] == '5')
        {
            $five_star_review++;
        }

        if($row["user_rating"] == '4')
        {
            $four_star_review++;
        }

        if($row["user_rating"] == '3')
        {
            $three_star_review++;
        }

        if($row["user_rating"] == '2')
        {
            $two_star_review++;
        }

        if($row["user_rating"] == '1')
        {
            $one_star_review++;
        }

        $total_review++;

        $total_user_rating = $total_user_rating + $row["user_rating"];

    }

    $average_rating = $total_user_rating / $total_review;

    $output = array(
        'average_rating'    =>  number_format($average_rating, 1),
        'total_review'      =>  $total_review,
        'five_star_review'  =>  $five_star_review,
        'four_star_review'  =>  $four_star_review,
        'three_star_review' =>  $three_star_review,
        'two_star_review'   =>  $two_star_review,
        'one_star_review'   =>  $one_star_review,
        'review_data'       =>  $review_content
    );

    echo json_encode($output);

}
?>
