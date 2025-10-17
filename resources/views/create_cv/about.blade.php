@extends('layouts.main')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Giới thiệu chuyên môn</title>
    <link rel="stylesheet" href="{{ asset('page/css/style.css') }}">
</head>
<body>
<div class="container">
  <div class="nav">
    <span>CONTACT</span>
    <span>EXPERIENCE</span>
    <span>EDUCATION</span>
    <span class="active">ABOUT</span>
    <span>FINISH IT</span>
  </div>


  <h2>Write down your professional summary</h2>
  <p>Include up to 3 sentences that describe your general experience.</p>

    <form action="{{ route('about.store') }}" method="POST">
        @csrf
  <label>Summary</label>
      <textarea name="summary" placeholder="Highly skilled software engineer with over 5 years of experience in leading successful software projects."></textarea>

      <div class="toolbar">
        <button type="button"><b>B</b></button>
        <button type="button"><i>I</i></button>
        <button type="button"><u>U</u></button>
        <button type="button">•</button>
        <button type="button">1.</button>
      </div>




      <div class="skill-row">
        <div class="field">
          <label>Skill</label>
          <input type="text" name="skill" placeholder="Type your skill here">
        </div>
        <div class="field">
          <label>Experience Level</label>
          <select name="level">
            <option value="Beginner">Beginner</option>
            <option value="Experienced" selected>Experienced</option>
            <option value="Expert">Expert</option>
          </select>
        </div>
      </div>


      
  <p class="note">Use formatting to highlight your strengths. Keep it concise and impactful.</p>

      <button type="submit" class="btn">Next to Finish It →</button>
      <button type="button" class="back-btn" onclick="history.back()">← Back</button>
      

    </form>

</div>
</body>
</html>
@endsection