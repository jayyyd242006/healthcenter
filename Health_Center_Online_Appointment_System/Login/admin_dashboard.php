<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}
$admin_name = $_SESSION['admin_name'] ?? 'Administrator';
$initials   = strtoupper(substr($admin_name, 0, 2));
$today      = date('l, F j, Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard — HealthCenter Admin</title>
  <link rel="stylesheet" href="shared.css"/>
  <link rel="stylesheet" href="admin_dashboard.css"/>
</head>
<body>

<div class="admin-layout">
  <div class="main-content">

    <!-- Top Bar -->
    <div class="topbar">
      <div class="topbar-left">
        <h1>Dashboard</h1>
        <p>Good <?= (date('H') < 12) ? 'morning' : ((date('H') < 18) ? 'afternoon' : 'evening') ?>, <?= htmlspecialchars($admin_name) ?> 👋</p>
      </div>
      <div class="topbar-right">
        <span class="topbar-date"><?= $today ?></span>
      </div>
    </div>

    <!-- Page Body -->
    <div class="page-body">

      <!-- Stat Cards -->
      <div class="stat-grid">

        <div class="stat-card">
          <div class="stat-info">
            <div class="stat-value">24</div>
            <div class="stat-label">Today's Appointments</div>
            <span class="stat-change up">↑ 4 from yesterday</span>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-info">
            <div class="stat-value">312</div>
            <div class="stat-label">Total Patients</div>
            <span class="stat-change up">↑ 12 this week</span>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-info">
            <div class="stat-value">8</div>
            <div class="stat-label">Pending Confirmations</div>
            <span class="stat-change down">↑ 3 need action</span>
          </div>
        </div>

        <!-- FIXED MISSING CARD -->
        <div class="stat-card">
          <div class="stat-info">
            <div class="stat-value">2</div>
            <div class="stat-label">No-shows Today</div>
            <span class="stat-change down">↓ 1 from yesterday</span>
          </div>
        </div>

      </div>

      <!-- Dashboard Content -->
      <div class="dashboard-grid">

        <!--  QUICK ACTIONS  -->
        <div class="card quick-actions-card">
          <div class="card-header">
            <div class="card-title">Quick Actions</div>
          </div>
          <div class="card-body">
            <div class="quick-actions">
              <a href="appointments.php?action=new" class="quick-action-btn">
                <span>New Appointment</span>
              </a>
              <a href="patients.php?action=new" class="quick-action-btn">
                <span>Add Patient</span>
              </a>
              <a href="appointments.php?filter=pending" class="quick-action-btn">
                <span>Pending</span>
              </a>
              <a href="#" class="quick-action-btn">
                <span>Reports</span>
              </a>
            </div>
          </div>
        </div>

        <!--  APPOINTMENTS TABLE -->
        <div class="card">
          <div class="card-header">
            <div>
              <div class="card-title">Today's Appointments</div>
              <div class="card-subtitle">
                <?= date('F j, Y') ?> · <?= date('l') ?>
              </div>
            </div>
            <a href="appointments.php" class="btn btn-outline btn-sm">View All</a>
          </div>

          <div class="card-body">
            <div class="table-wrap">
              <table>
                <thead>
                  <tr>
                    <th>Time</th>
                    <th>Patient</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>

</body>
</html>