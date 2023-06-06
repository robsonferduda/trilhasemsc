@extends('layouts.site')
@section('content')
@include('layouts/partes/header')
    <section class="pt-1 pb-0 mt-2">
        <div class="container mt-n6 position-relative">
            <div class="row mt-sm-0 mt-5">
                <section class="py-5">
                    @if($trilhas->count() > 0)
                        @if($trilhas->count() > 1)
                            <h6 class="mt-4">Foram encontradas {{ $trilhas->total() }} trilhas </h6>
                        @else
                            <h6 class="mt-4">Foi encontrada {{ $trilhas->total() }} trilha </h6>
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
                                            <a href="{{ url($trilha->ds_url_tri) }}"><img class="img border-radius-lg" src="{{ asset('img/trilhas/busca/'.$img) }}" alt="{{ $alt }}"></a>
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
    
                        <div class="col-lg-4 col-md-4 mx-auto mt-5">
                            <ul class="pagination pagination-primary mt-4 ml-2">
                               <li class="page-item">
                                  <a class="page-link" href="{{ $trilhas->previousPageUrl().'#lista' }}" aria-label="Previous">
                                  <span aria-hidden="true"><i class="fa fa-angle-double-left" aria-hidden="true"></i></span>
                                  </a>
                               </li>
                               @for ($i = 1; $i <= $trilhas->lastpage(); $i++)
                               <li class="page-item {!! $trilhas->currentPage() ==  $i ? "active" : ' '  !!}">
                               <a class="page-link" href="{{ $trilhas->url($i).'#lista' }}">{{ $i }}</a>
                               </li>
                               @endfor                            
                               <li class="page-item">
                                  <a class="page-link" href="{{ $trilhas->nextPageUrl().'#lista' }}" aria-label="Next">
                                  <span aria-hidden="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
                                  </a>
                               </li>
                            </ul>
                        </div>     
                    @endif       
                </section>
            </div>
         </div>
    </section>    
@endsection