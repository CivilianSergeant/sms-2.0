@extends('templates.bucket.bucket')

@section('wrapper')
<section class="wrapper" xmlns="http://www.w3.org/1999/html">
{{Helpers::showMessage()}}
<div class="row">
<div class="col-sm-12">
<section class="panel">
<header class="panel-heading">
    List of Students
                           <span class="tools pull-right  col-lg-4">
                                {{ Form::open(array('url'=>'student/add','method'=>'get','class'=>'col-lg-5')) }}
                                <button class="btn btn-primary panel-btn" type="submit">
                                    <i class="fa fa-plus-circle"></i> <span>Add New</span>
                                </button>
                                {{ Form::close() }}

                                {{ Form::open(array('url'=>'student/trash','method'=>'get','class'=>'col-lg-2')) }}
                                <button class="btn btn-danger delete panel-btn" type="submit">
                                   <i class="fa fa-trash-o"></i> <span> Deleted Students</span>
                                </button>
                                {{ Form::close() }}

                             </span>
</header>
<div class="panel-body">
<div class="adv-table">
<table class="display table table-bordered table-striped" id="dynamic-table">
    <thead>
        <tr>
            <th>Sl</th>
            <th>Unique ID</th>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Father Name</th>
            <th>Mother Name</th>
            <th>Date of Birth</th>
            <th>Contact No</th>
            <th class="hidden-phone">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($students))
            @foreach($students as $index=> $student)
                <tr class="gradeX">
                    <td>{{{($index+1)}}}</td>
                    <td>{{{$student->id}}}</td>
                    <td>{{{$student->student_id}}}</td>
                    <td>{{{$student->name}}}</td>
                    <td>{{{$student->father_name}}}</td>
                    <td>{{{$student->mother_name}}}</td>
                    <td>{{{Helpers::dateTimeFormat("j F,Y",$student->dob)}}}</td>
                    <td>{{{$student->father_cell_phone or $student->mother_cell_phone}}}</td>
                    <td class="hidden-phone">
                        <?php $page = Request::get('page'); ?>
                        <a href="{{{url('student/edit/'.$student->id)}}}{{{ (!empty($page))? '?page='.(int)$page : ''}}}" class="grid-action-link"><i class="fa fa-pencil" title="Edit"></i></a>
                        <a href="{{{url('student/view/'.$student->id)}}}{{{ (!empty($page))? '?page='.(int)$page : ''}}}" class="grid-action-link"><i class="fa fa-eye" title="View Details"></i></a>
                        <a href="{{{$student->id}}}" class="grid-action-link delete-student"><i class="fa fa-trash-o" title="Delete"></i></a>
                    </td>
                </tr>
            @endforeach
        @else
                <tr class="gradeX">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="hidden-phone"></td>
                </tr>
        @endif
    </tbody>
    <tfoot>
        <tr>
            <th>Sl</th>
            <th>Unique ID</th>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Father Name</th>
            <th>Mother Name</th>
            <th>Date of Birth</th>
            <th>Contact No</th>
            <th class="hidden-phone">Action</th>
        </tr>
        <tr>
            <td colspan="9">{{$students->links()}}</td>
        </tr>
    </tfoot>
</table>
</div>
</div>
</section>
</div>
</div>
</section>
<script src="{{$theme}}js/custom/student.js"></script>
@stop