<div id="myModal" class="modal hide fade" id="post-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Name Trello</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="col-md-10">
                            <h5>LABEL</h5>
                            <div class="textlbel">
                            </div>
                            <div class="dates-date">
                                <h5>DUE DATE</h5>
                                <div class="date-color date">
                                </div>
                            </div>

                        <div class="description">
                            <h4>
                                <form class="theme-form" id="descriptionform" action="">
                                    <span class="name-title">Description</span>
                                    <input type="text" class="form-control description-comment" name="description" id="show"
                                        value="" placeholder="Description">
                                    <input type="submit" value="Save" name="submit" id="submit" class="btn btn-success menu" style="display: none;">
                                    <button type="button" class="menu" style="display: none;"><i class="fa fa-times"aria-hidden="true"></i></button>
                                </form>
                            </h4>
                        </div>

                        <div class="attachment">
                            <div class="images">
                                <h4>Attachment</h4>
                                <div class="center-image image">
                                </div>
                            </div>
                        </div>
                            <h4> Checklist </h4>
                            <div class="progressbar-container">
                                <div class="progressbar-bar ui-progressbar ui-widget ui-widget-content ui-corner-all" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow=""><div class="ui-progressbar-value ui-widget-header ui-corner-left" style="display: block; width:;"></div></div>
                                <span><div class="progressbar-label"></div></span>
                        </div>
                        <div class="checklist-checklist">
                            <span class="checklist check"></span>
                        </div>
                        <div class="add-checklist">
                                <form class="theme-form" id="addchecklist" action="">
                                    <input type="text"  class="demo-demo" name="checklist" id="textInput" value="" hidden/>
                                    <input type="submit" id="myButton" class="btn btn-success" name="answer" value="Add More" onclick="showInputBox()"/>
                                </form>
                        </div>
                        <h4>
                            <form class="theme-form" id="commentform" action="">
                                <span class="name-title"> Activets </span>
                                <input type="text" class="form-control description-comment" name="comment" id="comment" value="" placeholder="Write a Comment">
                                <input type="submit" value="Save" class="menu-menu btn btn-success" style="display: none;" name="submit" id="submit">
                                <button type="button" class="menu-menu" style="display: none;"><i class="fa fa-times"aria-hidden="true"></i></button>
                            </form>
                        </h4>
                    </div>

                    <p class="addtocart"> Add to Cart </p>
                    <div class="row">
                        <div class="col-md-2 ml-auto">
                            <a class="button-link js-change-card-members" data-toggle="modal" data-target="#members"><span class="icon-sm icon-member">
                                </span><span class="js-sidebar-action-text members">Members</span></a>
                            <a class="button-link js-change-card-members" data-toggle="modal" data-target="#checklist"><span class="icon-sm icon-member">
                                </span><span class="js-sidebar-action-text checklist">Checklist</span></a>
                            <a class="button-link js-change-card-members" data-toggle="modal" data-target="#attachment"><span class="icon-sm icon-member">
                                </span><span class="js-sidebar-action-text attachment">Attachment</span></a>
                            <a class="button-link js-change-card-members" data-toggle="modal" data-target="#dates"><span class="icon-sm icon-member">
                                </span><span class="js-sidebar-action-text dates">Dates</span></a>
                            <a class="button-link js-change-card-members" data-toggle="modal" data-target="#labels"><span class="icon-sm icon-member">
                            </span><span class="js-sidebar-action-text dates">Labels</span></a>
                            <a class="button-link js-change-card-members" href="#"><span class="icon-sm icon-member">
                                </span><span class="js-sidebar-action-text Carts">Carts</span></a>
                            <a class="button-link js-change-card-members" href="#"><span class="icon-sm icon-member">
                                </span><span class="js-sidebar-action-text All">All Carts</span></a>
                        </div>
                    </div>
            </div>
        </div>

    <div class="modal fade dates" id="dates" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Date</h4>
                </div>
                <div class="modal-body">
                    <form class="theme-form" id="dateform" action="">
                        <label for="start">Start date:</label>
                        <input type="date" id="start" name="start">
                        <input type="submit" class="btn btn-success" value="Save" name="submit" id="submit">
                  </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade members" id="members" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">All Members</h4>
                </div>
                <div class="modal-body">
                    <form class="theme-form" id="checklists" action="">
                        @foreach($user as $key => $value)
                        <div class="members-model">
                                {{ $value->name }} ({{ $value->email }})
                        </div>
                        @endforeach
                    </form>
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
                        <input type="submit" class="btn btn-success" value="Save" name="submit" id="submit">
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
                <form method="POST" id="upload_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>Attachment</p>
                        <input type="file" name="select_file" id="select_file" value="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-success" name="upload" id="submit" value="Upload">
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
                        <input type="submit" class="btn btn-success" value="Save" name="submit" id="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade checklist" id="deletedoc" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Attachment</h4>
                </div>
                <div class="modal-body">
                    <p> Deleting an attachment is permanent. There is no undo.</p>
                        <button type="button" class="btn btn-primary deleteRecord" data-id="130" >Delete Record</button>
                </div>
            </div>
        </div>
    </div>

