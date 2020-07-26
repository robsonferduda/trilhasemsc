@extends('layouts.blog')

@section('content')
<div class="blog-post-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <div class="title-border">
                        <br/><br/><h1>Guia de Dificuldade<span> em Trilhas</span></h1>
                    </div>    
                </div>
            </div>   
            <div class="col-md-12">
                <div class='table-responsive'>
                    <!--Table-->
                    <table id="tablePreview" class="table">
                        <!--Table head-->
                        <thead>
                            <tr>                            
                                <th style="width: 10%">Nível</th>
                                <th style="width: 10%">Duração</th>
                                <th style="width: 10%">Percurso</th>
                                <th style="width: 20%">Desnível</th>
                                <th style="width: 20%">Obstáculos</th>
                                <th style="width: 20%">Piso/Terreno</th>   
                                <th style="min-width: 90px"></th>                       
                            </tr>
                        </thead>
                        <!--Table head-->
                        <!--Table body-->
                        <tbody>
                            <tr>                            
                                <th scope="row" style="vertical-align: middle;">Leve</th>                     
                                <td style="vertical-align: middle;">Até 1 hora</td>
                                <td style="vertical-align: middle;">Até 3 km</td>
                                <td style="vertical-align: middle;">até 200 metros (+) e até 400 (-) </td>
                                <td style="vertical-align: middle;">Poucos e simples obstáculos</td>
                                <td style="vertical-align: middle;">Piso regular</td>
                                <td>
                                    <img style="height: 35%" src="{{ asset('img/trilhas/dificuldade/femerj/esforco-fisico-leve.png') }}">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="vertical-align: middle;">Leve Superior</th>                
                                <td style="vertical-align: middle;">De 1 até 2 horas</td>
                                <td style="vertical-align: middle;">Até 6 km</td>
                                <td style="vertical-align: middle;">acima de 200 até 400 metros (+) e acima de 400 até 600 metros (-)</td>
                                <td style="vertical-align: middle;">Pode ter pequenos obstáculos</td>
                                <td style="vertical-align: middle;">Piso ligeiramente irregular</td>
                                <td>
                                    <img style="height: 35%" src="{{ asset('img/trilhas/dificuldade/femerj/esforco-fisico-leve-superior.png') }}">
                                </td>
                            </tr>
                            <tr>                            
                                <th scope="row" style="vertical-align: middle;">Moderada</th>                     
                                <td style="vertical-align: middle;">De 2 até 4 horas</td>
                                <td style="vertical-align: middle;">Até 12 km</td>
                                <td style="vertical-align: middle;">acima de 400 até 600 metros (+) e acima</td>
                                <td style="vertical-align: middle;">Com obstáculos</td>
                                <td style="vertical-align: middle;">Piso irregular</td>
                                <td>
                                    <img style="height: 35%" src="{{ asset('img/trilhas/dificuldade/femerj/esforco-fisico-moderada.png') }}">
                                </td>
                            </tr>
                            <tr>                            
                                <th scope="row" style="vertical-align: middle;">Moderada Superior</th>                     
                                <td style="vertical-align: middle;">De 4 e 6 horas</td>
                                <td style="vertical-align: middle;">Até 18 km</td>
                                <td style="vertical-align: middle;">acima de 600 até 800 metros (+) e acima de 800 até 1200 metros (-)</td>
                                <td style="vertical-align: middle;">Muitos obstáculos</td>
                                <td style="vertical-align: middle;">Piso irregular e lugares onde é necessário usar as mãos para manter o equilíbrio e/ou ascender</td>
                                <td>
                                    <img style="height: 35%" src="{{ asset('img/trilhas/dificuldade/femerj/esforco-fisico-moderada-superior.png') }}">
                                </td>
                            </tr>
                            <tr>                            
                                <th scope="row" style="vertical-align: middle;">Pesada</th>                     
                                <td style="vertical-align: middle;">De 6 até 8 horas</td>
                                <td style="vertical-align: middle;">Até 24 km</td>
                                <td style="vertical-align: middle;">acima de 800 até 1200 metros (+) e acima de 1200 até 2000 metros (-)</td>
                                <td style="vertical-align: middle;">Com muitos ou grandes obstáculos</td>
                                <td style="vertical-align: middle;">Piso irregular e lugares onde é necessário usar as mãos para manter o equilíbrio e/ou ascender</td>
                                <td>
                                    <img style="height: 35%" src="{{ asset('img/trilhas/dificuldade/femerj/esforco-fisico-pesada.png') }}">
                                </td>
                            </tr>
                            <tr>                            
                                <th scope="row" style="vertical-align: middle;">Pesada Superior</th>                     
                                <td style="vertical-align: middle;">De 8 até 12 horas</td>
                                <td style="vertical-align: middle;">Até 36 km</td>
                                <td style="vertical-align: middle;">acima de 1200 até 2000 metros (+) e acima de 2000 até 2600 metros (-)</td>
                                <td style="vertical-align: middle;">Com muitos ou grandes obstáculos</td>
                                <td style="vertical-align: middle;">Piso irregular e lugares onde é necessário usar as mãos para manter o equilíbrio e/ou ascender</td>
                                <td>
                                    <img style="height: 35%" src="{{ asset('img/trilhas/dificuldade/femerj/esforco-fisico-pesada-superior.png') }}">
                                </td>
                            </tr>
                            <tr>                            
                                <th scope="row" style="vertical-align: middle;">Extra Pesada</th>                     
                                <td style="vertical-align: middle;">Mais de 12 horas</td>
                                <td style="vertical-align: middle;">A partir de 36 km</td>
                                <td style="vertical-align: middle;">acima de 2000 metros (+) e acima de 2600 metros (-)</td>
                                <td style="vertical-align: middle;">Com muitos ou grandes obstáculos</td>
                                <td style="vertical-align: middle;"></td>
                                <td>
                                    <img style="height: 35%" src="{{ asset('img/trilhas/dificuldade/femerj/esforco-fisico-extra-pesada.png') }}">
                                </td>
                            </tr>
                            <tr>                            
                                <th scope="row" style="vertical-align: middle;">Longo Curso</th>                     
                                <td style="vertical-align: middle;">Vários dias</td>
                                <td style="vertical-align: middle;">Normalmente mais de 50 km</td>
                                <td style="vertical-align: middle;">acima de 2000 metros (+) e acima de 2600 metros (-)</td>
                                <td style="vertical-align: middle;">Essa classificação não está relacionada diretamente as dificuldades ou obstáculos existentes nessa trilha, que podem sim ser muitos, mas está mais relacionado com o comprimento da mesma</td>
                                <td style="vertical-align: middle;">Variado</td>
                                <td>
                                    <img style="height: 35%" src="{{ asset('img/trilhas/dificuldade/femerj/longo-curso.png') }}">
                                </td>
                            </tr>
                        </tbody>
                        <!--Table body-->
                    </table>
                    <!--Table-->
                </div>

                <div class='table-responsive'>
                    <!--Table-->
                    <table id="tablePreview" class="table">
                        <!--Table head-->
                        <thead>
                            <tr>                            
                                <th style="width: 20%">Grau de Exposição</th>
                                <th style="width: 70%">Descrição</th>
                                <th style="min-width: 90px"></th>                       
                            </tr>
                        </thead>
                        <!--Table head-->
                        <!--Table body-->
                        <tbody>
                            <tr>                            
                                <th scope="row" style="vertical-align: middle;">Pequeno</th>                  <td style="vertical-align: middle;">Probabilidade de pequenas lesões, no máximo casos de primeiros socorros ou tratamento médico menor. Probabilidade baixa de acidentes graves</td>                           
                                <td style="text-align: center;">
                                    <img style="height: 50%" src="{{ asset('img/trilhas/dificuldade/femerj/exposicao-ao-risco-pequeno.png') }}">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="vertical-align: middle;">Moderado</th>                
                                <td style="vertical-align: middle;">Probabilidade de lesões médias e tratamento médico. Probabilidade pequena de acidentes graves</td>
                                <td style="text-align: center;">
                                    <img style="height: 50%" src="{{ asset('img/trilhas/dificuldade/femerj/exposicao-ao-risco-moderado.png') }}">
                                </td>
                            </tr>
                            <tr>                            
                                <th scope="row" style="vertical-align: middle;">Severo</th>                
                                <td style="vertical-align: middle;">Probabilidade média de lesões de gravidade moderada a alta</td>
                                <td style="text-align: center;">
                                    <img style="height: 50%" src="{{ asset('img/trilhas/dificuldade/femerj/exposicao-ao-risco-severo.png') }}">
                                </td>
                            </tr>
                            <tr>                            
                                <th scope="row" style="vertical-align: middle;">Crítico</th>                
                                <td style="vertical-align: middle;">Probabilidade alta de lesões graves ou morte caso o evento de risco aconteça</td>
                                <td style="text-align: center;">
                                    <img style="height: 50%" src="{{ asset('img/trilhas/dificuldade/femerj/exposicao-ao-risco-critico.png') }}">
                                </td>
                            </tr>
                            
                        </tbody>
                        <!--Table body-->
                    </table>
                    <!--Table-->
                </div>

            </div>                       
        </div>
    </div>
</div>
@endsection