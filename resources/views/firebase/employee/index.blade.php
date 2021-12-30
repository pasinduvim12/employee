@extends('firebase.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="col-md-12">
                @if(session('status'))
                <h4 class="alert alert-warning mb-2"> {{session('status')}}</h4>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>  
                            Employee List - Total : {{$total_emploees}}
                            <a href="{{url('add-employees')}}" class="btn btn -sm btn-primary float-end">add Employee</a>
                        </h4>

                    </div>

                    
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>System ID</th>

                                    <th>Full name</th>
                                    <th>phone number</th>
                                    <th>Employee ID</th>
                                    <th>Position</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php $i=1 @endphp

                                @forelse($employees as $key => $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item['fname']}}</td>
                                    <td>{{$item['phone']}}</td>
                                    <td>{{$item['Eid']}}</td>
                                    <td>{{$item['Position']}}</td>

                                    <td><a href="{{('edit-employee/'.$key)}}" type="button" class="btn btn-block btn-warning">Edit</a></td>
                                    <td>
                                        <a href="{{('delete-employee/'.$key)}}" type="button" class="btn btn-block btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @empty

                                <tr>
                                    <td colspan="7">No record Found </td>
                                </tr>

                                @endforelse

                            </tbody>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection