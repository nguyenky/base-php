@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div>
                        <a href="/items">Items</a>
                    </div>
                </div>
                <div class="card-body">
                <form action="{{route('items.store')}}" method="POST">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="email">Title</label>
                        <input type="text" value="{{ old('title') }}" name="title" class="form-control">
                        @if ($errors->has('title'))
                            <label class="text-danger">{{$errors->first('title')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Channel</label>
                        <select class="form-control" name="channel_id">
                            <option value="" disabled selected>Select Channel</option>
                            @foreach($channels as $channel)
                                @if (old('channel_id') == $channel->id)
                                    <option value="{{$channel->id}}" selected>{{$channel->title}}</option>
                                @else
                                    <option value="{{$channel->id}}">{{$channel->title}}</option>
                                @endif
                                
                            @endforeach
                        </select>
                        @if ($errors->has('channel_id'))
                            <label class="text-danger">{{$errors->first('channel_id')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Link</label>
                        <input type="text" value="{{ old('link') }}" name="link" class="form-control" id="email">
                        @if ($errors->has('link'))
                            <label class="text-danger">{{$errors->first('link')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Category</label>
                        <input type="text" value="{{ old('category') }}" name="category" class="form-control" id="email">
                        @if ($errors->has('category'))
                            <label class="text-danger">{{$errors->first('category')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Comment</label>
                        <textarea id="form7" class="md-textarea form-control" rows="3" name="comments">{!! old('comments') !!}</textarea>
                        @if ($errors->has('comments'))
                            <label class="text-danger">{{$errors->first('comments')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="pwd">Description</label>
                        <textarea id="form7" class="md-textarea form-control" rows="7" value="" name="description">{!! old('description') !!}</textarea>
                        @if ($errors->has('description'))
                            <label class="text-danger">{{$errors->first('description')}}</label>
                        @endif
                    </div>
                    <!-- <div class="checkbox">
                        <label><input type="checkbox"> Remember me</label>
                    </div> -->
                    <button type="submit" class="btn btn-default">Create Item</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
