

document.addEventListener("DOMContentLoaded", function () {
  showLoader();
});

window.addEventListener("load", function () {
  setTimeout(hideLoader, 1500);
});

function showLoader() {
  document.querySelector(".loader-container").style.display = "flex";
}

function hideLoader() {
  document.querySelector(".loader-container").style.display = "none";
}


/// TABS
function showCategory(category) {
  document.querySelectorAll('.product-content').forEach(content => {
      content.classList.add('hidden');
  });

  document.querySelectorAll(`.${category}Content`).forEach(content => {
      content.classList.remove('hidden');
  });
}


