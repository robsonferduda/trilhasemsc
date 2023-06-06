<section class="pt-5 pb-0">
    <div class="container">
       <div class="row mb-2">
           <div class="col-md-7">
              <h3 class="text-primary">Destaques</h3>
           </div>
        </div>
       <div class="row">

           @foreach($ultimas as $trilha)
           @php
                $img = ($trilha->foto->where('id_tipo_foto_tfo',3)->first()) ? $trilha->foto->where('id_tipo_foto_tfo',3)->first()->nm_path_fot : 'padrao.jpg';
           @endphp
          
               <div class="col-lg-4 col-md-6">
               <div class="card card-blog card-plain">
                   <div class="position-relative">
                       <a href="{{ url($trilha->ds_url_tri) }}" class="d-block">
                            <img src="{{ asset('img/trilhas/detalhes-principal/'.$img) }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                       </a>
                   </div>
                   <div class="card-body px-1 pt-3">
                       <p class="text-gradient text-dark mb-2 text-sm">{{ $trilha->cidade->nm_cidade_cde }}</p>
                       <a href="{{ url($trilha->ds_url_tri) }}">
                       <h5>
                           {{ $trilha->nm_trilha_tri }}
                       </h5>
                       </a>
                       <p>                           
                           {!! nl2br(\Illuminate\Support\Str::limit($trilha->ds_trilha_tri, 250, $end='...')) !!}
                       </p>
                        <!--
                        <div class="author align-items-center mt-3 mb-3">
                            <img src="{{ asset('img/guias/12.png') }}" alt="..." class="avatar rounded-circle shadow">
                            <div class="name ps-2">
                                <span>Eco Trilhas Floripa</span>
                                <div class="stats">
                                    <small>Membro desde 12/02/2023</small>
                                </div>
                            </div>
                        </div>
                        -->
                        <a href="{{ url($trilha->ds_url_tri) }}" type="button" class="btn btn-outline-primary btn-sm">Veja Mais</a>
                   </div>
               </div>
           </div>
           @endforeach
       </div>
    </div>
</section>