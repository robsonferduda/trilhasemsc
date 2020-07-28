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
                        <h4 class="center"><strong>Guia de Classificação de Dificuldade em Trilhas - ABNT NBR 15505-2</strong></h4>
                    </div>  
                    <div class="col-md-12">
                        <p>
                            A norma estabelece critérios referentes à classificação de percursos utilizados em caminhadas sem pernoite quanto às suas características de severidade. São apresentados critérios com escala de intensidade crescente que determinam o grau em cada um deles. A classificação é composta por quatro critérios: severidade do meio, orientação do percurso, condições do terreno e intensidade do esforço físico. 
                        </p>
                        <h5><strong>Severidade do Meio</strong></h5>
                        <p>
                            Refere-se aos perigos e outras dificuldades decorrentes do meio natural, como temperatura, pluviosidade, riscos de quedas, facilidade de resgate, entre outros, que podem ser encontrados ao longo do percurso. A classificação para este critério deve ser efetuada contando-se o número de ocorrências dos fatores listados abaixo, de forma cumulativa.
                        </p>
                        <p>
                            <ul>
                                <li>
                                    a) exposição a desprendimentos espontâneos de pedras durante o percurso;
                                </li>
                                <li>
                                    b) exposição a desprendimentos de pedras provocados pelo próprio grupo ou outro durante o percurso;
                                </li>
                                <li>
                                    c) eventualidade de queda no vazio ou por um declive acentuado;
                                </li>
                                <li>
                                    d) existência de passagens onde seja necessário o uso das mãos para progredir no percurso;
                                </li>
                                <li>
                                    e) exposição a trechos permanentemente escorregadios, pedregosos ou alagados durante o percurso;
                                </li>
                                <li>
                                    f) exposição a trechos escorregadios ou alagados devido às chuvas durante o percurso;
                                </li>
                                <li>
                                    g) travessia de rios ou outros corpos d’água com correnteza, a vau (sem ponte);
                                </li>
                                <li>
                                    h) alta probabilidade de chuvas intensas ou contínuas para o período;
                                </li>
                                <li>
                                    i) alta probabilidade de que pela noite a temperatura caia abaixo de 0 °C;
                                </li>
                                <li>
                                    j) alta probabilidade de que a temperatura caia abaixo de 5 °C e a umidade relativa do ar supere os 90 %;
                                </li>
                                <li>
                                    k) alta probabilidade de exposição a ventos fortes ou frios;
                                </li>
                                <li>
                                    l) alta probabilidade de que a umidade relativa do ar seja inferior aos 30 %;
                                </li>
                                <li>
                                    m) alta probabilidade de exposição ao calor em temperatura acima de 32 °C;
                                </li>
                                <li>
                                    n) longos trechos de exposição ao sol forte;
                                </li>
                                <li>
                                    o) tempo de realização da atividade igual ou superior a 1 h de marcha sem passar por um lugar habitado,
                                    um telefone de socorro (ou sinal de celular ou radiocomunicador) ou uma estrada aberta com fluxo de
                                    veículos;
                                </li>
                                <li>
                                    p) tempo de realização da atividade igual ou superior a 3 h de marcha sem passar por um lugar habitado,
                                    um telefone de socorro (ou sinal de celular ou radiocomunicador) ou uma estrada aberta com fluxo de
                                    veículos;
                                </li>
                                <li>
                                    q) a diferença entre o tempo necessário para completar o percurso e a quantidade de horas restantes de luz
                                    natural ao fim do dia (disponível na época do ano considerada) é menor que 3 h;
                                </li>
                                <li>
                                    r) eventual diminuição da visibilidade por fenômenos atmosféricos que possa aumentar consideravelmente
                                    a dificuldade de orientação ou a localização de pessoas em algum trecho do percurso;
                                </li>
                                <li>
                                    s) trajeto por vegetação densa ou por terreno irregular que possa dificultar a orientação ou a localização de
                                    pessoas em algum trecho do percurso;
                                </li>
                                <li>
                                    t) região ou trechos sem acesso a água potável.
                                </li>
                            </ul>
                        </p>
                        <h5><strong>Orientação no percurso</strong></h5>
                        <p>
                            Refere-se ao grau de dificuldade para orientação, como presença de sinalização, trilhas bem marcadas, presença de pontos de referência, entre outros, para completar o percurso.
                        </p>
                        <h5><strong>Condições do Terreno</strong></h5>
                        <p>
                            Condições do terreno: refere-se aos aspectos encontrados no percurso em relação ao piso e às condições para percorrê-lo, como tipos de pisos, trechos com obstáculos, trechos com pedras soltas, entre outros.
                        </p>
                        <h5><strong>Intensidade do Esforço Físico</strong></h5>
                        <p>
                            Intensidade de esforço físico: refere-se à quantidade de esforço físico requerido para cumprir o percurso, levando em conta extensão e desníveis (subidas e descidas), considerando um cliente comum.
                        </p>
                        <p>
                            O percurso pode ser dividido em diferentes trechos e cada trecho pode ser avaliado individualmente em cada um dos critérios em escala que varia de 1 a 5, sendo que o valor final em cada critério é definido pelo maior valor encontrado em cada trecho.
                        </p>
                        <p>
                            A tabela abaixo relaciona cada um dos critérios, sua escala e descrição de cada item:
                        </p>
                        <div class='table-responsive' style="margin-top: 25px;">
                            <h4 class="center"><strong>Tabela de referência de classificação de percursos</strong></h4>
                            <p>
                                Avalia o grau de dificuldade para o usuário manter-se orientado na trilha.
                            </p>
                            <!--Table-->
                            <table id="tablePreview" class="table">
                                <!--Table head-->
                                <thead>
                                    <tr>                            
                                        <th style="width: 20%">Critérios</th>
                                        <th style="width: 35%">Classificação</th>
                                        <th style="width: 35%">Descrição</th>
                                        <th style="min-width: 90px"></th>                       
                                    </tr>
                                </thead>
                                <!--Table head-->
                                <!--Table body-->
                                <tbody>
                                    <tr>                            
                                        <th rowspan="5" scope="row" style="vertical-align: middle;">Severidade do Meio</th>                  
                                        <td style="vertical-align: middle;">
                                            1 Pouco severo 
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            Até 3 fatores
                                        </td> 
                                        <td rowspan="5" style="text-align: center; vertical-align: middle;">
                                            <img style="height: 50%" src="{{ asset('img/trilhas/dificuldade/abnt/severidade-do-meio.png') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            2 Moderadamente severo
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            4 ou 5 fatores
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            3 Severo 
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            6 a 8 fatores
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            4 Bastante severo  
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            9 a 12 fatores
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            5 Muito severo
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            Pelo menos 13 fatores
                                        </td> 
                                    </tr>
                                    <tr>
                                        <th rowspan="5" scope="row" style="vertical-align: middle;">Orientação no Percurso</th>                
                                        <td style="vertical-align: middle;">
                                            1 Caminhos e cruzamentos bem definidos
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            Caminhos principais bem delimitados ou sinalizados, com cruzamentos claros com indicação explícita ou implícita. Manter-se sobre o caminho não exige esforço de identificação do traçado. Eventualmente, pode ser necessário acompanhar uma linha marcada por um acidente geográfico inconfundível (por exemplo, uma praia ou uma margem de um lago)
                                        </td> 
                                        <td rowspan="5" style="text-align: center; vertical-align: middle;">
                                            <img style="height: 50%" src="{{ asset('img/trilhas/dificuldade/abnt/orientacao-do-percurso.png') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            2 Caminho ou sinalização que indica a continuidade
                                        </td> 
                                        <td style="vertical-align: middle;">
                                             Existe um traçado claro do caminho sobre o terreno ou sinalização para a continuidade do percurso. Requer atenção para a continuidade e o cruzamento de outros traçados, mas sem necessidade de uma interpretação precisa dos acidentes geográficos. Esta condição se aplica à maioria dos caminhos sinalizados que utilizam, em um mesmo percurso, distintos tipos de caminhos com numerosos cruzamentos como, por exemplo, trilhos de veículos automotores, trilhas para pedestres, caminhos para montaria, campos assinalados por marcos (bem localizados e bem mantidos)
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            3 Exige a identificação de acidentes geográficos e de pontos cardeais
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            Ainda que o itinerário se desenvolva por traçado sobre trilhas, percursos marcados por acidentes geográficos (rios, fundos de vales, costas, cristas, costões de pedras, entre outros) ou marcas de passagem de outras pessoas, a escolha do itinerário adequado depende do reconhecimento dos acidentes geográficos e dos pontos cardeais
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            4 Exige habilidades de navegação fora do traçado  
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            Não existe traçado sobre o terreno, nem segurança de contar com pontos de referência no horizonte. O itinerário depende da compreensão do terreno e do traçado de rumos
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            5 Exige navegação para utilizar trajetos alternativos e não conhecidos previamente
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            O itinerário depende da compreensão do terreno e do traçado de rotas, além de exigir capacidade de navegação para completar o percurso. Os rumos do itinerário podem ser interrompidos inesperadamente por obstáculos que necessitem ser contornados
                                        </td> 
                                    </tr>
                                    <tr>                            
                                        <th rowspan="5"  scope="row" style="vertical-align: middle; ">Condições do Terreno</th>                
                                        <td style="vertical-align: middle;">
                                            1 Percurso em superfícies planas 
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            Estradas e pistas para veículos, independentemente da sua inclinação. Caminhos com degraus com piso plano e regular. Praias (de areia ou de cascalho) com piso nivelado e firme
                                        </td> 
                                        <td rowspan="5"  style="text-align: center; vertical-align: middle;">
                                            <img style="height: 50%" src="{{ asset('img/trilhas/dificuldade/abnt/condicoes-do-terreno.png') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            2 Percurso por caminhos sem obstáculos
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            Caminhos por diversos terrenos firmes, mas que mantenham a regularidade do piso, trilhas bem marcadas que não apresentem grandes inclinações nem obstáculos que requeiram grande esforço físico para serem ultrapassados. Percursos através de terrenos uniformes como campos e pastagens não muito inclinados
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            3 Percurso por trilhas escalonadas ou terrenos irregulares  
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            Percurso por trilhas com obstáculos ou degraus irregulares, de tamanho, altura e inclinação diferentes. Percurso fora de trilhas e por terrenos irregulares. Travessias de áreas pedregosas ou com afloramentos rochosos (lajes de pedras). Trechos de pedras soltas, pedreiras instáveis, raízes muito expostas, areões ou grandes erosões
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            4 Percurso com obstáculos 
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            Caminhos com obstáculos que podem exigir saltos ou a utilização das mãos até I Sup. (graduação UIAA para escalada ou progressão vertical)
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            5 Percurso que requer técnicas verticais
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            Trechos que exigem técnicas de escalada do grau II até III Sup. (graduação UIAA para escalada ou progressão vertical). Exige a utilização de equipamentos e técnicas específicas
                                        </td> 
                                    </tr>
                                    <tr>                            
                                        <th rowspan="5"  scope="row" style="vertical-align: middle;">Intensidade de Esforço Físico</th>            
                                        <td style="vertical-align: middle;">
                                            1 Pouco esforço 
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            Até 1 hora de caminhada
                                        </td> 
                                        <td rowspan="5" style="text-align: center; vertical-align: middle;">
                                            <img style="height: 50%" src="{{ asset('img/trilhas/dificuldade/abnt/intensidade-de-esforco-fisico.png') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            2 Esforço moderado
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            Mais de 1 e até 3 horas de caminhada
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            3 Esforço significativo
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            Mais de 3 e até 6 horas de caminhada
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            4 Esforço intenso  
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            Mais de 6 e até 10 de caminhada
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            5 Esforço extraordinário
                                        </td> 
                                        <td style="vertical-align: middle;">
                                            Mais de 10 horas de caminhada
                                        </td> 
                                    </tr>
                                    
                                </tbody>
                                <!--Table body-->
                            </table>
                            <!--Table-->
                            <p><strong>Fonte</strong>: Adaptado de ABNT NBR 15505-2</p>
                        </div>

                        <h5><strong>Referências</strong></h5>
                        <p>
                            ASSOCIAÇÃO BRASILEIRA DE NORMAS TÉCNICAS. NBR 15505-2: Turismo com atividades de caminhada. Parte 2: Classificação de percursos. Rio de Janeiro, 2008.
                        </p>

                        <h4 class="center" style="margin-top: 50px;"><a class="link" href="{{ url('guia-de-dificuldade-em-trilhas') }}">Voltar para o Guia de Dificuldade</a>
                        </h4>                    
                    </div>                        
                </div>
            </div>
        </div>
@endsection