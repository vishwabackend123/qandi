
@extends('layouts.app')
@section('content')
<style>
.exam_instruction_wrapper
{
    background:#f5faf6;
    height:100vh;
    padding:20px;
}
.exam_instruction_text{
  font-size: 20px;
  font-weight: 800;
  font-stretch: normal;
  font-style: normal;
  line-height: normal;
  letter-spacing: normal;
  text-align: left;
  color: #363c4f;
  padding-top:30px;
}
.exam_inst_ul_li
{
    padding-left:30px;
}
.exam_inst_ul_li li
{
    list-style: disc;
    padding-top:10px;
}
.exam_section_right_side
{
    background:#ffffff;
}
</style>
<div class="exam_instruction_wrapper">
    <div class="row">
        <div class="col-9">
            <div>
                < Mock Test
            </div>
            <div class="exam_instruction_text">INSTRUCTIONS</div>
            <div class="exam_instruction_text_under_text">Prior to taking the test, please read through all of the instruction sections carefully.</div>
            <div>
                <div><b>1. General</b></div>
                <div class="line-692"></div>
                <ul class="exam_inst_ul_li">
                    <li>The total duration of this test is <b>180 minutes</b></li>
                    <li>This test is of <b>300 marks</b></li>
                    <li>There will be <b>90 questions</b> in the test</li>
                    <li>The following are the sections in the test:</li>
                </ul>
            </div>
            <div>
                <div><b>2. Physics</b></div>
                <div class="line-692"></div>
                <ul class="exam_inst_ul_li">
                    <li>This section contains 15 <b>questions of Single Choice.</b></li>
                    <li><b>For Single Choice question</b>, 4 mark(s) is allotted for each correct response, 1 mark(s) will be deducted for each incorrect response, and 0 mark(s) are given for partial answers</li>
                </ul>
            </div>
            <div>
                <div><b>3. Chemistry</b></div>
                <div class="line-692"></div>
                <ul class="exam_inst_ul_li">
                    <li>This section contains 15 questions of Single Choice.</li>
                    <li>For Single Choice question, 4 mark(s) is allotted for each correct response, 1 mark(s) will be deducted for each incorrect response, and 0 mark(s) are given for partial answers</b></li>
                </ul>
            </div>
            <div>
                <div><b>4. Mathematics</b></div>
                <div class="line-692"></div>
                <ul class="exam_inst_ul_li">
                    <li>This section contains 15 questions of Single Choice.</li>
                    <li>For Single Choice question, 4 mark(s) is allotted for each correct response, 1 mark(s) will be deducted for each incorrect response, and 0 mark(s) are given for partial answers</li>
                </ul>
            </div>
        </div>
        <div class="col-3">
            <div class="exam_section_right_side">
                <div>JEE Main - Full Syllabus -2021</div>
                <div class="line-692"></div>
                <div></div>
            </div>
        </div>
    </div>
</div>

@endsection