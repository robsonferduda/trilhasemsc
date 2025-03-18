@extends('layouts.template')
@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
                <h2>Trilheiros</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-map"></i> Trilheiros</li>
                    <li class="breadcrumb-item">Atualizar Cadastro</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card planned_task">
                <div class="header no-padding-bottom">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <h2>Dados do Trilheiro</h2>
                        </div>
                    </div>
                </div>
               
                <div class="body">
                    @include('layouts.mensagens')
                    <form action="{{ url('trilheiro/privado/atualizar-cadastro') }}" enctype="multipart/form-data" method="post" id="form-trilheiro">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="nome">Nome</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="nome" id="nome" value="{{ $trilheiro->nm_trilheiro_tri }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="text" name="email" id="email" value="{{ $usuario->email }}" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="email">Sexo</label><span class="text-danger"> Obrigatório</span>
                                    <select name="sexo" id="sexo" class="form-control select2" data-parsley-errors-container="#error-sexo" required>
                                        <option value="">Selecione uma opção</option>
                                        <option value="F" {!! $trilheiro->cd_sexo_sex == 'F' ? 'selected' : '' !!}>Feminino</option>
                                        <option value="M" {!! $trilheiro->cd_sexo_sex == 'M' ? 'selected' : '' !!}>Masculino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="estado_origem">Estado de Origem</label><span class="text-danger"> Obrigatório</span>
                                    <select name="estado_origem" id="estado_origem" class="form-control select2" data-parsley-errors-container="#error-estado-origem" required>
                                        <option value="">Selecione um estado</option>
                                        @foreach($estados as $estado)
                                            <option {!! $trilheiro->cd_estado_est == $estado->cd_estado_est ? 'selected' : '' !!}  value="{{ $estado->cd_estado_est }}">{{ $estado->nm_estado_est }}</option>
                                        @endforeach
                                    </select>
                                    <span id="error-estado-origem"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="cidade_origem">Cidade de Origem</label><span class="text-danger"> Obrigatório</span>
                                    <select name="cidade_origem" id="cidade_origem" class="form-control select2" data-parsley-errors-container="#error-cidade-origem" required>
                                        <option value="">Selecione uma cidade</option>
                                        @foreach($cidades as $cidade)
                                            <option {!! $trilheiro->cd_cidade_tri == $cidade->cd_cidade_cde ? 'selected' : '' !!}  value="{{ $cidade->cd_cidade_cde }}">{{ $cidade->nm_cidade_cde }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="cidade_selecionada" id="cidade_selecionada" value="{{ ($trilheiro and $trilheiro->cd_cidade_tri) ? $trilheiro->cd_cidade_tri : '' }}"/>
                                    <span id="error-cidade-origem"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="dt_nascimento">Data de Nascimento</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="dt_nascimento" id="dt_nascimento" value="{{ ($trilheiro) ? \Carbon\Carbon::parse($trilheiro->dt_nascimento)->format('d/m/Y') : old('dt_nascimento') }}" class="form-control data" placeholder="__/__/____" required>
                                </div>
                            </div>                            
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="biografia">Objetivos e Interesses</label><span class="text-info"> Opcional</span>
                                    <textarea name="objetivos" id="objetivos" rows="5" style="width: 100%;" data-parsley-minlength="20">{{ ($trilheiro) ? $trilheiro->ds_objetivos_tri : old('objetivos') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <input type="hidden" id="cropped-image" name="cropped_image" />
                                    <label for="dropify-event">Faça aqui o upload da sua foto de perfil</label><span class="text-info"> Preferencialmente foto em formato quadrado, com medidas proporcionais</span>
                                    <p class="text-danger"><strong>Atenção!</strong> Ao usar fotos em formato diferente do sugerido, sua imagem de perfil pode ficar desproporcional ou sua foto pouco nítida.</p>
                                    <input name="imagem" type="file" id="dropify-event"  
                                    data-default-file="{{  $trilheiro->nm_path_foto_tri ? asset('img/trilheiros/'.$trilheiro->nm_path_foto_tri) : asset('img/trilheiros/default.png') }}">
                                    <input name="imagem_deletada" id="imagem_deletada" type="hidden" value='false' >
                                </div>
                            </div>
                        </div>
                        <div style="text-align: center; margin-top:15px; ">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para recorte de imagem -->
    <div class="modal fade" id="cropperModal" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropperModalLabel">Recortar Imagem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="image" src="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="cropButton">Recortar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {

            var host = $('meta[name="base-url"]').attr('content');

            $('#form-trilheiro').parsley();

            $('.phone').mask('(99) 999-999999');
            $('.data').mask('99/99/9999');

            var drEvent = $('#dropify-event').dropify();

            var cropper;
            var image = document.getElementById('image');
            
            /*
            drEvent.on('dropify.fileReady', function(event, element) {
               var reader = new FileReader();
                reader.onload = function(e) {
                    image.src = $('#dropify-event').attr('data-default-file');
                    $('#cropperModal').modal('show');
                };
                reader.readAsDataURL($('#dropify-event').attr('data-default-file'));
            });*/

            drEvent.on('dropify.fileReady', function(event, element) {

                var file = event.target.files[0];

                if (!file) {
                    console.error('No file selected');
                    return;
                }

                var reader = new FileReader();
                reader.onload = function(e) {
                    image.src = e.target.result;
                    $('#cropperModal').modal('show');
                };
                reader.readAsDataURL(file);
            });

            $('#cropperModal').on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });

            $('#cropButton').on('click', function() {
                
                var canvas = cropper.getCroppedCanvas({
                    width: 300,
                    height: 300,
                });

                const croppedCanvas = cropper.getCroppedCanvas();
                const croppedImage = croppedCanvas.toDataURL('image/jpeg');
                
                $('#dropify-event').attr('data-default-file', croppedImage);

                canvas.toBlob(function(blob) {
                    
                    var url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {

                        $('#dropify-event').dropify('destroy');
                        $('#dropify-event')[0].value = '';

                        $('#cropped-image').val(croppedImage);

                        $('#dropify-event').dropify({
                            defaultFile: croppedImage
                        });

                        // Força a atualização manual da visualização
                        setTimeout(() => {
                            const dropifyWrapper = $('.dropify-wrapper');
                            const previewImage = dropifyWrapper.find('.dropify-preview');
                            const imageElement = previewImage.find('img');

                            // Atualiza a imagem no DOM diretamente
                            if (imageElement.length > 0) {
                                imageElement.attr('src', croppedImage);
                            } else {
                                // Cria uma nova tag <img> se não existir
                                previewImage.append(`<img src="${croppedImage}" />`);
                            }

                            // Exibe a área de pré-visualização
                            previewImage.show();
                            dropifyWrapper.addClass('has-preview');
                        }, 100); // Pequeno atraso para garantir que o Dropify esteja pronto

                        $('#cropperModal').modal('hide');
                    };
                }, 'image/jpeg');
            });

            

            drEvent.on('dropify.afterClear', function(event, element) {
                $('#imagem_deletada').val(true);
            });

            $(document).ready(function(){

                $("#estado_origem").trigger('change');

            });

            $(document).on('change', '#estado_origem', function() {

                var estado = $(this).val();
                var cd_cidade = $("#cidade_origem").val();
                var cidade_selecionada = $("#cidade_selecionada").val();

                $('#cidade_origem').find('option').remove().end();

                if($(this).val() == '') {
                    $('#cidade_origem').attr('disabled', true);
                    $('#cidade_origem').append('<option value="">Selecione</option>').val('');
                    return;
                }

                $('#cidade_origem').append('<option value="">Carregando...</option>').val('');

                $.ajax({
                    url: host+'/estado/'+estado+'/cidades',
                    type: 'POST',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "estado": $(this).val(),
                    },
                    beforeSend: function() {
                        
                    },
                    success: function(data) {
                        if(!data) {
                           
                        }
                        $('#cidade_origem').attr('disabled', false);
                        $('#cidade_origem').find('option').remove().end();
                        $('#cidade_origem').append('<option value="" selected>Selecione uma cidade</option>').val('');

                        data.forEach(element => {
                            let option = new Option(element.nm_cidade_cde, element.cd_cidade_cde);
                            $('#cidade_origem').append(option);

                            if(cidade_selecionada == element.cd_cidade_cde)
                                $('#cidade_origem').val(cidade_selecionada);
                        });

                    },
                    complete: function(){
                        
                    }
                });
            });
        });
    </script>
@endsection