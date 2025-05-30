<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark sidebar-link" href="admin.php" aria-expanded="false">
                    <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span>
                  </a>
                </li>
                <li class="sidebar-item <?=(isset($_GET['users']))?' class="active"':'';?>">
                  <a class="sidebar-link waves-effect waves-dark sidebar-link" href="admin.php?users" aria-expanded="false">
                    <i class="mdi mdi-account"></i><span class="hide-menu">Users</span>
                  </a>
                </li>
                <li class="sidebar-item <?=(isset($_GET['bankaccounts']))?' class="active"':'';?>">
                  <a class="sidebar-link waves-effect waves-dark sidebar-link" href="admin.php?bankaccounts" aria-expanded="false">
                    <i class="mdi mdi-bank"></i><span class="hide-menu">Contracts</span>
                  </a>
                </li>
                <li class="sidebar-item <?=(isset($_GET['maintenance']))?' class="active"':'';?>">
                  <a class="sidebar-link waves-effect waves-dark sidebar-link" href="admin.php?maintenance" aria-expanded="false">
                    <i class="mdi mdi-book-open-page-variant"></i><span class="hide-menu">Maintenance</span>
                  </a>
                </li>
                <li class="sidebar-item <?=(isset($_GET['reports']))?' class="active"':'';?>">
                  <a class="sidebar-link waves-effect waves-dark sidebar-link" href="admin.php?reports" aria-expanded="false">
                    <i class="mdi mdi-file-document"></i><span class="hide-menu">Reports</span>
                  </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>