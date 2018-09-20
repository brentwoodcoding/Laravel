@extends('main')

@section('title', '| Show Case')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="well" style="margin-top: 30px;">
              @foreach ($clientcase->toArray() as $key => $value)
                <label name="client_name">{{ $key }}:</label> {{ $value }} <br>
              @endforeach
            </div>
        </div>
    </div>
@endsection