@extends('layouts.blog')
@section('content')
    <style>
        .galleria{ width: 100%; height: 600px; background: #000 }
    </style>
        <div class="portfolio-area portfolio-two">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title title-two text-center">
                            <div class="title-border" style="margin-top: 50px;">
                                <h1>GALERIA <span>{{ $galeria->nm_galeria_gal }}</span></h1>
                                <h3><a href="{{ url('galerias') }}">Voltar para Galerias</h3>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="galleria">
                        @foreach($galeria->itens as $foto)
                            <img src="{{ asset('img/galerias/fotos/'.$foto->nm_path_fot) }}" alt="{{ $foto->dc_alt_fot }}">
                        @endforeach
                    </div>
                </div>
                <br/>
            </div>
        </div>
@endsection
@section('script')
<script src="{{ asset('js/galeria/galleria.min.js') }}"></script>
<script>
    (function() {
        Galleria.loadTheme('../public/js/galeria/themes/classic/galleria.classic.min.js');
        Galleria.run('.galleria');
    }());
</script>
@endsection