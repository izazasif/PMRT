
@extends('layout.master')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
    @if (session('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    {{ session('message') }}
                </div>
      @endif
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Assigned Project List </h3>
                                 <div class="box-tools">
                                    <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                                        <!-- <div class="input-group-btn">
                                            <a href="">
                                                <button type="button" class="btn btn-primary btn-sm pull-right">
                                                    <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Create New News Event
                                                </button>
                                            </a>
                                        </div> -->
                                    </div>
                                  </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th class="text-center">Serial No </th>
                  <th class="text-center"> Project Name </th>
                  <th class="text-center">Role</th>
                  <th class="text-center"> Submit Report </th>
                </tr>
                </thead>
                @php 
                   
                   $count=1;
   
                @endphp
                <tbody>
                  @foreach($data as $project)
                      <tr>
                        <td class="text-center">{{$count++}}</td>
                        <td class="text-center">{{ $project -> projects->name }}</td>
                        <td class="text-center">{{ $project -> roles->name }}</td>
                        @php
                        $startOfWeek = Carbon\Carbon::now()->startOfWeek();
                        $endOfWeek = Carbon\Carbon::now()->endOfWeek();
                        $id = session()->get('user_id');
                            $weekly_report_exists = App\Models\WeeklyReports::where('project_id', $project->project_id)
                            ->where('developer_id', $id)
                            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                            ->exists();
                        @endphp
                        @if(!$weekly_report_exists)
                        <td class="text-center">   <a href="{{route('report.create',$project->id)}}"><i class="fa fa-edit"></i> </a></td>
                        @else 
                        <td class="text-center">   <a href="{{ route('report.edit_dev',[$project->project_id, 'id' => $id]) }}" >Edit</a></td>
                        @endif
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div> 
@endsection

