 <div class="skills-area section-bottom-padding hidden-sm hidden-xs">
            <div class="container"> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <h2 class="h2-section">NOSSAS <span class="h2-section-span">AVENTURAS</span></h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row hidden-xs hidden-sm">
                    <div class="col-md-6 col-sm-6">
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
                                <span class="contador"><span class="counter">{{ $totais['trilha'] }}</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 hidden-sm">
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
                                <span class="contador"><span class="counter">{{ $totais['camping'] }}</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>