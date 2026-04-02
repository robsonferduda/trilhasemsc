@extends('layouts.site')
@section('content')
<header class="position-relative">
    <div class="container">
       <div class="row bg-white py-4 mt-n7 position-relative shadow border-radius-lg mb-2" style="margin-left: 0px; margin-right: 0px;">
          <div class="col-lg-2 col-md-5 position-relative my-auto justify-content-center text-center">
               <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/nacional/pantanal/capa.jpeg') }}" alt="Pantanal">
          </div>
          <div class="col-md-10 z-index-2 position-relative mt-sm-0 mt-4">
             <h4 class="mb-1">Minha Experiência no Pantanal</h4>
             <p class="text-sm mb-0">Um dia intenso de safari no coração do Pantanal</p>
             <p class="mb-1 mt-2"><i class="fa fa-calendar"></i> Agosto/2025 | <i class="fa fa-map-marker"></i> Porto Jofre - Poconé/MT</p>    
          </div>
       </div>
    </div>
</header>

<!-- Introdução -->
<section class="pt-3 pb-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        <h4 class="text-gradient text-info mb-3">Sobre a Experiência</h4>
                        <p class="">
                            Uma aventura intensa de um dia completo em busca das onças-pintadas no Pantanal! Saindo de <strong>Poconé/MT</strong> às 3h da manhã, 
                            percorremos a famosa <strong>Transpantaneira</strong> até <strong>Porto Jofre</strong>, onde embarcamos para um safari fluvial inesquecível 
                            de 7 horas no rio. O resultado? <strong>9 avistamentos de onças</strong> (7 indivíduos diferentes), além de inúmeras outras espécies da fauna pantaneira. 
                            Guiado pelo especialista <strong>Erivelto Oliveira</strong> (Pantanal Birds), cada momento foi marcado por aprendizado e conexão profunda com a natureza.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Detalhes do Passeio -->
