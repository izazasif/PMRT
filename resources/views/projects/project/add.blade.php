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
                            <h3 class="box-title"> Create Project</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                       
                        <div class="box-body">
                            <div class="row"> 
                                <form role="form" method="POST" action="{{route('project.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required"> Project Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                        placeholder="Name" value="{{ old('name') }}" required>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="required">Project Stage</label>
                                    <select name="project_stage_id" class="form-control" required>
                                        <option value=""> Select Stage</option>
                                        @foreach ($data as $stage)
                                            <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('project_stage_id'))
                                        <span class="text-danger">{{ $errors->first('project_stage_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Timeline</label>
                                    <input type="date" class="form-control" name="timeline" id="exampleInputEmail1"
                                        placeholder="timeline">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Client Spoke Name</label>
                                    <input type="text" name="client_spoke_name" class="form-control" id="exampleInputEmail1"
                                        placeholder="Client Spoke Name" required>
                                    @if ($errors->has('client_spoke_name'))
                                        <span class="text-danger">{{ $errors->first('client_spoke_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Client Spoke Number </label>
                                    <input type="text" name="client_spoke_mobile" class="form-control" id="exampleInputEmail1"
                                        placeholder="Client Spoke Number" required>
                                    @if ($errors->has('client_spoke_mobile'))
                                        <span class="text-danger">{{ $errors->first('client_spoke_mobile') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Client Spoke Email</label>
                                    <input type="email" name="client_spoke_email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Client Spoke Email" required>
                                    @if ($errors->has('client_spoke_email'))
                                        <span class="text-danger">{{ $errors->first('client_spoke_email') }}</span>
                                    @endif
                                </div>
                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Miaki Spoke Name</label>
                                    <input type="text" name="miaki_spoke_name" class="form-control" id="exampleInputEmail1"
                                        placeholder="Miaki Spoke Name" required>
                                    @if ($errors->has('miaki_spoke_name'))
                                        <span class="text-danger">{{ $errors->first('miaki_spoke_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Miaki Spoke Mobile</label>
                                    <input type="text" name="miaki_spoke_mobile" class="form-control" id="exampleInputEmail1"
                                        placeholder="Miaki Spoke Mobile" required>
                                    @if ($errors->has('miaki_spoke_mobile'))
                                        <span class="text-danger">{{ $errors->first('miaki_spoke_mobile') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Miaki Spoke Email</label>
                                    <input type="email" name="miaki_spoke_email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Miaki Spoke Email" required>
                                    @if ($errors->has('miaki_spoke_email'))
                                        <span class="text-danger">{{ $errors->first('miaki_spoke_email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Customer Name</label>
                                    <input type="text" name="customer_name" class="form-control" id="exampleInputEmail1"
                                        placeholder="Customer Name" required>
                                    @if ($errors->has('customer_name'))
                                        <span class="text-danger">{{ $errors->first('customer_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                              
                                <div class="form-group">
                                    <label for="exampleInputEmail1">SRS (pdf)</label>
                                    <input type="file" class="form-control" name="srs_pdf"  accept=".pdf"
                                        required>
                                    @if ($errors->has('srs_pdf'))
                                        <span class="text-danger">{{ $errors->first('srs_pdf') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">UI/UX Link</label>
                                    <input type="text" class="form-control" name="ui_ux_link" placeholder="UI/UX link"
                                        required>
                                    @if ($errors->has('ui_ux_link'))
                                        <span class="text-danger">{{ $errors->first('ui_ux_link') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Repository Link</label>
                                    <input type="text" class="form-control" name="rep_link"
                                        placeholder="Repository Link">
                                </div>
                              
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Remarks </label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="remarks"></textarea>
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
    </script>
@endsection
