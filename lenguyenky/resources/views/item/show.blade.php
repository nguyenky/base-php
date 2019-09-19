@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <a href="/items">Items</a>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <h3>{{$item->title}}</h3>
                        <p><strong>Channel</strong>: {{$item->channel->title}}</p>
                        <a href="{{$item->link}}">{{$item->link}}</a>
                        <p><strong>Category</strong>: {{$item->category}}</p>
                        <p><strong>Comment</strong>: {{$item->comments}}</p>
                        <p><strong>Pub Date</strong>: {{$item->pub_date}}</p>
                        <p><strong>Description</strong>: {!! $item->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
