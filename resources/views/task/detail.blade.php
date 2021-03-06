@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-lg index-tables border-0 mt-5">
            <div class="w-100 {{ $task->task_status }} rounded-top mb-2 status-height">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                      
                        <div class="card-header bg-white">
                            <div class="container">
                                <div class="row">
                           

                                

                                    <div class="col-md-12"><div class="card-title"><h3 class="text-center">{{ $task->task_title }}</h3> </div></div>
                                   

                                </div>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <div class=" p-3" >
                                
                                <div class="container">
                                    <div class="row">
                                        <div class="col-2 mb-2">
                                        <strong class="text-muted">Assigned By</strong> 
                                        </div>
                                        <div class="col-1 mb-2">
                                        :
                                        </div>
                                        <div class="col-9 mb-2">
                                        {{ $task->assignedByEmployee->emp_name.' >> '.$task->assignedByEmployee->emp_position }}
                                        </div>
                                        <div class="col-2 mb-2">
                                        <strong class="text-muted">Assigned To</strong> 
                                        </div>
                                        <div class="col-1 mb-2">
                                        :
                                        </div>
                                        <div class="col-9 mb-2">
                                        {{ $task->assignedToEmployee->emp_name.' >> '.$task->assignedToEmployee->emp_position }}
                                        </div>
                                        <div class="col-2 mb-2">
                                        <strong class="text-muted">Start Time</strong> 
                                        </div>
                                        <div class="col-1 mb-2">
                                        :
                                        </div>
                                        <div class="col-9 mb-2">
                                        {{ $task->start_time }}
                                        <p>{{ $task->started_at }}</p>
                                            
                                        </div>
                                        <div class="col-2 mb-2">
                                        <strong class="text-muted">End Time </strong> 
                                        </div>
                                        <div class="col-1 mb-2">
                                        :
                                        </div>
                                        <div class="col-9 mb-2">
                                        {{ $task->end_time }}
                                            <p>{{ $task->finish_date }}</p>
                                        </div>
                                        <div class="col-2 mb-2">
                                        <strong class="text-muted">Description </strong>
                                        </div>
                                        <div class="col-1 mb-2">
                                        :
                                        </div>
                                        <div class="col-9 mb-2">
                                            {!! $task->description !!}
                                        </div>

                                       
                                        
                                    
                                        <div class="col-12 p-4">
                                            <div class="nav nav-pills nav-justified border-2">
                                                <a class="nav-item nav-link active" data-toggle="tab" role="tab" aria-controls="nav-reference" aria-selected="true" href="#reference">{{$task->assignedByEmployee->emp_name}}'s Files</a>
                                                <a class="nav-item nav-link" data-toggle="tab" role="tab" aria-controls="nav-report" aria-selected="true" href="#report">{{$task->assignedToEmployee->emp_name}}'s Files</a>
                                            </div>
                                            <div class="tab-content">
                                                <div class="tab-pane show active task-detail-tabpane" id="reference">
                                                    <div class="row p-3">
                                                        @foreach($task->assignor_file as $src)
                                                            <div class="card mr-2" style="width:250px;">
                                                                <img src="{{ asset(\Illuminate\Support\Facades\Storage::url($src) ) }}" alt="" width="5" height="150" class="card-img-top">
                                                                <div class="card-body">
                                                                    <p class="card-text"><small><a href="{{ asset(\Illuminate\Support\Facades\Storage::url($src) ) }}" download>Download From Here</a></small></p>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <small class="text-muted">{{$task->created_at}}</small>
                                                                </div>
                                                            </div>
                                                            
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="report">
                                                    <div class="task-detail-tabpane">
                                                        @if(count($task->assignee_file)==0)
                                                            <span class="text-center d-block"><small>No files uploaded yet!</small></span>
                                                        @endif
                                                        <div class="row p-3">
                                                        @foreach($task->assignee_file as $reportsrc)
                                                        
                                                        
                                                            <div class="card mr-2" style="width:250px;">
                                                                <img src="{{ asset(\Illuminate\Support\Facades\Storage::url($reportsrc) ) }}" alt="" width="5" height="150" class="card-img-top">
                                                                <div class="card-body">
                                                                    <p class="card-text"><small><a href="{{ asset(\Illuminate\Support\Facades\Storage::url($reportsrc) ) }}" download>Download From Here</a></small></p>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <small class="text-muted">{{$task->updated_at}}</small>
                                                                </div>
                                                            </div>
                                                            
                                                        @endforeach
                                                        </div>
                                                        <hr>
                                                        <div id="assignee">
                                                            @if(auth::user()->emp_id==$task->assignee_person)
                                                                <input type="hidden" value="{{$task->status}}" class="status">
                                                                <div class="container pt-4" >
                                                                    <div class="row">
                                                                        @if($task->remark->isEmpty() != 1)
                                                                        <div class="col-2 mb-2 font-weight-bold text-muted">
                                                                        
                                                                          Remark
                                                                       
                                                                           </div>
                                                                           <div class="col-1 mb-2">
                                                                            :
                                                                        </div>
                                                                       
                                                                    
                                                                            <div class="col-9 mb-2">
                                                                                <div class="bg-light pb-3 pl-1">
                                                                                @foreach($task->remark as $remark_desc)
                                                                                {!!$remark_desc->remark_description!!}
                                                                                @endforeach
                                                                                </div> 
                                                                               
                                                                            </div>
                                                                            @endif
                                                                        <div class="col-2 mb-2">
                                                                            <label class="font-weight-bold text-muted" for="task_description">Feedback</label>
                                                                        </div>
                                                                        <div class="col-1 mb-2">
                                                                            :
                                                                        </div>
                                                                        <div class="col-9 mb-2">
                                                                            <div class="form-group">
                                                                                <textarea name="TD" class="editor_feedback" id="feedback"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    

                                                                        <div class="col-2 mb-2">
                                                                            <label class="font-weight-bold text-muted">Reported files</label>
                                                                        </div>
                                                                        <div class="col-1 mb-2">
                                                                            :
                                                                        </div>
                                                                            <input type="text" class="d-none" value="{{$task->task_id}}" id="task_hidden_id">
                                                                        <div class="col-9 mb-2 report_task_image">
                                                                            <form action="{{ route('reportTask') }}"
                                                                                class="dropzone" id="reportform" method="POST" enctype="multipart/form-data">
                                                                            
                                                                                @csrf
                                                                            </form>
                                                                        </div>

                                                                        
                                                                        
                                                                        <div class="col-12 mt-4">
                                                                            <center>
                                                                                <button class="btn btn-primary rounded shadow"  id="report_submit">Submit</button>
                                                                            </center>
                                                                        </div>
                                                                        

                                                                    </div>
                                                                </div>
                                                            @else
                                                            <div id=assignor>
                                                            <input type="hidden" value="{{$task->status}}" class="status">
                                                            <form action="{{ route('remark') }}" method="POST" id="remark_form">
                                                                @csrf
                                                                <div class="container pt-4">
                                                                    <div class="row">
                                                                        <div class="col-2 mb-2">
                                                                            <strong class="text-muted">Feedback </strong>
                                                                        </div>
                                                                        <div class="col-1 mb-2">
                                                                            :
                                                                        </div>
                                                                        <div class="col-9 mb-2">
                                                                            <div class="bg-light">{!! $task->feedback !!}</div>
                                                                        </div>
                                                                        
                                                                        <div class="col-2">
                                                                            <strong class="text-muted">Remark </strong> 
                                                                        </div>
                                                                            <div class="col-1 mb-2">
                                                                            :
                                                                            </div>
                                                                        <div class="col-9" id="remark-box">
                                                                            <div class="form-group">
                                                                                <textarea name="remark_description" class="remark" id="remark"></textarea>
                                                                            </div>
                                                                            <input type="hidden" value="{{$task->task_id}}" name="task_id">
                                                                            <!-- <input type="hidden" value="reject" name="reject"> -->
                                                                            
                                                                        </div> 
                                                                        
                                                                        <div class="col-12 mt-2 ">
                                                                            <center>
                                                                                <!-- <button class="btn btn-success rounded shadow" name="status" value="approve"type="submit" id="approve_submit">Approve</button> -->
                                                                                <button class="btn btn-success rounded shadow" type="submit" name="status" value="approve" >Approve</button>
                                                                                    
                                                                                <button class="btn btn-danger rounded shadow" type="submit" name="status" value="reject" id="reject_submit">Reject</button>
                                                                            </center>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                        </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                </div>                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <hr>
                        </div>

                        <!-- Test -->
                        <div class="modal fade" id="hod_report_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-info-circle pr-3" ></i><p class="d-inline-block" id="hot_report_title"></p></h5>

                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="form-group">
                                                                                        <label for="message-text" class="col-form-label">Report Letter:</label>
                                                                                        <textarea class="form-control" id="report_text"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="form-group">
                                                                                        <label for="message-text" class="col-form-label">Percentage:</label>
                                                                                        <input type="number" class="form-control" id="per" min="0" max="100"></input>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    <button type="button" class="btn btn-primary" id="hod_report_submit">Report</button>
                                                                                </div>

                                                                                <div class="col-sm-12 no-gutters p-5 test-toast">
                                                                                    <div id="tui-image-editor-container" class="shadow-lg rounded"></div>
                                                                                  <button class="btn btn-success" onclick="savedatatosaver()">Save</button>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2 pl-3 h4">
                                                                                                    <button type="button" class="btn btn-success btn_hot_report">Report</button>
                                                                                                </div>

                        <!-- Test End -->

                        <div class="container pb-3">
                            <div class="row">
                                
                                <div class="col-6 mb-2">
                                
                                    @if(auth::user()->emp_id==$task->assignee_person)
                                        <div class="col-lg-12 bg-white text-left"> <a href="{{ url('profile') }}" class="btn bg-orange text-white"><i class="fas fa-angle-left"></i>&emsp;Back</a></div>
                                        @else
                                        <div class="col-lg-12 bg-white text-left"> <a href="{{ route('task.index', $task) }}" class="btn bg-orange text-white"><i class="fas fa-angle-left"></i>&emsp;Back</a></div>
                                    @endif
                                </div>
                                <div class="col-6 mb-2">
                               
                                    <form action="{{ route('remark') }}" method="POST">
                                        @csrf 
                                        <input type="hidden" value="{{$task->task_id}}" name="task_id">
                                        @if($task->status == 0 && auth::user()->emp_id==$task->assignee_person)
                                                               
                                        <div class="col-lg-12 bg-white text-right"><button class="btn btn-danger rounded shadow text-right" name="status" value="start">Start</button></div>
                                        @endif
                                        @if(auth::user()->emp_id==$task->assignor_person && $task->status != 3)
                                    <div class="col-md-12 bg-white text-right"><a href="{{ route('task.edit', $task) }}" class="btn btn-outline-secondary"><i class="fas fa-edit"></i>&nbsp;&emsp;Edit Task&emsp; </a></a></div>
                                    <!-- <div class="col-md-2"> <a href="" class="btn bg-orange text-white"><i class="fas fa-edit"></i>&emsp;Start</a></div> -->
                                    @endif
                                    </form>
                                </div>
                                
                            </div>
                        </div>

                        

                                    
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        window.onload = function () {
            $(function () {

                // test
                $('.btn_hot_report').click(function(){
                   $('#hod_report_modal').modal('show');
                });

                var imageEditor;

      
            // Image editor
            imageEditor = new tui.ImageEditor('#tui-image-editor-container', {

                includeUI: {
                    loadImage: {
                        path: 'storage/profile/default.jpg',
                        name: 'SampleImage'
                    },
                    download: false,
                    theme: blackTheme, // or whiteTheme
                    initMenu: 'filter',
                    uiSize: {
                        height: '580px',
                        width: '100%'
                    },
                    menuBarPosition: 'left',
                    cssMaxWidth: 200,
                    usageStatistics: false,
                },





            }, {
                methods: {
                    selectImage: function (event) {
                        console.log('fff');
                    },
                    crop: function () {
                        console.log('ffff');
                    }

                }
            });

            window.onresize = function () {

                imageEditor.ui.resizeEditor();
            }
            imageEditor.on('mousedown', function (pos) {
                console.log('ppppp')
            });
            // imageEditor.on('applyFilter', function(pos) {
            //     console.log('ppppp')
            // });

      


       //saving function to saver

        var image;
        function savedatatosaver() {


           // let tets=imageEditor.getImageName();//test use for instance methods



           // console.log(tets);
            image=imageEditor.toDataURL();
            image = image.replace('data:image/png;base64,', '');




            // console.log(imageEditor.toDataURL())///this line is important to save image in server
            //save image to server
            // $.ajax({
            //     type: 'POST',
            //     url: 'Default.aspx/MoveImages',
            //     data: '{ "imageData" : "' + image + '" }',
            //     contentType: 'application/json; charset=utf-8',
            //     dataType: 'json',
            //     success: function (msg) {
            //     }
            // });


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                contentType: 'application/json; charset=utf-8',

                url: "/saveimagetoserver",
                data:'{ "imageData" : "' + image + '" }',
            }).done(function (data) {

                console.log("S blade: [task/create] component :[employee dropdown] from:app.js Data => Employee count" +data.success );

            }).fail(function (jqXHR, textStatcbp_listus) {
                console.log("F blade: [task/create] component :[department dropdown] from:app.js Fail =>" )
            });
        }

                // test end





           var last_status=$(".status").val();
           
            if( last_status==3){
                $("#assignee").hide();
            }
                if( last_status==0 || last_status==1){
                $("#assignor").hide();
            }
          
         //this function is for ckeditor in task detail.blade.php
        //  console.log($(".editor_feedback").length); 
        if($(".editor_feedback").length!=0){
            ClassicEditor
                    .create(document.querySelector('.editor_feedback'), {
                        toolbar: [
                            'heading',
                            'bold',
                            'italic',
                            'bulletedList',
                            'numberedList',
                            'blockQuote',
                            'undo',
                            'redo'
                        ],

                    })
                    .then(editor => {
                        editor_feedback = editor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
        }      
         

                     //this function is for ckeditor in task create.blade.php
                ClassicEditor
                    .create(document.querySelector('.remark'), {
                        toolbar: [
                            'heading',
                            'bold',
                            'italic',
                            'bulletedList',
                            'numberedList',
                            'blockQuote',
                            'undo',
                            'redo'
                        ],

                    })
                    .then(editor => {
                        remark = editor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
                    
                    // $('#approve_submit').on("click", function () {
                    //     alert("hh");

    
                    //     });
                $('#task-endtime').datetimepicker();
                $('#task-starttime').datetimepicker();
            });
        };
        
    </script>
@endpush
