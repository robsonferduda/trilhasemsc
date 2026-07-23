@extends('layouts.site')
@section('pageTitle', 'Índice de Experiência em Trilhas | Trilhas em Santa Catarina')
@section('description', 'Entenda o Índice de Experiência em Trilhas (IET): critérios de pontuação e as categorias Iniciante, Aventureiro, Explorador, Montanhista e Expedicionário.')
@section('content')
    @include('layouts/partes/header')
    <section class="pt-1 pb-0 mt-3 mb-5">
        <div class="container">
           <div class="row mb-2">
              <div class="col-md-12">
                 <h1 class="h3 text-dark"><i class="fa fa-tachometer" aria-hidden="true"></i> Índice de Experiência em Trilhas</h1>
                 <p>O índice de experiência em trilhas foi criado com base na observação de participantes de atividades em trilhas e os fatores que impactavam em seu desempenho 
                    e em uma boa experiência na realização destas atividades.
                 </p>
                 <p>Para seu cálculo, foram utilizados critérios físicos dos praticantes, seu condicionamento físico e sua experiência em trilhas. 
                    Para cada grupo de critérios, foram especificados níveis de pontuação para compor um valor final para o índice de experiência.
                </p>
              </div>
            </div>

            @if(isset($indices) && $indices->count())
            <div class="row mb-2">
                <div class="col-md-12">
                    <h2 class="h4 text-dark mb-2">Conheça os níveis do Índice</h2>
                    <p class="text-secondary mb-4">
                        Cada trilheiro recebe uma classificação com base no questionário de experiência.
                        Confira abaixo o significado de cada nível:
                    </p>
                </div>
            </div>
            <div class="row mb-5">
                @foreach($indices as $indice)
                    <div class="col-12 mb-3">
                        <div class="d-flex flex-column flex-sm-row align-items-start border rounded p-3 p-md-4 h-100"
                             style="background:#fff; box-shadow:0 2px 10px rgba(0,0,0,.05); gap:1rem;">
                            @if($indice->img_indice_ind)
                                <div class="flex-shrink-0 text-center" style="min-width:88px;">
                                    <img src="{{ asset('img/nivel/'.$indice->img_indice_ind) }}"
                                         alt="{{ $indice->ds_indice_ind }}"
                                         style="width:80px; height:auto;">
                                </div>
                            @endif
                            <div class="flex-grow-1">
                                <div class="d-flex flex-wrap align-items-center mb-2" style="gap:.5rem;">
                                    @if($indice->ds_sigla_ind)
                                        <span class="badge badge-info">{{ $indice->ds_sigla_ind }}</span>
                                    @endif
                                    <h3 class="h4 mb-0">{{ $indice->ds_indice_ind }}</h3>
                                </div>
                                @if($indice->descricao_ind)
                                    <p class="mb-0 text-secondary" style="line-height:1.65;">{{ $indice->descricao_ind }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <div class="border rounded p-3 p-md-4" style="background:#f8faf8;">
                        <p class="mb-2"><strong>Quer descobrir o seu nível?</strong></p>
                        <p class="mb-3 text-secondary">
                            Responda o questionário na área do trilheiro e veja seu Índice de Experiência em Trilhas.
                        </p>
                        @auth
                            @if(trim(Auth::user()->id_role) == 'TRILHEIRO')
                                <a href="{{ url('trilheiro/privado/meu-nivel') }}" class="btn btn-success btn-sm">
                                    Responder questionário
                                </a>
                            @else
                                <a href="{{ url('login') }}" class="btn btn-outline-success btn-sm">Acessar minha conta</a>
                            @endif
                        @else
                            <a href="{{ url('login') }}" class="btn btn-success btn-sm">Entrar / Cadastrar</a>
                        @endauth
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-md-12 mb-2">
                    <h2 class="h5 text-dark">Como a pontuação é calculada</h2>
                    <p>Os critérios e níveis são pontuados de acordo com a tabela abaixo:</p>
                </div>
                <div class="col-md-12 mb-md-0 mt-2">
                    <div class="table-responsive">
                            <table class="table align-items-center tabela-criterios mb-0">
                                <thead>
                                <tr>
                                    <th class="text-left text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Grupo</th>
                                    <th class="text-left text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Critério</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Pontuação</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Máximo</th>
                                </tr>
                                <tr class="zebra">
                                    <td rowspan="6">IMC</td>
                                    <td>Abaixo do Peso</td>
                                    <td class="center">85</td>
                                    <td rowspan="6">100</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Peso Normal</td>
                                    <td class="center">100</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Sobrepeso</td>
                                    <td class="center">85</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Obesidade Grau I</td>
                                    <td class="center">75</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Obesidade Grau II</td>
                                    <td class="center">60</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Obesidade Grau III</td>
                                    <td class="center">40</td>
                                </tr>
                            
                                <tr>
                                    <td rowspan="4">Corrida ou Caminhada</td>
                                    <td>Não</td>
                                    <td class="center">0</td>
                                    <td rowspan="4">50</td>
                                </tr>
                                <tr>
                                    <td>Sim, somente uma vez por semana</td>
                                    <td class="center">15</td>
                                </tr>
                                <tr>
                                    <td>Sim, até três vezes por semana</td>
                                    <td class="center">30</td>
                                </tr>
                                <tr>
                                    <td>Sim, mais de três vezes por semana</td>
                                    <td class="center">50</td>
                                </tr>
                            
                                <tr class="zebra">
                                    <td rowspan="4">Distância</td>
                                    <td>0 km</td>
                                    <td class="center">0</td>
                                    <td rowspan="4">60</td>
                                </tr>
                                <tr class="zebra">
                                    <td>5 km</td>
                                    <td class="center">20</td>
                                </tr>
                                <tr class="zebra">
                                    <td>10 km</td>
                                    <td class="center">40</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Mais de 10 km</td>
                                    <td class="center">60</td>
                                </tr>
                            
                                <tr>
                                    <td rowspan="2">Musculação</td>
                                    <td>Não</td>
                                    <td class="center">0</td>
                                    <td rowspan="2">40</td>
                                </tr>
                                <tr>
                                    <td>Sim</td>
                                    <td class="center">40</td>
                                </tr>
                            
                                <tr class="zebra">
                                    <td rowspan="2">Trilhas na Areia</td>
                                    <td>Não</td>
                                    <td class="center">0</td>
                                    <td rowspan="2">30</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Sim</td>
                                    <td class="center">30</td>
                                </tr>
                            
                                <tr>
                                    <td rowspan="2">Travessias em Rio</td>
                                    <td>Não</td>
                                    <td class="center">0</td>
                                    <td rowspan="2">30</td>
                                </tr>
                                <tr>
                                    <td>Sim</td>
                                    <td class="center">30</td>
                                </tr>
                            
                                <tr class="zebra">
                                    <td rowspan="2">Medo/Fobia de Altura</td>
                                    <td>Não</td>
                                    <td class="center">30</td>
                                    <td rowspan="2">30</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Sim</td>
                                    <td class="center">0</td>
                                </tr>
                            
                                <tr>
                                    <td rowspan="2">Experiência em Trekking</td>
                                    <td>Não</td>
                                    <td class="center">0</td>
                                    <td rowspan="2">60</td>
                                </tr>
                                <tr>
                                    <td>Sim</td>
                                    <td class="center">60</td>
                                </tr>

                                <tr class="zebra">
                                    <td rowspan="2">Experiência em Hiking</td>
                                    <td>Não</td>
                                    <td class="center">0</td>
                                    <td rowspan="2">40</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Sim</td>
                                    <td class="center">40</td>
                                </tr>
                            
                                <tr>
                                    <td rowspan="3">Costões Rochosos</td>
                                    <td>Nenhuma experiência</td>
                                    <td class="center">0</td>
                                    <td rowspan="3">60</td>
                                </tr>
                                <tr>
                                    <td>Já caminhou com cautela, trechos curtos</td>
                                    <td class="center">60</td>
                                </tr>
                                <tr>
                                    <td>Costões longos, molhados ou expostos</td>
                                    <td class="center">60</td>
                                </tr>

                                <tr>
                                    <td rowspan="2">Via Ferrata / Escalada</td>
                                    <td>Não</td>
                                    <td class="center">0</td>
                                    <td rowspan="2">50</td>
                                </tr>
                                <tr>
                                    <td>Sim</td>
                                    <td class="center">50</td>
                                </tr>

                                <tr>
                                    <td rowspan="2">Acampamento / Bivaque</td>
                                    <td>Não</td>
                                    <td class="center">0</td>
                                    <td rowspan="2">50</td>
                                </tr>
                                <tr>
                                    <td>Sim</td>
                                    <td class="center">50</td>
                                </tr>

                                <tr class="zebra">
                                    <td rowspan="6">Distância Percurso</td>
                                    <td>Já fez trilhas de até 3km?</td>
                                    <td class="center">50</td>
                                    <td rowspan="6">200</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Já fez trilhas de até 5km?</td>
                                    <td class="center">100</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Já fez trilhas de até 10km?</td>
                                    <td class="center">130</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Já fez trilhas de até 15km?</td>
                                    <td class="center">170</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Já fez trilhas de até 20km?</td>
                                    <td class="center">180</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Já fez trilhas superiores a 20km?</td>
                                    <td class="center">200</td>
                                </tr>
                            
                                <tr>
                                    <td rowspan="5">Elevação</td>
                                    <td>Já fez trilhas com elevação de até 300 metros?</td>
                                    <td class="center">80</td>
                                    <td rowspan="5">200</td>
                                </tr>
                                <tr>
                                    <td>Já fez trilhas com elevação de até 500 metros?</td>
                                    <td class="center">100</td>
                                </tr>
                                <tr>
                                    <td>Já fez trilhas com elevação de até 800 metros?</td>
                                    <td class="center">120</td>
                                </tr>
                                <tr>
                                    <td>Já fez trilhas com elevação de até 1000 metros?</td>
                                    <td class="center">150</td>
                                </tr>
                                <tr>
                                    <td>Já fez trilhas com elevação superior a 1000 metros?</td>
                                    <td class="center">200</td>
                                </tr>
                                
                                <tr class="zebra">
                                    <td colspan="3"><strong>TOTAL</strong></td>
                                    <td class="center"><strong>1000</strong></td>
                                </tr>
                            </table>
                        
                    </div>
               </div>
               <div class="col-md-12 mb-md-0 mb-4 mt-4">
                    <p>De acordo com o somatório da pontuação parcial obtida em cada nível é calculada a pontuação final do trilheiro e determinada a categoria, de acordo com a tabela abaixo:</p>
               </div>

               <div class="col-md-12 mb-md-0 mt-2">
                <div class="table-responsive">
                    <table class="table align-items-center tabela-niveis mb-0">
                        <thead>
                           <tr>
                              <th class="text-left text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Critérios</th>
                              <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Iniciante<br><small>IE-1</small></th>
                              <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Aventureiro<br><small>IE-2</small></th>
                              <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Explorador<br><small>IE-3</small></th>
                              <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Montanhista<br><small>IE-4</small></th>
                              <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Expedicionário<br><small>IE-5</small></th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>IMC</td>
                              <td>80</td>
                              <td>100</td>
                              <td>120</td>
                              <td>135</td>
                              <td>150</td>
                           </tr>
                           <tr>
                              <td>Corrida</td>
                              <td>0</td>
                              <td>50</td>
                              <td>80</td>
                              <td>100</td>
                              <td>100</td>
                           </tr>
                           <tr>
                              <td>Distância</td>
                              <td>0</td>
                              <td>20</td>
                              <td>40</td>
                              <td>30</td>
                              <td>60</td>
                           </tr>
                           <tr>
                              <td>Musculação</td>
                              <td>0</td>
                              <td>0</td>
                              <td>100</td>
                              <td>100</td>
                              <td>100</td>
                           </tr>
                           <tr>
                              <td>Areia</td>
                              <td>0</td>
                              <td>0</td>
                              <td>30</td>
                              <td>30</td>
                              <td>30</td>
                           </tr>
                           <tr>
                              <td>Travessia Rio</td>
                              <td>0</td>
                              <td>0</td>
                              <td>30</td>
                              <td>30</td>
                              <td>30</td>
                           </tr>
                           <tr>
                              <td>Fobia</td>
                              <td>0</td>
                              <td>0</td>
                              <td>30</td>
                              <td>30</td>
                              <td>30</td>
                           </tr>
                           <tr>
                              <td>Trekking</td>
                              <td>0</td>
                              <td>0</td>
                              <td>80</td>
                              <td>80</td>
                              <td>100</td>
                           </tr>
                           <tr>
                              <td>Distância</td>
                              <td>100</td>
                              <td>120</td>
                              <td>150</td>
                              <td>200</td>
                              <td>200</td>
                           </tr>
                           <tr>
                              <td>Elevação</td>
                              <td>100</td>
                              <td>120</td>
                              <td>150</td>
                              <td>200</td>
                              <td>200</td>
                           </tr>
                           <tr class="pontuacao">
                              <td>Pontuação Mínima</td>
                              <td>—</td>
                              <td>580</td>
                              <td>665</td>
                              <td>785</td>
                              <td>945</td>
                           </tr>
                        </tbody>
                     </table>
                </div>
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
