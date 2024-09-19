@extends('layouts.site')
@section('content')
    @include('layouts/partes/header')
    <section class="pt-1 pb-0 mt-3 mb-5">
        <div class="container">
           <div class="row mb-2">
              <div class="col-md-12">
                 <h3 class="text-dark"><i class="fa fa-tachometer" aria-hidden="true"></i> Índice de Experiência em Trilhas</h3>
                 <p>O índice de experiência em trilhas foi criado com base na observação de participantes de atividades em trilhas e os fatores que impactavam em seu desempenho 
                    e em uma boa experiência na realização destas atividades.
                 </p>
                 <p>Para seu cálculo, foram autilizados critérios físicos dos praticantes, seu condicionamento físico e sua experiência em trilhas. 
                    Para cada grupo de critérios, foram especificados níveis de pontuação para compor um valor final para o íncide de experiência.
                </p>
                <p>Os critérios e níveis são pontuados de acordo com a tabela abaixo:</p>
              </div>
            </div>
            <div class="row">
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
                                    <td class="center">135</td>
                                    <td rowspan="6">150</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Peso Normal</td>
                                    <td class="center">150</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Sobrepeso</td>
                                    <td class="center">135</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Obesidade Grau I</td>
                                    <td class="center">120</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Obesidade Grau II</td>
                                    <td class="center">100</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Obesidade Grau III</td>
                                    <td class="center">80</td>
                                </tr>
                            
                                <tr>
                                    <td rowspan="4">Corrida ou Caminhada</td>
                                    <td>Não</td>
                                    <td class="center">0</td>
                                    <td rowspan="4">100</td>
                                </tr>
                                <tr>
                                    <td>Sim, somente uma vez por semana</td>
                                    <td class="center">50</td>
                                </tr>
                                <tr>
                                    <td>Sim, até três vezes por semana</td>
                                    <td class="center">80</td>
                                </tr>
                                <tr>
                                    <td>Sim, mais de três vezes por semana</td>
                                    <td class="center">100</td>
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
                                    <td rowspan="2">100</td>
                                </tr>
                                <tr>
                                    <td>Sim</td>
                                    <td class="center">100</td>
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
                                    <td rowspan="2">100</td>
                                </tr>
                                <tr>
                                    <td>Sim</td>
                                    <td class="center">100</td>
                                </tr>
                            
                                <tr class="zebra">
                                    <td rowspan="4">Distância Percurso</td>
                                    <td>Já fez trilhas de até 3km?</td>
                                    <td class="center">100</td>
                                    <td rowspan="4">200</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Já fez trilhas de até 5km?</td>
                                    <td class="center">120</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Já fez trilhas de até 10km?</td>
                                    <td class="center">150</td>
                                </tr>
                                <tr class="zebra">
                                    <td>Já fez trilhas superiores a 10km?</td>
                                    <td class="center">200</td>
                                </tr>
                            
                                <tr>
                                    <td rowspan="4">Elevação</td>
                                    <td>Já fez trilhas com elevação de até 300 metros?</td>
                                    <td class="center">100</td>
                                    <td rowspan="4">200</td>
                                </tr>
                                <tr>
                                    <td>Já fez trilhas com elevação de até 500 metros?</td>
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
                    <p>De acordo com o somatório da pontuação parcial obtida em cada nível é calculada a pontuação final do trilheiro e determinado a categoria, de acordo com a tabela abaixo: </p>
               </div>

               <div class="col-md-12 mb-md-0 mt-2">
                <div class="table-responsive">
                    <table class="table align-items-center tabela-niveis mb-0">
                        <thead>
                           <tr>
                              <th class="text-left text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Critérios</th>
                              <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Iniciante</th>
                              <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Intermediário</th>
                              <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Avançado</th>
                              <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Profissional</th>
                              <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Especialista</th>
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
                              <td>280</td>
                              <td>410</td>
                              <td>810</td>
                              <td>935</td>
                              <td>1000</td>
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