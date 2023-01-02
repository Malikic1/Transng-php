<?php
include "config.php";
session_start();
if(isset($_SESSION['user_id'])){
  header("Location: send-pkg.php");
}
if(!isset($_SESSION['user_id'])){
 
}


if(isset($_POST["register"])){

  $full_name = mysqli_real_escape_string($conn, $_POST["full-name"]);
  $reg_email = mysqli_real_escape_string($conn, $_POST["reg-email"]);
  $reg_password = mysqli_real_escape_string($conn, $_POST["reg-pass"]);
  $c_pass = mysqli_real_escape_string($conn, $_POST["c-pass"]);
  $checkEmail= mysqli_num_rows(mysqli_query($conn, "SELECT email FROM transng_users WHERE email='$reg_email'"));


  if($reg_password !== $c_pass){
    echo "<script>alert('password did not match');</script>";
  }elseif($checkEmail > 0){
      echo
          "<script>alert('Email already exist');</script>";
  } else {
    $sql = "INSERT INTO transng_users (full_name,email,password) VALUES ('$full_name','$reg_email','$reg_password')";
    $result = mysqli_query($conn, $sql);
    if($result){
      echo
      "<script>alert('Registration successful');</script>";
    }else{
      echo
      "<script>alert('Cannot register user. Please try again.');</script>";
    }
  }

}

if(isset($_POST["login"])){
  $log_email = mysqli_real_escape_string($conn, $_POST["log-email"]);
  $log_password = mysqli_real_escape_string($conn, $_POST["log-pass"]);
    $checkEmail= mysqli_query($conn, "SELECT id FROM transng_users WHERE email='$log_email' AND password ='$log_password'");

    if (mysqli_num_rows($checkEmail) > 0) {
      $row = mysqli_fetch_assoc($checkEmail);
      $_SESSION["user_id"] = $row['id'];
      header("Location: send-pkg.php");

    }else{
        echo "<script>alert('Login details is incorrect. Please try again.');</script>";
      }
    }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trans-login</title>
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
    <link href="style.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple||3d"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
      integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <header>
      <nav class="navbar fixed-top">
        <div class="container-fluid">
          <div>
            <button
              class="navbar-toggler p-1 bd"
              type="button"
              data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasNavbar"
              aria-controls="offcanvasNavbar"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand brand">
              <span class="font2 font-effect-shadow-multiple col1">trans</span
              ><span class="font1 font-effect-shadow-multiple col1">NG</span>
            </a>
          </div>
          <button
            class="px-3 border-0 rounded-pill py-1"
            onclick="location.href='send-pkg.html'"
          >
            <b>WELCOME</b>
          </button>
          <div
            class="offcanvas offcanvas-end"
            tabindex="-1"
            id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel"
          >
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                <a class="navbar-brand mx-3" style="font-size: 1.5rem">
                  <span class="font2 font-effect-shadow-multiple">trans</span
                  ><span class="font1 font-effect-shadow-multiple">NG</span>
                </a>
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
              ></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item mt-3">
                  <a class="nav-link" href="index.html">Home</a
                  >
                </li>
                <li class="nav-item mt-3">
                  <a class="nav-link" href="service.html">Services</a>
                </li>
                <li class="nav-item mt-3">
                  <a class="nav-link" href="about.html">About Us</a>
                </li>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <br /><br />
    <main>
      <h4 class="mt-2">
        <mark class="text-light mx-3" style="background-color: dimgrey"
          >For your 24/7 needs</mark
        >
      </h4>
      <br />
      <div class="position-absolute z-n1 opacity-25 end-50" style="z-index: -3">
        <img src="images/image2.jpeg" alt="delivery bus" class="rounded-pill" />
      </div>
      <br />
      <form
        id="login"
        method="post"
        class="log-form m-auto text-center px-3 pt-2"
      >
        <p>
          Don't have an account yet ?
          <span
            >&nbsp;<button
              style="background-color: transparent"
              class="text-success border-0"
              onclick="regBtn()"
            >
              REGISTER
            </button></span
          >
        </p>
        <label for="email" class="float-start"><b>EMAIL</b></label>
        <br />
        <input
          type="email"
          name="log-email"
          placeholder="&nbsp;enter email address"
          class="form-control mt-1 mt"
        />

        <br />
        <label for="password" class="float-start"><b>PASSWORD</b></label>
        <br />
        <input
          type="password"
          name="log-pass"
          placeholder="&nbsp; password"
          class="form-control mt-1 mt"
          required
        />
        <br />
        <input type="checkbox" id="check" /><span> Remember me</span>
        <br /><br />
        <input
          type="submit"
          name="login"
          value="LOGIN"
          class="form-control w-50 m-auto bg-secondary text-light hv"
        /><br />
        <a href="#forgot password" class="text-dark">forgot password</a
        ><br /><br />
        <p>
          <b>--------------</b>&nbsp;
          <a><i class="fa-brands fa-google a-1 a-2"></i></a>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>
            <a type="button">
              <i class="fa-brands fa-facebook-f a-2 a-f"></i></a></span
          >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a type="button"><i class="fa-brands fa-twitter a-2 a-t"></i></a>
          &nbsp;<b>--------------</b>
        </p>
      </form>

      <form
        id="register"
        action=""
        method="post"
        class="log-form m-auto text-center px-3 py-2"
      >
        <p>
          Already have an account ?
          <span
            >&nbsp;<button
              style="background-color: transparent"
              class="text-success border-0"
              onclick="logBtn()"
            >
              LOGIN
            </button>
          </span>
        </p>

        <label class="float-start"><b>FULL-NAME</b></label>
        <br />
        <input
          type="text"
          name="full-name"
          placeholder="&nbsp;enter full name"
          class="form-control mt-1 mt"
        />
        <label class="float-start mt-1"><b>EMAIL</b></label> <br />
        <input
          type="email"
          name="reg-email"
          placeholder="&nbsp;enter email address"
          class="form-control mt-1 mt"
        />
        <label class="float-start mt-1"><b>PASSWORD</b></label>
        <br />
        <input
          type="password"
          name="reg-pass"
          placeholder="&nbsp; password"
          class="form-control mt-1 mt"
          required
        />
        <label class="float-start mt-1"
          ><b>CONFIRM PASSWORD</b></label
        >
        <br />
        <input
          type="password"
          placeholder="&nbsp; password"
          name="c-pass"
          class="form-control mt-1 mt"
          required
        />
        <br />
        <input
          type="submit"
          name="register"
          value="REGISTER"
          class="form-control w-50 m-auto bg-secondary text-light hv"
        />
        <p class="mt-3">
          <b>---------------</b>&nbsp;
          <a><i class="fa-brands fa-google a-1 a-2"></i></a>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>
            <a type="button">
              <i class="fa-brands fa-facebook-f a-2 a-f"></i></a></span
          >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a type="button"><i class="fa-brands fa-twitter a-2 a-t"></i></a>
          &nbsp;<b>---------------</b>
        </p>
      </form>
      <br />
    </main>
    <!-- JavaScript Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
    <script>
      function regBtn(event) {
        document.getElementById("login").style.display = "none";
        document.getElementById("register").style.display = "block";
      }
      function logBtn() {
        document.getElementById("register").style.display = "none";
        document.getElementById("login").style.display = "block";
      }
    </script>
  </body>
</html>
