@extends('firebase.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Edit Employee Details
                        <a href="{{url('employees')}}" class="btn btn -sm btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url('update-employee/'.$key)}}" method="POST">
                        @csrf

                        @method('PUT')
                           
                        <div class="form grroup mb-3">
                            <label> Full name </label>
                            <input type="text" name="fname" value="{{$editdata['fname']}}" class="form-control"/>
                        </div>

                        <div class="form grroup mb-3">
                            <label> phone numbere </label>
                            <input type="text" name="phone"  value="{{$editdata['phone']}}" class="form-control"/>
                        </div>

                        <div class="form grroup mb-3">
                            <label>Employee ID </label>
                            <input type="text" name="Eid"  value="{{$editdata['Eid']}}" class="form-control"/>
                        </div>

                        <div class="form grroup mb-3">
                            <label> Position </label>
                            <input  type="text" name="Position"  value="{{$editdata['Position']}}" class="form-control"/>
                        </div>

                        <div class="form grroup mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>


                        

                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection