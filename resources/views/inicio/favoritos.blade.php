<section class="pt-5 pb-0 mt-5 mb-6">
    <div class="container">
       <div class="row">
          <div class="container">
             <div class="row">
                <div class="col-lg-2 my-auto text-center">
                   <h1 class="mb-0 text-primary">Trilhas </h1>
                   <h3 class="mb-4 text-primary">Favoritas</h3>
                   <p class="lead">Essas são as trilhas favoritas dos trilherios de Santa Catarina</p>
                </div>
                <div class="col-lg-10 ps-5 pe-0">
                   <div class="row">
                       <div class="col-lg-3 col-6">
                        <a href="{{ url($preferidas[0]->ds_url_tri) }}"><img class="w-100 border-radius-lg h-50 shadow mt-0 mt-lg-7" src="{{ asset('img/trilhas/busca/'.$preferidas[0]->foto->where('id_tipo_foto_tfo',1)->first()->nm_path_fot) }}" alt=""></a>
                      </div>
                      <div class="col-lg-3 col-6">
                        <a href="{{ url($preferidas[1]->ds_url_tri) }}"><img class="w-100 border-radius-lg h-50 shadow" src="{{ asset('img/trilhas/busca/'.$preferidas[1]->foto->where('id_tipo_foto_tfo',1)->first()->nm_path_fot) }}" alt=""></a>
                        <a href="{{ url($preferidas[2]->ds_url_tri) }}"><img class="w-100 border-radius-lg h-50 shadow mt-4" src="{{ asset('img/trilhas/busca/'.$preferidas[2]->foto->where('id_tipo_foto_tfo',1)->first()->nm_path_fot) }}" alt=""></a>
                      </div>
                      <div class="col-lg-3 col-6">
                        <a href="{{ url($preferidas[3]->ds_url_tri) }}"><img class="w-100 border-radius-lg h-50 shadow mt-0 mt-lg-5" src="{{ asset('img/trilhas/busca/'.$preferidas[3]->foto->where('id_tipo_foto_tfo',1)->first()->nm_path_fot) }}" alt=""></a>
                        <a href="{{ url($preferidas[4]->ds_url_tri) }}"><img class="w-100 border-radius-lg h-50 shadow mt-4" src="{{ asset('img/trilhas/busca/'.$preferidas[4]->foto->where('id_tipo_foto_tfo',1)->first()->nm_path_fot) }}" alt=""></a>
                      </div>
                      <div class="col-lg-3 col-6">
                           <a href="{{ url($preferidas[5]->ds_url_tri) }}"><img class="w-100 border-radius-lg h-50 shadow mt-3" src="{{ asset('img/trilhas/busca/'.$preferidas[5]->foto->where('id_tipo_foto_tfo',1)->first()->nm_path_fot) }}" alt=""></a>
                           <a href="{{ url($preferidas[6]->ds_url_tri) }}"><img class="w-100 border-radius-lg h-50 shadow mt-4" src="{{ asset('img/trilhas/busca/'.$preferidas[6]->foto->where('id_tipo_foto_tfo',1)->first()->nm_path_fot) }}" alt=""></a>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>