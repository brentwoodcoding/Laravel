@extends('main')

@section('title', '| All Client Cases')

@section('content')

  <div class="row">
    <div class="col-md-9">
      <h3>All Client Cases</h3>
    </div>

    <div class="col-md-3">
      <a href="{{ route('clientcases.create') }}" class="btn btn-md btn-primary" style="margin-top: 25px">Create New Client Case</a>
    </div>
    <div class="col-md-12">
      <hr>
    </div>
  </div> <!-- end of .row -->

  <div class="row">
    <div class="col-md-12">
      <table class="table table-striped">
        <thead>
          <th>Case #</th>
          <th>Client Name</th>
          <th>Representative Name</th>
          <th>Caller</th>
          <th style="width: 50px"></th>
          <th style="width: 50px"></th>
          <th style="width: 50px"></th>
        </thead>

        <tbody>

          @foreach ($clientcases as $clientcase)

            <tr id="{{ $clientcase->{'Case #'} }}">
              <th>{{ $clientcase->{'Case #'} }}</th>
              <td>{{ $clientcase->{'Client Name'} }}</td>
              <td>{{ $clientcase->{'Representative Name'} }}</td>
              <td id="caller_{{ $clientcase->{'Case #'} }}">{{ $clientcase->{'Caller'} }}</td>
              <td style="text-align:right">
                <a href="{{ route('clientcases.show', $clientcase->{'Case #'}) }}" class="btn btn-default btn-sm">View</a>
              </td>
              <td style="text-align:left">
                <input type="button" name="" class="btn btn-default btn-sm btn-primary" value="Edit" onclick="editCaller(this)">
              </td>
              <td style="text-align:left">
                <input type="button" name="" class="btn btn-default btn-sm btn-success" value="Save" onclick="saveCaller(this)">
              </td>
            </tr>

          @endforeach

        </tbody>
      </table>

      <div class="text-center">
        {!! $clientcases->links(); !!}
      </div>
    </div>
  </div>

@stop

@section('scripts')

  <script type="text/javascript">
    
    function editCaller(e) 
    {
      var id = $(e).closest("tr").attr('id');
      console.log(id);

      var caller_id = "caller_" + id;
      var caller_value = $("#"+caller_id).html();
      console.log(caller_id);
      console.log(caller_value);

      var input_box ='<input type="text" value="'+caller_value+'" />';
      $("#"+caller_id).html(input_box);
      // $(e).attr("disabled", true);
    }

    function saveCaller(e) 
    {
      var id = $(e).closest("tr").attr('id');
      console.log(id);

      var caller_id = "caller_" + id;
      var caller_value = $("#"+caller_id+" > input").val();
      console.log(caller_id);
      console.log(caller_value);

      $("#"+caller_id).html(caller_value);
      // $(e).attr("disabled", true);

      $.ajax({
        type: "PUT",
        url: '/clientcases/'+id,
        headers:
        {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          "Caller": caller_value,
          },
        success: function( returned_data )
        {
          console.log(returned_data);
        }
      });
    }
  </script>

@endsection