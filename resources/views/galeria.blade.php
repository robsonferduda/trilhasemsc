@extends('layouts.blog')

@section('content')
        <div class="blog-post-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @foreach($galerias as $galeria)

                            {{ $galeria }}

                        @endforeach
                    </div>                          
                </div>
            </div>
        </div>
@endsection