<section class="pt-3 pb-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md me-3">
                                <i class="fa fa-compass text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <h3 class="mb-0 text-warning">Detalhes do Passeio</h3>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <h5 class="text-gradient text-dark">📅 Itinerário Completo</h5>
                                <div class="timeline timeline-one-side">
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step bg-dark">
                                            <i class="fa fa-moon-o text-white"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">03:00 - Saída de Poconé</h6>
                                            <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">
                                                • Busca na pousada em Poconé/MT<br>
                                                • Início da jornada ainda de madrugada
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step bg-info">
                                            <i class="fa fa-road text-white"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">Transpantaneira</h6>
                                            <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">
                                                • Travessia pela famosa estrada-parque<br>
                                                • Avistamentos de fauna pelo caminho<br>
                                                • Cenário espetacular do Pantanal
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step bg-warning">
                                            <i class="fa fa-coffee text-white"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">Chegada em Porto Jofre</h6>
                                            <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">
                                                • Recepção na Pousada Berço Pantaneiro<br>
                                                • Café da manhã reforçado<br>
                                                • Preparação para o safari fluvial
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step bg-success">
                                            <i class="fa fa-ship text-white"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">08:00 - Safari Fluvial</h6>
                                            <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">
                                                • Início do safari de barco pelo rio<br>
                                                • Busca intensiva pelas onças-pintadas<br>
                                                • Observação de fauna ribeirinha
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step bg-gradient-warning">
                                            <i class="fas fa-utensils text-white"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">12:00 - Almoço no Barco</h6>
                                            <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">
                                                • Marmita entregue diretamente no barco<br>
                                                • Descanso de 1 hora<br>
                                                • Reabastecimento de energia
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step bg-gradient-success">
                                            <i class="fas fa-camera text-white"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">13:00-15:00 - Safari Continua</h6>
                                            <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">
                                                • Continuação da busca pelas onças<br>
                                                • <strong>Resultado: 9 avistamentos!</strong><br>
                                                • 7 onças diferentes, 2 vistas duas vezes
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step bg-gradient-info">
                                            <i class="fas fa-house text-white"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">15:00 - Retorno</h6>
                                            <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">
                                                • Fim do safari fluvial<br>
                                                • Retorno pela Transpantaneira<br>
                                                • Volta para Poconé
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <h5 class="text-gradient text-dark">🦜 Fauna Avistada</h5>
                                
                                <!-- Destaque Onças -->
                                <div class="card shadow mb-3" style="background: #f5f5f5;">
                                    <div class="card-body p-3">
                                        <h6 class="mb-2"><i class="fa fa-star text-warning"></i> Destaque do Passeio</h6>
                                        <h5 class="mb-1">🐆 9 Avistamentos de Onças!</h5>
                                        <p class="text-sm mb-0">7 onças diferentes (2 vistas duas vezes)</p>
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="badge badge-sm bg-gradient-success w-100 text-start">
                                            <i class="fa fa-check"></i> Tuiuiú
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="badge badge-sm bg-gradient-success w-100 text-start">
                                            <i class="fa fa-check"></i> Capivaras
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="badge badge-sm bg-gradient-success w-100 text-start">
                                            <i class="fa fa-check"></i> Jacarés
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="badge badge-sm bg-gradient-success w-100 text-start">
                                            <i class="fa fa-check"></i> Ariranhas
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="badge badge-sm bg-gradient-success w-100 text-start">
                                            <i class="fa fa-check"></i> Araras-azuis
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="badge badge-sm bg-gradient-success w-100 text-start">
                                            <i class="fa fa-check"></i> Garças
                                        </div>
                                    </div>
                                </div>

                                <h5 class="text-gradient text-dark mt-4">📋 O Que Está Incluso</h5>
                                <ul class="text-sm">
                                    <li>Transporte de Poconé até Porto Jofre (ida e volta)</li>
                                    <li>Travessia pela Transpantaneira</li>
                                    <li>Café da manhã na Pousada Berço Pantaneiro</li>
                                    <li>Safari fluvial de 7 horas (08:00 às 15:00)</li>
                                    <li>Almoço servido no barco (marmita)</li>
                                    <li>Guia especializado (Erivelto Oliveira)</li>
                                    <li>Equipamento de segurança</li>
                                </ul>

                                <h5 class="text-gradient text-dark mt-3">📍 Locais</h5>
                                <ul class="text-sm">
                                    <li><strong>Cidade base:</strong> Poconé/MT</li>
                                    <li><strong>Destino:</strong> Porto Jofre</li>
                                    <li><strong>Via:</strong> Transpantaneira</li>
                                    <li><strong>Pousada:</strong> Berço Pantaneiro</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Perfil da Empresa -->
<section class="pt-3 pb-3">
    <div class="container">
        <div class="row ">
            <div class="col-md-6 mb-3">
                <div class="card h-100 shadow-lg">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset('img/nacional/pantanal/logos/ecotur.jpg') }}" alt="EcoTur Pantanal Logo" class="avatar avatar-md shadow me-3" style="border-radius: 10px;">
                            <h4 class="mb-0 text-info">Perfil da Empresa</h4>
                        </div>
                        <h5 class="font-weight-bold">EcoTur Pantanal</h5>
                        <p class="text-sm mb-2">
                            <strong>Responsável:</strong> Domingas
                        </p>
                        <p class="text-sm mb-2">
                            <strong>Especialização:</strong> Ecoturismo e safáris fotográficos no Pantanal
                        </p>
                        <p class="text-sm mb-2">
                            <strong>Diferenciais:</strong>
                        </p>
                        <ul class="text-sm">
                            <li>Guias especializados em fauna e flora local</li>
                            <li>Infraestrutura completa e confortável</li>
                            <li>Compromisso com turismo sustentável</li>
                            <li>Roteiros personalizados</li>
                            <li>Conhecimento profundo da região pantaneira</li>
                        </ul>
                        <p class="text-sm mb-2">
                            <strong>Contato:</strong><br>
                            <i class="fa fa-instagram"></i> <a href="https://www.instagram.com/ecoturpantanal/" target="_blank" class="text-info">@ecoturpantanal</a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Perfil do Guia -->
            <div class="col-md-6 mb-3">
                <div class="card h-100 shadow-lg">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md me-3">
                                <i class="fa fa-user text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <h4 class="mb-0 text-success">Perfil do Guia</h4>
                        </div>
                        <div class="text-center mb-3">
                            <img class="avatar avatar-xl shadow rounded-circle" src="{{ asset('img/nacional/pantanal/logos/pantanalbirds.jpg') }}" alt="Erivelto Oliveira">
                        </div>
                        <h5 class="font-weight-bold text-center">Erivelto Oliveira</h5>
                        <p class="text-center text-sm text-muted mb-2">Pantanal Birds</p>
                        <p class="text-center text-sm mb-3">
                            <a href="https://www.instagram.com/pantanalbirds/" target="_blank" class="text-success me-2">
                                <i class="fa fa-instagram"></i> @pantanalbirds
                            </a>
                            <a href="https://www.youtube.com/channel/UCvttpCyOxnJ1jViipOLnNJw" target="_blank" class="text-danger">
                                <i class="fa fa-youtube-play"></i> YouTube
                            </a>
                        </p>
                        <p class="text-sm mb-2">
                            <strong>Formação:</strong> Engenharia Ambiental 🌱
                        </p>
                        <p class="text-sm mb-2">
                            <strong>Atuação:</strong>
                        </p>
                        <ul class="text-sm mb-3">
                            <li>Guia de turismo profissional em natureza 🐆</li>
                            <li>Educador Ambiental ♻️</li>
                        </ul>
                        <p class="text-sm mb-2">
                            <strong>Especialidades:</strong>
                        </p>
                        <ul class="text-sm">
                            <li>Observação de aves (birdwatching) - Especialista</li>
                            <li>Identificação de mamíferos</li>
                            <li>Fotografia de natureza</li>
                            <li>Conhecimento profundo sobre ecossistema pantaneiro</li>
                            <li>Safáris fotográficos especializados</li>
                        </ul>
                        <p class="text-sm mt-3 fst-italic">
                            <em>"O conhecimento e a paixão do Erivelto pela região e especialmente pelas aves fizeram toda a diferença na experiência!"</em>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Galeria de Fotos -->
