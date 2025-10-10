<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["job_title"] = $_POST["job_title"];
    $_SESSION["employer"] = $_POST["employer"];
    $_SESSION["job_city"] = $_POST["city"];
    $_SESSION["start_date"] = $_POST["start_date"];
    $_SESSION["end_date"] = $_POST["end_date"];
    $_SESSION["job_description"] = $_POST["description"];
    header("Location: education.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Experience</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 40px; }
    .container { max-width: 700px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    h2 { color: #003366; }
    label { display: block; margin-top: 15px; font-weight: bold; color: #333; }
    input[type="text"], input[type="date"], textarea {
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
    <span class="active">EXPERIENCE</span>
    <span>EDUCATION</span>
    <span>SKILLS</span>
    <span>ABOUT</span>
    <span>FINISH IT</span>
  </div>

  <h2>Tell us about your experience</h2>
  <p>Start with your recent job.</p>

  <form action="" method="POST">
    <label>Job Title (Mandatory)</label>
    <input type="text" name="job_title" placeholder="Software Engineer">

    <label>Employer</label>
    <input type="text" name="employer" placeholder="FPT Corporation">

    <label>Start Date</label>
    <input type="date" name="start_date" >

    <label>End Date</label>
    <input type="date" name="end_date" >

    <label>City</label>
    <input type="text" name="city" placeholder="Ho Chi Minh City">

    <label>City</label>
    <input type="text" name="city" placeholder="Ho Chi Minh City">

    <label>Description</label>
    <textarea name="description" placeholder="Worked as lead developer on several major projects, contributing to the overall success of the company."></textarea>


    <button type="submit" class="btn">Next to Education →</button>
  </form>
</div>

</body>
</html>