@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('') }}</div>

                    <div class="card-body">
                        {{-- Alert dari session status (bisa untuk email verifikasi, dll) --}}
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- Alert sukses yang akan otomatis hilang --}}
                        @if ($message = session()->pull('success'))
                            <div id="login-alert" class="alert alert-success">
                                {{ $message }}
                            </div>

                            <script>
                                // Hilangkan alert setelah 3 detik
                                setTimeout(() => {
                                    const alert = document.getElementById('login-alert');
                                    if (alert) {
                                        alert.style.transition = "opacity 0.5s ease";
                                        alert.style.opacity = 0;
                                        setTimeout(() => alert.remove(), 500);
                                    }
                                }, 3000);
                            </script>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection