// On page load or when changing themes, best to add inline in `head` to avoid FOUC
if (
  localStorage.getItem("color-theme") === "dark" ||
  (!("color-theme" in localStorage) &&
    window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
  document.documentElement.classList.add("dark");
} else {
  document.documentElement.classList.remove("dark");
}
var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
var themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");

// Change the icons inside the button based on previous settings
if (
  localStorage.getItem("color-theme") === "dark" ||
  (!("color-theme" in localStorage) &&
    window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
  themeToggleLightIcon.classList.remove("hidden");
} else {
  themeToggleDarkIcon.classList.remove("hidden");
}

var themeToggleBtn = document.getElementById("theme-toggle");

themeToggleBtn.addEventListener("click", function () {
  // toggle icons inside button
  themeToggleDarkIcon.classList.toggle("hidden");
  themeToggleLightIcon.classList.toggle("hidden");

  // if set via local storage previously
  if (localStorage.getItem("color-theme")) {
    if (localStorage.getItem("color-theme") === "light") {
      document.documentElement.classList.add("dark");
      localStorage.setItem("color-theme", "dark");
    } else {
      document.documentElement.classList.remove("dark");
      localStorage.setItem("color-theme", "light");
    }

    // if NOT set via local storage previously
  } else {
    if (document.documentElement.classList.contains("dark")) {
      document.documentElement.classList.remove("dark");
      localStorage.setItem("color-theme", "light");
    } else {
      document.documentElement.classList.add("dark");
      localStorage.setItem("color-theme", "dark");
    }
  }
});

//profileeeeeeee
document.addEventListener("DOMContentLoaded", function () {
  const editAvatarButton = document.getElementById("edit-avatar");
  const modal = document.getElementById("modal");
  const closeBtn = document.getElementsByClassName("close")[0];
  const fileInput = document.getElementById("file-input");
  const avatarPreview = document.getElementById("avatar-preview");
  const canvas = document.getElementById("canvas");
  const ctx = canvas.getContext("2d");
  const saveAvatarButton = document.getElementById("save-avatar");

  let imageObj = null;

  // Check if avatar data exists in localStorage
  const avatarData = localStorage.getItem("avatarData");
  if (avatarData) {
    avatarPreview.src = avatarData;
  }

  editAvatarButton.addEventListener("click", function () {
    modal.style.display = "block";
  });

  closeBtn.addEventListener("click", function () {
    modal.style.display = "none";
  });

  fileInput.addEventListener("change", function () {
    const file = this.files[0];
    const reader = new FileReader();
    reader.onload = function (e) {
      const img = new Image();
      img.src = e.target.result;
      img.onload = function () {
        imageObj = this;
        const aspectRatio = this.width / this.height;
        const canvasWidth = 300;
        const canvasHeight = canvasWidth / aspectRatio;
        canvas.width = canvasWidth;
        canvas.height = canvasHeight;
        ctx.drawImage(img, 0, 0, canvasWidth, canvasHeight);
      };
    };
    reader.readAsDataURL(file);
  });

  saveAvatarButton.addEventListener("click", function () {
    if (imageObj) {
      const dataURL = canvas.toDataURL();
      avatarPreview.src = dataURL;
      modal.style.display = "none";
      // Save avatar data to server
      saveAvatarToServer(dataURL);
    } else {
      alert("Please select an image.");
    }
  });

  function saveAvatarToServer(avatarData) {
    const sessionId = getSessionId();
    const formData = new FormData();
    formData.append("sessionId", sessionId);
    formData.append("avatar", avatarData);

    fetch("avatar_upload.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (response.ok) {
          console.log("Avatar saved successfully");
        } else {
          console.error("Failed to save avatar");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }

  // Function to get the session ID
  function getSessionId() {
    // Your code to retrieve the session ID goes here
  }
});

function saveAvatarToServer(avatarData) {
  // Get the session ID or any identifier that uniquely identifies the user's account
  const sessionId = '<?php echo $_SESSION["id"]; ?>';

  // Create a FormData object to send data to the server
  const formData = new FormData();
  formData.append("sessionId", sessionId); // Include the session ID
  formData.append("avatar", avatarData); // Include the avatar data

  // Send a POST request to the server with the FormData
  fetch("avatar_upload.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => {
      if (response.ok) {
        console.log("Avatar saved successfully");
      } else {
        console.error("Failed to save avatar");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
