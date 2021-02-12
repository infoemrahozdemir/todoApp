@extends('layouts/app')

@section('title')
    Update {{$task->name}}
@endsection

@section('content')
    <h1 class="text-center my-5">UPDATE TASK</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-primary">
                <div class="card-header bg-info"></div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{{URL::to("/")}}}/tasks/{{$task->id}}/update" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Task Name" value="{{$task->name}}">
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success">Update</button>
                            <button class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
