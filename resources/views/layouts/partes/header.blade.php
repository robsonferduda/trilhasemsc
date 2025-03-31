<header class="position-relative">
    <div class="container">
       <div class="row bg-white shadow mt-n5 border-radius-lg pb-5 p-3 mx-sm-0 mx-1 position-relative">
          <form action="{{ url('trilhas/#lista') }}" style="display: inherit;" method="GET" id="banner-searchbox" class="">
            <div class="row w-100">
               <div class="col-lg-4 col-md-4 col-sm-12 mt-2 mr-2" style="padding-right: 15px;">
                  <label class="">Selecione a cidade</label>
                  <select class="form-control" name="cidade" id="cidades">
                     <option value="">Selecione uma cidade</option>
                     @if(isset($cidades))
                        @forelse($cidades as $cidade)
                           <option {{ old('cidade') == stringToStringSeo($cidade->nm_cidade_cde) ? 'selected': ''}} value="{{stringToStringSeo($cidade->nm_cidade_cde)}}">{{$cidade->nm_cidade_cde}}</option>
                        @empty
                           <option selected value="">Nenhuma cidade disponível</option>
                        @endforelse
                     @endif
                  </select>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-12 mt-2 mr-2" style="padding-right: 15px;">
                  <label class="">Selecione o nível</label>
                  <select class="form-control" name="nivel" id="list-niveis">
                     <option value="">Selecione um nível</option>
                     @if(isset($niveis))
                        @foreach($niveis as $nivel)
                           <option {{ old('nivel') == stringToStringSeo($nivel->dc_nivel_niv) ? 'selected': ''}} value="{{stringToStringSeo($nivel->dc_nivel_niv)}}">{{$nivel->dc_nivel_niv}}</option>
                        @endforeach
                     @endif
                  </select>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-12 mt-2 mr-2" style="padding-right: 15px;">
                  <label class="">Nome da Trilha</label>
                  <div class="input-group">
                     <input type="text" name="termo" class="form-control flatpickr-input" placeholder="Nome da Trilha">
                  </div>
               </div>
               <div class="col-lg-2 col-md-2 col-sm-12 mt-2">
                  <label class="">&nbsp;</label>
                  <button type="submit" class="btn bg-gradient-primary w-100 mb-0">Buscar Trilhas</button>
               </div>
            </div>
          </form>
       </div>
    </div>
 </header>