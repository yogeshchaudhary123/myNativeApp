<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - NativeApp</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
            background-image:
                radial-gradient(circle at 0% 0%, rgba(124, 58, 237, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 100% 100%, rgba(236, 72, 153, 0.1) 0%, transparent 40%);
        }

        .glass {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md animate-[fadeInUp_0.8s_ease-out]">
        <div class="text-center mb-10">
            <img src="{{ asset('images/logo.png') }}" alt="NativeApp Logo"
                class="w-20 h-20 mx-auto mb-4 object-contain">
            <h1 class="text-3xl font-bold tracking-tight">Setup New Password</h1>
            <p class="text-[var(--text-muted)] mt-2">Please enter your new password below</p>
        </div>

        <form action="#" class="space-y-6">
            <div class="space-y-2">
                <label for="password" class="text-sm font-medium text-[var(--text-muted)] ml-1">New Password</label>
                <input type="password" id="password" placeholder="••••••••"
                    class="w-full h-14 glass rounded-2xl px-5 focus:outline-none focus:border-[var(--accent-primary)] transition-all placeholder:text-gray-600">
            </div>

            <div class="space-y-2">
                <label for="password_confirmation" class="text-sm font-medium text-[var(--text-muted)] ml-1">Confirm New
                    Password</label>
                <input type="password" id="password_confirmation" placeholder="••••••••"
                    class="w-full h-14 glass rounded-2xl px-5 focus:outline-none focus:border-[var(--accent-primary)] transition-all placeholder:text-gray-600">
            </div>

            <button type="button"
                class="w-full h-14 bg-gradient-to-r from-[#7c3aed] to-[#4f46e5] rounded-2xl font-semibold text-white shadow-lg shadow-purple-500/30 hover:scale-[0.98] active:scale-95 transition-transform mt-4">
                Update Password
            </button>
        </form>

        <p class="text-center mt-8 text-[var(--text-muted)] text-sm">
            Suddenly remembered?
            <a href="/login"
                class="text-white font-semibold hover:text-[var(--accent-secondary)] transition-colors">Back to
                Login</a>
        </p>
    </div>

    <style>
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
</body>

</html>