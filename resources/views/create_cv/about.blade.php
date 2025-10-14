@extends('layouts.main')
@section('content')
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Professional Summary</title>
    <style>
      body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 40px; }
      .container { max-width: 700px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
      h2 { color: #003366; }
      label { display: block; margin-top: 15px; font-weight: bold; color: #333; }
      textarea {
        width: 100%; padding: 10px; margin-top: 5px;
        border: 1px solid #ccc; border-radius: 4px;
        height: 120px; resize: vertical;
      }
      .toolbar { margin-top: 10px; }
      .toolbar button {
        background: #eee; border: none; padding: 5px 10px;
        margin-right: 5px; cursor: pointer;
      }
      .btn { margin-top: 20px; background: #0078D4; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; float: right; }
      .back-btn { margin-top: 20px; background: none; color: #333; padding: 10px 20px; border: none; cursor: pointer; float: left; }
      .nav { display: flex; justify-content: space-between; margin-bottom: 20px; font-size: 14px; }
      .nav span { padding: 5px 10px; border-bottom: 2px solid transparent; }
      .nav .active { border-bottom: 2px solid #0078D4; font-weight: bold; color: #0078D4; }
      .note { font-size: 13px; color: #666; margin-top: 10px; }


  .skill-row {
        display: flex;
        gap: 20px;
        margin-top: 20px;
      }
      .skill-row .field {
        flex: 1;
      }
      input[type="text"], select {
        width: 100%; padding: 10px; margin-top: 5px;
        border: 1px solid #ccc; border-radius: 4px;
      }

    </style>
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

    <form action="{{ route('aboutcv.store') }}" method="POST">
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