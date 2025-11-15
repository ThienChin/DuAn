@extends('layouts.main')

@section('content')
<div class="container py-5">
    <h2>Apply for {{ $job->title }}</h2>
    <p><strong>Company:</strong> {{ $job->company_name }}</p>
    <p><strong>Location:</strong> {{ optional($job->locationItem)->value ?? 'N/A' }}</p>
    <hr>

    <form action="{{ route('jobs.apply', ['id' => $job->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" name="name" placeholder="Your full name" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email" placeholder="you@example.com" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Upload CV</label>
            <input type="file" class="form-control" name="cv">
        </div>
        <button type="submit" class="btn btn-primary">Submit Application</button>
    </form>

</div>
@endsection