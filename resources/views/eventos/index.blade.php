@extends('layouts.blog')
@section('content')
        <div class="blog-post-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <br/><br/><h1>Eventos</h1>
                            </div>    
                        </div>
                    </div>                          
                </div>
                @foreach($eventos as $key => $evento)
                    <div class="row">
                        <h6><a href="{{ url('eventos/detalhes', $evento->id_evento_eve) }}">{{ \Carbon\Carbon::parse($evento->dt_realizacao_eve)->format('d/m/Y H:i:s') }} - {{ $evento->nm_evento_eve }}</a></h6>
                    </div>               
                @endforeach
            </div>
        </div>
@endsection