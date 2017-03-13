@extends('layouts.app')

@section('page_class', 'page-albums-edit')

@section('content')
<div class="container">

    <h2 class="mtn">{{ ($album->id) ? 'Edit Album' : 'Add New Album' }}</h2>
    <hr>

    @include('layouts.messages')

    <form name="frm" id="frm-main" class="form-horizontal" action="/albums/update" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $album->id }}">

    <div class="row">

        <div class="form-group">
            <label for="album-name" class="col-sm-3 control-label">Name <sup><i class="glyphicon glyphicon-asterisk text-danger"></i></sup></label>
            <div class="col-sm-9">
                <input type="text" name="name" value="{{ old('name', $album->name) }}" id="album-name" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="album-band" class="col-sm-3 control-label">Band  <sup><i class="glyphicon glyphicon-asterisk text-danger"></i></sup></label>
            <div class="col-sm-3">
                <select id="album-band" name="band_id" class="form-control">
                   <option value="" @if(!$album->band_id) selected @endif>Select one</option>
                @foreach($bands as $band)
                   <option value="{{ $band->id }}" @if(old('band_id', $album->band_id) == $band->id) selected @endif>{{ $band->name }}</option>
                @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="album-recorded-date" class="col-sm-3 control-label">Recorded Date</label>
            <div class="col-sm-3">
                <input type="text" name="recorded_date" value="{{ old('recorded_date', $album->recorded_date ? $album->recorded_date->format('m/d/Y') : '') }}" id="album-recorded-date" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="album-release-date" class="col-sm-3 control-label">Release Date</label>
            <div class="col-sm-3">
                <input type="text" name="release_date" value="{{ old('release_date', $album->release_date ? $album->release_date->format('m/d/Y') : '') }}" id="album-release-date" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="album-number-of-tracks" class="col-sm-3 control-label">Number of Tracks</label>
            <div class="col-sm-3">
                <input type="text" name="number_of_tracks" value="{{ old('number_of_tracks', $album->number_of_tracks) }}" id="album-number-of-tracks" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="album-label" class="col-sm-3 control-label">Label</label>
            <div class="col-sm-9">
                <input type="text" name="label" value="{{ old('label', $album->label) }}" id="album-label" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="album-producer" class="col-sm-3 control-label">Producer</label>
            <div class="col-sm-9">
                <input type="text" name="producer" value="{{ old('producer', $album->producer) }}" id="album-producer" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="album-genre" class="col-sm-3 control-label">Genre</label>
            <div class="col-sm-3">
                <input type="text" name="genre" value="{{ old('genre', $album->genre) }}" id="album-genre" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
            <sup><i class="glyphicon glyphicon-asterisk text-danger"></i></sup> Indicates required field.
            </div>
        </div>

        <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-primary mrm">{{ ($album->id) ? 'Save' : 'Add' }}</button>
            <a href="/albums" class="btn btn-default">Cancel</a>
        </div>
    </div>

    </form>
</div>
@endsection
