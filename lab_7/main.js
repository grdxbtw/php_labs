$(document).ready(function () {
  // Redirect to login page
  $("#loginBtn").click(function () {
    window.location.href = "login.html";
  });

  // Redirect to registration page
  $("#registerBtn").click(function () {
    window.location.href = "register.html";
  });

  // Redirect to profile update page
  $("#profileBtn").click(function () {
    window.location.href = "update_profile.html";
  });

  // Redirect to logout page
  $("#logoutBtn").click(function () {
    window.location.href = "logout.php";
  });

  // Handle registration form submission
  $("#registerForm").submit(function (e) {
    e.preventDefault();
    const password = $("#password").val();
    const confirmPassword = $("#confirmPassword").val();
    const email = $("#email").val();
    const username = $("#username").val();

    const validationMessage = validateForm(
      username,
      email,
      password,
      confirmPassword
    );
    if (validationMessage) {
      $("#registerMessage").text(validationMessage);
    } else {
      $.ajax({
        type: "POST",
        url: "register.php",
        data: { username: username, email: email, password: password },
        success: function (response) {
          if (response === "success") {
            alert("Registration successful!");
            window.location.href = "index.php";
          } else {
            $("#registerMessage").text(response);
          }
        },
      });
    }
  });

  // Handle login form submission
  $("#loginForm").submit(function (e) {
    e.preventDefault();
    const email = $("#loginEmail").val();
    const password = $("#loginPassword").val();

    $.ajax({
      type: "POST",
      url: "login.php",
      data: { email: email, password: password },
      success: function (response) {
        if (response === "success") {
          alert("Login successful!");
          window.location.href = "index.php";
        } else {
          $("#loginMessage").text(response);
        }
      },
    });
  });

  // Handle profile edit form submission
  $("#editProfileForm").submit(function (e) {
    e.preventDefault();
    const username = $("#username").val();
    const email = $("#email").val();
    const password = $("#password").val();

    const validationMessage = validateForm(username, email, password);
    if (validationMessage) {
      $("#message").text(validationMessage);
    } else {
      $.ajax({
        url: "update_profile.php",
        type: "POST",
        data: { username: username, email: email, password: password },
        success: function (response) {
          if (response === "success") {
            alert("Profile updated successfully!");
            window.location.href = "index.php";
          } else {
            $("#loginMessage").text(response);
          }
        },
      });
    }
  });

  function validateForm(username, email, password, confirmPassword) {
    if (!validateEmail(email)) {
      return "Invalid email format";
    }

    if (!validateUsername(username)) {
      return "Username must be 3 to 15 characters long and contain only letters, numbers, and underscores";
    }

    if (!validatePassword(password)) {
      return "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number";
    }

    if (confirmPassword !== undefined && password !== confirmPassword) {
      return "Passwords do not match";
    }

    return null;
  }

  function validateEmail(email) {
    const regex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
    return regex.test(email);
  }

  function validateUsername(username) {
    const regex = /^[a-zA-Z0-9_]{3,15}$/;
    return regex.test(username);
  }

  function validatePassword(password) {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    return regex.test(password);
  }
});
