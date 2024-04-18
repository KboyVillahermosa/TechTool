var rating_data = 0;

$('#add_review').click(function() {
    $('#review_modal').modal('show');
});

$(document).on('mouseenter', '.submit_star', function() {
    var rating = $(this).data('rating');
    reset_background();
    for (var count = 1; count <= rating; count++) {
        $('#submit_star_' + count).addClass('text-warning');
    }
});

function reset_background() {
    for (var count = 1; count <= 5; count++) {
        $('#submit_star_' + count).addClass('star-light');
        $('#submit_star_' + count).removeClass('text-warning');
    }
}

$(document).on('mouseleave', '.submit_star', function() {
    reset_background();
    for (var count = 1; count <= rating_data; count++) {
        $('#submit_star_' + count).removeClass('star-light');
        $('#submit_star_' + count).addClass('text-warning');
    }
});

$(document).on('click', '.submit_star', function() {
    rating_data = $(this).data('rating');
});

$('#save_review').click(function() {
var user_name = $('#user_name').val();
var user_review = $('#user_review').val();
if (user_name == '' || user_review == '') {
alert("Please Fill Both Fields");
return false;
} else {
$.ajax({
    url: "../submit_rating.php",
    method: "POST",
    data: {
        rating_data: rating_data,
        user_name: user_name,
        user_review: user_review
    },
    success: function(response) {
        if (response.trim() == "Review submitted successfully!") {
            alert(response);
            // Clear input fields after successful submission if needed
            $('#user_name').val('');
            $('#user_review').val('');
            // Hide the modal if it's open
            hideModal();
            // Reload the rating data
            load_rating_data();
        } else {
            alert("An error occurred while submitting the review. Please try again.");
        }
    },
    error: function() {
        alert("An error occurred while submitting the review. Please try again.");
    }
});
}
});

// Function to show modal with custom message
function showModal(message) {
    $('#review_modal').find('.modal-body').html('<h4 class="text-center">' + message + '</h4>');
    $('#review_modal').modal('show');
}

load_rating_data();

function load_rating_data() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../submit_rating.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            document.getElementById('average_rating').textContent = data.average_rating;
            document.getElementById('total_review').textContent = data.total_review;

            var count_star = 0;
            document.querySelectorAll('.main_star').forEach(function(element) {
                count_star++;
                if (Math.ceil(data.average_rating) >= count_star) {
                    element.classList.add('text-warning');
                    element.classList.add('star-light');
                }
            });

            document.getElementById('total_five_star_review').textContent = data.five_star_review;
            document.getElementById('total_four_star_review').textContent = data.four_star_review;
            document.getElementById('total_three_star_review').textContent = data.three_star_review;
            document.getElementById('total_two_star_review').textContent = data.two_star_review;
            document.getElementById('total_one_star_review').textContent = data.one_star_review;

            // Calculate percentage for each star rating
            var total_review = data.total_review;
            var five_star_percentage = (data.five_star_review / total_review) * 100;
            var four_star_percentage = (data.four_star_review / total_review) * 100;
            var three_star_percentage = (data.three_star_review / total_review) * 100;
            var two_star_percentage = (data.two_star_review / total_review) * 100;
            var one_star_percentage = (data.one_star_review / total_review) * 100;

            // Update the width of progress bars
            document.getElementById('five_star_progress').style.width = five_star_percentage + '%';
            document.getElementById('four_star_progress').style.width = four_star_percentage + '%';
            document.getElementById('three_star_progress').style.width = three_star_percentage + '%';
            document.getElementById('two_star_progress').style.width = two_star_percentage + '%';
            document.getElementById('one_star_progress').style.width = one_star_percentage + '%';

            document.getElementById('total_five_star_review').textContent = five_star_percentage.toFixed(2) + '%';
    document.getElementById('total_four_star_review').textContent = four_star_percentage.toFixed(2) + '%';
    document.getElementById('total_three_star_review').textContent = three_star_percentage.toFixed(2) + '%';
    document.getElementById('total_two_star_review').textContent = two_star_percentage.toFixed(2) + '%';
    document.getElementById('total_one_star_review').textContent = one_star_percentage.toFixed(2) + '%';
            
            if (data.review_data.length > 0) {
                var html = '';
                for (var count = 0; count < data.review_data.length; count++) {
                    html += '<div class="row mb-3">';
                    html += '<div class="col-sm-1"><div class="profile-initial"><h3 class="text-center">' + data.review_data[count].user_name.charAt(0) + '</h3></div></div>';
                    html += '<div class="col-sm-11">';
                    html += '<div class="card ">';
                    html += '<div class="card-header"><b>' + data.review_data[count].user_name + '</b></div>';
                    html += '<div class="card-body">';
                    for (var star = 1; star <= 5; star++) {
                        var class_name = '';
                        if (data.review_data[count].rating >= star) {
                            class_name = 'text-warning';
                        } else {
                            class_name = 'star-light';
                        }
                        html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
                    }
                    html += '<br />';
                    html += '<p class="text-xl  font-semibold text-gray-900 dark:text-white"">' + data.review_data[count].user_review;
                    html += '</div>';
                    // Displaying current date and time using JavaScript
                    html += '<div class="card-footer  font-semibold text-gray-900 dark:text-white"">On <span class="review-datetime  font-semibold text-gray-900 dark:text-white"">' + data.review_data[count].datetime + '</span></div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                }
                document.getElementById('review_content').innerHTML = html;
            }
        }
    };
    xhr.onerror = function() {
        alert("An error occurred while loading the rating data. Please try again.");
    };
    xhr.send("action=load_data");
}

// Update the current date and time every second
setInterval(function() {
    var now = new Date();
    $('.review-datetime').each(function() {
        $(this).text(formatDate(now));
    });
}, 1000);

function formatDate(date) {
    var options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour12: true,
        timeZone: 'Asia/Manila' // Set the time zone to Philippines
    };
    return date.toLocaleString('en-US', options).replace(/\s\d{1,2}:\d{2}:\d{2}\s[A|P]M$/, '');
}

function showModal() {
    document.getElementById("review_modal").style.display = "block";
}

function hideModal() {
    document.getElementById("review_modal").style.display = "none";
}

// Event listener for the review button to show the modal
document.getElementById("add_review").addEventListener("click", function() {
    showModal();
});

// Event listener for the close button in the modal to hide it
document.querySelector(".close").addEventListener("click", function() {
    hideModal();
});

// Event listener for the submit button in the modal to submit the review and hide the modal
document.getElementById("save_review").addEventListener("click", function() {
    // Your code to submit the review goes here
    // After submitting the review, hide the modal
    hideModal();
});        




