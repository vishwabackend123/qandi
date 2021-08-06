@php
$question_text = isset($question_data->question)?$question_data->question:'';
$option_data = (isset($question_data->question_options) && !empty($question_data->question_options))?json_decode($question_data->question_options):'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;

@endphp
<div class="question-block">
    <button class="btn arrow prev-arow {{empty($prev_qid)?'disabled':''}}" id="quesprev{{ $activeq_id }}" onclick="qnext('{{$prev_qid}}')"><i class="fa fa-angle-left"></i></button>
    <button class="btn arrow next-arow {{empty($next_qid)?'disabled':''}}" id="quesnext{{ $activeq_id }}" onclick="qnext('{{$next_qid}}')"><i class="fa fa-angle-right"></i></button>
    <div class="question pb-5 " id="question_blk"><span class="q-no">Q{{$qNo}}.</span>{!! $question_text !!}</div>
    <div class="ans-block row">
        @if(isset($option_data) && !empty($option_data))
        @php $no=0;
        $alpha = array('A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z');
        @endphp

        @foreach($option_data as $key=>$opt_value)
        @php
        $dom = new DOMDocument();
        @$dom->loadHTML($opt_value);
        $anchor = $dom->getElementsByTagName('img')->item(0);
        $text = isset($anchor)? $anchor->getAttribute('alt') : '';
        $latex = "https://math.now.sh?from=".$text;
        $view_opt='<img src="'.$latex.'" />' ;

        if(in_array($key,$answerKeys) && in_array($key,$attempt_opt)){
        $resp_class= 'btn-light-green';
        }else if(in_array($key,$answerKeys) && !in_array($key,$attempt_opt)){
        $resp_class= 'btn-light-green';
        }else if(!in_array($key,$answerKeys) && in_array($key,$attempt_opt)){
        $resp_class= 'btn-light-red';
        }else{
        $resp_class= '';
        }
        @endphp
        <div class="col-md-6 mb-4">
            <input class="form-check-input radioans" type="radio" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}">
            <div class="border ps-3 ans  {{$resp_class}}">
                <label class="question m-0 py-3   d-block " for="option_{{$activeq_id}}_{{$key}}"><span class="q-no">{{$alpha[$no]}}. </span>{!! !empty($text)?$view_opt:$opt_value; !!}</label>
            </div>
        </div>

        @php $no++; @endphp
        @endforeach
        @endif
    </div>
    </>
    <div class="answer-block p-3 mb-5">
        <div class="row">
            <div class="col-md-2">
                <p class="mb-0 text-green">answer :</p>
            </div>

            <div class="col-md-7">
                @php $mn=0; @endphp
                @foreach($correct_ans as $akey=>$ans_value)
                @php
                $ans_dom = new DOMDocument();
                @$ans_dom->loadHTML($ans_value);
                $ans_anchor = $ans_dom->getElementsByTagName('img')->item(0);
                $atext = isset($ans_anchor)? $ans_anchor->getAttribute('alt') : '';
                $alatex = "https://math.now.sh?from=".$atext;
                $view_ans='<img src="'.$alatex.'" />' ;
                @endphp
                <p class="mb-0 text-green"> {!! !empty($atext)?$view_ans:$ans_value; !!}</p>
                @php $mn++; @endphp
                @endforeach
            </div>

            <div class="col-md-3 text-end">
                <button type="button" class="btn btn-success btn-green answer-percentage-btn" data-bs-toggle="collapse" data-bs-target="#perecent-box">21%</button>
            </div>
            <div class="col-md-12 percentage-box collapse" id="perecent-box">
                <div class="d-flex p-4 bg-gray">
                    <div class="">
                        <h3>21%</h3>
                    </div>
                    <div class="">
                        <h5>Of the people have got this right</h5>
                    </div>
                </div>
                <div class="bg-white p-3">
                    <p>to answer this, you should have</p>

                    <p class="mb-0">knowledge of</p>
                    <button type="button" class="btn btn-danger mb-3" data-bs-toggle="collapse" data-bs-target="#perecent-box1">ARC & RADIUS</button>

                    <p class="mb-0">knowledge and application of</p>
                    <button type="button" class="btn btn-danger">Pythagoras Theorem</button>

                </div>

            </div>

            <div class="col-md-12 percentage-box arc-radius-box collapse" id="perecent-box1">
                <div class=" p-4 bg-gray">
                    <div class="d-flex">
                        <div class="">
                            <h6 class="text-danger">ARC & RADIUS</h6>
                        </div>
                        <div class="text-end">
                            <ul>
                                <li><a href=""><i class="fa fa-bookmark-o" aria-hidden="true"></i> 2</a></li>
                                <li><a href=""><i class="fa fa-bookmark-o" aria-hidden="true"></i> 2</a></li>
                                <li><a href=""><i class="fa fa-bookmark-o" aria-hidden="true"></i> 2</a></li>
                                <li><a href=""><i class="fa fa-bookmark-o" aria-hidden="true"></i> 2</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-3 pt-1">
                        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item text-danger">/ Basic Geometry /</li>
                                <li class="breadcrumb-item text-danger">Geometry /</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="bg-white p-4">
                    <p>AB is an arc of length 42 cm on the circumference of a circle with center O and radius 12 cm. What is the size of angle AOB in radians?</p>

                    <p class="mb-0">AB is an arc of length 42 cm on the circumference of a circle with center O and radius 12 cm. What is the size of angle AOB in radians?</p>
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-7">
                {!! $question_data->reference_text !!}
            </div>
        </div>
    </div>

</div>