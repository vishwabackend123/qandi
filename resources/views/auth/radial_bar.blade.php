@extends('layouts.app')
@section('content')

<div class="radial_progress_bar">
    <svg xmlns="http://www.w3.org/2000/svg"
        viewBox="-1 -1 34 34">
    
    <circle cx="16" cy="16" r="15.9155"
            class="progress-bar__background" />
    
    <circle cx="16" cy="16" r="15.9155"
            class="progress-bar__progress 
                    js-progress-bar" />
    </svg>
</div>

@endsection