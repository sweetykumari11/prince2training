<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Change Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2 class="text-center mb-4">Reset Password</h2>
        <form action="{{ route('password.change') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <div class="form-group">
                <label for="oldPassword">Old Password</label>
                <input type="password" class="form-control @error('oldPassword') is-invalid @enderror" id="oldPassword"
                    name="oldPassword" value="{{ old('oldPassword') }}">
                @error('oldPassword')
                    <span class="error invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" class="form-control @error('newPassword') is-invalid @enderror" id="newPassword"
                    name="newPassword" value="{{ old('newPassword') }}">
                @error('newPassword')
                    <span class="error invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror"
                    id="confirmPassword" name="confirmPassword" value="{{ old('confirmPassword') }}">
                @error('confirmPassword')
                    <span class="error invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#oldPassword,#newPassword,#confirmPassword")
                .on("input", function() {
                    removeErrorMessages($(this));
                });

            function removeErrorMessages(inputField) {
                var parent = inputField.closest('.form-group');
                var errorElement = parent.find('.error');
                errorElement.remove();
                inputField.removeClass('is-invalid');
            }
        });
    </script>
</body>

</html>
