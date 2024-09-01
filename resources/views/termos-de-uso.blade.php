@extends('layouts.site')
@section('content')
@include('layouts/partes/header')
<section class="pt-1 pb-0 mt-3 mb-5">
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-7">
                <h3 class="text-warning"><i class="fa fa-shield" aria-hidden="true"></i> Termos de Uso</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 mt-1 ml-5 mr-5 px-4">
                <h4>1. Termos</h4>
                <p>Ao acessar ao site <a href='https://trilhasemsc.com.br'>Trilhas em SC</a>, concorda em cumprir estes termos de serviço, todas as leis e regulamentos aplicáveis ​​e concorda que é responsável pelo cumprimento de todas as leis locais aplicáveis. Se você não concordar com algum                desses termos, está proibido de usar ou acessar este site. Os materiais contidos neste site são protegidos pelas leis de direitos autorais e marcas comerciais aplicáveis.</p>
                <h4>2. Uso de Licença</h4>
                <p>É concedida permissão para baixar temporariamente uma cópia dos materiais (informações ou software) no site Trilhas em SC , apenas para visualização transitória pessoal e não comercial. Esta é a concessão de uma licença, não uma transferência de título e,                sob esta licença, você não pode: </p>
                <ol>
                <li>modificar ou copiar os materiais;  </li>
                <li>usar os materiais para qualquer finalidade comercial ou para exibição pública (comercial ou não comercial);  </li>
                <li>tentar descompilar ou fazer engenharia reversa de qualquer software contido no site Trilhas em SC;  </li>
                <li>remover quaisquer direitos autorais ou outras notações de propriedade dos materiais; ou  </li>
                <li>transferir os materiais para outra pessoa ou 'espelhe' os materiais em qualquer outro servidor.</li>
                </ol>
                <p>Esta licença será automaticamente rescindida se você violar alguma dessas restrições e poderá ser rescindida por Trilhas em SC a qualquer momento. Ao encerrar a visualização desses materiais ou após o término desta licença, você deve apagar todos os materiais                baixados em sua posse, seja em formato eletrónico ou impresso.</p>
                <h4>3. Isenção de responsabilidade</h4>
                <ol>
                <li>Os materiais no site da Trilhas em SC são fornecidos 'como estão'. Trilhas em SC não oferece garantias, expressas ou implícitas, e, por este meio, isenta e nega todas as outras garantias, incluindo, sem limitação, garantias implícitas ou condições de comercialização,            adequação a um fim específico ou não violação de propriedade intelectual ou outra violação de direitos. </li>
                <li>Além disso, o Trilhas em SC não garante ou faz qualquer representação relativa à precisão, aos resultados prováveis ​​ou à confiabilidade do uso dos            materiais em seu site ou de outra forma relacionado a esses materiais ou em sites vinculados a este site.</li>
                </ol>
                <h4>4. Limitações</h4>
                <p>Em nenhum caso o Trilhas em SC ou seus fornecedores serão responsáveis ​​por quaisquer danos (incluindo, sem limitação, danos por perda de dados ou lucro ou devido a interrupção dos negócios) decorrentes do uso ou da incapacidade de usar os materiais em Trilhas em SC,                mesmo que Trilhas em SC ou um representante autorizado da Trilhas em SC tenha sido notificado oralmente ou por escrito da possibilidade de tais danos. Como algumas jurisdições não permitem limitações em garantias implícitas, ou limitações de responsabilidade                por danos conseqüentes ou incidentais, essas limitações podem não se aplicar a você.</p>
                <h4>5. Precisão dos materiais</h4>
                <p>Os materiais exibidos no site da Trilhas em SC podem incluir erros técnicos, tipográficos ou fotográficos. Trilhas em SC não garante que qualquer material em seu site seja preciso, completo ou atual. Trilhas em SC pode fazer alterações nos materiais contidos em seu                site a qualquer momento, sem aviso prévio. No entanto, Trilhas em SC não se compromete a atualizar os materiais.</p>
                <h4>6. Links</h4>
                <p>O Trilhas em SC não analisou todos os sites vinculados ao seu site e não é responsável pelo conteúdo de nenhum site vinculado. A inclusão de qualquer link não implica endosso por Trilhas em SC do site. O uso de qualquer site vinculado é por conta e risco do usuário.</p>
                </p>            
                <h3>Modificações</h3>
                <p>O Trilhas em SC pode revisar estes termos de serviço do site a qualquer momento, sem aviso prévio. Ao usar este site, você concorda em ficar vinculado à versão atual desses termos de serviço.</p>
                <h3>Lei aplicável</h3>
                <p>Estes termos e condições são regidos e interpretados de acordo com as leis do Trilhas em SC e você se submete irrevogavelmente à jurisdição exclusiva dos tribunais naquele estado ou localidade.</p>
            </div>
            <div class="col-lg-12 col-md-12 mt-4 center">
                <a href="{{ url('/') }}" type="button" class="btn btn-outline-warning btn-sm">Voltar ao Início</a>
            </div>
        </div>    
    </div>
</section>    
@endsection