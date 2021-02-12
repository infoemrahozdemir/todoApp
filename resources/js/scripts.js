<script>
$(function() {


    $( "#sortable" ).sortable({
        placeholder: "ui-sortable-placeholder",
        update: function(event, ui) {
            let order = {};
            $('.list-group-item').each(function() {
                order[ $(this).data('id') ] = $(this).index();
            });
            $.ajax({

                type: 'POST',
                url: "{{ URL::to('/')}}/task-sortable",
                data: {
                    "_token": "{{ csrf_token() }}",
                    order: order},
                success: function(data){
                    console.log(data)
                }
            });
        }
    });
});
</script>
