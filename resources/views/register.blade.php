<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title>Реєстрація</title>
</head>

<body>
<h2>Реєстрація користувача</h2>

@if (session('error'))
    <p>{{ session('error') }}</p>
@endif

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('register.store') }}" method="POST">
    @csrf
    <label>Username: <input type="text" name="username" value="{{ old('username') }}" required></label><br><br>
    <label>Phonenumber: <input type="text" name="phone" value="{{ old('phone') }}" required></label><br><br>
    <button type="submit">Register</button>
</form>

</body>
</html>
