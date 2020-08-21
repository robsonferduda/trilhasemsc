<div class="blog-two-area section-padding" style="background: #edecec !important;">
    <div class="container">              
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <div class="title-border">
                        <h1>Últimas <span>TRILHAS</span></h1>
                    </div>                            
                </div>
            </div>
        </div>
        <div class="row">
            <div class="blog-carousel">
                @foreach($ultimas as $trilha)

                @php 
                $img = ($trilha->foto->where('id_tipo_foto_tfo',3)->first()) ? $trilha->foto->where('id_tipo_foto_tfo',3)->first()->nm_path_fot : 'padrao.jpg';
                $alt = ($trilha->foto->where('id_tipo_foto_tfo',3)->first()) ? $trilha->foto->where('id_tipo_foto_tfo',3)->first()->dc_alt_fot : 'Foto da Trilha';
                @endphp

                <div class="col-md-6">
                    <div class="single-blog hover-effect">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="blog-image box-hover">

                                    <a href="{{ url($trilha->ds_url_tri) }}"><img src="{{ asset('img/trilhas/recentes/'.$img) }} " alt="{{ $alt }}"></a>

                                    <div class="date-time">
                                        <span class="date" style="padding-left: 8px">{{ \Carbon\Carbon::parse($trilha->created_at)->format('d') }}</span>
                                        <span class="month">{{ strtoupper(\Carbon\Carbon::parse($trilha->created_at)->format('M')) }}</span>
                                    </div>
                                </div>
                                <div class="blog-link">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 margin-left">
                                <div class="blog-text">
                                    <h4><a href="{{ url($trilha->ds_url_tri) }}">{{ $trilha->nm_trilha_tri }}</a></h4>
                                    <p>{!! \Illuminate\Support\Str::limit($trilha->ds_trilha_tri, 200, $end='...') !!}</p>
                                    <a href="{{ url($trilha->ds_url_tri) }}" class="button-one button-yellow">Leia Mais</a>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>