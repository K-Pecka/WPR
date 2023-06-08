<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="../style/login.css">
</head>

<body>
  <div class="container">
    <div class="message signup">
      <div class="btn-wrapper">
        <button class="button" id="signup">Sign Up</button>
        <button class="button" id="login"> Login</button>
      </div>
    </div>
    <div class="form form--signup">
      <div class="form--heading">Welcome! Sign Up</div>
      <form autocomplete="off">
        <input type="text" placeholder="Name">
        <input type="email" placeholder="Email">
        <input type="password" placeholder="Password">
        <button class="button">Sign Up</button>
      </form>
    </div>
    <div class="form form--login">
      <div class="form--heading">Welcome back! </div>
      <form autocomplete="off">
        <input type="text" placeholder="Name">
        <input type="password" placeholder="Password">
        <button class="button">Login</button>
      </form>
    </div>
  </div>
  <script>
    document.getElementById("signup").addEventListener("click", function() {
      var message = document.querySelector(".message");
      message.style.transform = "translateX(100%)";

      if (message.classList.contains("login")) {
        message.classList.remove("login");
      }

      message.classList.add("signup");
    });

    document.getElementById("login").addEventListener("click", function() {
      var message = document.querySelector(".message");
      message.style.transform = "translateX(0)";

      if (message.classList.contains("signup")) {
        message.classList.remove("signup");
      }

      message.classList.add("login");
    });
  </script>
</body>

</html>