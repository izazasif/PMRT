
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
              <h3 class="box-title"> Weekly Reports </h3>
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
                  <th class="text-center">Developer Name</th>
                  <th class="text-center"> Task Completed </th>
                  <th class="text-center"> Deadline </th>
                </tr>
                </thead>
                @php 
                   
                   $count=1;
   
                @endphp
                <tbody>
                    
                  @foreach($data as $key =>$report)
                  
                      <tr>

                      <td class="text-center">{{$count++}}</td>
                    
                        

                      <td>
                       
                       {{ $key }} 
                    </td>
                       <td>
                       @foreach ($report as $project)
                       {{ $project['developer_name']}} <br>
                       @endforeach
                      </td>
                      <td> 
                      
                        <span class="border-bottom">
                        @foreach ($report as $project)
                        @php
                          $description = $project['task_completed'];
                          $search = array("Powered by");
                          $replace = array(" ");
                          $new_string = str_replace($search, $replace, $description);
                          $search1 = array("Froala Editor");
                          $replace = array(" ");
                          $new_string1 = str_replace($search1, $replace, $new_string);
                         @endphp
                         {!! $new_string1  !!}<br>
                         
                          @endforeach
                        </span>
                      </td>
                      <td> 
                      @if (count($report) > 0)
                       {{ Carbon\Carbon::parse($project['timeline'])->format('l j,M, Y') }} <br>
                        @endif
                      </td>
                    
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

