 {{ Auth::user() }}
                                {{ var_dump(session()->all()) }}
                                {{ "Valor de sessão: ".Session::get('TESTE') }}