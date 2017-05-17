<div class="navbar-inner">
    <div class="container"> 
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            
        </a>
        <a class="brand" href="index.php">Trang quản trị </a>
       
        <?php
        if (isset($_SESSION['admin-login'])) {
            ?>
            <div class="nav-collapse">
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> <?php echo isset($_SESSION['admin-username'])?$_SESSION['admin-username']:"" ?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            
                            <li><a href="?options=signout">Thoát</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-search pull-right">
                    <input type="text" class="search-query" placeholder="Search">
                </form>
            </div>
            <!--/.nav-collapse --> 
            <?php
        }
        ?>
    </div>
    <!-- /container --> 
</div>
<!-- /navbar-inner --> 