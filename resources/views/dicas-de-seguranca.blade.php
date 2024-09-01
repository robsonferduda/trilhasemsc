@extends('layouts.site')
@section('content')
    @include('layouts/partes/header')
    <section class="pt-1 pb-0 mt-3 mb-5">
        <div class="container">
           <div class="row mb-2">
              <div class="col-md-7">
                 <h3 class="text-warning"><i class="fa fa-shield" aria-hidden="true"></i> Dicas de Segurança</h3>
              </div>
           </div>
           <div class="row">
               <div class="col-md-12 mb-md-0 mt-2">
                  <h3 class="mb-0"><i class="fa fa-life-bouy"></i> Cuidados básicos</h3>
                  <p class="mb-4">
                     Atividades em ambientes expostos existem cuidados básicos que são os mínimos necessários para ter conforto e evitar acidentes.
                  </p>
                  <p class="font-weight-bold"><span class="me-2">-</span> Planeja o horário de início da trilha de acordo com sua duração;</p>
                  <p class="font-weight-bold"><span class="me-2">-</span> Escolha roupas adequadas ao clima e a vegetação;</p>
                  <p class="font-weight-bold"><span class="me-2">-</span> Utilize calçados fechados, confortáveis e com proteção nos tornozelos;</p>
                  <p class="font-weight-bold mb-5"><span class="me-2">-</span> Em trilhas com muita exposição, utilize protetor solar e bonés ou chapéus;</p>
               </div>
               <div class="col-md-12 mb-md-0 mt-2">
                  <h3 class="mb-0"><i class="fa fa-cutlery"></i> Alimentação e hidradatação</h3>
                  <p class="mb-4">
                     Energia é sempre fundamental para sua aventura. Além, claro, de estar devidamente hidratado.
                  </p>
                  <p class="font-weight-bold"><span class="me-2">-</span> Leve água e alimentos para consumo durante o trajeto;</p>
                  <p class="font-weight-bold"><span class="me-2">-</span> Planeje a quantidade de água de acordo com a duração da atividade e disponibilidade de água no local;</p>
                  <p class="font-weight-bold"><span class="me-2">-</span> Ao consumir água de fontes e rios, tenha cuidado com a qualidade da água. Se possível, utilize produtos químicos para purificar a água, como o Clorin;</p>
                  <p class="font-weight-bold mb-5"><span class="me-2">-</span> Leve alimentos suficientes para repor suas energia;</p>
               </div>
               <div class="col-md-12 mb-md-0 mt-2">
                  <h3 class="mb-0"><i class="fa fa-compass"></i> Orientação</h3>
                  <p class="mb-4">
                     Um dos principais fatores que levam a acidentes em trilhas é não conhecer o trajeto e seus riscos.
                  </p>
                  <p class="font-weight-bold"><span class="me-2">-</span> Pesquise com antecedência o trajeto da trilha;</p>
                  <p class="font-weight-bold"><span class="me-2">-</span> Evite fazer trilhas sozinho em lugares desconhecidos;</p>
                  <p class="font-weight-bold"><span class="me-2">-</span> Utilize dispositivos GPS e aplicativos de navegação em trilhas, como o Wikiloc.</p>
               </div>
               <div class="col-md-12 mb-md-0 mb-4">
                  
                     <div class="row">
                       <div class="col-12 mt-1 mb-3 pt-3 mx-auto">
                         <div class="toast fade show d-flex align-items-center justify-content-between bg-gradient-primary border-0 pe-2 mx-auto w-100" role="alert" aria-live="assertive" aria-atomic="true">
                           <div class="toast-body text-white">
                              <strong>Atenção! </strong>Para evitar qualquer transtorno e ter uma aventura segura, contrate sempre um guia autorizado.
                           </div>
                           <i class="fas fa-times text-md cursor-pointer pe-2 text-white" data-bs-dismiss="toast" aria-label="Close"></i>
                         </div>
                       </div>
                     </div>
                   
               </div>
               <div class="col-lg-12 col-md-12 mt-4 center">
                  <a href="{{ url('/') }}" type="button" class="btn btn-outline-warning btn-sm">Voltar ao Início</a>
               </div>
           </div>
        </div>
     </section>    
@endsection