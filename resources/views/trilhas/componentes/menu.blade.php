<nav>
    <ul id="nav">
        <li class="drop-down"><a href="{{ url('/') }}">HOME</a></li>
        <li class="drop-down"><a href="{{ url('trilhas/#lista') }}">TRILHAS</a>
            <ul class="sub-menu">                
                <li><a href="{{ url('trilhas/#lista') }}">Trilhas em SC</a></li>
                <li><a href="{{ url('trilhas/regioes') }}">Regiões de Florianópolis</a></li>
                <li><a href="{{ url('trilhas/santa-catarina/regioes') }}">Regiões de Santa Catarina</a></li>
                <li><a href="{{ url('trilhas/brasil') }}">Trilhas no Brasil</a></li>
                <li><a href="{{ url('guia-de-dificuldade-em-trilhas') }}">Grau de Dificuldade</a></li>
            </ul>
        </li>
        <li><a href="{{ url('campings') }}">CAMPING</a></li>
        <li><a href="{{ url('grupos') }}">GRUPOS</a></li>
        <li><a href="{{ url('eventos') }}">EVENTOS</a></li>
        <li><a href="{{ url('guias-e-condutores') }}">GUIAS E CONDUTORES</a></li>
    </ul>
</nav>