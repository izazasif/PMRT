 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
     <!-- sidebar: style can be found in sidebar.less -->
     <section class="sidebar">
         <!-- Sidebar user panel -->
         <div class="user-panel">
             <div class="pull-left image">
                 <img src="{{ url('/') }}/img/avatar5.png" class="img-circle" alt="User Image">
             </div>
             <div class="pull-left info">
                 <p>{{ session()->get('user_name') }}</p>
                 <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
             </div>
         </div>
         @php
            $currentRoute = Route::currentRouteName();
        @endphp
         <!-- /.search form -->
         <!-- sidebar menu: : style can be found in sidebar.less -->
         <ul class="sidebar-menu" data-widget="tree">`
             {{-- class="active treeview" --}}
             <li >
                 <a href="{{ route('login') }}">
                     <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                 </a>
             </li>
             @if(session()->get('type') =='leader')
                 <li class="treeview {{ $is_active == 'user_list' || $is_active == 'user_create'  ? 'active' : '' }}">
                     <a href="#">
                         <i class="fa fa-user"></i>
                         <span>User</span>
                         <span class="pull-right-container">
                             <i class="fa fa-angle-left pull-right"></i>
                         </span>
                     </a>
                     <ul class="treeview-menu">
                         <li class="{{ $is_active == 'user_list' ? 'active' : '' }}"><a
                                 href="{{route('user.index')}}"><i class="fa fa-users"></i> User List</a></li>
                         <li class="{{ $is_active == 'user_create' ? 'active' : '' }}"><a href="{{route('user.create')}}"><i class="fa fa-user-plus"></i> Create User</a>
                         </li>
                     </ul>
                 </li>
                @endif
                 <!-- <li><a href=""><i class="fa fa-table"></i> <span>Target Board </span></a>
                 </li>
           
                 <li><a href=""><i class="fa fa-bar-chart"></i> <span>KAM Performance
                         </span></a>
                 </li> -->
                 @if(session()->get('type') =='leader')
                 <li class="treeview {{ $is_active == 'project_list' || $is_active == 'create_project' ? 'active' : '' }}">
                     <a href="#">
                         <i class="fa fa-clock-o"></i>
                         <span>Project</span>
                         <span class="pull-right-container">
                             <i class="fa fa-angle-left pull-right"></i>
                         </span>
                     </a>
                     <ul class="treeview-menu">
                         <li class="{{ $is_active == 'project_list' ? 'active' : '' }}"><a href="{{ route('project.index') }}"><i class="fa fa-list"></i> Projects List</a></li>
                         <li class="{{ $is_active == 'create_project' ? 'active' : '' }}"><a href="{{ route('project.create') }}"><i class="fa fa-plus"></i> Create New Project</a></li>
                         <!-- <li class="{{ $is_active == 'create_stage' ? 'active' : '' }}"><a href="{{ route('project.stage') }}"><i class="fa fa-plus"></i> Create Stage</a></li> -->
                     </ul>
                 </li>
                 @endif
                 <li class="treeview {{ $is_active == 'assigned_list' || $is_active == 'submitted_report' || $is_active == 'report' || $is_active == 'developer_involved' || $is_active == 'developer_worked' || $is_active == 'developer_all_report' ? 'active' : '' }}">
                     <a href="#">
                         <i class="fa fa-bar-chart"></i>
                         <span>Report</span>
                         <span class="pull-right-container">
                             <i class="fa fa-angle-left pull-right"></i>
                         </span>
                     </a>
                     <ul class="treeview-menu">
                        @if(session()->get('type') =='leader')
                         <li class="{{ $is_active == 'submitted_report' ? 'active' : '' }}"><a href="{{ route('report.show') }}"><i class="fa fa-plus"></i> Submitted Reports </a></li>
                         <li class="{{ $is_active == 'report' ? 'active' : '' }}"><a href="{{ route('report.report_show') }}"><i class="fa fa-eye"></i> Reports </a></li>
                         <li class="{{ $is_active == 'developer_involved' ? 'active' : '' }}"><a href="{{ route('report.project_show') }}"><i class="fa fa-list"></i> Developer Involved </a></li>
                         <li class="{{ $is_active == 'developer_worked' ? 'active' : '' }}"><a href="{{ route('report.history') }}"><i class="fa fa-file"></i> Developer Worked </a></li>
                        @else
                         <li class="{{ $is_active == 'assigned_list' ? 'active' : '' }}"><a href="{{ route('report.index') }}"><i class="fa fa-list"></i> Assigned Projects</a></li>
                         <li class="{{ $is_active == 'developer_all_report' ? 'active' : '' }}"><a href="{{ route('report.developer_all_report') }}"><i class="fa fa-plus"></i> Previous Reports </a></li>
                         <!-- <li class="{{ $is_active == 'submitted_report' ? 'active' : '' }}"><a href="{{ route('report.show') }}"><i class="fa fa-plus"></i> Submitted Reports </a></li> -->
                         <!-- <li class="{{ $is_active == 'report' ? 'active' : '' }}"><a href="{{ route('report.report_show') }}"><i class="fa fa-eye"></i> Reports </a></li>
                         <li class="{{ $is_active == 'developer_involved' ? 'active' : '' }}"><a href="{{ route('report.project_show') }}"><i class="fa fa-list"></i> Developer Involved </a></li>
                         <li class="{{ $is_active == 'developer_worked' ? 'active' : '' }}"><a href="{{ route('report.history') }}"><i class="fa fa-file"></i> Developer Worked </a></li> -->
                        @endif 
                     </ul>
                 </li>
                
                 <li class="treeview {{ $is_active == 'pass_change' || $is_active == 'tech_set' || $is_active == 'role_set' || $is_active == 'create_stage' || $is_active == 'update_profile' ? 'active' : '' }}">
                     <a href="#">
                         <i class="fa fa-asterisk"></i>
                         <span>Settings</span>
                         <span class="pull-right-container">
                             <i class="fa fa-angle-left pull-right"></i>
                         </span>
                     </a>
                     @php 
                         $data_id = Auth::user()->id;
                     @endphp
                     <ul class="treeview-menu">
                         @if(session()->get('type') =='leader') 
                         <li class="{{ $is_active == 'create_stage' ? 'active' : '' }}"><a href="{{ route('project.stage') }}"><i class="fa fa-plus"></i> Create Stage</a></li>
                         <li class="{{ $is_active == 'tech_set' ? 'active' : '' }}" ><a href="{{ route('developer.technology') }}"><i class="fa fa-plus"></i> Create Technology </a></li>
                         <li class="{{ $is_active == 'role_set' ? 'active' : '' }}"><a href="{{ route('developer.role') }}"><i class="fa fa-plus"></i> Create Role </a></li>
                         @endif 
                         <li class="{{ $is_active == 'update_profile' ? 'active' : '' }}"><a href="{{ route('user.update_profile',$data_id) }}"><i class="fa fa-asterisk"></i> Update Profile</a></li>
                         <li class="{{ $is_active == 'pass_change' ? 'active' : '' }}"><a href="{{ route('developer.pass_change') }}"><i class="fa fa-asterisk"></i> Change Password</a></li>
                        </ul>
                 </li>
                     </ul>
                 </li>
             <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> Profile Edit</a></li>
            <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> User Allocate </a></li>
            
          </ul>
        </li>   -->
         </ul>
     </section>
     <!-- /.sidebar -->
 </aside>
