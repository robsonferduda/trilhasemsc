<div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 hidden-xs">
                            
                        </div>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <div class="header-top-right">
                                {{ Auth::user() }}
                                @guest
                                    <div class="login">
                                        <a href="{{ route('register') }}"><i class="fa fa-pencil-square-o"></i>Cadastre-se</a>
                                    </div>
                                    <div class="account">
                                        <a href="{{ route('login') }}"><i class="fa fa-lock"></i>Acesse</a>
                                    </div>
                                    <ul class="header-r-cart">
                                        <li><a href="#" class="cart"><span>Olá Visitante!</span></a>
                                            
                                        </li>
                                    </ul>
                                @else
                                    <div class="login">
                                        <a href="{{ route('logout') }}" 
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-pencil-square-o"></i>Sair
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                    <ul class="header-r-cart">
                                        <li><a href="#" class="cart"><span>{{ Auth::user()->name }}</span></a>
                                            
                                        </li>
                                    </ul>
                                @endguest
                            </div>    
                        </div>
                    </div>
                </div>
            </div> 