<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - NativeApp</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/auth.css')

</head>

<body class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md animate-[fadeInUp_0.8s_ease-out]">
        <div class="text-center mb-10">
            <img src="{{ asset('images/logo.png') }}" alt="NativeApp Logo"
                class="w-20 h-20 mx-auto mb-4 object-contain">
            <h1 class="text-3xl font-bold tracking-tight">Forgot Password?</h1>
            <p class="text-[var(--text-muted)] mt-2">No worries, we'll send you reset instructions</p>
        </div>

        <form action="#" class="space-y-6">
            <div class="space-y-2">
                <label for="email" class="text-sm font-medium text-[var(--text-muted)] ml-1">Email Address</label>
                <input type="email" id="email" placeholder="name@example.com"
                    class="w-full h-14 glass rounded-2xl px-5 focus:outline-none focus:border-[var(--accent-primary)] transition-all placeholder:text-gray-600">
            </div>

            <button type="button"
                class="w-full h-14 bg-gradient-to-r from-[#7c3aed] to-[#4f46e5] rounded-2xl font-semibold text-white shadow-lg shadow-purple-500/30 hover:scale-[0.98] active:scale-95 transition-transform mt-4">
                Reset Password
            </button>
        </form>

        <p class="text-center mt-8 text-[var(--text-muted)] text-sm">
            Remember your password?
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