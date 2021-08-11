<div class="subChapter">
    <table class="table  table-hover  ">
        <thead>
            <tr>
                <th scope="col">Select Chapter</th>
            </tr>
        </thead>
        <tbody class="text-left ">
            <div>
                @if(isset($chapter_list) && !empty($chapter_list))
                @foreach($chapter_list as $key=>$val)
                <tr>
                    <td><input class="form-check-input me-2" type="checkbox" name="chapter_id" value="{{$val->chapter_id}}" onchange="handleChange(this, '{{$val->chapter_name}}','{{$active_subject_id}}' );">{{$val->chapter_name}}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td>No Chapter Available...</td>
                </tr>
                @endif
            </div>
        </tbody>
    </table>
</div>

<script>
    $(".subChapter").slimscroll({
        height: "40vh",
    });
</script>