
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
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Assign Info </h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                       
                        <div class="box-body">
                        <form role="form" method="POST" action="{{route('project.assign_store')}}" enctype="multipart/form-data">
                                          @csrf 
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Select Developer </th>
                                            <th class="text-center">Select Role </th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                     
                                     <tbody>
                                       
                                        
                                          <input type="hidden" value="{{$id}}" id="id" name="project_id">
                                          <tr>
                                            <td>
                                                <select name="developer_id[]" id="mySelect" class="form-control select2" >
                                                <option value=""> Select Developer</option>
                                                @foreach ($data as $stage)
                                                    <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                                @endforeach
                                              </select>
                                            </td>
                                            <td> 
                                                <select name="role_id[]" id="mySelect1" class="form-control" >
                                                <option value=""> Select Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                                 </select>
                                            </td>
                                            <td>
                                            <button type="button" name="add" id="add" class="btn btn-success btn-sm add">Add </button>
                                            </td>
                                            
                                            </tr>  
                                         
                                   </tbody>
                                   <tfoot>

                                   </tfoot>
                                </table>
                                <div style="text-align:right;">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                                </div>
                               
                                   </form>   
                            </div>
                            <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    
    <script type="text/javascript">
 $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

   
  })

$(document).ready(function () {
    var counter = 1;
    
    $("#add").on("click", function () {
        counter++;
        
        var newRow = $("<tr>");
        var cols = "";
        cols += '<td> <select name="developer_id[]" class="form-control"  required>  <option selected disabled>Select Developer </option>  @foreach($data as $stage)   <option value="{{$stage->id}}">{{$stage->name}}</option> @endforeach </select> </td>';
        cols += '<td> <select name="role_id[]" class="form-control"  required>  <option selected disabled>Select Role </option>  @foreach($roles as $role)   <option value="{{$role->id}}">{{$role->name}}</option> @endforeach </select> </td>';
        cols += '<td><a class="btn btn-danger btn-sm deleteRow"> Remove </a></td>';
        newRow.append(cols);
        
        $("#myTable").append(newRow);
    });

    
    $("#myTable").on("click", "a.deleteRow", function (event) {
        $(this).closest("tr").remove();
    });   
});


    </script>
@endsection

