<section class="pt-1 pb-0 mt-0 mb-0 mt-4 d-lg-none d-md-none">
    <div class="container">
       <div class="row mb-2">
          <div class="col-md-7">
             <h3 class="text-default">Acesso Guias e Condutores</h3>
          </div>
       </div>
        <div class="row">
            <div class="col-md-12">
                @if(Auth::user())
                    <a href="{{ url('guia-e-condutores/privado/atualizar-cadastro') }}" class="btn btn-sm  bg-gradient-warning  btn-round mb-0 me-1">MEU PERFIL</a>
                    <a href="{{ url('logout') }}" class="btn btn-sm  bg-gradient-danger  btn-round mb-0 me-1" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">SAIR</a>
                @else
                    <a href="{{ url('guias-e-condutores/cadastro') }}" class="btn btn-sm  bg-gradient-warning  btn-round mb-0 me-1">CADASTRE-SE</a>
                    <a href="{{ url('login') }}" class="btn btn-sm  bg-gradient-info  btn-round mb-0 me-1">LOGIN</a>
                @endif
            </div>
        </div>
    </div>
</section>