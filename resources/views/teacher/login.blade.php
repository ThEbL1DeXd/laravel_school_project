<div class="container mt-5">
    <form method="post" action="/teacher/login" class="bg-info p-5 w-75 m-auto rounded shadow">
        @csrf
        <h2 class="text-center mb-4">Teacher Login</h2>
        <div class="mb-3 row">
            <label for="username" class="col-sm-4 col-form-label text-end">Enter your username:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password" class="col-sm-4 col-form-label text-end">Enter your password:</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
        </div>
        @error('message')
        <div class="alert alert-danger mt-3 text-center">
            {{ $message }}
        </div>
        @enderror
        <div class="text-center">
            <button type="submit" class="btn btn-danger px-4">Login</button>
        </div>
    </form>
</div>

