<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark sidebar-link" href="user.php" aria-expanded="false">
                    <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span>
                  </a>
                </li>
                <li class="sidebar-item <?=(isset($_GET['maintenance']))?' class="active"':'';?>">
                  <a class="sidebar-link waves-effect waves-dark sidebar-link" href="user.php?maintenance" aria-expanded="false">
                    <i class="mdi mdi-book-open-page-variant"></i><span class="hide-menu">Maintenance</span>
                  </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>