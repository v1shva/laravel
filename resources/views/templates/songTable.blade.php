<?php
/**
 * Created by PhpStorm.
 * User: inova
 * Date: 8/11/2017
 * Time: 4:07 PM
 */?>

@foreach ($songsAll as $song)
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
            Current Average Rating: {{$rank = $song->getRank()}}
            <form method="post" action="{{route("rank")}}">
                {{ csrf_field() }}
                <fieldset class="rating">
                    <input type="radio" id="{{'star5'.$song->getId().'all'}}" name="rating" value="5" /><label class = "full" for="{{'star5'.$song->getId().'all'}}" title="Awesome - 5 stars"></label>
                    <input type="radio" id="{{'star4.5'.$song->getId().'all'}}" name="rating" value="4.5" /><label class="half" for="{{'star4.5'.$song->getId().'all'}}" title="Pretty good - 4.5 stars"></label>
                    <input type="radio" id="{{'star4'.$song->getId().'all'}}" name="rating" value="4" /><label class = "full" for="{{'star4'.$song->getId().'all'}}" title="Pretty good - 4 stars"></label>
                    <input type="radio" id="{{'star3.5'.$song->getId().'all'}}" name="rating" value="3.5" /><label class="half" for="{{'star3.5'.$song->getId().'all'}}" title="Meh - 3.5 stars"></label>
                    <input type="radio" id={{'star3'.$song->getId().'all'}}" name="rating" value="3" /><label class = "full" for="{{'star3'.$song->getId().'all'}}" title="Meh - 3 stars"></label>
                    <input type="radio" id="{{'star2.5'.$song->getId().'all'}}" name="rating" value="2.5" /><label class="half" for="{{'star2.5'.$song->getId().'all'}}" title="Kinda bad - 2.5 stars"></label>
                    <input type="radio" id="{{'star2'.$song->getId().'all'}}" name="rating" value="2" /><label class = "full" for="{{'star2'.$song->getId().'all'}}" title="Kinda bad - 2 stars"></label>
                    <input type="radio" id="{{'star1.5'.$song->getId().'all'}}" name="rating" value="1.5" /><label class="half" for="{{'star1.5'.$song->getId().'all'}}" title="Meh - 1.5 stars"></label>
                    <input type="radio" id="{{'star1'.$song->getId().'all'}}" name="rating" value="1" /><label class = "full" for="{{'star1'.$song->getId().'all'}}" title="Sucks big time - 1 star"></label>
                    <input type="radio" id="{{'star0.5'.$song->getId().'all'}}" name="rating" value="0.5" /><label class="half" for="{{'star0.5'.$song->getId().'all'}}" title="Sucks big time - 0.5 stars"></label>
                </fieldset>
                <input type="text" value="{{$song->getId()}}" hidden name="song">
                <div class="form-group">
                    <button type="submit" class="btn btn-default"> Rate </button>
                </div>
            </form>
            <script>
                $('document').ready(function(){
                    document.getElementById("{{'star'.$rank.$song->getId().'all'}}").checked = true
                });
            </script>
        </td>


    </tr>

@endforeach