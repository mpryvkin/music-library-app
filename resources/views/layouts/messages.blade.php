@if (count($errors) > 0)
<div class="alert alert-danger">
   @if (count($errors) > 1)
   <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
   </ul>
   @else
      @foreach ($errors->all() as $error)
      {{ $error }}
      @endforeach
   @endif
</div>
@endif

@if(Session::has('info.message'))
<div class="alert alert-info">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   {{ Session::get('info.message') }}
</div>
@endif

@if(Session::has('success.message'))
<div class="alert alert-success">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   {{ Session::get('success.message') }}
</div>
@endif

@if(Session::has('warning.message'))
<div class="alert alert-warning">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   {{ Session::get('warning.message') }}
</div>
@endif

@if(Session::has('error.message'))
<div class="alert alert-danger">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   {{ Session::get('error.message') }}
</div>
@endif
