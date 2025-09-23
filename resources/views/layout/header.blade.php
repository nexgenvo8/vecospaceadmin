        <!-- Navbar -->
        {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('index') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('contact_list') }}" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li> --}}

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fas fa-user-circle"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- Profile -->
                        <a href="{{ route('profile.view') }}" class="dropdown-item">
                            <i class="fas fa-user"></i> Profile
                        </a>



                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item">
                            <i class="fas fa-user"></i> Logout
                        </a>
                    </div>
                </li>


                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    {{-- <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a> --}}
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    {{-- <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a> --}}
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/index') }}" class="brand-link">
                <a href="{{ url('/index') }}" class="brand-link">
                    <img src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/img/logo11.png') }}"
                        alt="JMIVecospace Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight fs-4 text-light">JMIVecospace</span>

                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/img/user2-160x160.jpg') }}"
                                class="img-circle elevation-2" alt="User Image">
                        </div>
                        @if (!session()->has('admin') || session('admin') === null)
                            <script>
                                window.location.href = "{{ route('loginform') }}";
                            </script>
                        @else
                            <div class="info">
                                <a href="{{ route('index') }}" class="d-block">{{ session('admin')['name'] }}</a>
                            </div>
                        @endif

                    </div>

                    <!-- SidebarSearch Form -->
                    {{-- <div class="form-inline">
                        <div class="input-group" data-widget="sidebar-search">
                            <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sidebar">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                            {{-- <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./index.html" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v1</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./index2.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v2</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./index3.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v3</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                            {{-- <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Widgets
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li> --}}
                            {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Layout Options
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right">6</span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/layout/top-nav.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Top Navigation</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Top Navigation + Sidebar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/boxed.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Boxed</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Fixed Sidebar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Fixed Sidebar <small>+ Custom Area</small></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/fixed-topnav.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Fixed Navbar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/fixed-footer.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Fixed Footer</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Collapsed Sidebar</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                            {{-- @php
                                function hasPermission($perm)
                                {
                                    return in_array($perm, session('permissions', []));
                                }
                            @endphp --}}


                            </li>
                            {{-- Sidebar / Header Navigation --}}
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">

                                @if (hasPermission('manage_menu_pages') || hasPermission('manage_faqs_pages'))
                                    <li class="nav-item has-treeview" id="pages">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-file-alt"></i>
                                            <!-- Changed icon to represent "pages" -->
                                            <p>
                                                Manage Pages
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>


                                        <ul class="nav nav-treeview">
                                            @if (hasPermission('manage_menu_pages'))
                                                <li class="nav-item">
                                                    <a href="{{ url('pages/manage-page') }}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Manage Pages</p>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (hasPermission('manage_faqs_pages'))
                                                <li class="nav-item">
                                                    <a href="{{ url('pages/manage-faqs') }}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Manage Faqs Pages</p>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>

                                @endif

                                {{-- Users --}}
                                @if (hasPermission('subscription_list') || hasPermission('import_userdata'))
                                    <li class="nav-item has-treeview" id="userMenu">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-users"></i>
                                            <p>
                                                Users
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>

                                        <ul class="nav nav-treeview">
                                            @if (hasPermission('subscription_list'))
                                                <li class="nav-item">
                                                    <a href="{{ url('users/subscription_list') }}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Manage Users</p>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (hasPermission('import_userdata'))
                                                <li class="nav-item">
                                                    <a href="{{ url('user/import_userdata') }}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Import Users Data</p>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>

                                @endif

                                {{-- Group --}}
                                @if (hasPermission('group_list'))
                                    <li class="nav-item has-treeview" id="groupMenu">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-user-friends"></i>
                                            <p>
                                                Group
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>

                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="{{ url('group/group_list') }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Manage Group</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif

                                {{-- Company Profiles --}}
                                @if (hasPermission('company_list'))
                                    <li class="nav-item has-treeview" id="companymenu">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-building"></i>
                                            <p>
                                                Company Profiles
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="{{ url('company/company_list') }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Manage Company</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif

                                {{-- Articles --}}
                                @if (hasPermission('article_list'))
                                    <li class="nav-item has-treeview" id="articlemenu">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-newspaper"></i>
                                            <p>
                                                Articles
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="{{ url('article/article_list') }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Manage Articles</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif

                                {{-- Event Calendar --}}
                                @if (hasPermission('events_list'))
                                    <li class="nav-item has-treeview" id="eventmenu">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-calendar-alt"></i>
                                            <p>
                                                Event Calendar
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="{{ url('event/events_list') }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Manage Event</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif

                                {{-- Roles & Permissions --}}
                                @if (hasPermission('roles_permissions_list'))
                                    <li class="nav-item has-treeview" id="rolemenu">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-user-shield"></i>
                                            <p>
                                                Role And Permissions
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            {{-- <li class="nav-item">
                                                <a href="{{ url('masteradmin/roles-permissions') }}"
                                                    class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Roles and Permissions</p>
                                                </a>
                                            </li> --}}
                                            @if (hasPermission('manage_permissions'))
                                                <li class="nav-item">
                                                    <a href="{{ url('/permissions_list') }}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Roles & Permissions</p>
                                                    </a>
                                                </li>
                                            @endif
                                    </li>
                                    {{-- @if (hasPermission('edit_roles_permissions'))
                                        <li class="nav-item">
                                            <a href="{{ url('/edit_roles_permissions') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Edit Permissions</p>
                                            </a>
                                        </li>
                                    @endif --}}
                            </ul>
                            </li>
                            @endif

                            {{-- Projects & Internships --}}
                            @if (hasPermission('project_list'))
                                <li class="nav-item has-treeview" id="projectmenu">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-tasks"></i>
                                        <p>
                                            Projects & Internships
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('project/project_list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Manage Projects</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            {{-- Career Enhancers --}}
                            @if (hasPermission('career_enhancers'))
                                <li class="nav-item has-treeview" id="careermenu">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-user-graduate"></i>
                                        <p>
                                            Career Enhancers
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('career/career_enhancers') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Manage Career Enhancers</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            {{-- Guest Speakers & Trainers --}}
                            @if (hasPermission('talent_list'))
                                <li class="nav-item has-treeview" id="guestmenu">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-microphone"></i>
                                        <p>
                                            Guest Speakers & Trainers
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('talent/talent_list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Manage Guest Speakers & Trainers</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            {{-- Jobs --}}
                            @if (hasPermission('job_list'))
                                <li class="nav-item has-treeview" id="jobmenu">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-briefcase"></i>
                                        <p>
                                            Jobs
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('job/job_list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Manage Jobs</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            {{-- Posts --}}
                            @if (hasPermission('posts_list'))
                                <li class="nav-item has-treeview" id="postmenu">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-pen"></i>
                                        <p>
                                            Posts
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('posts/posts_list') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Manage Posts</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            {{-- Contacts --}}
                            @if (hasPermission('list_contact_query'))
                                <li class="nav-item has-treeview" id="contactmenu">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-phone"></i>
                                        <p>
                                            Contacts
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('contactus/list_contact_query') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Manage Contact Us</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            {{-- Courses --}}
                            @if (hasPermission('manage_course'))
                                <li class="nav-item has-treeview" id="coursemenu">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-graduation-cap"></i>
                                        <p>
                                            Course
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('course/manage_course') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Manage Course</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            {{-- Department --}}
                            @if (hasPermission('manage_department'))
                                <li class="nav-item has-treeview" id="departmentmenu">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-building"></i>
                                        <p>
                                            Department
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('department/manage_department') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Manage Department</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            {{-- Notice Board --}}
                            @if (hasPermission('manage_notice'))
                                <li class="nav-item has-treeview" id="noticeboardmenu">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-building"></i>
                                        <p>
                                            Notice Board
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('notice-board/manage_notice') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Manage Notice Board</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            {{-- Placement Registration --}}
                            @if (hasPermission('manage_jobfair'))
                                <li class="nav-item has-treeview" id="registermenu">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-bullhorn"></i>
                                        <p>
                                            Placement Registration
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('register/manage_jobfair') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Placement Registration</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                        </ul>





                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tree"></i>
                                <p>
                                    UI Elements
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/UI/general.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>General</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/UI/icons.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Icons</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/UI/buttons.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Buttons</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/UI/sliders.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sliders</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/UI/modals.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Modals & Alerts</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/UI/navbar.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Navbar & Tabs</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/UI/timeline.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Timeline</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/UI/ribbons.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Ribbons</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Forms
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/forms/general.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>General Elements</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/forms/advanced.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Advanced Elements</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/forms/editors.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Editors</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/forms/validation.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Validation</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Tables
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/tables/simple.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Simple Tables</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/tables/data.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>DataTables</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/tables/jsgrid.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>jsGrid</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        {{-- <li class="nav-header">EXAMPLES</li>
                        <li class="nav-item"> --}}
                        {{-- <a href="pages/calendar.html" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Calendar
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a> --}}
                        {{-- </li>
                        <li class="nav-item">
                            <a href="pages/gallery.html" class="nav-link">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    Gallery
                                </p>
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="pages/kanban.html" class="nav-link">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Kanban Board
                                </p>
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-envelope"></i>
                                <p>
                                    Mailbox
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/mailbox/mailbox.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inbox</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/mailbox/compose.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Compose</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/mailbox/read-mail.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Read</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Pages
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/examples/invoice.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Invoice</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/profile.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/e-commerce.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>E-commerce</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/projects.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Projects</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/project-add.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Project Add</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/project-edit.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Project Edit</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/project-detail.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Project Detail</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/contacts.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Contacts</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/faq.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>FAQ</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/contact-us.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Contact us</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>
                                    Extras
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Login & Register v1
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="pages/examples/login.html" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Login v1</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages/examples/register.html" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Register v1</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages/examples/forgot-password.html" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Forgot Password v1</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages/examples/recover-password.html" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Recover Password v1</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Login & Register v2
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="pages/examples/login-v2.html" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Login v2</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages/examples/register-v2.html" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Register v2</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages/examples/forgot-password-v2.html" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Forgot Password v2</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages/examples/recover-password-v2.html" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Recover Password v2</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/lockscreen.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lockscreen</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Legacy User Menu</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/language-menu.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Language Menu</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/404.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Error 404</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/500.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Error 500</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/pace.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pace</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/blank.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Blank Page</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="starter.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Starter Page</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-search"></i>
                                <p>
                                    Search
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/search/simple.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Simple Search</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/search/enhanced.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Enhanced</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        {{-- <li class="nav-header">MISCELLANEOUS</li> --}}
                        {{-- <li class="nav-item">
                            <a href="iframe.html" class="nav-link">
                                <i class="nav-icon fas fa-ellipsis-h"></i>
                                <p>Tabbed IFrame Plugin</p>
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="https://adminlte.io/docs/3.1/" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>Documentation</p>
                            </a>
                        </li> --}}
                        {{-- <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Level 1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Level 1
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Level 2</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Level 2
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Level 3</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Level 3</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Level 3</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Level 2</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Level 1</p>
                            </a>
                        </li>
                        <li class="nav-header">LABELS</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p class="text">Important</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-warning"></i>
                                <p>Warning</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-info"></i>
                                <p>Informational</p>
                            </a>
                        </li> --}}
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
        </aside>
        <script>
            document.querySelector('#pages > .nav-link').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('pages').classList.toggle('menu-open');
            });
            document.querySelector('#userMenu > .nav-link').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('userMenu').classList.toggle('menu-open');
            });
            document.querySelector('#groupMenu > .nav-link').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('groupMenu').classList.toggle('menu-open');
            });
            document.querySelector('#companymenu > .nav-link').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('companymenu').classList.toggle('menu-open');
            });
            document.querySelector('#articlemenu > .nav-link').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('articlemenu').classList.toggle('menu-open');
            });
            document.querySelector('#eventmenu > .nav-link').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('eventmenu').classList.toggle('menu-open');
            });
            document.querySelector('#rolemenu > .nav-link').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('rolemenu').classList.toggle('menu-open');
            });
            document.querySelector('#projectmenu > .nav-link').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('projectmenu').classList.toggle('menu-open');
            });
            document.querySelector('#careermenu > .nav-link').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('careermenu').classList.toggle('menu-open');
            });
            document.querySelector('#guestmenu > .nav-link').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('guestmenu').classList.toggle('menu-open');
            });
            document.querySelector('#jobmenu > .nav-link').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('jobmenu').classList.toggle('menu-open');
            });
            document.querySelector('#postmenu > .nav-link').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('postmenu').classList.toggle('menu-open');
            });
            document.querySelector('#contactmenu > .nav-link').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('contactmenu').classList.toggle('menu-open');
            });
            document.querySelector('#coursemenu > .nav-link').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('coursemenu').classList.toggle('menu-open');
            });
            document.querySelector('#departmentmenu > .nav-link').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('departmentmenu').classList.toggle('menu-open');
            });
            document.querySelector('#noticeboardmenu> .nav-link').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('noticeboardmenu').classList.toggle('menu-open');
            });
            document.querySelector('#registermenu > .nav-link').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('registermenu').classList.toggle('menu-open');
            });
        </script>
