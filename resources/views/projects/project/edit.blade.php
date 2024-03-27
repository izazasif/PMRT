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
           
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Project</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                        <form role="form" method="POST" action="{{route('project.edit_store')}}" enctype="multipart/form-data">
                                          @csrf 
                            <div class="row"> 
                               <input type="hidden" name="project_id" value="{{$data->id}}">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required"> Project Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                        value="{{$data->name}}" required>
                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1" > Customer Name</label>
                                    <input type="text" name="customer_name" value="{{$data->customer_name}}" class="form-control" id="exampleInputEmail1"
                                        required>
                                    @if ($errors->has('customer_name'))
                                        <span class="text-danger">{{ $errors->first('customer_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> client spoke name</label>
                                    <input type="text" name="client_spoke_name" class="form-control" id="exampleInputEmail1"
                                        value="{{$data->client_spoke_name}}" required>
                                    @if ($errors->has('client_spoke_name'))
                                        <span class="text-danger">{{ $errors->first('client_spoke_name') }}</span>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> client spoke mobile</label>
                                    <input type="text" name="client_spoke_mobile" value="{{$data->client_spoke_mobile}}" class="form-control" id="exampleInputEmail1"
                                         required>
                                    @if ($errors->has('client_spoke_mobile'))
                                        <span class="text-danger">{{ $errors->first('client_spoke_mobile') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> client spoke email</label>
                                    <input type="text" name="client_spoke_email" class="form-control" id="exampleInputEmail1"
                                        value="{{$data->client_spoke_email}}" required>
                                    @if ($errors->has('client_spoke_email'))
                                        <span class="text-danger">{{ $errors->first('client_spoke_email') }}</span>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> miaki spoke name</label>
                                    <input type="text" name="miaki_spoke_name" value="{{$data->miaki_spoke_name}}" class="form-control" id="exampleInputEmail1"
                                        required>
                                    @if ($errors->has('miaki_spoke_name'))
                                        <span class="text-danger">{{ $errors->first('miaki_spoke_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> miaki spoke mobile</label>
                                    <input type="text" name="miaki_spoke_mobile" class="form-control" id="exampleInputEmail1"
                                        value="{{$data->miaki_spoke_mobile}}" required>
                                    @if ($errors->has('miaki_spoke_mobile'))
                                        <span class="text-danger">{{ $errors->first('miaki_spoke_mobile') }}</span>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> miaki spoke email</label>
                                    <input type="text" name="miaki_spoke_email" value="{{$data->miaki_spoke_email}}" class="form-control" id="exampleInputEmail1"
                                         required>
                                    @if ($errors->has('miaki_spoke_email'))
                                        <span class="text-danger">{{ $errors->first('miaki_spoke_email') }}</span>
                                    @endif
                                </div>
                                @if($data->srs_pdf ==null)
                                <div class="form-group">
                                    <label for="exampleInputEmail1">SRS (pdf)</label>
                                    <input type="file" class="form-control" name="srs_pdf" accept=".pdf"
                                        required>
                                    @if ($errors->has('srs_pdf'))
                                        <span class="text-danger">{{ $errors->first('srs_pdf') }}</span>
                                    @endif
                                </div>
                                @else
                                <div class="form-group">
                                    <label for="exampleInputEmail1">SRS (pdf)</label> <br>
                                    <!-- <span>{{$data->srs_pdf}} </span> -->
                                    <a href="{{ url('/app/' . $data->srs_pdf) }}" target="_blank">Open PDF</a>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Change SRS (pdf)</label>
                                    <input type="file" class="form-control" name="srs_pdf" accept=".pdf"
                                        required>
                                    @if ($errors->has('srs_pdf'))
                                        <span class="text-danger">{{ $errors->first('srs_pdf') }}</span>
                                    @endif
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Repository link</label>
                                    <input type="text" name="rep_link" class="form-control" id="exampleInputEmail1"
                                        value="{{$data->rep_link}}" required>
                                    @if ($errors->has('rep_link'))
                                        <span class="text-danger">{{ $errors->first('rep_link') }}</span>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> ui_ux_link</label>
                                    <input type="text" name="ui_ux_link" value="{{$data->ui_ux_link}}" class="form-control" id="exampleInputEmail1"
                                        required>
                                    @if ($errors->has('ui_ux_link'))
                                        <span class="text-danger">{{ $errors->first('ui_ux_link') }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            @php
                                $date = \Carbon\Carbon::parse($data->timeline);
                                $formattedDate = $date->format('Y-m-d');
                            @endphp
                            <div class="col-md-6">
                                @if($data->timeline == null)
                                <div class="form-group ">
                                            <label for="shdaterange" class="required"> Timeline </label>
                                        <input style="position: inherit;height: 32px;width: 100%;" class="form-control input-sm"
                                            type="date" name="timeline">
                                </div>

                                @else 
                                <div class="form-group ">
                                            <label for="shdaterange" class="required"> Timeline </label>
                                        <input style="position: inherit;height: 32px;width: 100%;" class="form-control input-sm"
                                            type="date" name="timeline"
                                            value="{{$formattedDate}}">
                                </div>
                                @endif
                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required"> Stage Change </label>
                                    <select name="stage_id" class="form-control" id="user-type"  required>
                                       @foreach($stage as $stages)
                                       <option value="{{ $stages->id }}" @if ($stages->name == $data->project_stage_name) selected @endif>{{ $stages->name }}</option>
                                       @endforeach    
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if($data->pro_name !== null)
                            <table id="myTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Select Developer </th>
                                            <th class="text-center">Select Role </th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                     
                                     <tbody>
                                       
                                        @php 
                                        $array = explode(",", $data->pro_name);
                                        $array1 = explode(",", $data->role_name);
                                        @endphp
                                         
                                        @foreach($array as $key => $arr)
                                            <tr>
                                                <td>
                                                    <select name="developer_id[]" id="mySelect" class="form-control" >
                                                    @foreach($dev as $dev1)
                                                    <option value="{{ $dev1->id }}" @if ($dev1->name == $arr) selected @endif disabled>{{ $dev1->name }}</option>
                                                    @endforeach  
                                                </select> <br>
                                                </td>
                                                <td> 
                                                    @php 
                                                        $pda_ind = 0;
                                                    @endphp
                                                <input type="hidden" value="{{$pda_ids[$pda_ind]['id']}}" name="project_id_{{$pda_ind}}" />
                                                @php $pda_ind++; @endphp
                                                    <select name="role_id[]" id="mySelect1" class="form-control" >
                                                    @foreach($roles as $role)
                                                    <option value="{{$role->id}}" @if ($role->name == $array1[$key]) selected @endif disabled > {{$role->name}}</option>
                                                    @endforeach 
                                                    </select> <br>   
                                                </td>
                                                <td><button id="remove.{{$arr}}.{{$data->id}}" class="btn btn-danger btn-sm remove">Remove</button></td>
                                            </tr>
                                        @endforeach 
                                   </tbody>
                                </table>
                                @endif
                                <div class="form-group">
                                    <div class="box-footer" style="text-align: right;">
                                    <a class="btn btn-primary" href="{{route('project.assign',$data->id)}}">Assign</a>
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
    $(document).ready(function () {

    $("#myTable").on("click", "button.remove", function (event) {
       var row = $(this).closest("tr").remove();
       var id = $(this).attr('id');
       const parts = id.split(".");
       const dev_name = parts[1]; 
       const userId = parts[2];
        var id = row.attr('data-id');
        $.ajax({
            url: '/remove-project/' + dev_name + '/' + userId,
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