<section class="pt-3 pb-3">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h3 class="text-info"><i class="fa fa-camera"></i> Galeria de Fotos</h3>
                <p class="text-sm">Alguns momentos inesquecíveis da viagem</p>
            </div>
        </div>
        <div class="row g-4">
            <!-- Imagem Destaque Principal -->
            <div class="col-md-12 mb-3">
                <div class="position-relative overflow-hidden border-radius-xl shadow-lg" style="height: 500px;">
                    <img class="w-100 h-100" style="object-fit: cover; transition: transform 0.3s ease;" 
                         onmouseover="this.style.transform='scale(1.05)'" 
                         onmouseout="this.style.transform='scale(1)'"
                         src="{{ asset('img/nacional/pantanal/tuiuiu.jpeg') }}" 
                         alt="Tuiuiú no Pantanal">
                    <div class="position-absolute bottom-0 start-0 w-100 p-3" 
                         style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                        <h5 class="text-white mb-0">Tuiuiú - Ave Símbolo do Pantanal</h5>
                    </div>
                </div>
            </div>

            <!-- Grid de Imagens 2 colunas -->
            <div class="col-md-6 mb-3">
                <div class="position-relative overflow-hidden border-radius-lg shadow-lg" style="height: 350px;">
                    <img class="w-100 h-100" style="object-fit: cover; transition: transform 0.3s ease;" 
                         onmouseover="this.style.transform='scale(1.05)'" 
                         onmouseout="this.style.transform='scale(1)'"
                         src="{{ asset('img/nacional/pantanal/onca.jpeg') }}" 
                         alt="Onça-pintada no Pantanal">
                    <div class="position-absolute bottom-0 start-0 w-100 p-3" 
                         style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                        <h6 class="text-white mb-0">🐆 Onça-pintada - O Grande Encontro</h6>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="position-relative overflow-hidden border-radius-lg shadow-lg" style="height: 350px;">
                    <img class="w-100 h-100" style="object-fit: cover; transition: transform 0.3s ease;" 
                         onmouseover="this.style.transform='scale(1.05)'" 
                         onmouseout="this.style.transform='scale(1)'"
                         src="{{ asset('img/nacional/pantanal/ariranha.jpeg') }}" 
                         alt="Ariranha no Pantanal">
                    <div class="position-absolute bottom-0 start-0 w-100 p-3" 
                         style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                        <h6 class="text-white mb-0">🦦 Ariranha - Mamífero Aquático</h6>
                    </div>
                </div>
            </div>

            <!-- Grid de Imagens 3 colunas -->
            <div class="col-md-4 mb-3">
                <div class="position-relative overflow-hidden border-radius-lg shadow-lg" style="height: 280px;">
                    <img class="w-100 h-100" style="object-fit: cover; transition: transform 0.3s ease;" 
                         onmouseover="this.style.transform='scale(1.05)'" 
                         onmouseout="this.style.transform='scale(1)'"
                         src="{{ asset('img/nacional/pantanal/jacare.jpeg') }}" 
                         alt="Jacaré no Pantanal">
                    <div class="position-absolute bottom-0 start-0 w-100 p-2" 
                         style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                        <p class="text-white text-sm mb-0">🐊 Jacaré Tomando Sol</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="position-relative overflow-hidden border-radius-lg shadow-lg" style="height: 280px;">
                    <img class="w-100 h-100" style="object-fit: cover; transition: transform 0.3s ease;" 
                         onmouseover="this.style.transform='scale(1.05)'" 
                         onmouseout="this.style.transform='scale(1)'"
                         src="{{ asset('img/nacional/pantanal/jacare_2.jpeg') }}" 
                         alt="Jacaré no Pantanal">
                    <div class="position-absolute bottom-0 start-0 w-100 p-2" 
                         style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                        <p class="text-white text-sm mb-0">🐊 Jacaré no Rio</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow-lg h-100 bg-gradient-info">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center text-center text-white p-4">
                        <i class="fa fa-camera fa-3x mb-3 opacity-8"></i>
                        <h5 class="text-white mb-2">Mais Fotos</h5>
                        <p class="text-sm mb-0">Centenas de registros incríveis desta viagem inesquecível!</p>
                        <div class="mt-3">
                            <span class="badge bg-white text-info me-1">+100 fotos</span>
                            <span class="badge bg-white text-info">+50 espécies</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estatísticas da Viagem -->
        <div class="row mt-4">
            <div class="col-md-3 col-6 mb-3">
                <div class="card shadow text-center">
                    <div class="card-body p-3">
                        <h3 class="text-gradient text-info mb-0">1</h3>
                        <p class="text-sm mb-0">Dia Intenso</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="card shadow text-center">
                    <div class="card-body p-3">
                        <h3 class="text-gradient text-warning mb-0">9</h3>
                        <p class="text-sm mb-0">Avistamentos de Onças</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="card shadow text-center">
                    <div class="card-body p-3">
                        <h3 class="text-gradient text-success mb-0">7h</h3>
                        <p class="text-sm mb-0">Safari Fluvial</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="card shadow text-center">
                    <div class="card-body p-3">
                        <h3 class="text-gradient text-danger mb-0">147km</h3>
                        <p class="text-sm mb-0">Transpantaneira</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Dicas e Recomendações -->
