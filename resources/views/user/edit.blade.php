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
                            <h3 class="box-title">User Edit</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                       
                        <div class="box-body">
                            <div class="row"> 
                                <form role="form" method="POST" action="{{route('user.update')}}" enctype="multipart/form-data">
                                    <input type="hidden" name="user_id" value="{{$data->id}}">
                                    <input type="hidden" name="ds_ID[]" value="{{$data->ds_id}}">
                                    <input type="hidden" name="developer_id[]" value="{{$data->dev_id}}">
                                @csrf
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">User Type</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        value="{{$data->type}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required"> Email</label>
                                    <input type="email" name="email" 
                                    class="form-control" id="exampleInputEmail1" value="{{$data->email}}"
                                    disabled>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
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
                                @if($data->type == 'developer')
                                        <div class="form-group">
                                        <label for="exampleInputEmail1"> Expertise </label>
                                            <table id="myTable" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center"> Technology </th>
                                                        <th class="text-center"> Expertise Level </th>
                                                        <th class="text-center"> Action </th>
                                                    </tr>
                                                </thead>
                                                @php 
                                                        $array = explode(",", $data->techno_name);
                                                        $array1 = explode(",", $data->expertise_level);
                                                      
                                                 @endphp
                                                <tbody>
                                                    @foreach($array as $key => $arr)
                                                        <tr>
                                                            <td>
                                                                <select name="technology_id[]" id="mySelect{{$key}}" class="form-control" >
                                                                    <option selected disabled> Select Technology </option>  
                                                                    @foreach($techno as $technos)
                                                                        <option value="{{ $technos->id }}" @if ($technos->name == $arr) selected @endif>{{ $technos->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select name="expertise_level[]" id="mySelect1{{$key}}" class="form-control" >
                                                                    <option selected disabled> Select Expertise Level </option> 
                                                                    @foreach(["Beginner" => "Beginner", "Mid" => "Mid","Intermediate" => "Intermediate", "Advanced" => "Advanced", "Expert" => "Expert"] AS $contactWay => $contactLabel)    
                                                                        <option value="{{ $contactWay }}" {{ old("contact_way", $array1[$key]) == $contactWay ? "selected" : "" }}>{{ $contactLabel }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                @if($key == 0)
                                                                    <button type="button" name="add"  id="add" class="btn btn-success btn-sm add"> Add </button> <br> <br>
                                                                @else
                                                                    <button type="button" name="remove"  id="remove.{{$arr}}.{{$data->id}}" class="btn btn-danger btn-sm remove"> Remove </button> <br> <br>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Points</label>
                                            <input type="number" name="points" class="form-control" id="exampleInputEmail1"
                                            value="{{$data->points}}" min="0" required>
                                            @if ($errors->has('points'))
                                                <span class="text-danger">{{ $errors->first('points') }}</span>
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
    $(document).ready(function () {
    var counter = 1;
    
    $("#add").on("click", function () {
        counter++;
        
        var newRow = $("<tr>");
        var cols = "";
        cols += '<td> <select name="technology_id[]" class="form-control"  required>  <option selected disabled>Select Technology </option>  @foreach($techno as $technos)   <option value="{{$technos->id}}">{{$technos->name}}</option> @endforeach </select> </td>';
        cols += '<td> <select name="expertise_level[]" class="form-control"  required>  <option selected disabled>Select Expertise Level </option>   <option value="Beginner">Beginner</option> <option value="Mid">Mid</option> <option value="Intermediate">Intermediate</option> <option value="Advanced">Advanced</option> <option value="Expert">Expert</option>  </select> </td>';
        cols += '<td><button type="button" name="remove"  id="remove'+counter+'" class="btn btn-danger btn-sm remove"> Remove </button></td>';
        newRow.append(cols);
        
        $("#myTable").append(newRow);
    });

    
    $("#myTable").on("click", "button.remove", function (event) {
       var row = $(this).closest("tr").remove();
       var id = $(this).attr('id');
       const parts = id.split(".");
       const tech = parts[1]; 
       const userId = parts[2];
        var id = row.attr('data-id');
        $.ajax({
            url: '/remove-item/' + tech + '/' + userId,
            method: 'POST',
            data: { _token: "{{ csrf_token() }}" },
            success: function (response) {
            row.remove();
            },
            error: function (xhr, status, error) {
            console.log(error);
            }
        });
    });   
});

    </script>
@endsection
