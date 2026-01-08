<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Puskesmas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --puskesmas-dark: #0f5132;   
            --puskesmas-main: #198754;
            --puskesmas-light: #e8f5e9;
        }

        body { 
            background-color: var(--puskesmas-light); 
            min-height: 100vh;
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        .card-login { 
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-radius: 15px; 
            border: none;
            overflow: hidden;
        }

        .header-login { 
            background-color: var(--puskesmas-dark); 
            color: white; 
            padding: 30px 20px; 
            text-align: center; 
        }

        .btn-primary {
            background-color: var(--puskesmas-main);
            border-color: var(--puskesmas-main);
        }

        .btn-primary:hover {
            background-color: var(--puskesmas-dark);
            border-color: var(--puskesmas-dark);
        }
        
        .form-control:focus {
            border-color: var(--puskesmas-main);
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
        }
    </style>
</head>
<body>

    <div class="card card-login bg-white">
        <div class="header-login">
            <h4>PUSKESMAS SEHAT</h4>
            <small>Silakan Login Terlebih Dahulu</small>
        </div>
        <div class="card-body p-4">
            @if($errors->has('login_gagal'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal Masuk!</strong> {{ $errors->first('login_gagal') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST" novalidate>
                @csrf               
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" 
                        name="username" 
                        id="username"
                        class="form-control @error('username') is-invalid @enderror" 
                        placeholder="Masukkan username" 
                        value="{{ old('username') }}">
                    
                    @error('username')
                        <div class="invalid-feedback server-error">
                            {{ $message }}
                        </div>
                    @enderror
                    <div id="username-min-error" class="invalid-feedback d-none">
                        Username terlalu pendek (minimal 3 karakter).
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" 
                        name="password" 
                        id="password"
                        class="form-control @error('password') is-invalid @enderror" 
                        placeholder="Masukkan password">

                    @error('password')
                        <div class="invalid-feedback server-error">
                            {{ $message }}
                        </div>
                    @enderror

                    <div id="password-min-error" class="invalid-feedback d-none">
                        Password terlalu pendek (minimal 6 karakter).
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2">MASUK</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const fields = [
                { 
                    inputId: 'username', 
                    errorId: 'username-min-error', 
                    minLength: 3 
                },
                { 
                    inputId: 'password', 
                    errorId: 'password-min-error', 
                    minLength: 6 
                }
            ];

            fields.forEach(field => {
                const inputEl = document.getElementById(field.inputId);
                const liveErrorEl = document.getElementById(field.errorId);
                
                if (inputEl && liveErrorEl) {
                    
                    inputEl.addEventListener('input', function() {
                        const currentVal = this.value;
                        const serverErrorEl = this.parentNode.querySelector('.server-error');

                        if (this.classList.contains('is-invalid') && !liveErrorEl.classList.contains('d-block')) {
                            if (serverErrorEl) serverErrorEl.style.display = 'none';
                            this.classList.remove('is-invalid');
                        }

                        if (currentVal.length > 0 && currentVal.length < field.minLength) {
                            this.classList.add('is-invalid');       
                            liveErrorEl.classList.remove('d-none');
                            liveErrorEl.classList.add('d-block');
                        } else {
                            liveErrorEl.classList.remove('d-block');
                            liveErrorEl.classList.add('d-none');
                            
                            if (!serverErrorEl || serverErrorEl.style.display === 'none') {
                                this.classList.remove('is-invalid');
                            }
                        }
                    });
                }
            });

            const alertBox = document.querySelector('.alert');
            const allInputs = document.querySelectorAll('.form-control');

            allInputs.forEach(input => {
                input.addEventListener('input', () => {
                    if (alertBox) {
                        try {
                            const bsAlert = bootstrap.Alert.getOrCreateInstance(alertBox);
                            bsAlert.close();
                        } catch (e) {
                            alertBox.remove();
                        }
                    }
                });
            });

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>