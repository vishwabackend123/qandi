<script type="text/javascript" src="{{URL::asset('public/js/jquery-2.2.4.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>

<script src="{{URL::asset('public/js/bootstrap.bundle.min.js')}}"></script>

<script type="text/javascript" src="{{URL::asset('public/js/jquery.slimscroll.min.js')}}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    var mesos = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ];

    var dies = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday'
    ];

    var dies_abr = [
        'S',
        'S',
        'M',
        'T',
        'W',
        'T',
        'F'
    ];

    Number.prototype.pad = function(num) {
        var str = '';
        for (var i = 0; i < (num - this.toString().length); i++)
            str += '0';
        return str += this.toString();
    }

    function calendari(widget, data) {

        var original = widget.getElementsByClassName('actiu')[0];

        if (typeof original === 'undefined') {
            original = document.createElement('table');
            original.setAttribute('data-actual',
                data.getFullYear() + '/' +
                data.getMonth().pad(2) + '/' +
                data.getDate().pad(2))
            widget.appendChild(original);
        }

        var diff = data - new Date(original.getAttribute('data-actual'));

        diff = new Date(diff).getMonth();

        var e = document.createElement('table');

        e.className = diff === 0 ? 'amagat-esquerra' : 'amagat-dreta';
        e.innerHTML = '';

        widget.appendChild(e);

        e.setAttribute('data-actual',
            data.getFullYear() + '/' +
            data.getMonth().pad(2) + '/' +
            data.getDate().pad(2))

        var fila = document.createElement('tr');
        var titol = document.createElement('th');
        titol.setAttribute('colspan', 7);

        var boto_prev = document.createElement('button');
        boto_prev.className = 'boto-prev';
        boto_prev.innerHTML = '&lt;';

        var boto_next = document.createElement('button');
        boto_next.className = 'boto-next';
        boto_next.innerHTML = '&gt;';

        titol.appendChild(boto_prev);
        titol.appendChild(document.createElement('span')).innerHTML =
            mesos[data.getMonth()] + '<span class="any">' + data.getFullYear() + '</span>';

        titol.appendChild(boto_next);

        boto_prev.onclick = function() {
            data.setMonth(data.getMonth() - 1);
            calendari(widget, data);
        };

        boto_next.onclick = function() {
            data.setMonth(data.getMonth() + 1);
            calendari(widget, data);
        };

        fila.appendChild(titol);
        e.appendChild(fila);

        fila = document.createElement('tr');

        for (var i = 1; i < 7; i++) {
            fila.innerHTML += '<th>' + dies_abr[i] + '</th>';
        }

        fila.innerHTML += '<th>' + dies_abr[0] + '</th>';
        e.appendChild(fila);

        /* Obtinc el dia que va acabar el mes anterior */
        var inici_mes =
            new Date(data.getFullYear(), data.getMonth(), -1).getDay();

        var actual = new Date(data.getFullYear(),
            data.getMonth(),
            -inici_mes);

        /* 6 setmanes per cobrir totes les posiblitats
         *  Quedaria mes consistent alhora de mostrar molts mesos 
         *  en una quadricula */
        for (var s = 0; s < 6; s++) {
            var fila = document.createElement('tr');

            for (var d = 1; d < 8; d++) {
                var cela = document.createElement('td');
                var span = document.createElement('span');

                cela.appendChild(span);

                span.innerHTML = actual.getDate();

                if (actual.getMonth() !== data.getMonth())
                    cela.className = 'fora';

                /* Si es avui el decorem */
                if (data.getDate() == actual.getDate() &&
                    data.getMonth() == actual.getMonth())
                    cela.className = 'avui';

                actual.setDate(actual.getDate() + 1);
                fila.appendChild(cela);
            }

            e.appendChild(fila);
        }

        setTimeout(function() {
            e.className = 'actiu';
            original.className +=
                diff === 0 ? ' amagat-dreta' : ' amagat-esquerra';
        }, 20);

        original.className = 'inactiu';

        setTimeout(function() {
            var inactius = document.getElementsByClassName('inactiu');
            for (var i = 0; i < inactius.length; i++)
                widget.removeChild(inactius[i]);
        }, 1000);

    }

    calendari(document.getElementById('calendari'), new Date());

    // end of calender js


    $('.submenu-L1').on('shown.bs.collapse', function() {
        $('body').addClass('move-mainwrapper');

    })

    $('.submenu-L1').on('hidden.bs.collapse', function() {
        $('body').removeClass('move-mainwrapper');

    })
    $('.submenu-L2').on('shown.bs.collapse', function() {
        $('body').addClass('move-mainwrapper2');

    })

    $('.submenu-L2').on('hidden.bs.collapse', function() {
        $('body').removeClass('move-mainwrapper2');

    })
    $(document).on('click', function(e) {
        /* bootstrap collapse js adds "in" class to your collapsible element*/
        var menu_opened = $('.submenu-L1, .submenu-L2').hasClass('show');

        if (!$(e.target).closest('.submenu-L1').length &&
            !$(e.target).is('.submenu-L1, .submenu-L2') &&
            menu_opened === true) {
            $('.submenu-L1, .submenu-L2').collapse('toggle');
        }

    });
</script>
<script>
    $(document).ready(function() {
        $('#edit-planner-btn').click(function() {

            $('#sub-planner').addClass('open-sub-planner');
            $(this).addClass('close-sub-planner');
            $('#close-edit-planner-btn').removeClass('close-sub-planner');

        });
        $('#close-edit-planner-btn').click(function() {

            $('#sub-planner').removeClass('open-sub-planner');
            $(this).addClass('close-sub-planner');
            $('#edit-planner-btn').removeClass('close-sub-planner');

        });

    });
</script>