<?php
session_start();
session_unset();
session_destroy();
// Redirect if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin_dashboard.php');
    exit();
}

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CSRF validation
    if (
        empty($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        $error = 'Invalid request. Please try again.';
    } else {

        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Basic validation
        if (empty($email) || empty($password)) {
            $error = 'Please fill in all fields.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        } else {
            $demo_email    = 'admin@healthcenter.com';
            $demo_password = 'Admin@1234';

            if ($email === $demo_email && $password === $demo_password) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_name']      = 'Administrator';
                $_SESSION['admin_email']     = $email;
                $success = 'Login successful! Redirecting to dashboard…';
                // header('Location: dashboard.php');
                // exit();
            } else {
                $error = 'Invalid email or password. Please try again.';
            }
        }
    }
}

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login — HealthCenter</title>
  <link rel="stylesheet" href="admin_login.css"/>
</head>
<body>

<div class="page">
  <div class="left-panel">
    <div class="left-pattern"></div>

    <div class="brand">
      <div class="brand-name">
        HealthCenter
        <span>Online Appointment System</span>
      </div>
    </div>

    <div class="hero-text">
      <h1>Manage care,<br><em>effortlessly.</em></h1>
    </div>

    <div class="stat-row">
      <div class="stat">
        <div class="stat-num">98%</div>
        <div class="stat-label">Booking accuracy</div>
      </div>
      <div class="stat">
        <div class="stat-num">24/7</div>
        <div class="stat-label">System uptime</div>
      </div>
      <div class="stat">
        <div class="stat-num">↓40%</div>
        <div class="stat-label">No-show rate</div>
      </div>
    </div>
  </div>
  <div class="right-panel">
    <div class="form-container">

      <div class="form-header">
        <div class="access-badge">Admin Access</div>
        <h2>Welcome back</h2>
        <p>Sign in to manage appointments, patients, and clinic schedules.</p>
      </div>

      <?php if (!empty($error)): ?>
          <span><?= htmlspecialchars($error) ?></span>
        </div>
      <?php endif; ?>

      <?php if (!empty($success)): ?>
        <div class="alert alert-success">
          <span><?= htmlspecialchars($success) ?></span>
        </div>
      <?php endif; ?>

      <form method="POST" action="" id="loginForm" novalidate>

        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>"/>

        <!-- Email -->
        <div class="field">
          <label for="email">Email Address</label>
          <div class="input-wrap">
            <input
              type="email"
              id="email"
              name="email"
              placeholder="admin@healthcenter.com"
              value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
              autocomplete="email"
              required
            />
          </div>
        </div>

        <!-- Password -->
        <div class="field">
          <label for="password">Password</label>
          <div class="input-wrap">
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Enter your password"
              autocomplete="current-password"
              required
            />
            <button type="button" class="toggle-pw" id="togglePw" aria-label="Toggle password visibility">👁</button>
          </div>
        </div>

        <!-- Remember me and Forgot password -->
        <div class="field-row">
          <label class="checkbox-label">
            <input
              type="checkbox"
              name="remember"
              id="remember"
              <?= isset($_POST['remember']) ? 'checked' : '' ?>
            />
            <span>Remember me</span>
          </label>
          <a href="forgot-password.php" class="forgot-link">Forgot password?</a>
        </div>

        <button type="submit" class="btn-login" id="submitBtn">
          Sign In to Dashboard
        </button>

        <div class="divider">Authorized personnel only</div>

        <div class="security-note">
          <span>This portal is protected by session-based authentication.<br>All activity is logged for security.</span>
        </div>

        <!-- Demo hint — remove in production -->
        <div class="demo-hint">
          <strong>Demo credentials:</strong><br>
          Email: <strong>admin@healthcenter.com</strong><br>
          Password: <strong>Admin@1234</strong>
        </div>

      </form>
    </div>
  </div>

</div>

<script src="admin_login.js"></script>

</body>
</html>