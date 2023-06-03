<header class="position-relative">
    <div class="container">
       <div class="row bg-white shadow mt-n5 border-radius-lg pb-4 p-3 mx-sm-0 mx-1 position-relative">
          <form action="{{ url('guias-e-condutores') }}" style="display: inherit;" method="GET" id="banner-searchbox" class="">
               <div class="row w-100">
                  <div class="col-lg-10 col-md-10 col-sm-12 mt-2 mr-2" style="padding-right: 15px;">
                     <label class="">Selecione a cidade</label>
                     <select class="form-control" name="cidade" id="list-cidade">
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
                  <div class="col-lg-2 col-md-2 col-sm-12 mt-2">
                     <label class="">&nbsp;</label>
                     <button type="submit" class="btn bg-gradient-primary w-100 mb-0">Buscar Guias</button>
                  </div>
               </div>
          </form>
       </div>
    </div>
 </header>