@extends('layouts.app')

@section('page_class', 'page-albums')

@section('content')
<div class="container">

    @include('layouts.messages')

    <div class="row">
        <div class="col-sm-3">
            <div class="list-group">
                <a href="/bands" class="list-group-item">Bands</a>
                <span class="list-group-item active">Albums</span>
            </div>
        </div>
        <div class="col-sm-9">
            
            <h2 class="mtn">Albums <a href="/albums/edit" class="btn btn-primary btn-sm mlm">New Album</a></h2>
            <hr>

            <form class="form-inline mbl">
                <div class="form-group">
                    <label for="album-band" class="control-label">Band</label>
                    <select id="album-band" name="band_id" class="form-control">
                        <option value="" selected>All</option>
                        @foreach($bands as $band)
                        <option value="{{ $band->id }}">{{ $band->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

            <table id="dt-albums" class="table table-condensed table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Band Id</th>
                    <th>Band</th>
                    <th>Genre</th>
                    <th>Released</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Band Id</th>
                    <th>Band</th>
                    <th>Genre</th>
                    <th>Released</th>
                    <th></th>
                </tr>
            </tfoot>
            </table>

        </div>
    </div>
</div>
@endsection