<section class="pt-3 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card shadow-lg bg-gradient-info">
                    <div class="card-body p-4 text-white">
                        <h5 class="text-white"><i class="fa fa-lightbulb"></i> Dicas Importantes</h5>
                        <ul class="text-sm mb-0">
                            <li>Leve roupas leves e em tons neutros</li>
                            <li>Protetor solar e repelente são essenciais</li>
                            <li>Binóculos e câmera com boa zoom</li>
                            <li>Respeite a distância dos animais</li>
                            <li>Melhor época: maio a outubro (seca)</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card shadow-lg bg-gradient-success">
                    <div class="card-body p-4 text-white">
                        <h5 class="text-white"><i class="fa fa-star"></i> Minha Avaliação</h5>
                        <div class="mb-2">
                            <strong>Estrutura:</strong> ⭐⭐⭐⭐⭐<br>
                            <strong>Guia:</strong> ⭐⭐⭐⭐⭐<br>
                            <strong>Experiência:</strong> ⭐⭐⭐⭐⭐<br>
                            <strong>Custo-Benefício:</strong> ⭐⭐⭐⭐⭐
                        </div>
                        <p class="text-sm mb-0">
                            <em>"Uma experiência transformadora! Recomendo fortemente para quem ama natureza e fotografia."</em>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts/partes/publicidade-google')

@endsection