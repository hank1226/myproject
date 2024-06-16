{{--
    @if ($errors->has('title'))
    <div class="alert alert-danger">
        {{ $errors->first('title') }}
    </div>
@endif

@if ($errors->has('body'))
    <div class="alert alert-danger">
        {{ $errors->first('body') }}
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif
    --}}


@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif
