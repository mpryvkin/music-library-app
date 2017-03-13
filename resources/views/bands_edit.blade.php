@extends('layouts.app')

@section('page_class', 'page-bands-edit')

@section('content')
<div class="container">

    <h2 class="mtn">{{ ($band->id) ? 'Edit Band' : 'Add New Band' }}</h2>
    <hr>

    @include('layouts.messages')

    <form name="frm" id="frm-main" class="form-horizontal" action="/bands/update" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $band->id }}">

    <div class="row">

        <div class="form-group">
            <label for="band-name" class="col-sm-3 control-label">Name <sup><i class="glyphicon glyphicon-asterisk text-danger"></i></sup></label>
            <div class="col-sm-9">
                <input type="text" name="name" value="{{ old('name', $band->name) }}" id="band-name" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="band-start-date" class="col-sm-3 control-label">Start Date</label>
            <div class="col-sm-3">
                <input type="text" name="start_date" value="{{ old('start_date', $band->start_date ? $band->start_date->format('m/d/Y') : '') }}" id="band-start-date" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="band-website" class="col-sm-3 control-label">Website</label>
            <div class="col-sm-9">
                <input type="text" name="website" value="{{ old('website', $band->website) }}" id="band-website" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3" >
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="still_active" value="1" id="band-still-active" {{ $band->still_active ? 'checked' : '' }}> Active
                    </label>
                </div>
            </div>
        </div>

        @if(count($band->albums))
        <div class="form-group">
            <label for="band-name" class="col-sm-3 control-label">Albums</label>
            <div class="col-sm-9">
               <ul class="mtm">
               @foreach($band->albums as $album)
                  <li><a href="/albums/edit/{{ $album->id }}">{{ $album->name }}</a> ({{ $album->release_date->format('m/d/Y') }})</li>
               @endforeach
               </ul>
            </div>
        </div>
        @endif

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
            <sup><i class="glyphicon glyphicon-asterisk text-danger"></i></sup> Indicates required field.
            </div>
        </div>

        <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-primary mrm">{{ ($band->id) ? 'Save' : 'Add' }}</button>
            <a href="/bands" class="btn btn-default">Cancel</a>
        </div>
    </div>

    </form>
</div>
@endsection
