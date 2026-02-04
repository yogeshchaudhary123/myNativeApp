<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - NativeApp</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0d0f14;
            --accent-primary: #7c3aed;
            --accent-secondary: #ec4899;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-main: #ffffff;
            --text-muted: #94a3b8;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            padding: 24px;
            background-image: radial-gradient(circle at 100% 0%, rgba(124, 58, 237, 0.1) 0%, transparent 40%);
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 32px;
        }

        .back-btn {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            margin-right: 16px;
        }

        h1 { font-size: 24px; font-weight: 700; }

        .stat-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 24px;
            margin-bottom: 20px;
            backdrop-filter: blur(10px);
        }

        .stat-val { font-size: 32px; font-weight: 700; color: var(--accent-primary); margin-bottom: 4px; }
        .stat-label { color: var(--text-muted); font-size: 14px; }

        .chart-container {
            height: 200px;
            display: flex;
            align-items: flex-end;
            gap: 12px;
            padding: 20px 0;
        }

        .bar {
            flex: 1;
            background: linear-gradient(to top, var(--accent-primary), var(--accent-secondary));
            border-radius: 8px 8px 0 0;
            transition: height 1s ease-out;
            min-height: 10px;
        }

    </style>
</head>
<body>
    <div class="header">
        <a href="/" class="back-btn">←</a>
        <h1>Analytics</h1>
    </div>

    <div class="stat-card">
        <div class="stat-val">12,480</div>
        <div class="stat-label">Active Users Today (+12%)</div>
        <div class="chart-container">
            <div class="bar" style="height: 40%"></div>
            <div class="bar" style="height: 70%"></div>
            <div class="bar" style="height: 55%"></div>
            <div class="bar" style="height: 90%"></div>
            <div class="bar" style="height: 75%"></div>
            <div class="bar" style="height: 100%"></div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-val">$4,290</div>
        <div class="stat-label">Revenue This Week</div>
    </div>
</body>
</html>
