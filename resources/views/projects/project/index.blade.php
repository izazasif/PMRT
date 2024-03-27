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
              <h3 class="box-title">Project List</h3>
            </div>
            <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th class="text-center">Name</th>
                          <th class="text-center">Project Stage </th>
                          <th class="text-center">Timeline</th>
                          <th class="text-center">Developer Assigned</th>
                          <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $project)
                          <tr>
                            <td class="text-center">{{$project->name}}</td>
                            <td class="text-center">{{$project->project_stage_name}}</td>
                            <td class="text-center">
                              @if($project->timeline != null)
                              {{ Carbon\Carbon::parse($project->timeline)->format('l j,M, Y') }}
                              @endif
                            </td>
                            <td class="text-center">{!! $project->pro_name !!}</td>
                            <td class="text-center"><a class="btn btn-success btn-sm" href="{{route('project.assign',$project->id)}}">Assign</a>
                            <a class="btn btn-warning btn-sm" href="{{route('project.edit',$project->id)}}">Edit</a>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default" data-user-id="{{ $project->id }}">View</button>
                            </td>
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
            <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Projects Information </h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-6">
                      <p>Project Name: <span id="modal-user-name"></span></p>
                      <p>Project Timeline: <span id="modal-user-timeline"></span></p>
                      <p>Client Name: <span id="modal-user-name"></span></p>
                      <p>Client Email: <span id="modal-user-email"></span></p>
                      <p>Client Phone: <span id="modal-user-phone"></span></p>
                      <p>Miaki Spoke Name: <span id="modal-user-spoke"></span></p>
                      <p>Miaki Spoke Email: <span id="modal-spoke_email"></span></p>
                      <p>Miaki Spoke Phone : <span id="modal-spoke_phone"></span></p>
                      <p>Customer Name : <span id="modal-user-cust_name"></span></p>
                      <p>Proejcts Stage: <span id="modal-user-stage"></span></p>
                      <p>SRS Link: <span id="modal-user-srs"></span></p>
                      <p>UI/UX Link: <span id="modal-user-uiux"></span></p>
                      <p>Repository Link: <span id="modal-user-rep"></span></p>
                      </div>
                      <div class="col-md-6">
                      <p>Developer Assigned : <br> <span id="modal-user-assigned"></span></p>
                      </div>
                    </div>
                
                  <!-- Add more data fields as needed -->
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                    
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </section>
        <!-- /.content -->
    </div>
    <script>
    $(document).ready(function() {
        $('#modal-default').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); 
            var userId = button.data('user-id'); 
            $.ajax({
                url: '/view/' + userId,
                type: 'GET',
                success: function(response) {
                  console.log(response)
                  var timelineDate = new Date(response.timeline);
                  var formattedTimeline = timelineDate.toLocaleDateString('en-US', {
                      weekday: 'long',
                      month: 'long',
                      year: 'numeric'
                  });
                    $('#modal-user-name').text(response.name);
                    $('#modal-user-timeline').text(formattedTimeline);
                    $('#modal-user-name').text(response.client_spoke_name);
                    $('#modal-user-email').text(response.client_spoke_email);
                    $('#modal-user-phone').text(response.client_spoke_mobile);
                    $('#modal-user-spoke').text(response.miaki_spoke_name);
                    $('#modal-spoke_email').text(response.miaki_spoke_email);
                    $('#modal-spoke_phone').text(response.miaki_spoke_mobile);
                    $('#modal-user-cust_name').text(response.customer_name);
                    $('#modal-user-stage').text(response.project_stage_name);
                    if (response.srs_pdf === "") {
                        $('#modal-user-srs').html('');
                    } else {
                        $('#modal-user-srs').html('<a href="{{ asset('/app') }}/' + response.srs_pdf + '" target="_blank">Open PDF</a>');
                    }
                    $('#modal-user-uiux').text(response.ui_ux_link);
                    $('#modal-user-rep').text(response.projects);
                    $('#modal-user-assigned').html(response.pro_name);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
@endsection
