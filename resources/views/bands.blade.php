@extends('layouts.app')

@section('page_class', 'page-bands')

@section('content')
<div class="container">

    @include('layouts.messages')

    <div class="row">
        <div class="col-sm-3">
            <div class="list-group">
                <span class="list-group-item active">Bands</span>
                <a href="/albums" class="list-group-item">Albums</a>
            </div>
        </div>

        <div class="col-sm-9">

            <h2 class="mtn">Bands <a href="/bands/edit" class="btn btn-primary btn-sm mlm">New Band</a></h2>
            <hr>

            <table id="dt-bands" class="table table-condensed table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Started</th>
                    <th>Website</th>
                    <th>Active</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Started</th>
                    <th>Website</th>
                    <th>Active</th>
                    <th></th>
                </tr>
            </tfoot>
            </table>

        </div>
    </div>
</div>
@endsection
