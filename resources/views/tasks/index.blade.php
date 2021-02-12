@extends('layouts/app')

@section('title')
    Tasks Lists
@endsection

@section('content')

    <h1 class="text-center py-5">TASKS</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-primary">
                <div class="card-header bg-primary text-center">
                    Tasks List
                </div>
                <div class="card-body">
                    <ul class="list-group" id="sortable">
                        @foreach ($tasks as $task)
                            @if (!$task->completed)
                                <li class="list-group-item list-group-item-action ui-sortable-placeholder"
                                    data-id="{{ $task->id }}">
                                    {{ $task->name }}
                                    <a href="{{{URL::to("/")}}}/tasks/{{$task->id}}/delete"
                                       class="btn btn-warning btn-sm ml-2 float-right">Delete</a>

                                    <a href="{{{URL::to("/")}}}/tasks/{{$task->id}}/edit"
                                       class="btn btn-primary btn-sm float-right">Edit</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>


@endsection
