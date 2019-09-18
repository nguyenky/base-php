@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <a href="">Channels</a>
                        <a href="/items">Items</a>
                        <a class="float-right" href="{{route('items.create')}}"><button type="button" class="btn btn-primary">New Item</button></a>
                    </div>
                </div>
                <div class="card-header">
                    
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
                                <td>{{$item->pubDate}}</td>
                                <td>
                                    <a href="{{route('items.show', ['id' => $item->id])}}"><i class="fa fa-info-circle fa-2x"></i></a> - 
                                    <a href=""><i class="fa fa-pencil fa-2x"></i></a> -
                                    <a href="{{route('items.destroy', ['id' => $item->id])}}"><i class="fa fa-trash fa-2x"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{$items->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
