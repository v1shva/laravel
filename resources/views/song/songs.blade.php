@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Songs</div>
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
                            <td>{{ $song->title }}</td>
                            <td>{{ $song->artist }}</td>
                            <td>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        URL : {{ $song->url }}
                                    </li>
                                    <li class="list-group-item">
                                        <audio controls>
                                            <source src="{{$song->url}}" type="audio/mpeg">
                                            Your browser does not support the audio tag.
                                        </audio>
                                    </li>
                                </ul>

                            </td>

                        </tr>

                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
