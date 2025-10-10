<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["first_name"] = $_POST["first_name"];
    $_SESSION["last_name"] = $_POST["last_name"];
    $_SESSION["city"] = $_POST["city"];
    $_SESSION["postal_code"] = $_POST["postal_code"];
    $_SESSION["phone"] = $_POST["phone"];
    $_SESSION["email"] = $_POST["email"];
    header("Location: experience.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Info</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 40px; }
    .container { max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    h2 { text-align: center; }
    label { display: block; margin-top: 15px; font-weight: bold; }
    input[type="text"], input[type="email"] {
      width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;
    }
    .btn { margin-top: 20px; background: #0078D4; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
    .btn:hover { background: #005fa3; }
    .nav { display: flex; justify-content: space-between; margin-bottom: 20px; font-size: 14px; }
    .nav span { padding: 5px 10px; border-bottom: 2px solid transparent; }
    .nav .active { border-bottom: 2px solid #0078D4; font-weight: bold; }
    .more-details { margin-top: 10px; display: inline-block; color: #0078D4; text-decoration: none; }
  </style>
</head>
<body>

<div class="container">
  <div class="nav">
    <span class="active">CONTACT</span>
    <span>EXPERIENCE</span>
    <span>EDUCATION</span>
    <span>SKILLS</span>
    <span>ABOUT</span>
    <span>FINISH IT</span>
  </div>

  <h2>Please enter your contact info</h2>
  <form action="{{ route('contract.store') }}" method="POST">
    @csrf
    
    <label>First Name (Mandatory)</label>
    <input type="text" name="first_name"  placeholder=" Nguyen">

    <label>Last Name (Mandatory)</label>
    <input type="text" name="last_name"  placeholder=" Thi Minh">

    <label>City</label>
    <input type="text" name="city"  placeholder=" Hanoi">

    <label>Postal Code</label>
    <input type="text" name="postal_code"  placeholder=" 100000">

    <label>Phone</label>
    <input type="text" name="phone"  placeholder=" +84 24 1234 5678">

    <label>Email (Mandatory)</label>
    <input type="email" name="email" placeholder=" example@email.com">


    
  <button type="submit" class="btn">Next to Experience</button>
  </form>
</div>

</body>

</html>
