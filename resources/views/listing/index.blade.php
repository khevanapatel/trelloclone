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
        img.image-image {
            margin-bottom: 15px;
        }
        input.form-control.list-text {
            width: 215px;
            height: 35px;
            text-align: center;
            margin-top: -25px;
        }
        .form-horizontal .form-group {
            margin-left: -57px;
        }
        span.checkmark.checkpink {
            background-color: #ff8ed4;
        }
        span.checkmark.checkff {
            background-color: #2d2727;
        }

        .color-wrapper {
            position: relative;
            width: 250px;
            margin: 20px auto;
        }

        .color-wrapper p {
            margin-bottom: 5px;
        }

        input.call-picker {
            border: 1px solid #AAA;
            color: #666;
            text-transform: uppercase;
            float: left;
            outline: none;
            padding: 5px;
            text-transform: uppercase;
            width: 85px;
        }

        .color-picker {
            width: 250px;
            background: #F3F3F3;
            height: 346px;
            padding: 22px;
            border: 5px solid #fff;
            box-shadow: 0px 0px 3px 1px #DDD;
            position: absolute;
            top: 61px;
            left: 4px;
        }

        .color-holder {
          background: #fff;
            cursor: pointer;
            border: 1px solid #AAA;
            width: 40px;
            height: 32px;
            float: left;
            margin-left: 13px;
        }

        .color-picker .color-item {
            cursor: pointer;
            width: 35px;
            height: 34px;
            list-style-type: none;
            float: left;
            margin: 2px;
            border: 1px solid #DDD;
        }

        .color-picker .color-item:hover {
            border: 1px solid #666;
            opacity: 0.8;
            -moz-opacity: 0.8;
            filter:alpha(opacity=8);
        }
        input.btn.btn-success.btn-color-cover {
            margin-top: -49px;
            margin-left: 16px;
        }
        .modal-header.cover {
            height: 100px;
        }
    </style>
@endsection

