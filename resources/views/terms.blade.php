@extends('shared.layout')


@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            <h1>Terms</h1>
            <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor veritatis atque vitae numquam accusamus
                neque, ea nobis. Iure maiores, quas vel dolorum pariatur architecto voluptates incidunt rerum fugit
                reiciendis eaque culpa natus recusandae illum reprehenderit, sint similique? Facilis ipsum esse eos quas qui
                aut officia tempora veniam animi rem maiores nam doloremque enim magni, vel id numquam odio cupiditate
                reprehenderit.</div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')
        </div>
    </div>
@endsection
