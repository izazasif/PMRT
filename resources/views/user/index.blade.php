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
                <div class="col-xs-12">
                    <!-- general form elements -->
                    <div class="box">
            <div class="box-header">
              <h3 class="box-title">User List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">Name</th>
                  <th class="text-center">User Type</th>
                  <th class="text-center">Employee ID</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Phone Number</th>
                  <th class="text-center">Expertise </th>
                  <th class="text-center">Points </th>
                  <th class="text-center">Active Status </th>
                  <th>Action </th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $users)
                  <tr>
                    <td class="text-center">{{$users->name}}</td>
                    <td class="text-center">{{ucfirst($users->type)}}</td>
                    <td class="text-center">{{$users->employee_id}}</td>
                    <td class="text-center">{{$users->email}}</td>
                    <td class="text-center">{{$users->phone_number}}</td>
                    <td class="text-center">
                    @if($users->type !== 'developer')
                      N/A
                      @else
                      {!! $users->skills !!}
                    @endif  
                    </td>
                    <td class="text-center">
                      @if($users->type !== 'developer')
                      N/A
                      @else
                      {{ $users->points }}
                      @endif
                    </td>
                    <td class="text-center">
                        @if($users->status == 1)
                          <span style="color: green;">Active</span> 
                          <a class="btn btn-danger btn-sm" href="{{route('user.status',$users->id)}}">Inactive</a>
                        @else
                        <span style="color: red;">Inactive</span>
                        <a class="btn btn-success btn-sm" href="{{route('user.status',$users->id)}}">Active</a>
                        @endif
                    </td>
                    
                    <td class="text-center"><a class="btn btn-primary btn-sm" href="{{route('user.edit',$users->id)}}">Edit</a></td>
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
  //      $(function () {

  //       $('#example1').DataTable({
  //               "processing": true,
  //               "serverSide": true,
  //               "ajax": "{{ route('user.index') }}",
  //               "columns": [
  //                   { "data": "name", "searchable": true  },
  //                   { "data": "type", "searchable": true  },
  //                   { "data": "employee_id", "searchable": true  },
  //                   { "data": "email", "searchable": true  },
  //                   { "data": "phone_number", "searchable": true  },
  //                   { "data": "expertise", "searchable": true  },
  //                   { "data": "action",
  //                           name: 'action',
  //                           orderable: false,
  //                           searchable: false,
  //                           render: function (data, type, full, meta) {
  //                               return '<a href="#" class="btn btn-primary btn-sm" data-id="' + full.id + '">Edit</a>';
  //                           } 
  //                   },
  //               ]
  //           });
  // })
    </script>
@endsection
