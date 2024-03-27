@extends('layout.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form class="" method="post" action="{{route('report.report_sort')}}">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Search</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body" style="">
                                   <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group ">
                                                <!-- <label for="shdaterange"> Date Range</label>
                                                <input style="position: inherit;" class="form-control input-sm daterangepicker"
                                                    type="text" name="shdaterange" placeholder="Choose Date Range"
                                                    value="{{ session()->has('search_date_obd') ? session()->get('search_date_obd') : '' }}"> -->
                                                    <label>Project Stage</label>
                                                    <select name="project_stage_id" class="form-control input-sm" >
                                                        <option value=""> Select Stage</option>
                                                        @foreach ($stage as $stage1)
                                                            <option value="{{ $stage1->id }}"{{ session()->get('project_stage_id') == $stage1->id ? 'selected' : '' }}>{{ $stage1->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Developer Name </label>
                                                <select class="form-control input-sm select2" name="name">
                                                <option value="">Select Name </option>
                                                @foreach ($name as $name1)
                                                            <option value="{{ $name1->id }}"{{ session()->get('name') == $name1->id ? 'selected' : '' }}>{{ $name1->name }}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>    
                                        <!-- <div class="distable-cell search-btns" style="padding-left: 57px;margin-bottom: -30px;">
                                            <button type="submit" class="btn btn-sm btn-flat btn-primary"
                                                name="search">Search</button>
                                        </div>
                                        <div class="distable-cell search-btns">
                                            <a class="btn btn-sm btn-flat btn-warning"
                                                href="{{route('report.report_reset')}}">Reset</a>
                                        </div> -->
                                    <div style="padding-top: 2.5%">
                                        <div class="col-md-1">
                                            <div class=" search-btns" style="padding-left: 20px;">
                                                <button type="submit" class="btn btn-sm btn-flat btn-primary"
                                                    name="search">Search</button>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class=" search-btns">
                                                <a class="btn btn-sm btn-flat btn-warning"
                                                    href="{{ route('report.report_reset') }}">Reset</a>
                                            </div>
                                        </div>
                                      </div>
                                </div>
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> Developers Involved in Projects  </h3>
                        </div>

                        @if (session('message'))
                            <div class="alert alert-success text-center">
                                <ul style="list-style-type: none">
                                    <li>
                                        <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ session('message') }}
                                    </li>
                                </ul>
                            </div>
                        @endif

                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered table-hover" style="margin-top:20px; margin-bottom:30px">
                                <tr>
                                   
                                    <th class="text-center">Developer Name</th>
                                    <th class="text-center">Project Name </th>
                                    <th class="text-center"> Stage </th>
                                </tr>
                                
                              
                                <tbody>
                    
                    @foreach($data as $item)
                    
                        <tr>
                        <td class="text-center">{{ $item['developer_name'] }}</td>
                        <td class="text-center">{!! $item['projects_name']  !!}</td>
                        <td class="text-center">{!! $item['projects_stage_name'] !!}</td>
                    </tr>
                    @endforeach
                  </tbody>
                               
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
<!-- Select2 -->

<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

   
  })
</script>
@endsection
