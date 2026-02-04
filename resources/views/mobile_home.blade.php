<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NativeApp - Premium Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            overflow-x: hidden;
            background-image:
                radial-gradient(circle at 0% 0%, rgba(124, 58, 237, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 100% 100%, rgba(236, 72, 153, 0.1) 0%, transparent 40%);
        }

        .container {
            padding: 24px;
            padding-bottom: 100px;
            /* Space for nav */
        }

        /* Header section */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            animation: fadeInDown 0.8s ease-out;
        }

        .user-info h1 {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .user-info p {
            color: var(--text-muted);
            font-size: 14px;
        }

        .profile-pic {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            border: 2px solid var(--glass-border);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Banner section */
        .banner {
            background: linear-gradient(135deg, #7c3aed 0%, #4f46e5 100%);
            border-radius: 24px;
            padding: 24px;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(124, 58, 237, 0.3);
            animation: fadeIn 1s ease-out;
        }

        .banner::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .banner h2 {
            font-size: 20px;
            margin-bottom: 8px;
            max-width: 70%;
        }

        .banner p {
            font-size: 14px;
            rgba(255, 255, 255, 0.8);
            margin-bottom: 16px;
        }

        .banner-btn {
            background: #fff;
            color: #7c3aed;
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .banner-btn:active {
            transform: scale(0.95);
        }

        /* Grid section */
        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .see-all {
            color: var(--accent-primary);
            font-size: 14px;
            font-weight: 500;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            animation: fadeInUp 0.8s ease-out;
            animation-fill-mode: both;
        }

        .card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .card:active {
            transform: translateY(-5px) scale(0.98);
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--accent-primary);
        }

        .icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(124, 58, 237, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            color: var(--accent-primary);
            font-size: 20px;
        }

        .card.pink .icon-box {
            background: rgba(236, 72, 153, 0.1);
            color: var(--accent-secondary);
        }

        .card.blue .icon-box {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .card.orange .icon-box {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .card h3 {
            font-size: 16px;
            margin-bottom: 4px;
        }

        .card p {
            color: var(--text-muted);
            font-size: 12px;
        }

        /* Bottom Nav */
        nav {
            position: fixed;
            bottom: 24px;
            left: 20px;
            right: 20px;
            background: rgba(13, 15, 20, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            height: 72px;
            border-radius: 24px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            z-index: 100;
        }

        .nav-item {
            color: var(--text-muted);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            font-size: 10px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .nav-item.active {
            color: var(--accent-primary);
        }

        .nav-item i {
            font-size: 24px;
            margin-bottom: 4px;
        }

        .nav-center {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 28px;
            margin-top: -40px;
            border: 4px solid var(--bg-color);
            box-shadow: 0 10px 20px rgba(124, 58, 237, 0.4);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <header>
            <div class="user-info">
                <p>Good Morning,</p>
                <h1>User 👋</h1>
            </div>
            <div class="profile-pic">U</div>
        </header>

        <div class="banner">
            <h2>Ready to Build?</h2>
            <p>Your NativePHP app is compiled and ready for deployment.</p>
            <button class="banner-btn">Get Started</button>
        </div>

        <div class="section-title">
            <span>Explore Features</span>
            <span class="see-all">See All</span>
        </div>

        <div class="grid">
            <a href="/analytics" style="text-decoration: none; color: inherit;">
                <div class="card">
                    <div class="icon-box">📊</div>
                    <h3>Analytics</h3>
                    <p>Track your app performance in real-time.</p>
                </div>
            </a>
            <div class="card pink">
                <div class="icon-box">📂</div>
                <h3>Storage</h3>
                <p>Manage your files and assets securely.</p>
            </div>
            <a href="/messages" style="text-decoration: none; color: inherit;">
                <div class="card blue">
                    <div class="icon-box">💬</div>
                    <h3>Messages</h3>
                    <p>Stay connected with your team always.</p>
                </div>
            </a>
            <div class="card orange">
                <div class="icon-box">⚙️</div>
                <h3>Settings</h3>
                <p>Customize your experience and theme.</p>
            </div>
        </div>
    </div>

    <nav>
        <a href="#" class="nav-item active">
            <i>🏠</i>
            Home
        </a>
        <a href="#" class="nav-item">
            <i>🔍</i>
            Search
        </a>
        <div class="nav-center">+</div>
        <a href="#" class="nav-item">
            <i>🔔</i>
            Alerts
        </a>
        <a href="#" class="nav-item">
            <i>👤</i>
            Profile
        </a>
    </nav>

</body>

</html>