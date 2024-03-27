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
                            <h3 class="box-title">Create User</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                       
                        <div class="box-body">
                            <div class="row"> 
                                <form role="form" method="POST" action="{{route('user.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                              
                                <div class="form-group">
                                    <label class="required">User Type</label>
                                    <select name="type" class="form-control" id="user-type" required>
                                        <option value=""> Select User Type</option>
                                            <option value="developer"  >Developer</option>
                                            <option value="leader"  >Leader</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="text-danger">{{ $errors->first('type') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required"> Name </label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                        placeholder="Name" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required"> Email</label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="Email" required>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputEmail1"
                                        placeholder="Password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" > Employee ID </label>
                                    <input type="text" name="employee_id" class="form-control" id="exampleInputEmail1"
                                        placeholder="Employee ID" value="{{ old('employee_id') }}" required>
                                    @if ($errors->has('employee_id'))
                                        <span class="text-danger">{{ $errors->first('employee_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Phone Number</label>
                                    <input type="number" name="phone_number" class="form-control" id="exampleInputEmail1"
                                        placeholder="Phone Number" value="{{ old('phone_number') }}" required>
                                    @if ($errors->has('phone_number'))
                                        <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                              
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Profile Picture </label>
                                    <input type="file" class="form-control" name="profile_picture" placeholder="profile_picture"
                                    accept=".jpg, .jpeg, .png" required>
                                    @if ($errors->has('profile_picture'))
                                        <span class="text-danger">{{ $errors->first('profile_picture') }}</span>
                                    @endif
                                </div>
                                        <div class="form-group">
                                            <table id="myTable" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center"> Technology </th>
                                                        <th class="text-center"> Expertise Level </th>
                                                        <th class="text-center"> Action </th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <select name="technology_id[]" id="mySelect" class="form-control" >
                                                            <option value=""> Select Technology</option>
                                                            @foreach ($techno as $technos)
                                                                <option value="{{ $technos->id }}">{{ $technos->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        </td>
                                                        <td> 
                                                            <select name="expertise_level[]" id="mySelect1" class="form-control" >
                                                            <option value=""> Select Expertise Level</option>
                                                                <option value="Beginner">Beginner</option>
                                                                <option value="Mid">Mid</option>
                                                                <option value="Intermediate">Intermediate</option>
                                                                <option value="Advanced">Advanced</option>
                                                                <option value="Expert">Expert</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                        <button type="button" name="add" id="add" class="btn btn-success btn-sm add">Add </button>
                                                        </td>
                                                    </tr>  
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group" id="points">
                                        <label for="exampleInputEmail1">Points</label>
                                        <input type="number" class="form-control" name="points" value="10" min="0"
                                            required>
                                        @if ($errors->has('points'))
                                            <span class="text-danger">{{ $errors->first('points') }}</span>
                                        @endif
                                    </div>
                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Short Description </label>
                                    <textarea class="form-control" rows="3" placeholder="Enter Description" name="description"></textarea>
                                </div>
                              
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
        // disable the button
        btn.disabled = true;
        // submit the form    
        btn.form.submit();
    }
    // When user selects a user type
    $(document).ready(function () {
        $("#myTable").hide();
        $("#points").hide();
        $("#user-type").change(function() {
            var userType = $(this).val();
            if (userType === "developer") {
                $("#myTable").show();
                $("#points").show();
            }
            else if (userType === "leader") {
                $("#myTable").hide();
                $("#points").hide();
            }
        });
        var counter = 1;
            
            $("#add").on("click", function () {
                counter++;
                
                var newRow = $("<tr>");
                var cols = "";
                cols += '<td> <select name="technology_id[]" class="form-control"  required>  <option selected disabled>Select Technology  </option>  @foreach($techno as $technos)   <option value="{{$technos->id}}">{{$technos->name}}</option> @endforeach </select> </td>';
                cols += '<td> <select name="expertise_level[]" class="form-control"  required>  <option selected disabled>Select Expertise Level </option>   <option value="Beginner">Beginner</option> <option value="Mid">Mid</option> <option value="Intermediate">Intermediate</option> <option value="Advanced">Advanced</option><option value="Advanced">Expert</option>  </select> </td>';
                cols += '<td><a class="btn btn-danger btn-sm deleteRow"> Remove </a></td>';
                newRow.append(cols);
                
                $("#myTable").append(newRow);
            });

            
            $("#myTable").on("click", "a.deleteRow", function (event) {
                $(this).closest("tr").remove();
            });
              
    });

   
// When user selects a user type
// $('#user-type').on('change', function() {
//     var userType = $(this).val();
    
//     // Show table if user type is "developer"
//     if (userType === 'developer') {
//         $('#user_table').show();
        
//         // AJAX call to populate dynamic dropdown with data from database
//         $.ajax({
//             url: '/get-users',
//             method: 'GET',
//             dataType: 'json',
//             success: function(data) {
//                 var options = '';
//                 $.each(data, function(index, value) {
//                     options += '<option value="' + value.id + '">' + value.name + '</option>';
//                 });
//                 $('#user_table .dynamic_dropdown').html(options);
//             },
//             error: function(xhr, textStatus, errorThrown) {
//                 console.log('Error: ' + errorThrown);
//             }
//         });
//     }
//     // Hide table if user type is "leader"
//     else if (userType === 'leader') {
//         $('#user_table').hide();
//     }
// });

// // When user clicks add button
// $('#user-table').on('click', '.add_button', function() {
//     var html = '<tr><td><select class="user_type_dropdown"><option value="">--Select--</option><option value="backend">Backend</option><option value="frontend">Frontend</option></select></td><td><select class="dynamic_dropdown"><option value="">--Select--</option></select></td><td><button class="remove_button" type="button">Remove</button></td></tr>';
//     $('#user_table tbody').append(html);
    
//     // AJAX call to populate dynamic dropdown with data from database
//     $.ajax({
//         url: '/project',
//         method: 'GET',
//         dataType: 'json',
//         success: function(data) {
//             var options = '';
//             $.each(data, function(index, value) {
//                 options += '<option value="' + value.id + '">' + value.name + '</option>';
//             });
//             $('#user_table .dynamic_dropdown:last').html(options);
//         },
//         error: function(xhr, textStatus, errorThrown) {
//             console.log('Error: ' + errorThrown);
//         }
//     });
// });

// // When user clicks remove button
// $('#user_table').on('click', '.remove_button', function() {
//     $(this).closest('tr').remove();
// });
       
    </script>
@endsection
