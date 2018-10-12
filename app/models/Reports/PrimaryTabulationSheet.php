<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 5/29/14
 * Time: 1:09 PM
 */

class PrimaryTabulationSheet extends TabulationSheet{

    private $data;
    protected $cellWidth;
    protected $subjectWidth;

    public function __construct($type,$size,$paper)
    {
        parent::__construct($type,$size,$paper);
        $this->subjectWidth = 38;
        $this->cellWidth = 12.66;
    }

    public function setHeaderContent($data) {
        $this->data = $data;
    }

    public function reportHeader($viewModel) {


        $session = $viewModel['session'];
        $className = $viewModel['class']->class_name;
        $sectionName = $viewModel['section']->section_name;
        $shiftName = $viewModel['shift']->shift_name;
        $systemName = Option::getData('vendor_name');

        $this->SetFont('Arial',"b",15);
        $this->Cell(320,15,$systemName,0,1,"C");
        $this->SetFontSize(10);
        $this->SetX((320-50)/1.9);
        $this->Cell(50,10,"Tabulation Sheet",1,1,"C");
        $this->Cell(10,2," ",0,1,"C");
        $this->Cell(25,10,"Session :",0,0,"R");
        $this->Cell(25,10,$session,0,0,"L");
        $this->Cell(25,10,"Class :",0,0,"R");
        $this->Cell(25,10,$className,0,0,"L");
        $this->Cell(25,10,"Group :",0,0,"R");
        $this->Cell(25,10,ucfirst($this->data['classInfo']['group_name']),0,0,"L");

        $this->Cell(25,10,"Section :",0,0,"R");
        $this->Cell(25,10,$sectionName,0,0,"L");
        $this->Cell(25,10,"Shift :",0,0,"R");
        $this->Cell(25,10,$shiftName,0,0,"L");
        $this->Cell(25,10,"Term :",0,0,"R");

        $this->Cell(25,10,"First",0,1,"L");
        $this->Cell(10,2," ",0,1,"C");
        $this->SetY(70);
        $this->Rotate(90);

        $this->Cell(20,10,"Roll No",1,0,"C");
        $this->Rotate(0);
        $this->SetXY(20,50);
        $this->Cell(30,20,"Name",1,0,"C");
        $this->Cell(12,20,"Terms",1,0,"C");
        

        foreach($viewModel['subjects'] as $subject)
        {

            $subjectNameLen = strlen($subject['subject_name']);
            $subjectName = ($subjectNameLen > 15) ? $subject['subject_initial'] : $subject['subject_name'];
            $this->Cell($this->subjectWidth,10,$subjectName,1,0,"C");

        }

        $this->Cell($this->cellWidth,10,"Total",1,0,"C");
        $this->Cell($this->cellWidth,10,"Pass/Fail",1,0,"C");
        $this->Cell($this->cellWidth,10,"In Sec",1,0,"C");
        $this->Cell($this->cellWidth,10,"In Class",1,1,"C");

        $this->setX(62);
        $this->SetFontSize(8);

        foreach($viewModel['subjects'] as $subject)
        {
            foreach($viewModel['markTypes'] as $type)
            {
                $markType = substr(str_replace(" ", "\n",$type),0,(($type == 'Practical')? 4: 3));

                $this->Cell($this->cellWidth,10,str_replace(" ", "\n",$markType),"L,T,B",0,"C");

            }
            $this->Cell($this->cellWidth,10,"Total","L,T,B",0,"C");
        }
        $this->Cell($this->cellWidth,10,"",1,0,"C");
        $this->Cell($this->cellWidth,10,"",1,0,"C");
        $this->Cell($this->cellWidth,10,"",1,0,"C");
        $this->Cell($this->cellWidth,10,"",1,1,"C");

    }


    public function subjectsMarks($viewModel)
    {

        $student = $viewModel['student'];
        $studentClassRoll = $viewModel['classRoll'];
        $termCount = count($viewModel['terms']);
        $h = 10;

        $this->SetFontSize(10);

        $this->Cell(10,($termCount*$h),"$studentClassRoll",1,0,"C");
        $this->Cell(30,($termCount*$h),str_replace(" ", "\n",$student->name),1,0,"C");

        //$subjectWidth = 38;
        foreach($viewModel['terms'] as $term)
        {
            $termSplits = explode(" ", $term);
            $termName = (!in_array(strtolower($termSplits[0]),array("first","second","annual")))? substr($termSplits[0],0,4).'.'.substr($termSplits[1],0,4).'.': $term;

            $this->setX(50);
            $this->Cell(12,$h,str_replace(" ", "\n",$termName),"B,T",0,"C");
            $this->setX(62);
            $this->SetFontSize(8);
            $marks = (!empty($viewModel['marks'][$term]))? $viewModel['marks'][$term] : '';

            foreach($viewModel['subjects'] as $subject)
            {
                $subjectName = $subject->subject_name;

                foreach($viewModel['markTypes'] as $markType)
                {
                   $type = strtolower(trim($markType));

                    $type_mark = (!empty($marks->subjects->{$subjectName}->{'types'}->$type))? $marks->subjects->{$subjectName}->{'types'}->$type : '';
                    $this->Cell($this->cellWidth,$h,$type_mark,"L,T,B",0,"C");

                }
                $subject_total = (!empty($marks->subjects->{$subjectName}->subject_total)) ? $marks->subjects->{$subjectName}->subject_total : '';
                $this->Cell($this->cellWidth,$h,$subject_total,"L,T,B",0,"C");
            }
            $totalMark = (!empty($marks->total))? $marks->total : '';
            $result = (!empty($marks))? (!empty($marks->hasFail))? 'Fail' : 'Pass' : '';

            $this->Cell($this->cellWidth,$h,$totalMark,1,0,"C");
            $this->Cell($this->cellWidth,$h,$result,1,0,"C");
            $this->Cell($this->cellWidth,$h,"",1,0,"C");
            $this->Cell($this->cellWidth,$h,"",1,1,"C");
        }

    }

} 