<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
            <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
            <p>{{ (session()->pull('sessionUser')) }}</p>
            <!-- Status -->

            </div>
        </div>

        <!-- search form (Optional) -->

        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <!-- Optionally, you can add icons to the links -->

            <li class="treeview">
                <a href="#"><i class="fa fa-user"></i> <span>Customer Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('customer.customer.create') }}">Customer Company</a></li>
                    <li><a href="{{ route('customer.customer.index') }}">Contact</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-cog"></i> <span>Product&ServiceManagement</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('service.service.index') }}">Service</a></li>
                    <li><a href="{{ route('picture.picture.index') }}">Picture</a></li>
                    <li><a href="{{ route('equipment.equipment.index') }}">Unit/Equipment</a></li>
                    <li><a href="{{ route('technology.technology.index') }}">Technology</a></li>
                    <li><a href="{{ route('reservoir.reservoir.index') }}">EWG Location</a></li>
                    <li><a href="{{ route('pipe.pipe.index') }}">Price List of Pipe</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
