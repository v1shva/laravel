@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1default" data-toggle="tab">Default 1</a></li>
                    <li><a href="#tab2default" data-toggle="tab">Default 2</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1default">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Artist</th>
                                <th>URL</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($songs as $song)
                                <tr>
                                    <td>{{ $song->getTitle() }}</td>
                                    <td>{{ $song->getArtist() }}</td>
                                    <td style="width:200px;">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                URL : {{ $song->getUrl() }}
                                            </li>
                                            <li class="list-group-item">
                                                <audio controls>
                                                    <source src="{{$song->getUrl()}}" type="audio/mpeg">
                                                    Your browser does not support the audio tag.
                                                </audio>
                                            </li>
                                        </ul>

                                    </td>
                                    <td style="text-align:center">
                                        <a class="btn btn-default" href="{{route("rank").'?song='.$song->getId().'&user='.Auth::user()->getId()}}"> Rate </a>
                                    </td>

                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="tab2default">Default 2</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
