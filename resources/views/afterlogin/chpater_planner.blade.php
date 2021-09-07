<div class="subChapter">
    <h5>Select Chapter</h5>
    <select name="planner_chapter_id" id="planner_chapter_add" class="form-select border-0 border-bottom rounded-0">
        <option value="">Select </option>
        @if(isset($chapter_list) && !empty($chapter_list))
        @foreach($chapter_list as $key=>$val)
        <option value="{{$val->chapter_id}}" @if(in_array($val->chapter_id,$selected_chapter)) disabled @endif >{{$val->chapter_name}}</option>
        @endforeach
        @endif
        </option>
    </select>
    <span class="invalid-feedback m-0" role="alert" id="errChptAdd_alert"> </span>
    <div class="w-100 text-right mt-4 mb-5">
        <button id="add_chapter" class="btn btn-green rounded-0  pull-right" onclick="handleChange('{{$active_subject_id}}' );">Add</button>
    </div>

</div>

<script>

</script>