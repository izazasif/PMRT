@extends('layout.master')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    {{ session('message') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                    @foreach ($errors->all() as $error)
                        <li><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> &nbsp;{{ $error }}
                        </li>
                    @endforeach
                </div>
            @endif
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Project Stage Info </h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                       
                        <div class="box-body">
                            <div class="row"> 
                                <form role="form" method="POST" action="{{route('project.stage_store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> Stage Name</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                            placeholder="Stage Name" required>
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <div class="box-footer" style="text-align: right;margin-top: 14px;">
                                        <button type="submit" class="btn btn-primary" onclick="submitForm(this);"><i class="fa fa-save"></i> Save</button>
                                        
                                        </div>
                                    </div>  
                                </div>
                              </form>
                            </div>
                        </div>
                            <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
              <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box">
                    <div class="box-header">
                    <h3 class="box-title">Stage List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Serial </th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Action </th>
                        </tr>
                        </thead>
                        @php 
                        $count = 1;
                        @endphp 
                        <tbody>
                            @foreach($data as $role)
                        <tr>
                        <td class="text-center">{{$count++}}</td>
                            <td class="text-center">{{$role->name}}</td>
                            <td class="text-center"><a class="btn btn-danger btn-sm" href="{{route('project.stage_delete',$role->id)}}">Delete</a></td>
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

    <script>
        function submitForm(btn) {
        // disable the button
        btn.disabled = true;
        // submit the form    
        btn.form.submit();
    }
    </script>
@endsection
