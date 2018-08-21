<section id="intro" class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="organiser_logo">
                <div class="thumbnail">
                    <img src="{{URL::to($organiser->full_logo_path)}}" />
                </div>
            </div>
            @if($organiser->full_logo_path === config('attendize.fallback_organiser_logo_url'))
            <h1>{{$organiser->name}}</h1>
            @endif
            @if($organiser->about)
            <div class="description pa10">
                {!! $organiser->about !!}
            </div>
            @endif
        </div>
    </div>
</section>
