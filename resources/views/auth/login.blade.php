<!DOCTYPE html>
<html>
<head>
    <title>Login - Digital Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f0f4ff; min-height:100vh; display:flex; align-items:center; justify-content:center;">

<div style="width:100%; max-width:420px; padding:16px;">

  <div style="text-align:center; margin-bottom:28px;">
    <h1 style="color:#1a2a5e; font-size:26px; font-weight:500;">📚 Digital Library</h1>
    <p style="color:#64748b; font-size:14px;">Silakan login untuk melanjutkan</p>
  </div>

  <div style="background:#fff; border-radius:12px; border:0.5px solid #bfcfef; padding:32px;">

    @if(session('error'))
      <div style="background:#fef2f2; border:0.5px solid #fca5a5; color:#dc2626; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px;">
        {{ session('error') }}
      </div>
    @endif
    <form action="/login" method="POST">
  @csrf

  <!-- Username -->
  <div style="margin-bottom:18px;">
    <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Username</label>
    <input type="text" name="username" value="{{ old('username') }}" placeholder="Masukkan username"
      style="width:100%; padding:10px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
    @error('username') <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
  </div>

  <!-- Password -->
  <div style="margin-bottom:24px;">
    <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Password</label>
    <input type="password" name="password" placeholder="Masukkan password"
      style="width:100%; padding:10px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
    @error('password') <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
  </div>

  <button type="submit"
    style="width:100%; background:#2563eb; color:#fff; border:none; border-radius:8px; padding:11px; font-size:14px; font-weight:500; cursor:pointer;">
    Login
  </button>
</form>
  </div>
</div>

</body>
</html>