<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NativeApp</title>
    @vite('resources/css/auth.css')
</head>

<body class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md animate-[fadeInUp_0.8s_ease-out]">
        <div class="text-center mb-10">
            <img src="{{ asset('images/logo.png') }}" alt="NativeApp Logo"
                class="w-20 h-20 mx-auto mb-4 object-contain">
            <h1 class="text-3xl font-bold tracking-tight">Welcome Back</h1>
            <p class="text-[var(--text-muted)] mt-2">Sign in to continue to NativeApp</p>
        </div>
          @error('main_error')
          <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
          @enderror
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="email" class="text-sm font-medium text-[var(--text-muted)] ml-1">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com"
                    class="w-full h-14 glass rounded-2xl px-5 focus:outline-none focus:border-[var(--accent-primary)] transition-all placeholder:text-gray-600 @error('email') border-red-500 @enderror"
                    required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <div class="flex justify-between items-center ml-1">
                    <label for="password" class="text-sm font-medium text-[var(--text-muted)]">Password</label>
                    <a href="/forgot-password"
                        class="text-sm font-medium text-[var(--accent-primary)] hover:opacity-80">Forgot?</a>
                </div>
                <input type="password" id="password" name="password" placeholder="••••••••"
                    class="w-full h-14 glass rounded-2xl px-5 focus:outline-none focus:border-[var(--accent-primary)] transition-all placeholder:text-gray-600 @error('password') border-red-500 @enderror"
                    required>
                @error('password')
                    <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center ml-1">
                <input type="checkbox" name="remember" id="remember"
                    class="w-4 h-4 rounded border-gray-300 text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                <label for="remember" class="ml-2 text-sm text-[var(--text-muted)]">Remember me</label>
            </div>

            <button type="submit"
                class="w-full h-14 bg-gradient-to-r from-[#7c3aed] to-[#4f46e5] rounded-2xl font-semibold text-white shadow-lg shadow-purple-500/30 hover:scale-[0.98] active:scale-95 transition-transform mt-4">
                Sign In
            </button>
        </form>

        <p class="text-center mt-8 text-[var(--text-muted)] text-sm">
            Don't have an account?
            <a href="/register"
                class="text-white font-semibold hover:text-[var(--accent-secondary)] transition-colors">Create
                Account</a>
        </p>
    </div>

</body>

</html>