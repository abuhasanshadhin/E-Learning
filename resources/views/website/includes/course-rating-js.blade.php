<script>
    $(document).on('mouseenter', '.rating', function() {
        var index = $(this).data('index');
        var course_id = $(this).data('cid');
        remove_bg(course_id);
        for(var i=1; i <= index; i++ ) {
            $('#'+course_id+'-'+i).removeClass('text-dark');
            $('#'+course_id+'-'+i).addClass('text-warning');
        }
    });

    $(document).on('mouseleave', '.rating', function() {
        var index = $(this).data('index');
        var course_id = $(this).data('cid');
        var ratings = $(this).data('ratings');
        remove_bg(course_id);
        for(var i=1; i <= ratings; i++) {
            $('#'+course_id+'-'+i).removeClass('text-dark');
            $('#'+course_id+'-'+i).addClass('text-warning');
        }
    });

    function remove_bg(course_id) {
        for(var i=1; i <= 5; i++) {
            $('#'+course_id+'-'+i).removeClass('text-waring');
            $('#'+course_id+'-'+i).addClass('text-dark');
        }
    }
</script>