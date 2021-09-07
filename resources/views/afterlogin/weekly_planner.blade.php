<ul id='slider' class="pt-3">
    <li class="gray prfile">
        <div class="col swipLi">
            <div class="TestLevel ">Level Up</div>
            <div class="TestTitle">One Last Step!</div>
            <div class="unlock-text">Unlock analytics and more</div>

            <div class="checkBody mb-2">
                <input class="inputCheck" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    Take a test and get a complete analysis of your preparation!
                </label>
            </div>
            <div class="btnBody">
                <a href="{{route('exam','full_exam')}}" class="text-uppercase goto-exam-btn p-2 w-100 text-center bt-hgt-48"><i class="fas fa-bolt"></i> Attempt Now!</a>
            </div>

        </div>
        <div class="clearfix"></div>
    </li>




    @if(isset($planner) && !empty($planner))
    @foreach($planner as $key=>$val)
    <li>
        <div class="col swipLi">
            <!-- <img src="images/thermodynamics_ic.png" /> -->
            <div class="TestLevel">Level Up In</div>
            <div class="TestTitle">{{$val->chapter_name}}</div>
            <div class="starRating">
                <div class="star"><span class="full" data-value="1"></span><span class="half" data-value="0.5"></span><span class="selected"></span></div>
                <div class="star"><span class="full" data-value="1"></span><span class="half" data-value="0.5"></span><span class="selected"></span></div>
                <div class="star"><span class="full" data-value="1"></span><span class="half" data-value="0.5"></span><span class="selected"></span></div>
                <div class="star"><span class="full" data-value="1"></span><span class="half" data-value="0.5"></span><span class="selected"></span></div>
                <div class="star"><span class="full" data-value="1"></span><span class="half" data-value="0.5"></span><span class="selected"></span></div>
                <div class="score score-rating-slt js-score">0%</div>
            </div>

            <div class="checkBody mb-2">
                <input class="inputCheck" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    Take a test and get a complete analysis of your preparation!
                </label>
            </div>
            <div class="btnBody">
                <a href="{{route('planner_exam',$val->chapter_id)}}" class="btn rounded-0 p-2 bt-hgt-48"><i class="fas fa-bolt"></i> Attempt Now!</a>
                <button class="btn rounded-0  ms-2 scheduleBtn bt-hgt-48"><i class="fas fa-clock"></i> Schedule Later</button>
            </div>
        </div>
        <div class="clearfix"></div>
    </li>

    @endforeach
    @endif

</ul>
<script type="text/javascript">
    console = window.console || {
        dir: new Function(),
        log: new Function()
    };
    var active = 0,
        as = document.getElementById('pagenavi').getElementsByTagName('a');
    for (var i = 0; i < as.length; i++) {
        (function() {
            var j = i;
            as[i].onclick = function() {
                t4.slide(j);
                return false;
            }
        })();
    }
    var t1 = new TouchSlider('slider', {
        duration: 800,
        interval: 3000,
        direction: 0,
        autoplay: false,
        align: 'left',
        mousewheel: false,
        mouse: true,
        fullsize: false
    });
    t4.on('before', function(m, n) {
        as[m].className = '';
        as[n].className = 'active';
    })
</script>