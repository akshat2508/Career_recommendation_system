<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Career Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            padding: 20px;
            color: #333;
        }

        h1 {
            color: #1e40af;
            margin-bottom: 5px;
        }

        h2 {
            margin-top: 20px;
            color: #111827;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .section {
            margin-top: 15px;
        }

        .box {
            margin-top: 10px;
            padding: 12px;
            border-radius: 6px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
        }

        .skill {
            display: inline-block;
            background: #e0f2fe;
            padding: 5px 10px;
            border-radius: 20px;
            margin: 3px;
            font-size: 12px;
        }

        .missing {
            background: #fee2e2;
        }

        .match {
            font-size: 22px;
            font-weight: bold;
            color: #2563eb;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>
<body>

<h1>{{ $career->career_name }}</h1>
<p>{{ $career->description }}</p>

<div class="section">
    <h2>Why This Career Fits You</h2>
    <div class="box">
        {{ $career->why_fit }}
    </div>
</div>

<div class="section">
    <h2>Match Score</h2>
    <div class="box">
        <span class="match">{{ $matchScore }}%</span>
    </div>
</div>

<div class="section">
    <h2>Required Skills</h2>
    <div class="box">
        @foreach($career->required_skills as $skill)
            <span class="skill">{{ ucfirst($skill) }}</span>
        @endforeach
    </div>
</div>

<div class="section">
    <h2>Skill Gap</h2>
    <div class="box">
        @if(count($missing) > 0)
            @foreach($missing as $skill)
                <span class="skill missing">{{ ucfirst($skill) }}</span>
            @endforeach
        @else
            You already have all required skills 🎉
        @endif
    </div>
</div>

<div class="section">
    <h2>Roadmap</h2>
    <div class="box">
        <ol>
            @foreach($career->roadmap as $step)
                <li>{{ $step }}</li>
            @endforeach
        </ol>
    </div>
</div>

<div class="footer">
    Generated on {{ now()->format('d M Y, h:i A') }}
</div>

</body>
</html>