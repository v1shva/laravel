@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1default" data-toggle="tab">My Songs</a></li>
                    <li><a href="#tab2default" data-toggle="tab">Ranked Songs</a></li>
                    <li><a href="#tab3default" data-toggle="tab">Top Charts</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1default">
                        <table class="table table-hover text-center">
                            <thead>
                            <tr>
                                <th class="text-center">Title</th>
                                <th class="text-center">Artist</th>
                                <th class="text-center">URL</th>
                                <th class="text-center">Rate</th>
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
                                        Current Rating: {{$song->getRank()}}
                                        <form method="post" action="{{route("rank")}}">
                                            {{ csrf_field() }}
                                                <fieldset class="rating">
                                                    <input type="radio" id="{{'star5'.$song->getId()}}" name="rating" value="5" /><label class = "full" for="{{'star5'.$song->getId()}}" title="Awesome - 5 stars"></label>
                                                    <input type="radio" id="{{'star4.5'.$song->getId()}}" name="rating" value="4.5" /><label class="half" for="{{'star4.5'.$song->getId()}}" title="Pretty good - 4.5 stars"></label>
                                                    <input type="radio" id="{{'star4'.$song->getId()}}" name="rating" value="4" /><label class = "full" for="{{'star4'.$song->getId()}}" title="Pretty good - 4 stars"></label>
                                                    <input type="radio" id="{{'star3.5'.$song->getId()}}" name="rating" value="3.5" /><label class="half" for="{{'star3.5'.$song->getId()}}" title="Meh - 3.5 stars"></label>
                                                    <input type="radio" id={{'star3'.$song->getId()}}" name="rating" value="3" /><label class = "full" for="{{'star3'.$song->getId()}}" title="Meh - 3 stars"></label>
                                                    <input type="radio" id="{{'star2.5'.$song->getId()}}" name="rating" value="2.5" /><label class="half" for="{{'star2.5'.$song->getId()}}" title="Kinda bad - 2.5 stars"></label>
                                                    <input type="radio" id="{{'star2'.$song->getId()}}" name="rating" value="2" /><label class = "full" for="{{'star2'.$song->getId()}}" title="Kinda bad - 2 stars"></label>
                                                    <input type="radio" id="{{'star1.5'.$song->getId()}}" name="rating" value="1.5" /><label class="half" for="{{'star1.5'.$song->getId()}}" title="Meh - 1.5 stars"></label>
                                                    <input type="radio" id="{{'star1'.$song->getId()}}" name="rating" value="1" /><label class = "full" for="{{'star1'.$song->getId()}}" title="Sucks big time - 1 star"></label>
                                                    <input type="radio" id="{{'star0.5'.$song->getId()}}" name="rating" value="0.5" /><label class="half" for="{{'star0.5'.$song->getId()}}" title="Sucks big time - 0.5 stars"></label>
                                                </fieldset>
                                            <input type="text" value="{{$song->getId()}}" hidden name="song">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-default"> Rate </button>
                                            </div>
                                       </form>
                                        <script>
                                            $('document').ready(function(){
                                                document.getElementById("{{'star'.$song->getRank().$song->getId()}}").checked = true
                                            });
                                        </script>
                                    </td>


                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="tab2default">Ranked Songs</div>
                    <div class="tab-pane fade" id="tab3default">Top Charts</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
