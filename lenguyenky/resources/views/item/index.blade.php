@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <a href="/items">Items</a>
                        <a class="float-right" href="{{route('items.create')}}"><button type="button" class="btn btn-primary">New Item</button></a>
                    </div>
                </div>
                <div class="card-header">
                    <form role="form" method="GET" action="{{route('items.index')}}">
                        <div class="col-md-6 float-right">
                            <div class="form-group">
                                <label for="email">Per page</label>
                                <input type="number" value="{{ request()->input('per_page') ?? 50}}" name="per_page" class="form-control">
                                @if ($errors->has('per_page'))
                                    <label class="text-danger">{{$errors->first('per_page')}}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Select channel to filter !</label>
                                <select class="form-control" name="channel_id">
                                    <option value="" disabled selected>Select Channel</option>
                                    @foreach($channels as $channel)
                                        @if (request()->input('channel_id') == $channel->id)
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
                            <label for="email">Enter category !</label>
                                <input type="text" value="{{ request()->input('category')}}" name="category" class="form-control">
                                @if ($errors->has('category'))
                                    <label class="text-danger">{{$errors->first('category')}}</label>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-default float-right">Go !!</button>
                        </div>
                    </form>
                </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width:1%">ID</th>
                                <th scope="col" style="width:10%">Channel</th>
                                <th scope="col" style="width:10%">Title</th>
                                <th scope="col" style="width:10%">Link</th>
                                <th scope="col" style="width:10%">Category</th>
                                <th scope="col" style="width:20%">PubDate</th>
                                <th scope="col" style="width:20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->channel->title}}</td>
                                <td>{{$item->title}}</td>
                                <td><a href="{{$item->link}}">{{$item->link}}</a></td>
                                <td>{{$item->category}}</td>
                                <td>{{$item->pub_date}}</td>
                                <td class="text-center">
                                    <a href="{{route('items.show', ['id' => $item->id])}}"><i class="fa fa-info-circle fa-2x"></i></a><br /> 
                                    <a href="{{route('items.edit', ['id' => $item->id])}}"><i class="fa fa-pencil fa-2x"></i></a><br />
                                    <form action="{{route('items.destroy', ['id' => $item->id])}}" method="POST">
                                        {{ method_field('DELETE') }}    
                                        {!! csrf_field() !!}
                                        <button class="btn btn-danger"><i class="fa fa-trash fa-2x"></i></button>
                                    </form>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{$items->appends(request()->input())->links()}}
                    </div>
                    @if($items->isEmpty())
                        <div class="text-center">
                            <p>Data not found !!!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
