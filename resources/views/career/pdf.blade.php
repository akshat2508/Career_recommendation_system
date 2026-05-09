<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Career Report - {{ $career->career_name }}</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

       body {
    font-family: DejaVu Sans, sans-serif;
    padding: 32px;
    color: #111827;
    background: #ffffff;
    font-size: 14px;
    line-height: 1.8;
}

        /* BRUTALIST COMPONENTS */
        .brutal-box {
            border: 4px solid #000;
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
        }

        .brutal-box-sm {
            border: 3px solid #000;
            padding: 12px;
            display: inline-block;
        }

        .brutal-tag {
            border: 3px solid #000;
            padding: 6px 12px;
            display: inline-block;
            margin: 4px;
            font-size: 11px;
            font-weight: bold;
            background: #f0f0f0;
        }

        .brutal-tag.missing {
            background: #fecaca;
            color: #7f1d1d;
        }

        .brutal-tag.matched {
            background: #d1fae5;
            color: #065f46;
        }

        /* HEADER */
        .header {
            border: 5px solid #000;
            background: #3b82f6;     
       padding: 30px;
            margin-bottom: 25px;
            position: relative;
        }

      
        .header-badge {
            border: 3px solid #000;
            background: #fff;
            padding: 6px 12px;
            display: inline-block;
            margin-bottom: 12px;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 1px;
        }

        h1 {
              font-size: 36px;
    line-height: 1.2;
            font-weight: 900;
            color: #fff;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            color: #fff;
            font-size: 12px;
            opacity: 0.95;
        }

        /* SCORE CARD */
        .score-section {
            border: 5px solid #000;
background: #facc15;            padding: 25px;
            margin-bottom: 25px;
            position: relative;
        }

      
        .score-label {
            border: 3px solid #000;
            background: #000;
            color: #fff;
            padding: 6px 12px;
            display: inline-block;
            margin-bottom: 15px;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 1px;
        }

        .score-display {
            border: 3px solid #000;
            background: #000;
            color: #fff;
            padding: 12px 20px;
            display: inline-block;
            margin-top: 10px;
        }

        .score-number {
            font-size: 32px;
            font-weight: 900;
        }

        .score-text {
            font-size: 10px;
            margin-left: 6px;
        }

        /* MATCH BAR */
        .match-bar-container {
            margin-top: 15px;
        }

        .match-bar-label {
            font-weight: 900;
            font-size: 10px;
            letter-spacing: 1px;
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
        }

        .match-bar-bg {
            border: 3px solid #000;
            background: #e5e5e5;
            height: 20px;
            position: relative;
            overflow: hidden;
        }

        .match-bar-fill {
            background: #000;
            height: 100%;
            transition: width 0.5s;
        }

        /* SECTION HEADERS */
        .section {
            margin-bottom: 25px;
        }

        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            gap: 12px;
        }

        .section-badge {
            border: 3px solid #000;
            background: #e5e7eb;
            padding: 4px 10px;
            font-size: 9px;
            font-weight: 900;
            letter-spacing: 1px;
        }

        .section-badge.blue { background: #bfdbfe; }
        .section-badge.green { background: #bbf7d0; }
        .section-badge.red { background: #fecaca; }
        .section-badge.purple { background: #e9d5ff; }

        h2 {
            font-size: 22px;
    line-height: 1.4;
            font-weight: 900;
            letter-spacing: -0.3px;
        }

        /* CONTENT BOXES */
        .content-box {
            border: 4px solid #000;
            background: #fff;
            padding: 18px;
        }

        .content-box p {
             font-size: 14px;
    color: #1f2937;
    line-height: 1.9;
            color: #374151;
        }

        /* TWO COLUMN LAYOUT */
        .two-column {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }

        .column {
            display: table-cell;
            width: 48%;
            vertical-align: top;
        }

        .column:first-child {
            padding-right: 15px;
        }

        .column:last-child {
            padding-left: 15px;
        }

        /* SKILLS GRID */
        .skills-container {
            margin-top: 12px;
        }

        /* ROADMAP */
        .roadmap-item {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }

        .roadmap-number {
            display: table-cell;
            width: 40px;
            vertical-align: top;
        }

        .roadmap-number-box {
            border: 3px solid #000;
            background: #000;
            color: #fff;
            width: 35px;
            height: 35px;
            text-align: center;
            line-height: 35px;
            font-weight: 900;
            font-size: 16px;
        }

        .roadmap-text {
            display: table-cell;
            vertical-align: top;
            padding-left: 15px;
            padding-top: 6px;
            font-size: 13px;
            line-height: 1.7;
        }

        /* INFO BOXES */
        .info-box {
            border: 3px solid #000;
            padding: 15px;
            margin-bottom: 15px;
        }

        .info-box.blue { background: #eff6ff; }
        .info-box.purple { background: #faf5ff; }

        .info-box-title {
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .info-box-title.blue { color: #1e3a8a; }
        .info-box-title.purple { color: #581c87; }

        .info-box p {
            font-size: 12px;
            line-height: 1.6;
        }

        /* GAP ANALYSIS */
        .gap-analysis {
            border: 4px solid #000;
            background: #fff;
            padding: 18px;
        }

        .gap-title {
            font-weight: 900;
            font-size: 10px;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .gap-success {
            border: 3px solid #000;
            background: #d1fae5;
            padding: 12px;
            text-align: center;
        }

        .gap-success p {
            font-size: 13px;
            font-weight: 900;
            color: #065f46;
        }

        /* FOOTER */
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 4px solid #000;
            font-size: 11px;
            color: #6b7280;
            font-family: monospace;
        }

        /* STATS GRID */
        .stats-grid {
            display: table;
            width: 100%;
            margin-top: 15px;
        }

        .stat-item {
            display: table-cell;
            width: 33.33%;
            padding: 0 8px;
        }

        .stat-box {
            border: 3px solid #000;
            background: #f9fafb;
            padding: 12px;
            text-align: center;
        }

        .stat-number {
            font-size: 24px;
            font-weight: 900;
            display: block;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 9px;
            font-weight: 900;
            letter-spacing: 0.5px;
            color: #6b7280;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <div class="header-badge">AI-POWERED CAREER ANALYSIS</div>
        <h1>{{ $career->career_name }}</h1>
        <div class="subtitle">Personalized recommendation based on your skills and personality profile</div>
    </div>

    <!-- SCORE CARD -->
    <div class="score-section">
        <div class="score-label">🏆 OVERALL MATCH SCORE</div>
        
        <div class="match-bar-container">
            <div class="match-bar-label">
                <span>COMPATIBILITY RATING</span>
                <span style="font-size: 20px; font-weight: 900;">{{ $matchScore }}%</span>
            </div>
            <div class="match-bar-bg">
                <div class="match-bar-fill" style="width: {{ $matchScore }}%;"></div>
            </div>
        </div>

        <div class="score-display">
            <span class="score-number">{{ $matchScore }}%</span>
            <span class="score-text">MATCH</span>
        </div>
    </div>

    <!-- STATISTICS OVERVIEW -->
    <div class="stats-grid" style="margin-bottom: 25px;">
        <div class="stat-item">
            <div class="stat-box">
                <span class="stat-number">{{ count($career->required_skills) }}</span>
                <span class="stat-label">REQUIRED SKILLS</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-box">
                <span class="stat-number">{{ count($career->required_skills) - count($missing) }}</span>
                <span class="stat-label">SKILLS MATCHED</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-box">
                <span class="stat-number">{{ count($missing) }}</span>
                <span class="stat-label">SKILLS TO LEARN</span>
            </div>
        </div>
    </div>

    <!-- WHY THIS FITS YOU -->
    <div class="section">
        <div class="section-header">
            <span class="section-badge blue">ANALYSIS</span>
            <h2>Why This Career Fits You</h2>
        </div>
        <div class="content-box">
            <p>{{ $career->why_fit }}</p>
        </div>
    </div>

    <!-- TWO COLUMN: SKILLS & GAP ANALYSIS -->
    <div class="two-column">
        <div class="column">
            <!-- REQUIRED SKILLS -->
            <div class="section">
                <div class="section-header">
                    <span class="section-badge green">SKILLS</span>
                    <h2>Required Skills</h2>
                </div>
                <div class="brutal-box" style="margin-bottom: 0;">
                    <div class="skills-container">
                        @foreach($career->required_skills as $skill)
                            @php
                                $isMatched = !in_array($skill, $missing);
                            @endphp
                            <span class="brutal-tag {{ $isMatched ? 'matched' : '' }}">
                                {{ ucfirst($skill) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="column">
            <!-- GAP ANALYSIS -->
            <div class="section">
                <div class="section-header">
                    <span class="section-badge red">GAP</span>
                    <h2>Skills to Develop</h2>
                </div>
                <div class="gap-analysis" style="margin-bottom: 0;">
                    @if(count($missing) > 0)
                        <div class="gap-title">FOCUS AREAS FOR GROWTH</div>
                        <div class="skills-container">
                            @foreach($missing as $skill)
                                <span class="brutal-tag missing">{{ ucfirst($skill) }}</span>
                            @endforeach
                        </div>
                    @else
                        <div class="gap-success">
                            <p>🎯 You're fully aligned with all requirements!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ROADMAP -->
    <div class="section">
        <div class="section-header">
            <span class="section-badge purple">ROADMAP</span>
            <h2>Your Career Development Path</h2>
        </div>
        <div class="brutal-box">
            @foreach($career->roadmap as $index => $step)
                <div class="roadmap-item">
                    <div class="roadmap-number">
                        <div class="roadmap-number-box">{{ $index + 1 }}</div>
                    </div>
                    <div class="roadmap-text">{{ $step }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        Generated on {{ now()->format('d M Y, h:i A') }} • AI-Powered Career Intelligence System
    </div>

</body>
</html>