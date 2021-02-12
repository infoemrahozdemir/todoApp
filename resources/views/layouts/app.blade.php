<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
    {{-- Bootstrap CSS file --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <link href="{{asset('style/main.css')}}" rel="stylesheet">

</head>
<body>
<div class="container">
    <div class="links text-center">
        <a href="{{{URL::to("/")}}}\">Home</a><span> | </span>
        <a href="{{{URL::to("/")}}}\tasks">Tasks</a><span> | </span>
        <a href="{{{URL::to("/")}}}\new-task">Create a New Task</a>
        {{--<a href="\completed">Completed</a>--}}
    </div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @yield('content')
</div>

{{-- bootsrap JS, sortable JS, and jQuery --}}
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(function () {


        $("#sortable").sortable({
            placeholder: "ui-sortable-placeholder",
            update: function (event, ui) {
                let order = {};
                $('.list-group-item').each(function () {
                    order[$(this).data('id')] = $(this).index();
                });
                $.ajax({

                    type: 'POST',
                    url: "{{ URL::to('/')}}/task-sortable",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        order: order
                    }
                });
            }
        });
    });
</script>

</body>
</html>
