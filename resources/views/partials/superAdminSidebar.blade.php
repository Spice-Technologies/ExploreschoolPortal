<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="{{ asset('assets/img/brand/blue.png') }}" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>     
                        <li class="nav-item nav-with-child">
                            <a class="nav-link ">
                                <i class="ni ni-align-left-2 "></i> Admin Mgt
                            </a>
                            <ul class="nav-item-child">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('student.create') }}">
                                        Add Admin
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('student.index') }}">
                                        View Admin
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item nav-with-child">
                            <a class="nav-link ">
                                <i class="ni ni-align-left-2 "></i> School Mgt
                            </a>
                            <ul class="nav-item-child">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('class.index') }}">
                                        View Schools
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('class.create') }}">
                                        Register School
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- <li class="nav-item nav-with-child">
                            <a class="nav-link ">
                                <i class="ni ni-align-left-2 "></i> Multilevel
                            </a>
                            <ul class="nav-item-child">
                                <li class="nav-item">
                                    <a class="nav-link" href="">
                                        Multilevel 1
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="">
                                        Multilevel 2
                                    </a>
                                </li>

                            </ul>
                        </li> --}}
                </ul>                   
            </div>
        </div>
    </div>
</nav>
