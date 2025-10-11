<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["school"] = $_POST["school"];
    $_SESSION["degree"] = $_POST["degree"];
    $_SESSION["grad_date"] = $_POST["grad_date"];
    $_SESSION["edu_city"] = $_POST["city"];
    $_SESSION["edu_description"] = $_POST["description"];
    header("Location: about.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Education</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 40px; }
    .container { max-width: 700px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    h2 { color: #003366; }
    label { display: block; margin-top: 15px; font-weight: bold; color: #333; }
    input[type="text"], input[type="date"], select, textarea {
      width: 100%; padding: 10px; margin-top: 5px;
      border: 1px solid #ccc; border-radius: 4px;
    }
    textarea { height: 120px; resize: vertical; }
    .btn { margin-top: 20px; background: #0078D4; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; float: right; }
    .nav { display: flex; justify-content: space-between; margin-bottom: 20px; font-size: 14px; }
    .nav span { padding: 5px 10px; border-bottom: 2px solid transparent; }
    .nav .active { border-bottom: 2px solid #0078D4; font-weight: bold; color: #0078D4; }
    .add-link { margin-top: 10px; display: inline-block; color: #0078D4; text-decoration: none; }
    .note { font-size: 13px; color: #666; margin-top: 10px; }
  </style>
</head>
<body>

<div class="container">
  <div class="nav">
    <span>CONTACT</span>
    <span>EXPERIENCE</span>
    <span class="active">EDUCATION</span>
    <span>SKILLS</span>
    <span>ABOUT</span>
    <span>FINISH IT</span>
  </div>

  <h2>Please enter your education information</h2>
  <p>Enter your last diploma first.</p>

  <form action="{{ route('education.store') }}" method="POST">
    @csrf

    <label>School</label>
    <input type="text" name="school" placeholder="Vietnam National University">

    <label>Degree</label>
    <select name="degree">
      <option value="">Select degree</option>
      <option value="Bachelor">Bachelor</option>
      <option value="Master">Master</option>
      <option value="PhD">PhD</option>
      <option value="Diploma">Diploma</option>
    </select>

    <label>Graduation Date</label>
    <input type="date" name="grad_date">

    <label>City</label>
    <input type="text" name="city" placeholder="Hanoi">

    <label>Description</label>
    <textarea name="description" placeholder="Graduated with a Bachelor of Science in Computer Science, specializing in software development."></textarea>



    <button type="submit" class="btn">Next to About →</button>
  </form>
</div>

</body>
</html>