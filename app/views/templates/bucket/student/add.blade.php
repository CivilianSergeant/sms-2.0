@extends('templates.bucket.bucket')

@section('wrapper')
<section class="wrapper">
    <!-- code here -->
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add New Section Information
                    <!-- <span class="tools pull-right">
                         <a class="fa fa-chevron-down" href="javascript:;"></a>
                         <a class="fa fa-cog" href="javascript:;"></a>
                         <a class="fa fa-times" href="javascript:;"></a>
                      </span>-->
                </header>
                <div class="panel-body">
                {{Form::open(array('url'=>'student/save-student','method'=>'post','enctype'=>'multipart/form-data','id'=>'studentAddForm','class'=>'cmxform form-horizontal'))}}

                        <div class="form col-lg-10">

                        <input type="hidden" name="refurl" value="{{{url('student/lists')}}}"/>
                        <div class="form-group">
                            <label for="student_id" class="control-label col-lg-3">Student Id <small>(Required)</small></label>
                            <div class="col-lg-6">
                                <input class=" form-control" id="student_id" name="student_id" type="text" value="{{{$admit_form->exam_roll}}}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="class_id" class="control-label col-lg-3">Class <small>(Required)</small></label>
                            <div class="col-lg-6">
                                <select class="form-control-select2" name="class_id" required style="width:150px !important">
                                    <option value="">Select Class</option>
                                    @if(count($classes))
                                        @foreach($classes as $class)
                                            <option value="{{{$class->class_id}}}">{{{$class->class_name}}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="class_id" class="control-label col-lg-3">Section <small>(Required)</small></label>
                            <div class="col-lg-6">
                                <select class="form-control-select2" name="section_id" required style="width:150px !important">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label col-lg-3">Student Name <small>(Required)</small></label>
                            <div class="col-lg-6">
                                <input class=" form-control" id="name" name="name" type="text" value="{{{$admit_form->name}}}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nationality" class="control-label col-lg-3">Nationality <small>(Required)</small></label>
                            <div class="col-lg-6">
                                <input class=" form-control" id="nationality" name="nationality" type="text" value="{{{$admit_form->nationality}}}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dob" class="control-label col-lg-3">Date of Birth <small>(Required)</small></label>
                            <div class="col-lg-6">
                                <input class="form-control default-date-picker" id="dob" name="dob" type="text" value="{{(!empty($admit_form->dob))? Helpers::dateTimeFormat('j F,Y',$admit_form->dob) : ''}}" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="blood_group" class="control-label col-lg-3">Blood Group <small>(Required)</small></label>
                            <div class="col-lg-6">
                                <select class="form-control-select2" id="blood_group" name="blood_group">
                                    @foreach($blood_group as $bg)
                                    @if($bg == $admit_form->blood_group)
                                    <option selected="selected" value="{{{$bg}}}">{{{$bg}}}</option>
                                    @else
                                    <option value="{{{$bg}}}">{{{$bg}}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('gender',"Gender",array('class'=>'control-label col-lg-3'))}}
                            <div class="col-lg-6">
                                <select class="form-control-select2" name="gender" style="width:150px !important;" required>
                                    @foreach($gender as $g)
                                    @if($g == $admit_form->gender)
                                    <option selected="selected" value="{{{$g}}}">{{{$g}}}</option>
                                    @else
                                    <option value="{{{$g}}}">{{{$g}}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('religion',"Religion",array('class'=>'control-label col-lg-3'))}}
                            <div class="col-lg-6">
                                <select class="form-control-select2" name="religion" style="width:150px !important;" required>
                                    @foreach($religion as $r)
                                    @if($r == $admit_form->religion)
                                    <option selected="selected" value="{{{$r}}}">{{{$r}}}</option>
                                    @else
                                    <option value="{{{$r}}}">{{{$r}}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::Label('father_name', "Father's Name", array('class'=>'control-label col-lg-3'))}}
                            <div class="col-lg-6">
                                <input class=" form-control" id="father_name" name="father_name" type="text" value="{{{$admit_form->father_name}}}" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::Label('father_profession', "Father's Profession", array('class'=>'control-label col-lg-3'))}}
                            <div class="col-lg-6">
                                <input class=" form-control" id="father_profession" name="father_profession" type="text" />
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::Label('father_cell_phone', "Father's Phone", array('class'=>'control-label col-lg-3'))}}
                            <div class="col-lg-6">
                                <input class=" form-control" id="father_cell_phone" name="father_cell_phone" type="text" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Father's Photo</label>
                            <div class="controls col-md-2">
                                <div class="fileupload-new thumbnail">
                                    <img alt="" src="{{$theme}}images/placeholder.gif"/>

                                </div>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Browse file</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="father_photo"/>
                                        </span>
                                    <span class="fileupload-preview" style="margin-left:5px;"></span>
                                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::Label('mother_name', "Mother's Name", array('class'=>'control-label col-lg-3'))}}
                            <div class="col-lg-6">
                                <input class=" form-control" id="mother_name" name="mother_name" type="text" value="{{{$admit_form->mother_name}}}" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::Label('mother_profession', "Mother's Profession", array('class'=>'control-label col-lg-3'))}}
                            <div class="col-lg-6">
                                <input class=" form-control" id="mother_profession" name="mother_profession" type="text" />
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::Label('mother_cell_phone', "Mother's Phone", array('class'=>'control-label col-lg-3'))}}
                            <div class="col-lg-6">
                                <input class=" form-control" id="mother_cell_phone" name="mother_cell_phone" type="text" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Mother's Photo</label>
                            <div class="controls col-md-2">
                                <div class="fileupload-new thumbnail">
                                    <img alt="" src="{{$theme}}images/placeholder.gif"/>

                                </div>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Browse file</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="mother_photo"/>
                                        </span>
                                    <span class="fileupload-preview" style="margin-left:5px;"></span>
                                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::Label('present_address', "Present Address", array('class'=>'control-label col-lg-3'))}}
                            <div class="col-lg-6">
                                <textarea class="form-control" name="present_address">{{{$admit_form->present_address}}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::Label('permanent_address', "Present Address", array('class'=>'control-label col-lg-3'))}}
                            <div class="col-lg-6">
                                <textarea class="form-control"  name="permanent_address"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::Label('no_of_child', "No of Child", array('class'=>'control-label col-lg-3'))}}
                            <div class="col-lg-6">
                                <input class=" form-control" id="no_of_child" name="no_of_child" type="text" />
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::Label('child_position', "Child Position", array('class'=>'control-label col-lg-3'))}}
                            <div class="col-lg-6">
                                <input class=" form-control" id="child_position" name="child_position" type="text" />
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::Label('no_of_sibling', "No of sibling", array('class'=>'control-label col-lg-3'))}}
                            <div class="col-lg-6">
                                <input class=" form-control" id="no_of_sibling" name="no_of_sibling" type="text" />
                            </div>
                        </div>

                        <hr/>
                        <h4>Additional Info</h4>
                        <div class="form-group col-lg-6">
                            <a class="btn btn-primary newAddBtn" id="addParam" href="#"><i class="fa fa-plus-circle"> Add More</i></a>
                            <table width="100%" id="paramTbl">
                                <thead>
                                <tr>
                                    <th>Field Name</th>
                                    <th>Value</th>
                                    <th><i class="fa fa-trash-o"></i></th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($options))
                                @foreach($options as $i=> $option)

                                <tr>
                                    <td><input type="text" name="key[]" class="form-control col-lg-2" value="<?php echo $option->key; ?>"/></td>
                                    <td><input class="paramVal form-control col-lg-2" type="text" name="value[]" value="<?php echo $option->value; ?>"/></td>
                                    <td><a class="delParam" href="#"><i class="fa fa-minus-circle"></i></a></td>
                                </tr>
                                @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-6">

                                <button class="btn btn-primary" type="submit">Save</button>
                                <button class="btn btn-default" type="reset">Clear</button>
                            </div>
                        </div>

                    </div>

                    <div class="form col-lg-2">
                        <div class="form-group">
                            <div class="fileupload-new thumbnail">

                                <img alt="" src="{{$theme}}images/placeholder.gif"/>


                            </div>
                            <div class="controls col-md-9">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <span class="btn btn-white btn-file">
                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Browse file</span>
                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                            <input type="file" class="default" name="student_photo" />
                                            </span>
                                    <span class="fileupload-preview" style="margin-left:5px;"></span>
                                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </section>
        </div>
    </div>
</section>
<script src="{{$theme}}js/custom/common.js"></script>
<script src="{{$theme}}js/custom/Classes.js"></script>
<script src="{{$theme}}js/custom/student.js"></script>
@stop