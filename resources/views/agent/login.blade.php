@extends('layouts.support')

@section('content')
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-8">
            @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            
            <hd-agent-login></hd-agent-login>
        </div>
    </div>
@endsection