@section('content')
    <div class="topPage" style="background-color:{{ $lists->image }};">
        <div class="listWrapper">
            @foreach ($listings as $listing)
            <div class="list empty">
                <div class="list_header">
                    <h2 class="list_header_title">{{ $listing->title }}</h2>
                    <div class="list_header_action">
                        <a onclick="return confirm('{{ $listing->title }} delete?')"
                            href="{{ url('/listingsdelete', $listing->id) }}"><i class="fas fa-trash"></i></a>
                            <a href="#"  data-toggle="modal" class="cardWrappers" list_id="{{ $listing->id }}" data-target="#editlist"><i class="fas fa-pen" ></i></a>
                    </div>
                </div>
                <div class="cardWrapper">
                    @foreach ($listing->cards as $card)
                        <div class="cardDetail_link">
                            <div class="card" draggable="true">
                                <a href="#myModal" role="button" class="cardWrappers" data-toggle="modal" cart_id="{{ $card->id }}">
                                    <h3  class="card_title">{{ $card->title }}</h3>
                                    <div class="card_detail is-exist"><i class="fas fa-bars"></i></div>
                                    <div class="card_detail is-exist left"><a class="cardDetail_link cardWrappers" cart_id="{{ $card->id }}"   data-toggle="modal" data-target="#CartEditModals"><i class="fas fa-pen"></i></a></div>
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

            <form action="{{ route('listings') }}"  method="POST" class="form-horizontal">
                <input type="hidden" name="board_id" id="board_id" value="{{@$lists->id}}">
                {{csrf_field()}}
                <div class="form-group list-from">
                    <label for="listing" class="col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <input type="text" name="list_name" class="form-control list-text" placeholder="Enter List Name " value="{{old('list_name')}}">
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
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script src="{{ url('js/script.js') }}">
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/jquery-ui.js" type="text/javascript"></script>
    <link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript"/>

    var colorList = [ '000000', '993300', '333300', '003300', '003366', '000066', '333399', '333333',
                      '660000', 'FF6633', '666633', '336633', '336666', '0066FF', '666699', '666666',
                      'CC3333', 'FF9933', '99CC33', '669966', '66CCCC', '3366FF', '663366', '999999',
                      'CC66FF', 'FFCC33', 'FFFF66', '99FF66', '99CCCC', '66CCFF', '993366', 'CCCCCC',
                      'FF99CC', 'FFCC99', 'FFFF99', 'CCffCC', 'CCFFff', '99CCFF', 'CC99FF', 'FFFFFF' ];
		var picker = $('#color-picker');

		for (var i = 0; i < colorList.length; i++ ) {
			picker.append('<li class="color-item" data-hex="' + '#' + colorList[i] + '" style="background-color:' + '#' + colorList[i] + ';"></li>');
		}

		$('body').click(function () {
			picker.fadeOut();
		});

		$('.call-picker').click(function(event) {
			event.stopPropagation();
			picker.fadeIn();
			picker.children('li').hover(function() {
				var codeHex = $(this).data('hex');

				$('.color-holder').css('background-color', codeHex);
				$('#pickcolor').val(codeHex);
			});
		});



    $(document).ready(function() {
        $("#myButton").click(function() {
            alert('hiii');
          $("#textInput").show();
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

    $(".cardWrappers").click(function() {
        var cilckid = $(this).attr('cart_id');

        $.ajax({
            url: "{{ Route('get.model.checklist') }}",
            method: "post",
            data: {
                '_token': "{{ csrf_token() }}",
                'cilckid': cilckid,
            },
            success: function(response) {
                $("#divid").append(response.success);
                $("#divlist").append(response.list);
                $("#divcomment").append(response.com);
                $("#divlabel").append(response.labs);
                $("#divfile").append(response.select);
                $("#show").val(response.descr);
                $("#carddate").append(response.carddate);
                $("#cover").append(response.cover);
                $(".name").append(response.cartname);
                $("#divusername").append(response.username);
            }

        });
    });


    $(".cardWrappers").click(function() {
        var cilckid = $(this).attr('cart_id');
        var id = $(this).attr('cart_id');
        var list_id = $(this).attr('lising_id');
        $("#cardid").val(id);
        $("#lisingid").val(list_id);

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
                count = $("input[name='checkbox-checklist']").length;
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

            $('#upload_form').on('submit', function(event) {
                event.preventDefault();
                let formData = new FormData($('#upload_form')[0]);
                let file = $('input[type=file]')[0].files[0];
                formData.append('file', file)

                formData.append('id', id)
                $.ajax({
                      url:"{{ route('files.upload') }}",
                      data :formData,
                      dataType:'json',
                      async:false,
                      type:'post',
                      processData: false,
                      success:function(response){
                      contentType: false,
                        console.log(response);
                        location.reload(true);
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

            $('#Editlisting').on('submit', function(event) {
                event.preventDefault();
                var list_name = $("#list_name").val();
                $.ajax({
                    url: "{{ Route('listing.update')}}",
                    method: "post",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'list_name': list_name,
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
                        'show':show,
                        'id': id,

                    },
                    success: function(response) {
                        console.log('success');
                        location.reload(true);
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
                        location.reload(true);
                    }

                });
            });


            $('#checklistform').on('submit',function(event){
                event.preventDefault();
                var checklist = $('#checktitle').val();
                alert(checklist);
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
                        location.reload(true);
                    }
                });
            });


            $('#lablefrom').on('submit', function(event){
                event.preventDefault();
                var label = $('#labe').val();
                var color = $('.labelcolor').val();
                alert(color);
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
                        location.reload(true);
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
                            location.reload(true);
                        }
                    });
                });

                $('#coverfrom').on('submit',function(event){
                    event.preventDefault();
                    var cover = $('#pickcolor').val();
                    alert(cover);
                    $.ajax({
                        url:"{{ route('update.files') }}",
                        method:"post",
                        data:{
                            '_token': "{{ csrf_token() }}",
                            'id':id,
                            'cover':cover,
                        },
                        success:function(response){
                            alert(response);
                            console.log('success');
                            location.reload(true);
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
                        location.reload(true);
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
                            location.reload(true);
                        }
                    });
                });
            });
        });
    </script>
@endsection
