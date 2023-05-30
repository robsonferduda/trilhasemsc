@extends('layouts.site')
@section('content')
<section class="pt-1 pb-0 mt-2">
    <div class="container mt-n6 position-relative">
        <div class="row mt-sm-0 mt-5">
           <div class="col-md-12 mx-auto">
              <div class="row bg-white shadow border-radius-lg">
                 <div class="col-lg-12 col-md-12 border-right ms-lg-auto">
                    <div class="p-3 text-center">
                       <i class="ni ni-pin-3 text-danger h3"></i>
                       <h4 class="mb-0">Trilhas em {{ $cidade->nm_cidade_cde }}</h4>
                       <p class="text-danger mb-0">{{ $cidade->nm_mesorregiao_cde }}</p>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
</section>
<section class="pt-1 pb-0 mt-2">
    <div class="container mt-n6 position-relative">
        <div class="row mt-sm-0 mt-5">
            <section class="py-5">
                <div class="mt-4">
                    <p>{!! nl2br($cidade->descricao_cde) !!}</p>
                </div>
                @if($trilhas->count() > 0)
                    @if($trilhas->count() > 1)
                        <h6>Foram encontradas {{ $trilhas->count() }} trilhas </h6>
                    @else
                        <h6>Foi encontrada {{ $trilhas->count() }} trilha </h6>
                    @endif
                    @foreach($trilhas as $key => $trilha)
                        @php 
                            $foto = $trilha->foto->where('id_tipo_foto_tfo',7)->first();
                            $img = !empty($foto->nm_path_fot) ? $foto->nm_path_fot : 'padrao.jpg';
                            $alt = !empty($foto->dc_alt_fot) ? $foto->dc_alt_fot : 'Foto';
                        @endphp
                        <div class="card card-plain card-blog {{ ($key > 0) ? 'mt-5' : 'mt-3' }}">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="card-image position-relative border-radius-lg">
                                        <img class="img border-radius-lg" src="{{ asset('img/trilhas/busca/'.$img) }}" alt="{{ $alt }}">
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 my-sm-auto mt-3 ms-sm-3">
                                    <h4>
                                        <a href="{{ url($trilha->ds_url_tri) }}" class="text-danger text-decoration-underline-none">{{ $trilha->nm_trilha_tri }}</a>
                                    </h4>
                                    <p>
                                        {!! nl2br(substr($trilha->ds_trilha_tri, 0, strpos($trilha->ds_trilha_tri, chr(10) ) - 1)) !!}
                                    </p>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 center">
                                            <img src="{{ asset('img/trilhas/nivel/'.$trilha->nivel->dc_icone_niv) }}" alt="Ícone indicador de trilha com nível {{ ucfirst(trans($trilha->nivel->dc_nivel_niv)) }}" class="img w-100">
                                            <p class="my-auto mx-auto" style="text-align: center;">{{ $trilha->nivel->dc_nivel_niv }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach 
                @endif       
            </section>
        </div>
     </div>
</section>
@endsection