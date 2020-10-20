@extends('layouts.app')
@section('style')
    <style type="text/css">
        .add-list {
            padding: 20px;
        }
        button#add {
            margin-top: 12px;
            padding-left: 60px;
            padding-right: 70px;
            border-radius: 20px;
        }
        div#carddate {
            background-color: #d4d8d8;
            padding: 5px;
            width: 100px;
            text-align: center;
        }
        a.confirm-delete {
            float: right;
        }
        .check-checklist {
            margin-bottom: 6px;
        }
        .comment-comment {
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="topPage" style="background-color:{{ $lists->image }};">
        <form action="{{url('listings')}}" method="POST" class="form-horizontal">
            <input type="hidden" name="board_id" id="board_id" value="{{@$lists->id}}">
            {{csrf_field()}}
            <div class="form-group">
                <label for="listing" class="col-sm-3 control-label">List name</label>
                <div class="col-sm-6">
                    <input type="text" name="list_name" class="form-control" value="{{old('list_name')}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i>Create
                    </button>
                </div>
            </div>
        </form>
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
                                        <div class="card_detail is-exist left"><a class="cardDetail_link cardWrappers" lising_id="{{ $listing->id }}" cart_id="{{ $card->id }}"   data-toggle="modal" data-target="#CartEditModals"><i class="fas fa-pen"></i></a></div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        <div class="add_Card">
                            <a href="#CartModals" role="button" class="cardWrappers" data-toggle="modal" list_id="{{ $listing->id }}"> +Add carts </a>
                        </div>
                    </div>
                </div>
            @endforeach
            @include('listing.model')
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script src="{{ url('js/script.js') }}">
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/jquery-ui.js" type="text/javascript"></script>
    <link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript"/>


    $(".cardWrappers").click(function() {
        var cilckid = $(this).attr('cart_id');
        var id = $(this).attr('cart_id');
        var list_id = $(this).attr('lising_id');
        $("#cardid").val(id);
        $("#lisingid").val(list_id);
    });


    $('#editformcart').on('submit', function(event) {
        event.preventDefault();
        var title = $("#title").val();
        var cardid = $("#cardid").val();
        var lisingid = $("lisingid").val();

        $.ajax({
            url: "<?=url('update/listing/carts')?>",
            method: "post",
            data: {
                '_token': "{{ csrf_token() }}",
                'title': $("#title").val(),
                'cardid':$("#cardid").val(),
                'lisingid':$("#lisingid").val(),

            },
            success: function(response) {
                console.log('success');
                location.reload(true);

            }

        });
    });

    function showInputBox() {
        if (document.getElementById("textInput")) {
          document.getElementById("textInput").style.display = 'block';
          location.relorad
        } else {
            //IF INPUT BOX DOES NOT EXIST
          var inputBox = document.createElement("INPUT");
          inputBox.setAttribute("type", "text");
          inputBox.setAttribute("id", "dynamicTextInput");
          document.body.appendChild(inputBox);
          alert("No");
        }
      }

      function addPost() {
        $("#post_id").val('');
        $('#post-modal').modal('show');
      }

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

            $(".progressbar-label").text(percentage + "%");
            }
            countBoxes();
            $(":checkbox").click(countBoxes);

            $('#show').click(function() {
                $('.menu').toggle("slide");
            });

            $('#comment').click(function() {
                $('.menu-menu').toggle("slide");
            });


        $(".cardWrappers").click(function() {
            var cilckid = $(this).attr('cart_id');
            var id = $(this).attr('cart_id');
            $("#cardid").val(id);
            var list_id = $(this).attr('list_id');

            $.ajax({
                url: "{{ Route('get.model') }}",
                method: "post",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'cilckid': cilckid,

                },
                success: function(response) {
                    if(response.success) {

                        $("#show").val(response.success);
                    }
                    else
                    {
                        $("#show").val('');

                    }
                    if(response.carddate){
                        $("#carddate").text(response.carddate);
                        $("#card_date").val(response.carddate);
                    }
                    else{
                        $("#carddate").text('');
                    }
                    if(response.label)
                    {
                        $("#cardlabel").html(response.label);
                        $("#card_label").val(response.label);
                    }
                    else
                    {
                        $("#cardlabel").html('');
                    }

                }

            });

            $('#upload_form').on('submit', function(event) {
                event.preventDefault();
                alert('hii');
                var _token = $('input#_token').val();
                var select_file = $('input#select_file').val();
                alert(select_file);
                var formData = new FormData();
                formData.append("_token", _token);
                formData.append("id",id);
                formData.append("upload_form").files['0'].select_file;

                $.ajax({
                      url:"{{ route('files.upload') }}",
                      data : formData,
                      dataType:'json',
                      async:false,
                      type:'post',
                      processData: false,
                      contentType: false,
                      success:function(response){
                        console.log(response);
                      },
                    });
                 });


            $('#cartform').on('submit', function(event) {
                event.preventDefault();
                var card_title = $("#card_title").val();

                $.ajax({
                    url: "<?=url('add/listing/carts')?>",
                    method: "post",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'card_title': card_title,
                        'list_id': list_id,
                    },
                    success: function(response) {
                        console.log('success');
                        location.reload(true);
                    }

                });
            });


            $('#descriptionform').on('submit', function(event) {
                event.preventDefault();
                var show = $("#show").val();

                $.ajax({
                    url: "{{ Route('update.files') }}",
                    method: "post",
                    dataType:'json',
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

            $('#addchecklist').on('submit', function(event) {
                event.preventDefault();
                var list = $("#textInput").val();
                var title_id = $("#title_id").val();

                $.ajax({
                    url:"{{ Route('check.list') }}",
                    method: "post",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'list': list,
                        'title_id': title_id,

                    },
                    success: function(response) {
                            console.log('success');
                    }

                });
            });


            $('#checklistform').on('submit',function(event){
                event.preventDefault();
                var checklist = $('#checklist').val();

                $.ajax({
                    url:"{{ route('check.title') }}",
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
                var color = $('#grayButton').val();
                var color = $('#Buttonred').val();
                var color = $('#blueButton').val();
                var color = $('#yellowButton').val();
                var color = $('#redsButton').val();

                $.ajax({
                    url:"{{ route('label') }}",
                    method:"post",
                    data:{
                        '_token':"{{ csrf_token() }}",
                        'id':id,
                        'label':label,
                        'color':color,
                    },
                    success:function(response){
                        console.log('success');
                    }
                });
            });

                $('#dateform').on('submit',function(event){
                    event.preventDefault();
                    var start = $('#start').val();

                    $.ajax({
                        url:"{{ route('update.files') }}",
                        method:"post",
                        data:{
                            '_token': "{{ csrf_token() }}",
                            'id':id,
                            'start':start,
                        },
                        success:function(response){
                            console.log('success');
                        }
                    });
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

                    var comment = $('#comment').val();

                    $.ajax({
                        url: "{{ route('comment') }}",
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
        });
    </script>
@endsection
