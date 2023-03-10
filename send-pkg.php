<?php
include "config.php";

session_start();
if(!isset($_SESSION["user_id"])){
  header("Location: login.php");
}

if(isset($_POST["confirm"])){
  $fullname = mysqli_real_escape_string($conn, $_POST["r_full-name"]);
  $r_address = mysqli_real_escape_string($conn, $_POST["r_address"]);
  $r_phone1 = mysqli_real_escape_string($conn, $_POST["r_phone1"]);
  $r_phone2 = mysqli_real_escape_string($conn, $_POST["r_phone2"]);
  $other_info = mysqli_real_escape_string($conn, $_POST["other-info"]);


  $item_category = mysqli_real_escape_string($conn, $_POST["category"]);
  $es_weight = mysqli_real_escape_string($conn, $_POST["pkg-size"]);
  $pkg_img = mysqli_real_escape_string($conn, $_POST["pkg-img"]);
  $pref_date = mysqli_real_escape_string($conn, $_POST["date"]);


  $firstname = mysqli_real_escape_string($conn, $_POST["first-name"]);
  $lastname = mysqli_real_escape_string($conn, $_POST["last-name"]);
  $s_phone = mysqli_real_escape_string($conn, $_POST["s_phone"]);
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $s_phone = mysqli_real_escape_string($conn, $_POST["s_phone"]);
  $s_address = mysqli_real_escape_string($conn, $_POST["s_addresss"]);

  $sql1 = "INSERT INTO pkg_receiver_db (full_name,phone_number1,phone_number2,delivery_address,other_info) VALUES ('$fullname','$r_phone1','$r_phone2','$r_address','$other_info')";
  $sql2 = "INSERT INTO pkg_sender_db (first_name,last_name,phone_number,email,home_address) VALUES ('$firstname','$lastname','$s_phone','$email','$s_address')";
  $sql3 = "INSERT INTO goods_type_db (item_category,estimated_weight,preferred_delivery_date,pkg_image_file) VALUES ('$item_category','$es_weight','$pref_date','$pkg_img')";

  
  $result = mysqli_query($conn, $sql1);
  $result = mysqli_query($conn, $sql2);
  $result = mysqli_query($conn, $sql3);

  if($result){
    echo
    "<script>alert('Registration successful');</script>";
  }else{
    echo
    "<script>alert('Cannot register user. Please try again.');</script>";
  }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send-package</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
    <header>
        <nav class="navbar fixed-top">
          <div class="container-fluid">
            <div>
            <button class="navbar-toggler p-1 bd" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand brand">
              <span class="font2 font-effect-shadow-multiple col1">trans</span><span class="font1 font-effect-shadow-multiple col1">NG</span>
            </a>
            </div>
            <button class="px-3 border-0 rounded-pill py-1"><b>Need Help ?</b></button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                  <a class="navbar-brand mx-3" style="font-size: 1.5rem;">
                  <span class="font2 font-effect-shadow-multiple">trans</span><span class="font1 font-effect-shadow-multiple">NG</span>
                  </a>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                  <li class="nav-item mt-3">
                    <a class="nav-link" aria-current="page" href="index.html">Home</a>
                  </li>
                  <li class="nav-item mt-3">
                    <a class="nav-link disabled active" href="#"><b>Send Pkg</b></a>
                  </li>
                  <li class="nav-item mt-3">
                    <a class="nav-link" href="service.html">Services</a>
                  </li>
                  <li class="nav-item mt-3">
                    <a class="nav-link" href="about.html">About Us</a>
                  </li>
                  <li class="nav-item mt-3">
                    <a class="nav-link text-info" href="logout.php">Logout</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </nav>
  
       </header>
       <main class="position-absolute">
        <h4 style="margin-top: -0.5rem;"><mark class="text-light mx-3" style="background-color: dimgrey;">For your 24/7 needs</mark></h4>
        <form class="container-fluid px-sm-2 px-md-3 px-lg-4" method="post" action="">
        <h2 class="card-title p">LET'S DELIVER IT !</h2><br>
        <div class="card-body">
          <div class="d-flex fc2 gap-2 l-col">
            <div class="card-text bg-light p-2 rounded w-75 fw">
              <p class="h5 text-danger">Receiver's Details </p>
              <input type="text" name="r_full-name" placeholder="FULL NAME" required class="form-control">
              <div class="d-flex fc gap-2 my-2"><select class="form-select half"><option value="">select State</option></select>
               <select class="form-select half"><option value="">select LGA</option></select></div>
              <input type="text" name="r_address" required placeholder="Recepient Address" class="form-control">
              <div class="d-flex fc gap-2 my-2">
                <input type="tel" name="r_phone1" required placeholder="Phone number 1" class="form-control half"><input type="tel" name="r_phone2" placeholder="Phone number 2" class="form-control half"></div>
              <textarea name="other-info" id="" rows="5" cols="50" placeholder="Write other information here..." class="form-control"></textarea>
            </div>
            <div class="card-text bg-light p-2 rounded">
              <p class="h5 text-danger">Package Details </p>
                <p class="h6">ITEM CATEGORY</p>
                <input type="radio" name="category" value="fragile" id=""><label for="" class="mx-1">Fragile</label>&nbsp;&nbsp;&nbsp;
                <input type="radio" name="category" value="light" id=""><label for="" class="mx-1">Light</label>&nbsp;&nbsp;&nbsp;
                <input type="radio" name="category" value="heavy" id=""><label for="" class="mx-1">Heavy</label>
              <br>
              <p class="h6">Estimated Package weight</p>
              <div class="d-flex">
                <input type="number" name="pkg-size" placeholder="0" class="form-control" style="width: 5rem;"><span class="fs-4 col1"> &nbsp;kg</span>
              </div>
              <p class="h6 mt-2">Upload Package Image</p>
              <input type="file" name="pkg-img" required>
              <br>
              <p class="h6 mt-2">Preffered Delivery Date </p>
              <input type="datetime-local" name="date" id="" class="form-control">
              <p style="width: 20rem; line-height: 15px;" class="text-info mt-2">
                <input type="checkbox" name="" required>
                <small class="pl-2">You agree that this item is not
                  a confisticated or illegal goods, if found 
                  guilty will be prosecuted by the enforcement agencies immediately.</small>
              </p>
            </div>
          </div>
          
          <div class="card-text bg-light w-100 p-3 rounded mt-2">
              <p class="h5 text-danger">Sender's Details</p>
                <div class="d-flex fc gap-2">
                  <input type="text" name="first-name" required placeholder="First Name"  class="form-control half">
                  <input type="text" name="last-name" required placeholder="Last Name"  class="form-control half" >
                </div>
                <div class="d-flex fc gap-2 my-2">
                  <input type="tel" name="s_phone" required placeholder="Phone number" class="form-control half">
                  <input type="email" name="email" placeholder="Email" class="form-control half">
              </div>
                <div class="d-flex fc gap-2 my-2">
                   <select class="form-select half"><option value="">select State</option></select>
                   <select class="form-select half"><option value="">select LGA</option></select></div>
                <input type="text" name="s_address" required placeholder="Home Address" class="form-control">
          </div>
      </div>
      <p class="text-center">
        <input class="px-5 border-0 rounded py-2 h5 mt-3 submit" name="confirm" type="submit" value="CONFIRM"/>
      </p>
    </form>
    <a class="navbar-brand " style="font-size: 4rem;">
      <span class="font2 font-effect-3d col1">trans</span><span class="font1 font-effect-3d col1">NG</span><br/>
      <b class="slogan">name it, we carry it...</b>
      </a>
        <!-- Footer --> 
        <div class="bg-dark h-50 text-light px-5">
            <div class="row">
              <div class="col-5 col-sm border-1">
                <a class="navbar-brand brand">
                  <span class="font2 font-effect-shadow-multiple col1">trans</span><span class="font1 font-effect-shadow-multiple col1">NG</span>
                  </a><br><br>
                  <h6 class="text-danger">Our Mission</h6>
                  <small>To provide our customers with the most professional, fast, dependable, and
                     technologically advanced delivery service in Austin and its surrounding areas.</small>
                  <br><br>
                  <h6 class="text-danger">Our Vision</h6>
                  <small class="w-25">Our vision is to be the premier courier & logistic service provider in Nigeria
                     utilizing our own network and selected partners to deliver an exceptional service to our customers.</small>
                  <br><br>
      
              </div>
              <div class="col-3 mt-5 col-sm">
                <h6 class="col1">Informations</h6>
                <ul style="list-style-type: square; color: cadetblue;">
                    <li><a href="#">Shipping Information</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="#">Privacy and Data Protection</a></li>
                    <li><a href="#">Conditions of Use</a></li>
                    <li><a href="#">Payment</a></li>
                </ul>
              </div>
              <div class="col mt-5 col-sm">
                <h6 class="col1">Let's Connect</h6>
                <button class="social"><i class="fa-brands fa-facebook-f"></i></button>
                <button class="social"><i class="fa-brands fa-instagram"></i></button>
                <button class="social"><i class="fa-brands fa-twitter"></i></button>
              </div>
            </div><br>
            <div class="text-center">&#169copyright AzeezCode 2022</div>
          </div>
    </main>
      <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</body>
</html>