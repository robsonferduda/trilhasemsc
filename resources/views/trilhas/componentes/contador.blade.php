 <div class="skills-area section-bottom-padding hidden-sm hidden-xs">
            <div class="container"> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <h1>NOSSAS <span>AVENTURAS</span></h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row hidden-sm hidden-xs">
                    <h2>Acompanhe nossas aventuras pelas trilhas, campings e praias por todo estado de Santa Catarina</h2>
                </div>

                <div class="row hidden-xs hidden-sm">
                    <div class="col-md-4 col-sm-6">
                        <div class="single-skill-item">
                            <div class="single-skill-icon">
                                <div class="skill-bg"></div>
                                <div class="skill-border-left"></div>
                                <img alt="" src="{{ asset('img/icon/skill-1.png') }}" class="primary-img">
                                <img alt="" src="{{ asset('img/icon/skill-1-hover.png') }}" class="secondary-img">
                                <div class="skill-border-right"></div>
                            </div>
                            <div class="single-skill-text">
                                <h4>TRILHAS</h4>
                                <h3><span class="counter">{{ $totais['trilha'] }}</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="single-skill-item low">
                            <div class="single-skill-icon">
                                <div class="skill-bg"></div>
                                <div class="skill-border-left"></div>
                                <img alt="" src="{{ asset('img/icon/skill-2.png') }}" class="primary-img">
                                <img alt="" src="{{ asset('img/icon/skill-2-hover.png') }}" class="secondary-img">
                                <div class="skill-border-right"></div>
                            </div>
                            <div class="single-skill-text">
                                <h4>GALERIAS</h4>
                                <h3><span class="counter">{{ $totais['galeria'] }}</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 hidden-sm">
                        <div class="single-skill-item medium">
                            <div class="single-skill-icon">
                                <div class="skill-bg"></div>
                                <div class="skill-border-left"></div>
                                <img alt="" src="{{ asset('img/icon/skill-3.png') }}" class="primary-img">
                                <img alt="" src="{{ asset('img/icon/skill-3-hover.png') }}" class="secondary-img">
                                <div class="skill-border-right"></div>
                            </div>
                            <div class="single-skill-text">
                                <h4>CAMPING</h4>
                                <h3><span class="counter">{{ $totais['camping'] }}</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>