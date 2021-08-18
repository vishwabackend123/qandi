<ul id='slider'>
    <li class="gray prfile">
        <div class="col swipLi">
            <small class="TestLevel text-danger fs-5 mb-3">Level up</small>
            <h3>One Last Step!</h3>
            <p class="TestTitle text-danger fs-5">Unlock analytics and more</p>

            <div class="checkBody fs-3">
                <input class="inputCheck" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    Take a test and get a complete analysis of your preparation!
                </label>
            </div>
            <div class="btnBody">
                <a href="{{route('exam','full_exam')}}" class="btn btn-danger rounded-0 mt-3"><i class="fas fa-link"></i> Attempt Now!</a>
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
                <div class="score score-rating js-score">0 %</div>
            </div>

            <div class="checkBody">
                <input class="inputCheck" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    Take a test and get a complete analysis of your preparation!
                </label>
            </div>
            <div class="btnBody">
                <a class="btn rounded-0 mt-3"><i class="fas fa-link"></i> Attempt Now!</a>
                <button class="btn rounded-0 mt-3 scheduleBtn"><i class="fas fa-clock"></i> Schedule Later</button>
            </div>
        </div>
        <div class="clearfix"></div>
    </li>

    <!-- <li style='display:block' class="Level1">
    <div class="col swipLi">
        <img src="images/mechanics_ic.png" />
        <div class="TestLevel">Level Up In</div>
        <div class="TestTitle">Mechanics</div>
        <div class="starRating">
            <div class="star"><span class="full" data-value="1"></span><span class="half" data-value="0.5"></span><span class="selected"></span></div>
            <div class="star"><span class="full" data-value="1"></span><span class="half" data-value="0.5"></span><span class="selected"></span></div>
            <div class="star"><span class="full" data-value="1"></span><span class="half" data-value="0.5"></span><span class="selected"></span></div>
            <div class="star"><span class="full" data-value="1"></span><span class="half" data-value="0.5"></span><span class="selected"></span></div>
            <div class="star"><span class="full" data-value="1"></span><span class="half" data-value="0.5"></span><span class="selected"></span></div>
            <div class="score score-rating js-score">83%</div>
        </div>

        <div class="checkBody">
            <input class="inputCheck" type="checkbox" value="" id="flexCheckChecked" checked>
            <label class="form-check-label" for="flexCheckChecked">
                Take a test and get a complete analysis of your preparation!
            </label>
        </div>
        <div class="btnBody">
            <button class="btn btn-danger rounded-0 mt-3"><i class="fas fa-link"></i> Attempt Now!</button>
        </div>
    </div>
</li>
<li>
    <div class="col swipLi">
        <img src="images/calculus_ic.png" />
        <div class="TestLevel">Coming up Next</div>
        <div class="TestTitle">Calculus</div>
        <div class="starRating">
            <div class="star"><span class="full" data-value="1"></span><span class="half" data-value="0.5"></span><span class="selected"></span></div>
            <div class="star"><span class="full" data-value="1"></span><span class="half" data-value="0.5"></span><span class="selected"></span></div>
            <div class="star"><span class="full" data-value="1"></span><span class="half" data-value="0.5"></span><span class="selected"></span></div>
            <div class="star"><span class="full" data-value="1"></span><span class="half" data-value="0.5"></span><span class="selected"></span></div>
            <div class="star"><span class="full" data-value="1"></span><span class="half" data-value="0.5"></span><span class="selected"></span></div>
            <div class="score score-rating js-score">0 %</div>
        </div>

        <div class="checkBody">
            <input class="inputCheck" type="checkbox" value="" id="flexCheckChecked" checked>
            <label class="form-check-label" for="flexCheckChecked">
                Take a test and get a complete analysis of your preparation!
            </label>
        </div>
        <div class="btnBody">
            <button class="btn rounded-0 mt-3"><i class="fas fa-link"></i> Attempt Now!</button>
        </div>
    </div>
</li>
<li class="CGreen">
    <div class="col swipLi">
        <div class="TestLevel">Keep in Coming!</div>
        <div class="TestTitle">Algebra</div>
        <img src="images/GreenCircleCheck_ic.png" />
        <div class="btnBody">
            <button class="btn rounded-0 mt-3"><i class="fas fa-check"></i> Complete</button>
        </div>
    </div>
</li>
<li class="CGreen">
    <div class="col swipLi">
        <div class="TestLevel">Keep it up!</div>
        <div class="TestTitle">Wave Optics</div>
        <img src="images/GreenCircleCheck_ic.png" />
        <div class="btnBody">
            <button class="btn rounded-0 mt-3"><i class="fas fa-check"></i> Complete</button>
        </div>
    </div>
</li>
<li class="CGreen planner">
    <div class="col swipLi">
        <div class="TestLevel">&nbsp;</div>
        <div class="TestTitle">&nbsp;</div>
        <img src="{{URL::asset('public/after_login/images/calander_ic.png')}}" />
        <div class="btnBody">
            <button class="btn scheduleBtn rounded-0 mt-3"><i class="fas fa-check"></i> Complete</button>
        </div>
    </div>
</li> -->
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