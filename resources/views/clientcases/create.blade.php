@extends('main')

@section('title', '| New Case')

@section('content')
    <div class="row">
        <h1>New Case</h1>
        <hr>
        <div class="col-md-6">
            <form action="{{ route('clientcases.store') }}" method="POST">
              {{ csrf_field() }}

              <div class="form-group">
                <label name="case_num">Case number:</label>
                <input id="case_num" name="case_num" class="form-control">
              </div>

              <div class="form-group">
                <label name="client_name">Client Name:</label>
                <input id="client_name" name="client_name" class="form-control">
              </div>

              <input type="submit" value="Submit" class="btn btn-success">
            </form>
        </div>
    </div>
@endsection