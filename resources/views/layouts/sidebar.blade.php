<!-- Main Sidebar Container -->
<style>
    .nav-link{
        display:flex;
        align-items:center;
    }
    
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{asset('img/logo1.png')}}" alt="Laravel" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light text-center">Project Monitoring</br>&nbsp&nbsp&nbsp&nbsp&nbsp    System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

               

               
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p class="common-font-size">
                            Dashboard
                        </p>
                    </a>
                </li>
<!-- 
                <li class="nav-item has-treeview {!! classActivePath(1,'users') !!}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-pie-chart"></i>
                        <p>
                            Report
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a> -->
                <!-- <ul class="nav nav-treeview"> -->
                     <li class="nav-item">
                        <a href="{{ route('projects') }}" class="nav-link">
                            <i class="nav-icon fa fa-table"></i>
                            <p class="common-font-size">
                                Projects
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('counts') }}" class="nav-link">
                            <i class="nav-icon fa fa-table"></i>
                            <p class="common-font-size">
                               1.1 Project Counts
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('count_cost') }}" class="nav-link">
                            <i class="nav-icon fa fa-table"></i>
                            <p class="common-font-size">
                               1.2 Project Count VS Cost
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('count_cost_amount') }}" class="nav-link">
                            <i class="nav-icon fa fa-table"></i>
                            <p  class="common-font-size">
                               1.3 Project Count vs </br>Cost vs Amount Disbursed
                            </p>
                        </a>
                    </li>

                    

                    <li class="nav-item">
                        <a href="{{ route('table') }}" class="nav-link">
                            <i class="nav-icon fa fa-table"></i>
                            <p class="common-font-size">
                           1.4 % completion vs </br>project count vs outstanding balance
                            </p>
                        </a>
                    </li>

                    <!--<li class="nav-item">-->
                    <!--    <a href="{{ route('lga_zone') }}" class="nav-link">-->
                    <!--        <i class="nav-icon fa fa-table"></i>-->
                    <!--        <p class="text-center">-->
                    <!--            Projects By </br> LGA/Senatorial Zone-->
                    <!--        </p>-->
                    <!--    </a>-->
                    <!--</li>-->

                    <li class="nav-item">
                        <a href="{{ route('lga_count') }}" class="nav-link">
                            <i class="nav-icon fa fa-table"></i>
                            <p class="text-center common-font-size">
                               1.5 LGA vs Project Count
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('zone_count') }}" class="nav-link">
                            <i class="nav-icon fa fa-table"></i>
                            <p class="text-center common-font-size">
                               1.6 Senatorial Zone </br> vs Project Count
                            </p>
                        </a>
                    </li>

                <!-- </ul> -->
           

                @if( Auth::user()->role == 'admin')
                <li class="nav-item has-treeview {!! classActivePath(1,'users') !!}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-pie-chart"></i>
                        <p class="common-font-size">
                            Admin Manage
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}"
                                class="nav-link {!! classActiveSegment(2, 'users_manage') !!}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p class="common-font-size">Users Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('MDA_manage') }}"
                                class="nav-link {!! classActiveSegment(2, 'MDA_manage') !!}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p class="common-font-size">MDA Manage</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('lga.index') }}"
                                class="nav-link {!! classActiveSegment(2, 'users_manage') !!}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p class="common-font-size">LGA Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('zone.index') }}"
                                class="nav-link {!! classActiveSegment(2, 'MDA_manage') !!}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p class="common-font-size">Senatorial Zone Manage</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>