  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#data-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Buy Data</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="data-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          
          <li>
            <a href="buy_data.php?data=mtn">
              <i class="bi bi-circle"></i><span>MTN Data</span>
            </a>
          </li>
          <li>
            <a href="buy_data.php?data=airtel">
              <i class="bi bi-circle"></i><span>Airtel Data</span>
            </a>
          </li>
          <li>
            <a href="buy_data.php?data=glo">
              <i class="bi bi-circle"></i><span>Glo Data</span>
            </a>
          </li>
          <li>
            <a href="buy_data.php?data=9mobile">
              <i class="bi bi-circle"></i><span>9Mobile Data</span>
            </a>
          </li>
			
        </ul>
      </li><!-- End Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#buy-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Buy Airtime</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="buy-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="buy_airtime.php?airtime=mtn">
              <i class="bi bi-circle"></i><span>MTN</span>
            </a>
          </li>
          <li>
            <a href="buy_airtime.php?airtime=airtel">
              <i class="bi bi-circle"></i><span>Airtel</span>
            </a>
          </li>
          <li>
            <a href="buy_airtime.php?airtime=glo">
              <i class="bi bi-circle"></i><span>Glo</span>
            </a>
          </li>
          <li>
            <a href="buy_airtime.php?airtime=9mobile">
              <i class="bi bi-circle"></i><span>9Mobile</span>
            </a>
          </li>
        </ul>
      </li><!-- End Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#utility-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Utility Payment</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="utility-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="pay_bill.php">
              <i class="bi bi-circle"></i><span>Pay Bill</span>
            </a>
          </li>
          <li>
            <a href="pay_subscription.php">
              <i class="bi bi-circle"></i><span>Cable Subscription</span>
            </a>
          </li>
        </ul>
      </li><!-- End Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#fund-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Fund Wallet</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="fund-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="fund_paystack.php">
              <i class="bi bi-circle"></i><span>Paystack (ATM)</span>
            </a>
          </li>
          <li>
            <a href="fund_transfer.php">
              <i class="bi bi-circle"></i><span>Bank Transfer</span>
            </a>
          </li>
          <li>
            <a href="fund_coupon.php">
              <i class="bi bi-circle"></i><span>Coupon Code</span>
            </a>
          </li>
          <li>
            <a href="fund_manually.php">
              <i class="bi bi-circle"></i><span>Manually</span>
            </a>
          </li>
        </ul>
      </li><!-- End Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#result-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Result Checker</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="result-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="result_checker.php?check=waec">
              <i class="bi bi-circle"></i><span>WAEC</span>
            </a>
          </li>
          <li>
            <a href="result_checker.php?check=new">
              <i class="bi bi-circle"></i><span>NECO</span>
            </a>
          </li>
          <li>
            <a href="result_checker.php?check=napteb">
              <i class="bi bi-circle"></i><span>NAPTEB</span>
            </a>
          </li>
        </ul>
      </li><!-- End Nav -->

	  <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#transaction-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Transactions</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="transaction-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="history_data.php">
              <i class="bi bi-circle"></i><span>Data History</span>
            </a>
          </li>
          <li>
            <a href="history_airtime.php">
              <i class="bi bi-circle"></i><span>Airtime History</span>
            </a>
          </li>
          <li>
            <a href="history_fund.php">
              <i class="bi bi-circle"></i><span>Funds History</span>
            </a>
          </li>
          <li>
            <a href="history_referal.php">
              <i class="bi bi-circle"></i><span>My Referals</span>
            </a>
          </li>
        </ul>
      </li><!-- End Nav -->

      <li class="nav-heading"></li>

	  <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#account-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Account</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="account-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="user_profile.php">
              <i class="bi bi-circle"></i><span>My Profile</span>
            </a>
          </li>
          <li>
            <a href="user_setting.php">
              <i class="bi bi-circle"></i><span>Setting</span>
            </a>
          </li>
          <li>
            <a href="user_setting.php">
              <i class="bi bi-circle"></i><span>Change Password</span>
            </a>
          </li>
        </ul>
      </li><!-- End Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="contact.php">
          <i class="bi bi-envelope"></i>
          <span>Contact Us</span>
        </a>
      </li><!-- End Contact Page Nav -->
		
      <li class="nav-item">
        <a class="nav-link collapsed" href="developer_api.php">
          <i class="bi bi-person"></i>
          <span>Developer API</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-question-circle"></i>
          <span>Version: <?= $app_version; ?></span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

    </ul>

  </aside>
<!-- End Sidebar-->