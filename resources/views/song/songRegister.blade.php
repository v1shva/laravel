@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add New Song</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('registerSong') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('artist') ? ' has-error' : '' }}">
                            <label for="artist" class="col-md-4 control-label">Artist</label>

                            <div class="col-md-6">
                                <input id="artist" type="text" class="form-control" name="artist" value="{{ old('artist') }}" required>

                                @if ($errors->has('artist'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('artist') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('method') ? ' has-error' : '' }}">
                            <label for="method" class="col-md-4 control-label">Method</label>

                            <div class="col-md-6">
                                <select id="method" type="text" class="form-control" name="method" value="{{ old('method') }}" required onchange="showMethod()">
                                    <option value="" disabled selected>Select your method </option>
                                    <option value="file">File</option>
                                    <option value="url">URL</option>
                                </select>

                                @if ($errors->has('method'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('method') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div id="urlForm" class="form-group{{ $errors->has('url') ? ' has-error' : '' }}" hidden>
                            <label for="url" class="col-md-4 control-label">URL</label>

                            <div class="col-md-6">
                                <input id="url" class="form-control" name="url" value="{{ old('url') }}" >

                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div id="fileForm" class="form-group{{ $errors->has('file') ? ' has-error' : '' }}" hidden>
                            <label for="file" class="col-md-4 control-label">File</label>

                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control" name="file" value="{{ old('file') }}">

                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Song
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        var showMethod = function(){
            if($("#method option:selected").val() == "file"){
                $("#fileForm").show();
                $("#urlForm").hide();
                $("#url").val(null);
            }
            else{
                $("#urlForm").show();
                $("#fileForm").hide();
                $("#file").val(null);
            }
        }
    </script>
@endsection
