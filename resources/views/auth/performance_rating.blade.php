<style>
ul.proficiency-level-lists li {
    border-radius: 8px;
    border: solid 1px #cde3d0;
    background-color: rgba(255, 255, 255, 0.3);
    display: inline-flex;
    max-width: 215px;
    height: 60px;
    justify-content: center;
    align-items: center;
    font-weight: 500;
    color: #363c4f;
    margin-top: 20px;
    width: 100%;
    margin-right: 20px;
}
ul.proficiency-level-lists li span b {width: 7px;background-color: #cccccca1;height: 13px;display: inline-block;border-radius: 10px;}
ul.proficiency-level-lists li span b.rate-level-active{background-color: #363c4f;}
ul.proficiency-level-lists li.selected-level{background-color:#e0f6e3;color:#56b663;}
ul.proficiency-level-lists li.selected-level span b.rate-level-active{background-color:#56b663;}
.subject-level-proficiency h5 {
    font-size: 16px;
    font-weight: 800;
}
ul.proficiency-level-lists li:last-child {
    margin-right: 0;
}
</style>
@extends('layouts.app')
@section('content')
<div class="performance_rating_wrapper" style="padding:50px;background-color: #f5faf6;">
    <div class="subject-level-proficiency mb-5">
        <h5>Mathematics</h5>
        <ul class="proficiency-level-lists d-flex justify-content-beween flex-wrap">
            <li>
                <span class="mr-3">
                    <b class="rate-level-active"></b>
                    <b class="rate-level-active"></b>
                    <b class="rate-level-active"></b>
                    <b></b>
                    <b></b>
                </span>
                <label class="mb-0">Beginner</label>
            </li>
            <li>
                <span class="mr-3">
                    <b class="rate-level-active"></b>
                    <b class="rate-level-active"></b>
                    <b></b>
                    <b></b>
                    <b></b>
                </span>
                <label class="mb-0">Foundation level</label>
            </li>
            <li class="selected-level">
                <span class="mr-3">
                    <b class="rate-level-active"></b>
                    <b class="rate-level-active"></b>
                    <b class="rate-level-active"></b>
                    <b></b>
                    <b></b>
                </span>
                <label class="mb-0">Intermediate</label>
            </li>
            <li>
                <span class="mr-3">
                    <b></b>
                    <b></b>
                    <b></b>
                    <b class="rate-level-active"></b>
                    <b class="rate-level-active"></b>
                </span>
                <label class="mb-0">Proficient</label>
            </li>
            <li>
                <span class="mr-3">
                    <b></b>
                    <b></b>
                    <b class="rate-level-active"></b>
                    <b></b>
                    <b></b>
                </span>
                <label class="mb-0">Expert</label>
            </li>
        </ul>
    </div>
    <div class="subject-level-proficiency mb-5">
        <h5>Chemistry</h5>
        <ul class="proficiency-level-lists d-flex justify-content-beween flex-wrap">
            <li>
                <span class="mr-3">
                    <b class="rate-level-active"></b>
                    <b class="rate-level-active"></b>
                    <b class="rate-level-active"></b>
                    <b></b>
                    <b></b>
                </span>
                <label class="mb-0">Beginner</label>
            </li>
            <li>
                <span class="mr-3">
                    <b class="rate-level-active"></b>
                    <b class="rate-level-active"></b>
                    <b></b>
                    <b></b>
                    <b></b>
                </span>
                <label class="mb-0">Foundation level</label>
            </li>
            <li>
                <span class="mr-3">
                    <b class="rate-level-active"></b>
                    <b></b>
                    <b></b>
                    <b></b>
                    <b></b>
                </span>
                <label class="mb-0">Intermediate</label>
            </li>
            <li>
                <span class="mr-3">
                    <b></b>
                    <b></b>
                    <b></b>
                    <b class="rate-level-active"></b>
                    <b class="rate-level-active"></b>
                </span>
                <label class="mb-0">Proficient</label>
            </li>
            <li>
                <span class="mr-3">
                    <b></b>
                    <b></b>
                    <b class="rate-level-active"></b>
                    <b></b>
                    <b></b>
                </span>
                <label class="mb-0">Expert</label>
            </li>
        </ul>
    </div>
    <div class="subject-level-proficiency">
        <h5>Physics</h5>
        <ul class="proficiency-level-lists d-flex justify-content-beween flex-wrap">
            <li>
                <span class="mr-3">
                    <b class="rate-level-active"></b>
                    <b class="rate-level-active"></b>
                    <b class="rate-level-active"></b>
                    <b></b>
                    <b></b>
                </span>
                <label class="mb-0">Beginner</label>
            </li>
            <li>
                <span class="mr-3">
                    <b class="rate-level-active"></b>
                    <b class="rate-level-active"></b>
                    <b></b>
                    <b></b>
                    <b></b>
                </span>
                <label class="mb-0">Foundation level</label>
            </li>
            <li>
                <span class="mr-3">
                    <b class="rate-level-active"></b>
                    <b></b>
                    <b></b>
                    <b></b>
                    <b></b>
                </span>
                <label class="mb-0">Intermediate</label>
            </li>
            <li>
                <span class="mr-3">
                    <b></b>
                    <b></b>
                    <b></b>
                    <b class="rate-level-active"></b>
                    <b class="rate-level-active"></b>
                </span>
                <label class="mb-0">Proficient</label>
            </li>
            <li>
                <span class="mr-3">
                    <b></b>
                    <b></b>
                    <b class="rate-level-active"></b>
                    <b></b>
                    <b></b>
                </span>
                <label class="mb-0">Expert</label>
            </li>
        </ul>
    </div>
</div>
@endsection