<nav id="dropdown">
    <ul>
        <li><a href="{{ url('/') }}">HOME</a></li>
        <li><a href="{{ url('trilhas/#lista') }}">TRILHAS</a>
            <ul>                
                <li><a href="{{ url('trilhas/#lista') }}">Trilhas em SC</a></li>
                <li><a href="{{ url('trilhas/regioes') }}">Regiões de Florianópolis</a></li>
                <li><a href="{{ url('trilhas/santa-catarina/regioes') }}">Regiões de Santa Catarina</a></li>
                <li><a href="{{ url('trilhas/brasil') }}">Trilhas no Brasil</a></li>
            </ul>
        </li>
        <li><a href="{{ url('campings') }}">CAMPING</a></li>
        <li><a href="{{ url('grupos') }}">GRUPOS</a></li>
        <li><a href="{{ url('guia-de-dificuldade-em-trilhas') }}">GUIA DE DIFICULDADE</a></li>
    </ul>
</nav>