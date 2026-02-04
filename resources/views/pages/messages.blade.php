<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - NativeApp</title>
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
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
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

        h1 {
            font-size: 24px;
            font-weight: 700;
        }

        .chat-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .chat-item {
            display: flex;
            align-items: center;
            padding: 16px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            margin-right: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .chat-info h3 {
            font-size: 16px;
            margin-bottom: 4px;
        }

        .chat-info p {
            color: var(--text-muted);
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="header">
        <a href="/" class="back-btn">←</a>
        <h1>Messages</h1>
    </div>

    <div class="chat-list">
        <div class="chat-item">
            <div class="avatar">JD</div>
            <div class="chat-info">
                <h3>John Doe</h3>
                <p>Hey, is the production build ready?</p>
            </div>
        </div>
        <div class="chat-item">
            <div class="avatar">AS</div>
            <div class="chat-info">
                <h3>Alice Smith</h3>
                <p>The new UI looks amazing on 16kb devices!</p>
            </div>
        </div>
        <div class="chat-item">
            <div class="avatar">MG</div>
            <div class="chat-info">
                <h3>Mark G.</h3>
                <p>Check the latest APK size optimization steps.</p>
            </div>
        </div>
    </div>
</body>

</html>