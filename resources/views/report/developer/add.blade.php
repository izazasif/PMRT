
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
                <div class="col-md-12 col-lg-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Weekly Report </h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('report.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Project Name : <span> {{ $data -> projects->name }}</span> </label>
                                    <input type="hidden" name="project_id" value="{{$data->project_id}}">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Role : <span> {{$data->roles->name}}</span> </label>
                                    <input type="hidden" name="developer_id" value="{{$data->developer_id}}">
                                  </div>
                                </div>
                              </div>
                               
                                <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">Report Date : <span> {{$data->roles->name}}</span></label>
                                    <input type="date" name="timeline" class="form-control" id="exampleInputEmail1"
                                        required>
                                    @if ($errors->has('timeline'))
                                        <span class="text-danger">{{ $errors->first('timeline') }}</span>
                                    @endif
                                </div> -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tasks Completed </label>
                                    <textarea id="example"  rows="10" name="task_completed" cols="80">
                                    </textarea>
                                    @if ($errors->has('task_completed'))
                                        <span class="text-danger">{{ $errors->first('task_completed') }}</span>
                                    @endif
                                </div>
                                
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" onclick="submitForm(this);"><i class="fa fa-save"></i> Save</button>
                                
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>
    <script>
        function submitForm(btn) {
        // disable the button
        btn.disabled = true;
        // submit the form    
        btn.form.submit();
    }
    var editor = new FroalaEditor('#example', {
        toolbarButtons: {
                moreText: {
                    buttons: ['bold', 'italic', 'underline', 'formatUL']
                },
                }
                });
    </script>
@endsection

