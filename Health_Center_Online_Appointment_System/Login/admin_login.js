
document.addEventListener('DOMContentLoaded', function () {

  // Toggle Password Visibility 
  const togglePw = document.getElementById('togglePw');
  const pwInput  = document.getElementById('password');

  if (togglePw && pwInput) {
    togglePw.addEventListener('click', function () {
      const isHidden = pwInput.type === 'password';
      pwInput.type         = isHidden ? 'text' : 'password';
      togglePw.textContent = isHidden ? '🙈' : '👁';
    });
  }

  // Submit Button Loading State 
  const loginForm = document.getElementById('loginForm');
  const submitBtn = document.getElementById('submitBtn');

  if (loginForm && submitBtn) {
    loginForm.addEventListener('submit', function () {
      submitBtn.textContent = 'Signing in…';
      submitBtn.disabled    = true;
      submitBtn.style.opacity = '0.8';
    });
  }

  // Auto-redirect on Success ─
  // Checks if a success alert is present, then redirects
  const successAlert = document.querySelector('.alert-success');
  if (successAlert) {
    setTimeout(function () {
      window.location.href = 'admin_dashboard.php';
    }, 1800);
  }

});