<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Career Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            padding: 30px;
            color: #111;
        }

        /* HEADER */
        .header {
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 26px;
            margin: 0;
        }

        .subtitle {
            margin-top: 5px;
            color: #555;
        }

        /* SECTION */
        .section {
            margin-top: 25px;
        }

        h2 {
            font-size: 16px;
            margin-bottom: 8px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 4px;
        }

        /* BOX */
        .box {
            border: 1px solid #000;
            padding: 12px;
            background: #fafafa;
        }

        /* SKILLS */
        .tag {
            display: inline-block;
            border: 1px solid #000;
            padding: 4px 8px;
            margin: 3px;
            font-size: 12px;
        }

        .missing {
            background: #fdd;
        }

        /* SCORE */
        .score {
            font-size: 28px;
            font-weight: bold;
        }

        /* ROADMAP */
        ol {
            padding-left: 18px;
        }

        li {
            margin-bottom: 6px;
        }

        /* FOOTER */
        .footer {
            margin-top: 40px;
            font-size: 11px;
            color: #777;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>

<body>

    <!-- 🔥 HEADER -->
    <div class="header">
        <h1>{{ $career->career_name }}</h1>
        <div class="subtitle">
            AI-generated career recommendation report
        </div>
    </div>

    <!-- 🧠 WHY FIT -->
    <div class="section">
        <h2>Why This Career Fits You</h2>
        <div class="box">
            {{ $career->why_fit }}
        </div>
    </div>

    <!-- 🎯 MATCH SCORE -->
    <div class="section">
        <h2>Match Score</h2>
        <div class="box">
            <span class="score">{{ $matchScore }}%</span>
        </div>
    </div>

    <!-- 🧩 REQUIRED SKILLS -->
    <div class="section">
        <h2>Required Skills</h2>
        <div class="box">
            @foreach($career->required_skills as $skill)
                <span class="tag">{{ ucfirst($skill) }}</span>
            @endforeach
        </div>
    </div>

    <!-- ❌ SKILL GAP -->
    <div class="section">
        <h2>Skill Gap</h2>
        <div class="box">
            @if(count($missing) > 0)
                @foreach($missing as $skill)
                    <span class="tag missing">{{ ucfirst($skill) }}</span>
                @endforeach
            @else
                You already meet all requirements.
            @endif
        </div>
    </div>

    <!-- 🛣️ ROADMAP -->
    <div class="section">
        <h2>Career Roadmap</h2>
        <div class="box">
            <ol>
                @foreach($career->roadmap as $step)
                    <li>{{ $step }}</li>
                @endforeach
            </ol>
        </div>
    </div>

    <!-- 📅 FOOTER -->
    <div class="footer">
        Generated on {{ now()->format('d M Y, h:i A') }}
    </div>

</body>
</html>