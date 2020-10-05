@extends('layouts.app')
@section('style')
    <style type="text/css">
        button.menu {
            margin-bottom: 25px;
        }
        form#riderform {
            margin-bottom: 40px;
        }
        input#checklist {
            margin-bottom: 15px;
        }
        button.btn.btn-default.save {
            color: #fff;
            background-color: #026aa7;
            border-color: #026aa7;
        }
        input#select_file {
            margin-bottom: 15px;
        }
        img.img-fluid.lazyload.product-img {
            width: 80px;
        }
    </style>
@endsection

@section('content')
    <div class="topPage">
        <div class="listWrapper">
            @foreach ($listings as $listing)
                <div class="list">
                    <div class="list_header">
                        <h2 class="list_header_title">{{ $listing->title }}</h2>
                        <div class="list_header_action">
                            <a onclick="return confirm('{{ $listing->title }} delete?')"
                                href="{{ url('/listingsdelete', $listing->id) }}"><i class="fas fa-trash"></i></a>
                            <a href="{{ url('/listingsedit', $listing->id) }}"><i class="fas fa-pen"></i></a>
                        </div>
                    </div>
                    <div class="cardWrapper">
                        @foreach ($listing->cards as $card)
                            <div class="cardDetail_link">
                                <div class="card" draggable="true">
                                    <a href="#myModal" role="button" class="cardWrappers" data-toggle="modal" cart_id="{{ $card->id }}">
                                        <h3 class="card_title">{{ $card->title }}</h3>
                                        <div class="card_detail is-exist"><i class="fas fa-bars"></i></div>
                                        <div class="card_detail is-exist left"><a class="cardDetail_link"href="listing/{{ $listing->id }}/card/{{ $card->id }}"><i class="fas fa-pen"></i></a></div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        <div class="add_Card">
                            <a class="addCard_link" href="/listing/{{ $listing->id }}/card/new"><i class="far fa-plus-square"></i>Add more cards</a>
                        </div>
                        @include('listing.model')
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script src=" http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js "></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>

    <script type="text/javascript">

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
                    url: '{{ URL::route('update/files') }}',
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
                    url:'{{ URL::Route('update/files') }}',
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
                alert(label);
                $.ajax({
                    url:'{{ URL::route('update/files') }}',
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

            $('upload_form').on('submit', function(event){
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
                        $('#message').css('display', 'block');
                        $('#message').html(data.message);
                        $('#message').addClass(data.class_name);
                        $('#uploaded_image').html(data.uploaded_image);
                        $('#id').html(data.id);
                    }
                });
            });

            $('#commentform').on('submit', function(event) {
                event.preventDefault();

                var comment = $('#checklist').val();

                $.ajax({
                    url: '{{ URL::route('update/files') }}',
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

        $(document).ready(function() {
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
                        $('#message').css('display', 'block');
                        $('#message').html(data.message);
                        $('#message').addClass(data.class_name);
                        $('#uploaded_image').html(data.uploaded_image);
                        $('#cart_id').html(data.cart_id);
                    }
                })
            });
        });
    </script>
@endsection
