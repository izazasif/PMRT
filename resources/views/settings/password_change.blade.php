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
            <div class="col-sm-12 col-xs-12">
                    <form class="" method="post" action="{{route('developer.pass_store')}}">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Change Password</h3>
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
                                            
                                            <label for="exampleInputEmail1"> Old Password</label>
                                            <input type="password" name="old_password" class="form-control" id="exampleInputEmail1"
                                                 required>
                                            @if ($errors->has('old_password'))
                                                <span class="text-danger">{{ $errors->first('old_password') }}</span>
                                            @endif
                                        </div>
                                        </div>
                                        <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> New Password</label>
                                            <input type="password" name="new_password" class="form-control" id="exampleInputEmail1"
                                                 required>
                                            @if ($errors->has('new_password'))
                                                <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                            @endif
                                            
                                        </div>
                                        </div> 
                                        <!-- <div class="distable-cell search-btns" style="padding-left: 57px;margin-bottom: -30px;">
                                            <button type="submit" class="btn btn-sm btn-flat btn-primary"
                                                name="search">Search</button>
                                        </div>
                                        <div class="distable-cell search-btns">
                                            <a class="btn btn-sm btn-flat btn-warning"
                                                href="{{route('report.report_reset1')}}">Reset</a>
                                        </div> -->
                                        <div style="padding-top: 2.5%">
                                        <div class="col-md-1">
                                            <div class=" search-btns" style="padding-left: 20px;">
                                                <button type="submit" class="btn btn-sm btn-flat btn-primary"
                                                    name="search">Change</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                            </div>

                        </div>
                    </form>
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
