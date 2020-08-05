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
                <h4 class="center"><strong>Guia de Classificação de Dificuldade em Trilhas - FEMERJ</strong></h4>
            </div>   
            <div class="col-md-12">
                <p>
                    As trilhas são classificadas levando em consideração quatro parâmetros: esforço físico, exposição ao risco, orientação e insolação. Cada um desses parâmetros possui uma escala crescente de severidade. Além disso, deve ser adicionado fatores como distância da trilha, tempo de percurso e dificuldades técnicas do caminho. Listamos abaixo a definição de cada critério e a respectiva escala de severidade e sua explicação.
                </p>
                <h4 class="center"><strong>Esforço Físico</strong></h4>
                <p>
                    Avalia o nível de esforço físico necessário para cumprir o percurso em função de parâmetros específicos.
                </p>
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
                    <p><strong>Fonte</strong>: Metodologia de Classificação de Trilhas (FEMERJ, 2015)</p>
                </div>

                <div class='table-responsive'>
                    <h4 class="center"><strong>Exposição ao Risco</strong></h4>
                    <p>
                        Avalia a dificuldade do trajeto em relação ao nível e à frequência de exposição a riscos.
                    </p>
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
                    <p><strong>Fonte</strong>: Metodologia de Classificação de Trilhas (FEMERJ, 2015)</p>
                </div>

                <div class='table-responsive'>
                    <h4 class="center"><strong>Orientação</strong></h4>
                    <p>
                        Avalia o grau de dificuldade para o usuário manter-se orientado na trilha.
                    </p>
                    <!--Table-->
                    <table id="tablePreview" class="table">
                        <!--Table head-->
                        <thead>
                            <tr>                            
                                <th style="width: 20%">Nível</th>
                                <th style="width: 70%">Descrição</th>
                                <th style="min-width: 90px"></th>                       
                            </tr>
                        </thead>
                        <!--Table head-->
                        <!--Table body-->
                        <tbody>
                            <tr>                            
                                <th scope="row" style="vertical-align: middle;">Fácil</th>                  
                                <td style="vertical-align: middle;">Caminhos e cruzamentos bem definidos: normalmente são trilhas com alguma sinalização, com poucas bifurcações e com o seu leito bem definido. Esse tipo de trilha pode até não ter sinalização, mas o seu traçado não deixa dúvida para onde seguir</td>                      <td style="text-align: center;">
                                    <img style="height: 50%" src="{{ asset('img/trilhas/dificuldade/femerj/orientacao-facil.png') }}">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="vertical-align: middle;">Moderado</th>                
                                <td style="vertical-align: middle;">Trilha com pouca ou nenhuma sinalização, com algumas bifurcações mas com o seu leito ainda definido ou com poucos trechos poucos marcados</td>
                                <td style="text-align: center;">
                                    <img style="height: 50%" src="{{ asset('img/trilhas/dificuldade/femerj/orientacao-moderada.png') }}">
                                </td>
                            </tr>
                            <tr>                            
                                <th scope="row" style="vertical-align: middle;">Difícil</th>                
                                <td style="vertical-align: middle;">Trilha sem nenhuma sinalização, com muitas bifurcações que podem confundir o caminhante, passando às vezes por mata fechada ou por lajes com a trilha pouco definida. Ainda é possível identificar a calha da trilha, mesmo que em alguns trechos ela fique com o seu leito tênue. Pode requerer a identificação precisa dos acidentes geográficos (rios, fundos de vale, bordas, cumes etc.) e pontos cardeais. Requer conhecimento e habilidade para navegação terrestre por meio de mapas topográficos e bússola ou aparelho de GPS</td>
                                <td style="text-align: center;">
                                    <img style="height: 50%" src="{{ asset('img/trilhas/dificuldade/femerj/orientacao-dificil.png') }}">
                                </td>
                            </tr>
                            <tr>                            
                                <th scope="row" style="vertical-align: middle;">Muito Difícil</th>            
                                <td style="vertical-align: middle;">Trilha fechada com traçado tênue ou inexistente e na mata. Na sua maioria são trilhas de montanhas do tipo exploração ou acessos a vias de escalada remotas. Requer conhecimento e habilidade para navegação terrestre por meio de mapas topográficos e bússola ou aparelho de GPS</td>
                                <td style="text-align: center;">
                                    <img style="height: 50%" src="{{ asset('img/trilhas/dificuldade/femerj/orientacao-muito-dificil.png') }}">
                                </td>
                            </tr>
                            
                        </tbody>
                        <!--Table body-->
                    </table>
                    <!--Table-->
                    <p><strong>Fonte</strong>: Metodologia de Classificação de Trilhas (FEMERJ, 2015)</p>
                </div>

                <div class='table-responsive'>
                    <h4 class="center"><strong>Insolação</strong></h4>
                    <p>
                        Determina o percentual do percurso da trilha em que há exposição direta ao sol. Isso ajuda a determinar equipamentos de proteção contra o sol, como bonés, óculos de sol, protetor solar e também ajuda a planejar hidratação.
                    </p>
                    <!--Table-->
                    <table id="tablePreview" class="table">
                        <!--Table head-->
                        <thead>
                            <tr>                            
                                <th style="width: 20%">Nível</th>
                                <th style="width: 70%">Descrição</th>
                                <th style="min-width: 90px"></th>                       
                            </tr>
                        </thead>
                        <!--Table head-->
                        <!--Table body-->
                        <tbody>
                            <tr>                            
                                <th scope="row" style="vertical-align: middle;">Baixa</th>                  
                                <td style="vertical-align: middle;">Até 33% do caminho com exposição ao sol</td>                      <td style="text-align: center;">
                                    <img style="height: 50%" src="{{ asset('img/trilhas/dificuldade/femerj/insolacao-baixa.png') }}">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="vertical-align: middle;">Média</th>                
                                <td style="vertical-align: middle;">De 33% até 66% do caminho com exposição ao sol</td>
                                <td style="text-align: center;">
                                    <img style="height: 50%" src="{{ asset('img/trilhas/dificuldade/femerj/insolacao-media.png') }}">
                                </td>
                            </tr>
                            <tr>                            
                                <th scope="row" style="vertical-align: middle;">Alta</th>                
                                <td style="vertical-align: middle;">De 66% até 100% do caminho com exposição ao sol</td>
                                <td style="text-align: center;">
                                    <img style="height: 50%" src="{{ asset('img/trilhas/dificuldade/femerj/insolacao-alta.png') }}">
                                </td>
                            </tr>                                                        
                        </tbody>
                        <!--Table body-->
                    </table>                    
                    <!--Table-->
                    <p><strong>Fonte</strong>: Metodologia de Classificação de Trilhas (FEMERJ, 2015)</p>
                </div>
                <h4 class="center" style="margin-top: 50px;"><a class="link" href="{{ url('guia-de-dificuldade-em-trilhas') }}">Voltar para o Guia de Dificuldade</a></h4>
            </div>                       
        </div>
    </div>
</div>
@endsection