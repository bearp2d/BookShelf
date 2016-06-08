@extends('layouts.app')

@section('content')
<div class="container m-y-md">
    <div class="m-t">
        <div class="row">
            @foreach ($books as $book)
                @include('search.book-search-content-item', $book)
            @endforeach
        </div>
    </div>
</div>
@endsection