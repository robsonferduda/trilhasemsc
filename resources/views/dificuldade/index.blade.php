@extends('layouts.blog')

@section('pageTitle', 'Guia de Dificuldade em Trilhas' )
@section('description', 'Uma das principais questões quando falamos em trilha é o nível de dificuldade. E essa preocupação é essencial para evitar problemas durante o percurso e transformar uma atividade prazerosa em uma experiência ruim. Mas simplesmente perguntar sobre o grau de dificuldade para alguém que fez o convite para a trilha não resolve, pois a percepção de dificuldade pode variar de pessoa para pessoa, além de estar relacionada também ao preparo físico e experiência em percorrer trajetos em trilhas.' )

@section('content')
        <div class="blog-post-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Tela Detalhes Trilha -->
                        <ins class="adsbygoogle"
                            style="display:block"
                            data-ad-client="ca-pub-1229685353625953"
                            data-ad-slot="7739149091"
                            data-ad-format="auto"
                            data-full-width-responsive="true"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                        <div class="section-title text-center">
                            <div class="title-border">
                                <br/><br/><h1>Guia de Dificuldade<span> em Trilhas</span></h1>
                            </div>    
                        </div>
                    </div>  
                    <div class="col-md-12">
                        <p>
                            Uma das principais questões quando falamos em trilha é o nível de dificuldade. E essa preocupação é essencial para evitar problemas durante o percurso e transformar uma atividade prazerosa em uma experiência ruim. Mas simplesmente perguntar sobre o grau de dificuldade para alguém que fez o convite para a trilha não resolve, pois a percepção de dificuldade pode variar de pessoa para pessoa, além de estar relacionada também ao preparo físico e experiência em percorrer trajetos em trilhas.
                        </p>
                        <p>
                            Como o objetivo de ajudá-lo a escolher a trilha de acordo com seu preparo físico e experiência, compilamos nesse texto alguns guias para classificação de trilhas, visto que no Brasil não existe uma padronização para tal. Além de trazer diferentes abordagens, também vamos definir qual a regra utilizada para classificar as trilhas apresentadas no site. 
                        </p>
                        <p>
                            Antes de classificar as trilhas de acordo com sua dificuldade, vamos apresentar a classificação de acordo com o tipo do percurso. Conhecer o percurso da trilha é muito importante, pois ajuda a definir estratégias de onde deixar o veículo, identificar ocorrência de pontos de hidratação e se localizar em relação ao trajeto. Segundo a Federação de Esportes de Montanha no Estado do Rio de Janeiro (FEMERJ), podemos classificar as trilhas em 3 categorias: trilhas, circuitos e travessias.
                        </p>
                        <div class='table-responsive'>
                            <h4 class="center" style="margin-top: 25px;">Tipos de Trilhas</h4>
                            <!--Table-->
                            <table id="tablePreview" class="table">
                                <!--Table head-->
                                <thead>
                                    <tr>                            
                                        <th style="width: 20%">Tipo</th>
                                        <th style="width: 70%">Descrição</th>
                                        <th style="min-width: 90px"></th>                       
                                    </tr>
                                </thead>
                                <!--Table head-->
                                <!--Table body-->
                                <tbody>
                                    <tr>                            
                                        <th scope="row" style="vertical-align: middle;">Circuito</th>                  
                                        <td style="vertical-align: middle;">Quando a trilha começa e termina no mesmo local, porém o trajeto de ida e volta não se repete
                                        </td>                      
                                        <td style="text-align: center;">
                                            <img style="height: 60%" src="{{ asset('img/trilhas/dificuldade/tipos/circuito.png') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="vertical-align: middle;">Travessia</th>                
                                        <td style="vertical-align: middle;">Quando a trilha começa em um local e termina em outro
                                        </td>
                                        <td style="text-align: center;">
                                            <img style="height: 60%" src="{{ asset('img/trilhas/dificuldade/tipos/travessia.png') }}">
                                        </td>
                                    </tr>
                                    <tr>                            
                                        <th scope="row" style="vertical-align: middle;">Trilha</th>                
                                        <td style="vertical-align: middle;">Quando a trilha começa e termina no mesmo local e o trajeto de ida e a volta se dá pelo mesmo caminho
                                        </td>
                                        <td style="text-align: center;">
                                            <img style="height: 60%" src="{{ asset('img/trilhas/dificuldade/tipos/trilha.png') }}">
                                        </td>
                                    </tr>                                                        
                                </tbody>
                                <!--Table body-->
                            </table>                    
                            <!--Table-->
                            <p><strong>Fonte</strong>: Metodologia de Classificação de Trilhas (FEMERJ, 2015)</p>
                        </div>
                        <p>
                            Agora que podemos classificar as trilhas de acordo com o percurso, vamos conhecer a classificação por grau de dificuldade. Essa classificação é complexa e baseada em vários critérios. Apresentamos duas classificações encontradas com frequência quando o assunto é a dificuldade das trilhas. A primeira foi feita pela Federação de Esportes de Montanha no Estado do Rio de Janeiro (FEMERJ) e publicada em 2015. No documento, as trilhas são classificadas levando em consideração quatro parâmetros: esforço físico, exposição ao risco, orientação e insolação. Cada um desses parâmetros possui uma escala crescente de severidade. Além disso, deve ser adicionado fatores como distância da trilha, tempo de percurso e dificuldades técnicas do caminho. Para conhecer os detalhes dessa classificação, leia o artigo <a class="link" href="{{ url('guia-de-dificuldade-em-trilhas/femerj') }}">Guia de Dificuldade em Trilhas - FEMERJ</a>.
                        </p>
                        <p>
                            A segunda classificação foi elaborada pela Associação Brasileira de Normas Técnicas (ABNT), por meio da NBR 15505-2, intitulada Turismo com atividades de caminhada Parte 2: Classificação de percursos. A norma estabelece critérios referentes à classificação de percursos utilizados em caminhadas sem pernoite quanto às suas características de severidade. Assim como na classificação da FEMERJ, são apresentados critérios com escala de intensidade crescente que determinam o grau em cada um deles. A classificação é composta por quatro critérios: severidade do meio, orientação do percurso, condições do terreno e intensidade do esforço físico. Diferente da classificação da FEMERJ, não existe a avaliação individual do critério de insolação e as condições do terreno recebem uma escala própria de intensidade. Para maiores detalhes, leia o artigo <a class="link" href="{{ url('guia-de-dificuldade-em-trilhas/abnt') }}">Guia de Dificuldade em Trilhas - Norma NBR 15505-2</a>.
                        </p>
                        <p>
                            As duas normas possuem um texto extenso e detalhado sobre a dificuldade das trilhas e traremos essas informações em nossos percursos sempre que possível, mas para nível de classificação das trilhas que realizamos vamos utilizar a classificação feita pelo pessoal do <a class="link" href="https://www.vamostrilhar.com.br/conteudo/infografico-os-niveis-de-dificuldade-de-trilhas/" target="_blank">Vamos Trilhar</a>. Eles elaboram uma escala que, assim como as escalas apresentadas anteriormente, utiliza alguns critérios para determinar o grau de dificuldade. Os critérios são: distância, terreno, físico e experiência. Essa é a classificação utilizada pelo Trilhas em SC. Lembrando que a nossa classificação dos trajetos não é oficial, ela é realizada por nós e faz uso do conhecimento sobre as diferentes formas de classificação, mas não foge da influência das nossas percepções de trilheiros não profissionais. 
                        </p>
                        <p>
                            Abaixo trazemos o infográfico do <a class="link" href="https://www.vamostrilhar.com.br/" target="_blank">Vamos Trilhar</a>, use ele como guia para identificar as características das trilhas que mostramos em nosso site.
                        </p>
                        <div class="center">
                            <a href="https://www.vamostrilhar.com.br/conteudo/infografico-os-niveis-de-dificuldade-de-trilhas/" target="_blank">
                                <img src="{{ asset('img/trilhas/dificuldade/infografico-niveis-de-dificuldade-em-trilhas-vamos-trilhar.png') }}">
                            </a>
                        </div>
                        <h5><strong>Referências</strong></h5>
                        <p>
                            ASSOCIAÇÃO BRASILEIRA DE NORMAS TÉCNICAS. NBR 15505-2: Turismo com atividades de caminhada. Parte 2: Classificação de percursos. Rio de Janeiro, 2008.
                        </p>
                        <p style='word-wrap: break-word;'>
                            Infográfico: Os níveis de dificuldade de trilhas. Disponível em https://www.vamostrilhar.com.br/conteudo/infografico-os-niveis-de-dificuldade-de-trilhas/. Acesso em 27/07/2020.
                        </p>
                        <p>
                            Metodologia de Classificação de Trilhas. Disponível em http://www.femerj.org/wp-content/uploads/classifica%C3%A7%C3%A3o-trilhas-v6.1.pdf. Acesso em 27/07/2020.
                        </p>
                        <h4 class="center" style="margin-top: 50px;"><a class="link" href="{{ url('/') }}">Voltar para a Página Inicial</a></h4>
                    </div>                       
                </div>
            </div>
        </div>
@endsection