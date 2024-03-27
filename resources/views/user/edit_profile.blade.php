@extends('layout.master')
<style>
    .required::after {
      content: "*";
      color: red;
      margin-left: 2px;
    }
  </style>
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
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">User Profile Update </h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                       
                        <div class="box-body">
                            <div class="row"> 
                                <form role="form" method="POST" action="{{route('user.update_profile_store')}}" enctype="multipart/form-data">
                                    <input type="hidden" name="user_id" value="{{$data->id}}">
                                @csrf
                                <div class="col-md-6">
                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required"> Name </label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                        value="{{$data->name}}" required>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Employee Id </label>
                                    <input type="text" name="employee_id" class="form-control" 
                                    id="exampleInputEmail1" value="{{$data->employee_id}}"
                                         required>
                                    @if ($errors->has('employee_id'))
                                        <span class="text-danger">{{ $errors->first('employee_id') }}</span>
                                    @endif
                                </div>
                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" id="exampleInputEmail1"
                                    value="{{$data->phone_number}}" required>
                                    @if ($errors->has('phone_number'))
                                        <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if($data->profile_picture == null)
                                <div class="form-group">
                                <label for="exampleInputEmail1">Profile Picture </label>
                                <input type="file" class="form-control" name="profile_picture"
                                    accept=".jpg, .jpeg, .png" required>
                                    @if ($errors->has('profile_picture'))
                                        <span class="text-danger">{{ $errors->first('profile_picture') }}</span>
                                    @endif
                                </div>
                                @else
                                <div class="form-group">
                                    <img src="{{ url('/') }}/app/{{ $data->profile_picture }}" alt="" style="width:100px;height:100px;">
                                    <input type="file" class="form-control" name="profile_picture"
                                    accept=".jpg, .jpeg, .png" required>
                                    @if ($errors->has('profile_picture'))
                                        <span class="text-danger">{{ $errors->first('profile_picture') }}</span>
                                    @endif
                                </div>
                                @endif
                              
                                <div class="form-group">
                                    <div class="box-footer" style="text-align: right;">
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
        </section>
        <!-- /.content -->
    </div>

    <script>
        function submitForm(btn) {
        btn.disabled = true; 
        btn.form.submit();
    }
   
    </script>
@endsection
