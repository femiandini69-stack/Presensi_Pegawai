<x-guest-layout>
    <style>
        body { background-color: #101B3A !important; }
    </style>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg border-0 rounded-4" style="width: 100%; max-width: 400px; padding: 20px;">
            <div class="card-body">
                <h4 class="text-center fw-bold mb-4" style="color: #3d6780;">SISTEM PRESENSI PEGAWAI</h4>
                <p class="text-center text-muted mb-4">Silakan masuk untuk memulai sesi Anda</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    {{-- Email --}}
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control rounded-3" value="{{ old('email') }}" required autofocus>
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" required>
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword(event)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Ingat Saya</label>
                    </div>

                    <button type="submit" class="btn w-100 text-white fw-bold shadow-sm" style="background-color: #3d6780; padding: 10px;">
                        Masuk
                    </button>
                </form>

                <div class="text-center mt-3">
                    <a href="/" class="text-decoration-none" style="color: #3d6780; font-size: 0.9rem;">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(event) {
            if (event) event.preventDefault();
            const p = document.getElementById("password");
            p.type = (p.type === "password") ? "text" : "password";
        }
    </script>
</x-guest-layout>