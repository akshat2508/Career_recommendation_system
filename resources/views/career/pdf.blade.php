<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Career Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h1 { color: #1e40af; }
        h2 { margin-top: 20px; }
        ul { margin-left: 15px; }
        .box { margin-top: 15px; padding: 10px; border: 1px solid #ddd; }
        .green { color: green; }
        .red { color: red; }
    </style>
</head>
<body>

<h1>{{ $career->career_name }}</h1>

<p><strong>Description:</strong> {{ $career->description }}</p>

<div class="box">
    <h2>Why This Career Fits You</h2>
    <p>{{ $career->why_fit }}</p>
</div>

<div class="box">
    <h2>Match Score</h2>
    <p><strong>{{ $matchScore }}%</strong></p>
</div>

<div class="box">
    <h2>Required Skills</h2>
    <ul>
        @foreach($career->required_skills as $skill)
            <li>{{ ucfirst($skill) }}</li>
        @endforeach
    </ul>
</div>

<div class="box">
    <h2>Skill Gap</h2>
    @if(count($missing) > 0)
        <ul>
            @foreach($missing as $skill)
                <li class="red">{{ ucfirst($skill) }}</li>
            @endforeach
        </ul>
    @else
        <p class="green">You already have all required skills 🎉</p>
    @endif
</div>

<div class="box">
    <h2>Roadmap</h2>
    <ol>
        @foreach($career->roadmap as $step)
            <li>{{ $step }}</li>
        @endforeach
    </ol>
</div>

</body>
</html>