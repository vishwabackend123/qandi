
@extends('layouts.app')
@section('content')
<style>
.exam_instruction_wrapper
{
    background:#f5faf6;
    padding:35px;
    min-height:100%
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
  padding-bottom:5px;
}
.exam_inst_ul_li
{
    padding-left:50px;
    font-size: 16px;
  font-weight: 500;
  line-height: 1.3;
  letter-spacing: normal;
  color: #363c4f;
}
.exam_inst_ul_li li
{
    list-style: disc;
    padding-top:10px;
}
.exam_section_right_side
{
    background:#ffffff;
    border-radius:20px;
    padding-bottom:18px
}
.exam_instruction_scrolling
{
    height:440px;
    overflow-y:auto;
    padding-right:150px;
}
.exam_instruction_scrolling::-webkit-scrollbar {
  width: 5px;
  height: 5px;
}
.exam_instruction_scrolling::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px #e5eaee;
  -webkit-border-radius: 10px;
  border-radius: 10px;
}
.exam_instruction_scrolling::-webkit-scrollbar-thumb {
  -webkit-border-radius: 10px;
  border-radius: 10px;
  background: rgba(255, 255, 255, 0.3);
  -webkit-box-shadow: inset 0 0 6px #cccccc;
}
.exam_inst_right_contant_green
{
    margin-left:10px;
    width: 94%;
  height: 229px;
  flex-grow: 0;
  border-radius: 8px;
  background-color: #56b663;
}
.mock_inst_text_mock_test a
{
    font-size: 16px;
  font-weight: 800;
  line-height: 1.6;
  color: #56b663;
}
.exam_instruction_text_under_text
{
    font-size: 14px;
  font-weight: 500;
  line-height: normal;
  color: #363c4f;
}
.exam_inst_sec_head
{
    font-size: 16px;
  font-weight: bold;
  line-height: 1.3;
  text-align: left;
  color: #363c4f;
  padding-top:20px;
}
.line-693 {
    height: 1px;
    align-self: stretch;
    flex-grow: 0;
    margin-top: 10px;
    background-color: rgba(3, 152, 85, 0.2);
    margin-left:20px;
}
.exam_section_right_side_jee_main
{
    font-size: 20px;
  font-weight: 800;
  letter-spacing: normal;
  text-align: left;
  color: #363c4f;
}
.exam_section_right_side_padding
{
    padding:20px;
}
.exam_instruction_col_four
{
    padding-left:85px;
}
.exam_inst_col_four_text_contant
{
    margin-top:20px;
}
.exam_inst_col_four_text_contant1
{
    font-size: 14px;
  font-weight: 500;
  line-height: 1.3;
  text-align: left;
  color: #363c4f;
}
.exam_inst_col_four_text_contant2
{
    font-size: 16px;
  font-weight: 800;
  line-height: 1.3;
  letter-spacing: normal;
  color: #363c4f;
  padding-top:5px;
}
.exam_inst_sec_head_flex
{
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.exam_inst_sec_head_padding
{
    padding-top:20px;
    font-size: 16px;
  line-height: 1.3;
  letter-spacing: normal;
  color: #363c4f;
}
@media(max-width:767px){
    .exam_instruction_scrolling
    {
        padding-right:unset;
        height:unset;
    }
    .exam_instruction_col_four {
        padding-left: 18px;
        padding-top:30px;
    }
}
.exam_inst_svg_right_green
{
    margin-top:10px;
}
.exam_inst_all_the_best
{
    font-size: 20px;
  font-weight: 800;
  line-height: 1.3;
  letter-spacing: normal;
  color: #ffffff;
  padding-top:10px;
}
.exam_inst_take_test_btn
{
    width: 150px;
  height: 40.5px;
  flex-grow: 0;
  display: inline-flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  padding: 12px 18px;
  border-radius: 8px;
  background-color: #ffffff;
  border:none;
  margin-top:15px;
  font-size: 14px;
  font-weight: 800;
  line-height: 1.6;
  letter-spacing: normal;
  color: #56b663;
  }
.exam_instruct_section_subject
{
    padding-left:20px;
    padding-top:10px;
}
.exam_instr_li_one_disk_none
{
    list-style: none!important;
}
</style>
<div class="exam_instruction_wrapper">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 exam_instruction_col_eight">
            <div class="mock_inst_text_mock_test">
                <a href=""><b><</b> Mock Test</a>
            </div>
            <div class="exam_instruction_text">INSTRUCTIONS</div>
            <div class="exam_instruction_text_under_text">Prior to taking the test, please read through all of the instruction sections carefully.</div>
            <div class="exam_instruction_scrolling">    
                <div>
                    <div class="exam_inst_sec_head"><b>1. General</b></div>
                    <div class="line-693"></div>
                    <ul class="exam_inst_ul_li">
                        <li>The total duration of this test is <b>180 minutes</b></li>
                        <li>This test is of <b>300 marks</b></li>
                        <li>There will be <b>90 questions</b> in the test</li>
                        <li class="exam_instr_li_one_disk_none">The following are the sections in the test:</li>
                    </ul>
                </div>
                <div>
                    <div class="exam_inst_sec_head_flex">
                        <div class="exam_inst_sec_head"><b>2. Physics</b></div>
                        <div class="exam_inst_sec_head_padding">
                            <span>Total Marks:</span>
                            <span><b>100</b></span>
                        </div>
                    </div>
                    <div class="line-693"></div>
                    <div class="exam_instruct_section_subject"><b>Section A</b></div>
                    <ul class="exam_inst_ul_li">
                        <li>This section contains 15 <b>questions of Single Choice.</b></li>
                        <li><b>For Single Choice question</b>, 4 mark(s) is allotted for each correct response, 1 mark(s) will be deducted for each incorrect response, and 0 mark(s) are given for partial answers</li>
                    </ul>
                    <div class="exam_instruct_section_subject"><b>Section B</b></div>
                    <ul class="exam_inst_ul_li">
                        <li>This section contains 15 <b>questions of Numerical Choice.</b></li>
                        <li>Out of 15 questions only <b>10 questions</b> need to be attempted</li>
                        <li>For Single Choice question, 4 mark(s) is allotted for each correct <br>response, 1 mark(s) will be deducted for each incorrect response</li>
                    </ul>
                </div>
                <div>
                    <div class="exam_inst_sec_head_flex">
                        <div class="exam_inst_sec_head"><b>3. Chemistry</b></div>
                        <div class="exam_inst_sec_head_padding">
                            <span>Total Marks:</span>
                            <span><b>100</b></span>
                        </div>
                    </div>
                    <div class="line-693"></div>
                    <div class="exam_instruct_section_subject"><b>Section A</b></div>
                    <ul class="exam_inst_ul_li">
                        <li>This section contains 15 <b>questions of Single Choice.</b></li>
                        <li><b>For Single Choice question</b>, 4 mark(s) is allotted for each correct response, 1 mark(s) will be deducted for each incorrect response, and 0 mark(s) are given for partial answers</li>
                    </ul>
                    <div class="exam_instruct_section_subject"><b>Section B</b></div>
                    <ul class="exam_inst_ul_li">
                        <li>This section contains 15 <b>questions of Numerical Choice.</b></li>
                        <li>Out of 15 questions only <b>10 questions</b> need to be attempted</li>
                        <li>For Single Choice question, 4 mark(s) is allotted for each correct <br>response, 1 mark(s) will be deducted for each incorrect response</li>
                    </ul>
                </div>
                <div>
                    <div class="exam_inst_sec_head_flex">
                        <div class="exam_inst_sec_head"><b>4. Mathematics</b></div>
                        <div class="exam_inst_sec_head_padding">
                            <span>Total Marks:</span>
                            <span><b>100</b></span>
                        </div>
                    </div>
                    <div class="line-693"></div>
                    <div class="exam_instruct_section_subject"><b>Section A</b></div>
                    <ul class="exam_inst_ul_li">
                        <li>This section contains 15 <b>questions of Single Choice.</b></li>
                        <li><b>For Single Choice question</b>, 4 mark(s) is allotted for each correct response, 1 mark(s) will be deducted for each incorrect response, and 0 mark(s) are given for partial answers</li>
                    </ul>
                    <div class="exam_instruct_section_subject"><b>Section B</b></div>
                    <ul class="exam_inst_ul_li">
                        <li>This section contains 15 <b>questions of Numerical Choice.</b></li>
                        <li>Out of 15 questions only <b>10 questions</b> need to be attempted</li>
                        <li>For Single Choice question, 4 mark(s) is allotted for each correct <br>response, 1 mark(s) will be deducted for each incorrect response</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 exam_instruction_col_four">
            <div class="exam_section_right_side">
                <div class="exam_section_right_side_padding">
                    <div class="exam_section_right_side_jee_main">JEE Main - Full Syllabus -2021</div>
                    <div class="line-692"></div>
                    <div class="exam_inst_col_four_text_contant">    
                        <div class="exam_inst_col_four_text_contant1">Duration</div>
                        <div class="exam_inst_col_four_text_contant2">180 Mins</div>
                    </div>
                    <div class="exam_inst_col_four_text_contant">    
                        <div class="exam_inst_col_four_text_contant1">No. Of Questions</div>
                        <div class="exam_inst_col_four_text_contant2">90 MCQ Questions</div>
                    </div>
                    <div class="exam_inst_col_four_text_contant">    
                        <div class="exam_inst_col_four_text_contant1">Subject</div>
                        <div class="exam_inst_col_four_text_contant2">Physics, Chemistry<br>& Mathematics</div>
                    </div>
                </div>
                <div class="exam_inst_right_contant_green text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="104" height="104" viewBox="0 0 104 104" fill="none" class="exam_inst_svg_right_green">
                    <mask id="stq5c63rya" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="104" height="104">
                        <path d="M0 0h104v96.18a7.82 7.82 0 0 1-7.82 7.82H0V0z" fill="#D9D9D9"/>
                    </mask>
                    <g mask="url(#stq5c63rya)">
                        <rect x="14.075" y="28.538" width="61.774" height="78.977" rx="1.564" transform="rotate(-12.796 14.075 28.538)" fill="#D4ECD8"/>
                        <rect x="22.054" y="20.718" width="61.774" height="78.977" rx="1.564" fill="#EDFFEF"/>
                        <rect x="26.746" y="54.343" width="7.82" height="7.82" rx="2.444" fill="#56B663"/>
                        <path d="m29.19 58.253.978.977 1.955-1.955" stroke="#E0F6E3" stroke-width=".977" stroke-linecap="round" stroke-linejoin="round"/>
                        <rect x="26.746" y="69.98" width="7.82" height="7.82" rx="2.444" fill="#56B663"/>
                        <path d="m29.19 73.889.977.977 1.955-1.955" stroke="#E0F6E3" stroke-width=".977" stroke-linecap="round" stroke-linejoin="round"/>
                        <path stroke="#B2D9B6" stroke-width="1.564" stroke-linecap="round" d="M38.475 55.122h11.73M38.475 70.761h11.73M28.309 36.356h32.842M28.309 42.613h22.677M65.844 36.356h13.293M38.475 60.596h20.331M38.475 76.236h20.331"/>
                        <path d="M71.485 83.871 63.6 78.785l-1.604 8.618c-.258 1.388 1.31 2.38 2.454 1.553l7.035-5.085z" fill="#56B663"/>
                        <path d="M87.759 41.33a3.128 3.128 0 0 1 4.324-.933l2.628 1.695a3.128 3.128 0 0 1 .933 4.324L71.484 83.87 63.6 78.785l24.16-37.455z" fill="#4A9453"/>
                        <path d="M87.759 41.33a3.128 3.128 0 0 1 4.324-.933l2.628 1.695a3.128 3.128 0 0 1 .933 4.324l-4.239 6.571-7.885-5.086 4.239-6.571z" fill="#E0F6E3"/>
                        <path fill="#56B663" d="m84.79 45.93 7.886 5.086-2.543 3.943-7.885-5.086z"/>
                    </g>
                </svg>
                <div class="exam_inst_all_the_best">All the Best Sakshi!</div>
                <button class="btn exam_inst_take_test_btn">Take Test</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection