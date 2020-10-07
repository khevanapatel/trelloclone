
$(document).ready(function() {

    $(":checkbox").click(countChecked);
   // get box count
        var count = 0;
        var checked = 0;
        function countBoxes() {
        count = $("input[type='checkbox']").length;
        console.log(count);
    }

    // count checks
    function countChecked() {
    checked = $("input:checked").length;
    console.log(checked);
    var percentage = parseInt(((checked / count) * 100),10);
    console.log(percentage);
    $('.progressbar-bar').css('width', percentage+'%').attr('aria-valuenow', percentage);

    //$(".progressbar-label").text(percentage + "%");
    }
    countBoxes();
    $(":checkbox").click(countBoxes);

    $('#show').click(function() {
        $('.menu').toggle("slide");
    });

    $('#comment').click(function() {
        $('.menu-menu').toggle("slide");
    });
});

$(".cardWrappers").click(function() {
    var id = $(this).attr('cart_id');

    $('#descriptionform').on('submit', function(event) {
        event.preventDefault();
        var show = $("#show").val();

        $.ajax({
            url: "{{ URL::route('update/files') }}",
            method: "post",
            data: {
                '_token': "{{ csrf_token() }}",
                'show': show,
                'id': id,

            },
            success: function(response) {
                console.log('success');
            }

        });
    });


    $('#checklistform').on('submit',function(event){
        event.preventDefault();
        var checklist = $('#check').val();

        $.ajax({
            url:"{{ URL::Route('update/files') }}",
            method:"post",
            data:{
                '_token': "{{ csrf_token() }}",
                'id':id,
                'checklist':checklist,
            },
            success:function(response){
                console.log('success');
            }
        });
    });

    $('#lablefrom').on('submit', function(event){
        event.preventDefault();
        var label = $('#labe').val();
        $.ajax({
            url:"{{ URL::route('update/files') }}",
            method:"post",
            data:{
                '_token':"{{ csrf_token() }}",
                'id':id,
                'label':label,
            },
            success:function(response){
                console.log('success');
            }
        });
    });

    $('#upload_form').on('submit', function(event) {
        event.preventDefault();
        var formData = $('#formData').serialize();
        $.ajax({
            url: "{{ route('update/files') }}",
            method: "POST",
            data : formData, 'id':id,
            success: function(response) {
                console.log('success');
            }
        })
    });


    $('#upload_form').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: "{{ route('files/upload') }}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                $('#message').css('display', 'block');
                $('#message').html(data.message);
                $('#message').addClass(data.class_name);
                $('#uploaded_image').html(data.uploaded_image);
                $('#cart_id').html(data.cart_id);
            }
        })
    });


    $(".deleteRecord").click(function(){
        var id = $(this).data("id");
        $.ajax(
        {
            url: "delete/files/"+id,
            type: 'GET',
            data: {
                "id": id,
            },
            success: function (){
                console.log("it Works");
            }
        });

    });

        $('#commentform').on('submit', function(event) {
            event.preventDefault();

            var comment = $('#checklist').val();

            $.ajax({
                url: "{{ URL::route('update/files') }}",
                method: "post",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': id,
                    'comment' : comment,
                },
                success: function(response) {
                    console.log('success');
                }
            });
        });
    });
