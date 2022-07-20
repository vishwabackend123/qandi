<div class="chapter_profici_nav__right_contant">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb chapter_breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">{{$subject}}</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Chapter : {{$chapter_name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Topics</li>
        </ol>
    </nav>
    <div class="knowledge_left_clr_with_text_right_div">
        <div class=" knowledge_left_clr_with_text">
            <span class="knowledge_left_clr"></span> <span class="cotogaty_right_text">Knowledge</span>
        </div>
        <div class=" knowledge_left_clr_with_text">
            <span class="aomprehension_left_clr"></span> <span class="cotogaty_right_text">Comprehension</span>
        </div>
        <div class=" knowledge_left_clr_with_text">
            <span class="application_left_clr"></span> <span class="cotogaty_right_text">Application</span>
        </div>
        <div class=" knowledge_left_clr_with_text">
            <span class="evaluation_left_clr"></span> <span class="cotogaty_right_text">Evaluation</span>
        </div>
    </div>
</div>
<!-- Tab panes -->
<div class="tab-content">
    <div id="overall_analytics" class="tab-pane">
    </div>
    <div id="maths" class="tab-pane active">
        <div class="row chapter_of_row_col_paddin_zero">
            @foreach($topicList as $list)
            @php
            $topicname = Illuminate\Support\Str::limit($list['topic_name'], 16, $end='...');
            $topicnametitle = $list['topic_name'];
            @endphp
            <div class="col">
                <div class="chapter_proficincy_point_anylytics">
                    <div class="chapter_profici_application_deves_text">{{Str::ucfirst(Str::lower($topicname))}} </div>
                    <div class="common_bars">
                        <div class="d-flex common_bars_flex">
                            <span class="common_bar_sky_blue common_bar_width position-relative"></span>
                            <span class="common_bar_dark_green common_bar_width position-relative"></span>
                            <span class="common_bar_green common_bar_width position-relative"></span>
                            <span class="common_bar_navi_blue common_bar_width position-relative"></span>
                        </div>
                    </div>
                    <div class="chapter_profici_percentage_profincy">
                        <div class="chapter_profici_percent">
                            <span>{{round($list['topic_score'])}}%</span> <span>Proficiency</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
