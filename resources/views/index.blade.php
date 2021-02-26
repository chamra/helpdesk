@extends('layouts.main')


@section('content')
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-10">
            <div class="card ">
                <div class="card-header ">
                    <h2>Welcome, Please fill this from to get support</h2>
                </div>
                <div class="card-body">
                    <hd-ticket-create></hd-ticket-create>
                </div>
            </div>
        </div>
    </div>
@endsection