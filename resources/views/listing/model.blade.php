
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Name Trello</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="col-md-10">
                        @foreach ($files as $file)
                            @if ($file->label == '')
                            @else
                                <div class="labels-labes">
                                    <h4>label</h4>
                                    <span class="labels">{{ $file->label }} </span>
                                </div>
                            @endif
                        @endforeach
                        <h4>
                            <form class="theme-form" id="descriptionform" action="">
                                <span class="name-title">Description</span>
                                <input type="text" class="form-control description-comment" name="description" id="show"
                                    value="" placeholder="Description">
                                <input type="submit" value="Save" name="submit" id="submit" class="menu"
                                style="display: none;">
                                <button type="button" class="menu" style="display: none;"><i class="fa fa-times"
                                        aria-hidden="true"></i></button>
                            </form>
                        </h4>
                        @if(@$file->select_file == '')
                        @else
                            <h4>Attachment</h4>
                            @foreach ($files as $file)
                                @if ($file->select_file == '')
                                @else
                                    <div class="images">
                                        <div class="center-image">
                                        <img src="{{ URL::asset('/files') }}/{{ @$file->select_file }}" class="img-fluid  lazyload product-img">
                                        <a href="javascript:void(0);" class=''>Delete</a>
                                        </div>
                                    </div>

                                @endif
                            @endforeach
                        @endif
                        @if(@$file->checklist == '')
                        @else
                            <h4>Checklist</h4>
                            <div class="progressbar-container">
                                <div class="progressbar-bar ui-progressbar ui-widget ui-widget-content ui-corner-all" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow=""><div class="ui-progressbar-value ui-widget-header ui-corner-left" style="display: block; width:;"></div></div>
                                <div class="progressbar-label"></div>
                            </div>
                        @foreach ($files as $file)
                            @if ($file->checklist == '')
                            @else
                                   <div><input class="checkbox" type="checkbox" name="checkbox" id="checkbox">{{ $file->checklist }}</div>
                            @endif
                        @endforeach
                        @endif
                        <h4>
                            <form class="theme-form" id="commentform" action="">
                                <span class="name-title"> Activets </span>
                                <input type="text" class="form-control description-comment" name="comment" id="comment" placeholder="Write a Comment">
                                <input type="submit" value="Save" class="menu-menu" style="display: none;" name="submit" id="submit">
                                <button type="button" class="menu-menu" style="display: none;"><i class="fa fa-times"aria-hidden="true"></i></button>
                            </form>
                        </h4>
                    </div>

                    <div class="row">
                        <div class="col-md-2 ml-auto">
                            <p class="addtocart"> Add to Cart </p>
                            <a class="button-link js-change-card-members" data-toggle="modal" data-target="#myModal"
                                title="Members"><span class="icon-sm icon-member">
                                </span><span class="js-sidebar-action-text members">Members</span></a>
                            <a class="button-link js-change-card-members" data-toggle="modal" data-target="#checklist"
                                title="Members"><span class="icon-sm icon-member">
                                </span><span class="js-sidebar-action-text">Checklist</span></a>
                            <a class="button-link js-change-card-members" data-toggle="modal" data-target="#attachment"
                                title="Members"><span class="icon-sm icon-member">
                                </span><span class="js-sidebar-action-text">Attachment</span></a>
                            <a class="button-link js-change-card-members" href="#" title="Members"><span
                                    class="icon-sm icon-member">
                                </span><span class="js-sidebar-action-text">Dates</span></a>
                            <a class="button-link js-change-card-members" data-toggle="modal" data-target="#labels"
                                title="Members"><span class="icon-sm icon-member">
                                </span><span class="js-sidebar-action-text">Labels</span></a>
                            <a class="button-link js-change-card-members" href="#" title="Members"><span
                                    class="icon-sm icon-member">
                                </span><span class="js-sidebar-action-text">Carts</span></a>
                            <a class="button-link js-change-card-members" href="#" title="Members"><span
                                    class="icon-sm icon-member">
                                </span><span class="js-sidebar-action-text">All Carts</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="modal fade checklist" id="checklist" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Checklist</h4>
                </div>
                <div class="modal-body">
                    <form class="theme-form" id="checklistform" action="">
                        <p>Title</p>
                        <input type="text" class="form-control" name="checklist" id="check" value="">
                        <input type="submit" value="Save" name="submit" id="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="attachment" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Attachment</h4>
                </div>
                <form method="post" id="upload_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>Attachment</p>
                        <input type="file" name="select_file" id="select_file" value="">
                        <input type="hidden" id="cart_id" name="cart_id" value="">
                        @foreach ($listings as $key)
                            @foreach ($key->cards as $vau)
                                <input value="{{ $vau->id }}" type="hidden" name="cart_id">
                            @endforeach
                        @endforeach
                        <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="labels" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Labels</h4>
                </div>
                <div class="modal-body">
                    <p>Title</p>
                    <form class="theme-form" id="lablefrom" action="">
                        <input type="text" class="form-control" name="label" id="labe" value=""></br>
                        <input type="submit" value="Save" name="submit" id="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
