@extends('layouts.site')
@section('pageTitle','Cadastro de Guias e Condutores e Trilheiros')
@section('description', 'Guia de trilhas e camping em Santa Catarina, trazendo informações de localização, trajetos e grau de dificuldade para quem quer conhecer e desfrutar das praias, serras e montanhas desse belo estado do Sul do Brasil' )

@section('content')
<div class="row mt-n6 mb-5">
    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
        <div class="card z-index-0">
           <div class="card-header text-center pt-4 mt-2 mb-0 pb-0">
              <h5>Cadastre-se no Trilhas em SC</h5>
           </div>
           <div class="card-body mt-0">
               
               <form action="{{ url('guias-e-condutores/cadastro') }}" method="post" >
                  @csrf                 
                  @include('layouts/mensagens-novo')
                  <div class="mb-3">
                      <div class="row"> 
                        <div class="col-xl-12 col-lg-12 col-md-12">
                           <p class="center"><strong>Escolha sua atividade</strong></p>
                        </div>
                     </div>
                     <div class="row center">
                        <div class="col-xl-12 col-lg-12 col-md-12 ml-0 mr-0">
                           <label class="custom-radio-button__container w-45">
                              <input class="tipo_cadastro" type="radio" name="tipo_cadastro" value="guia">
                              <span class="custom-radio-button designer">

                                 <div class="svg-designer"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
                                 
                                <h5>Guia/Condutor</h5>
                              </span>
                            </label>
         
                            <label class="custom-radio-button__container w-45">
                              <input class="tipo_cadastro" type="radio" name="tipo_cadastro" value="trilheiro">
                              <span class="custom-radio-button">
                                 <div class="svg-designer"><i class="fa fa-map" aria-hidden="true"></i></div>
                                <h5>Trilheiro</h5>
                              </span>
                            </label>
                        </div>
                     </div>
                  </div>
                  
                  <div class="row"> 
                     <div class="col-xl-12 col-lg-12 col-md-12">
                     
                       <div class="alert alert-warning alert-dismissible text-white fade show d-none alert-atividade" role="alert">
                         <strong>Atenção!</strong> É obrigatório selecionar o tipo de atividade.
                         <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                       </div>
                     
                   </div>
                  </div>

                   <div class="row"> 
                     <div class="col-xl-12 col-lg-12 col-md-12">
                     <div class="mb-3">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nome" value="{{ old('name') }}" required autocomplete="name" autofocus>
                     </div>
                     <div class="mb-3">
                           <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                     </div>
                     <div class="mb-3 box-cadastur d-none">
                        <input id="cadastur" type="text" class="form-control @error('cadastur') is-invalid @enderror" name="cadastur" placeholder="Cadastur" value="{{ old('cadastur') }}" autocomplete="cadastur" autofocus>
                     </div>
                     <div class="mb-3">
                           <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="Senha" value="{{ old('password') }}" required autocomplete="new-password">
                     </div>
                     <div class="mb-3">
                           <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Senha" value="{{ old('password_confirmation') }}" required autocomplete="new-password">
                        </div>
                        <div class="row center mb-3"> 
                           <div class="col-xl-12 col-lg-12 col-md-12">
                              {!! htmlFormSnippet() !!}
                           </div>
                        </div>
                        
                     <div class="form-check form-check-info text-left ">
                        <input class="form-check-input" type="checkbox" value="S" id="flexCheckDefault" name="term" required>
                        <label class="form-check-label" for="flexCheckDefault">
                              Eu aceito os termos e condições<a href="{{ url('termos-de-uso') }}" target="blank" class="text-dark font-weight-bold text-decoration-underline-hover"> Termos e Condições</a>
                        </label>
                     </div>
                     
                     <div class="text-center">
                        <button type="submit" class="btn bg-gradient-dark w-40 my-4 mb-2 btn-cadastrar">Cadastrar</button>
                     </div>
                     <p class="text-sm mt-3 mb-0 text-center">Já possui uma conta? <br/><a href="{{ url('login') }}" class="text-dark font-weight-bold text-decoration-underline-hover">Clique aqui</a></p>
                     </div>
                  </div>
              </form>
           </div>
           <div class="row px-xl-5 px-sm-4 px-3">
            <div class="mt-2 position-relative text-center mb-3">
               <p class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                  OU CADASTRE-SE COM
               </p>
            </div>
            <div class="col-3 ms-auto px-1 d-flex justify-content-center">
               <a class="btn btn-outline-light w-75 h-75 px-3" href="{{ url('login/facebook') }}" >
                  <svg width="24px" height="32px" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="facebook-3" transform="translate(3.000000, 3.000000)" fill-rule="nonzero">
                           <circle id="Oval" fill="#3C5A9A" cx="29.5091719" cy="29.4927506" r="29.4882047"></circle>
                           <path d="M39.0974944,9.05587273 L32.5651312,9.05587273 C28.6886088,9.05587273 24.3768224,10.6862851 24.3768224,16.3054653 C24.395747,18.2634019 24.3768224,20.1385313 24.3768224,22.2488655 L19.8922122,22.2488655 L19.8922122,29.3852113 L24.5156022,29.3852113 L24.5156022,49.9295284 L33.0113092,49.9295284 L33.0113092,29.2496356 L38.6187742,29.2496356 L39.1261316,22.2288395 L32.8649196,22.2288395 C32.8649196,22.2288395 32.8789377,19.1056932 32.8649196,18.1987181 C32.8649196,15.9781412 35.1755132,16.1053059 35.3144932,16.1053059 C36.4140178,16.1053059 38.5518876,16.1085101 39.1006986,16.1053059 L39.1006986,9.05587273 L39.0974944,9.05587273 L39.0974944,9.05587273 Z" fill="#FFFFFF"></path>
                        </g>
                     </g>
                  </svg>
               </a>
            </div>
            <div class="col-3 me-auto px-1 d-flex justify-content-center">
               <a class="btn btn-outline-light w-75 h-75 px-3" href="{{ url('login/google') }}" >
                  <svg width="24px" height="32px" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="google-icon" transform="translate(3.000000, 2.000000)" fill-rule="nonzero">
                           <path d="M57.8123233,30.1515267 C57.8123233,27.7263183 57.6155321,25.9565533 57.1896408,24.1212666 L29.4960833,24.1212666 L29.4960833,35.0674653 L45.7515771,35.0674653 C45.4239683,37.7877475 43.6542033,41.8844383 39.7213169,44.6372555 L39.6661883,45.0037254 L48.4223791,51.7870338 L49.0290201,51.8475849 C54.6004021,46.7020943 57.8123233,39.1313952 57.8123233,30.1515267" fill="#4285F4"></path>
                           <path d="M29.4960833,58.9921667 C37.4599129,58.9921667 44.1456164,56.3701671 49.0290201,51.8475849 L39.7213169,44.6372555 C37.2305867,46.3742596 33.887622,47.5868638 29.4960833,47.5868638 C21.6960582,47.5868638 15.0758763,42.4415991 12.7159637,35.3297782 L12.3700541,35.3591501 L3.26524241,42.4054492 L3.14617358,42.736447 C7.9965904,52.3717589 17.959737,58.9921667 29.4960833,58.9921667" fill="#34A853"></path>
                           <path d="M12.7159637,35.3297782 C12.0932812,33.4944915 11.7329116,31.5279353 11.7329116,29.4960833 C11.7329116,27.4640054 12.0932812,25.4976752 12.6832029,23.6623884 L12.6667095,23.2715173 L3.44779955,16.1120237 L3.14617358,16.2554937 C1.14708246,20.2539019 0,24.7439491 0,29.4960833 C0,34.2482175 1.14708246,38.7380388 3.14617358,42.736447 L12.7159637,35.3297782" fill="#FBBC05"></path>
                           <path d="M29.4960833,11.4050769 C35.0347044,11.4050769 38.7707997,13.7975244 40.9011602,15.7968415 L49.2255853,7.66898166 C44.1130815,2.91684746 37.4599129,0 29.4960833,0 C17.959737,0 7.9965904,6.62018183 3.14617358,16.2554937 L12.6832029,23.6623884 C15.0758763,16.5505675 21.6960582,11.4050769 29.4960833,11.4050769" fill="#EB4335"></path>
                        </g>
                     </g>
                  </svg>
               </a>
            </div>
            
         </div>
        </div>
     </div>
</div>
@endsection
@section('script')
    <script>

        $(document).ready(function() {       

            $(".tipo_cadastro").click(function(){

               var tipo = $(this).val();
               $(".alert-atividade").addClass("d-none");

               if(tipo == "guia"){
                  $(".box-cadastur").removeClass("d-none");
               }else{
                  $(".box-cadastur").addClass("d-none");
               }

            });

            $(".btn-cadastrar").click(function(){

               var tipo = $('input[name="tipo_cadastro"]:checked').val();

               if(!tipo){
                  $(".alert-atividade").removeClass("d-none");
                  return false;
               }
            });
         });
    </script>
@endsection