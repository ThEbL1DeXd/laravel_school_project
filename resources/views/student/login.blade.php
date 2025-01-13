<div class="container mt-5">

    <form method="post" action="/login" class="p-4 border rounded shadow">
        @csrf
        <h2 class="mb-4 text-center">Login</h2>

        <div class="mb-3">
            <label for="email" class="form-label">Enter your email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        @error('email')
        <div class="alert alert-danger mt-3 text-center">
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="password" class="form-label">Enter your password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        @error('password')
        <div class="alert alert-danger mt-3 text-center">
            {{ $message }}
        </div>
        @enderror
        @error('message')
        <div class="alert alert-danger mt-3 text-center">
            {{ $message }}
        </div>
        @enderror

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>

    <div class="text-center mt-3">
        <a href="/signin" class="text-decoration-none">
            <h3 class="h6">Sign in if you don't have an account</h3>
        </a>
    </div>
</div>
