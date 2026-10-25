<?php

namespace App\Http\Controllers;

use App\EventoTrilheiro;
use App\Guia;
use App\GuiaAvaliacao;
use App\GuiaFavorito;
use App\Trilheiro;
use Auth;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class GuiaReputacaoController extends Controller
{
    public function meus()
    {
        $trilheiro = $this->trilheiro();
        if (!$trilheiro instanceof Trilheiro) {
            return $trilheiro;
        }

        $favoritos = GuiaFavorito::with('guia')
            ->where('id_trilheiro_tri', $trilheiro->id_trilheiro_tri)
            ->latest()
            ->get();

        return view('trilheiro.favoritos', compact('favoritos'));
    }

    public function favoritar($guia)
    {
        $trilheiro = $this->trilheiro();
        if (!$trilheiro instanceof Trilheiro) {
            return $trilheiro;
        }

        $guia = Guia::findOrFail($guia);
        if ((int) $guia->id_user === (int) Auth::id()) {
            Flash::warning('O favorito é para os trilheiros marcarem o guia.');
            return redirect($guia->urlPublica());
        }

        $favorito = GuiaFavorito::where('id_guia_gui', $guia->id_guia_gui)
            ->where('id_trilheiro_tri', $trilheiro->id_trilheiro_tri)
            ->first();

        if ($favorito) {
            $favorito->delete();
            Flash::success('Favorito removido. Você deixa de receber os passeios deste guia.');
        } else {
            GuiaFavorito::create([
                'id_guia_gui' => $guia->id_guia_gui,
                'id_trilheiro_tri' => $trilheiro->id_trilheiro_tri,
            ]);
            Flash::success('Guia favoritado. Quando ele lançar um passeio, você recebe um aviso.');
        }

        return redirect($guia->urlPublica());
    }

    public function avaliar(Request $request, $guia)
    {
        $trilheiro = $this->trilheiro();
        if (!$trilheiro instanceof Trilheiro) {
            return $trilheiro;
        }

        $guia = Guia::findOrFail($guia);
        if ((int) $guia->id_user === (int) Auth::id()) {
            Flash::warning('A avaliação é feita por quem participou do passeio.');
            return redirect($guia->urlPublica());
        }

        if (!$this->participou($trilheiro, $guia)) {
            Flash::warning('A avaliação abre depois de uma vaga confirmada com este guia.');
            return redirect($guia->urlPublica().'#avaliacoes');
        }

        $dados = $request->validate([
            'nota' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:400',
        ]);

        $comentario = trim(strip_tags((string) $request->input('comentario')));

        GuiaAvaliacao::updateOrCreate(
            [
                'id_guia_gui' => $guia->id_guia_gui,
                'id_trilheiro_tri' => $trilheiro->id_trilheiro_tri,
            ],
            [
                'nr_nota_gav' => (int) $dados['nota'],
                'ds_comentario_gav' => $comentario === '' ? null : $comentario,
            ]
        );

        Flash::success('Avaliação registrada.');

        return redirect($guia->urlPublica().'#avaliacoes');
    }

    private function trilheiro()
    {
        if (Auth::guest() || trim(Auth::user()->id_role) !== 'TRILHEIRO') {
            return redirect('login');
        }

        $trilheiro = Trilheiro::where('id_user', Auth::id())->first();
        if (!$trilheiro) {
            return redirect('trilheiro/privado/atualizar-cadastro');
        }

        return $trilheiro;
    }

    private function participou(Trilheiro $trilheiro, Guia $guia)
    {
        return EventoTrilheiro::where('id_trilheiro_tri', $trilheiro->id_trilheiro_tri)
            ->where('st_inscricao_evt', EventoTrilheiro::PAGO)
            ->whereIn('id_evento_eve', function ($query) use ($guia) {
                $query->select('id_evento_eve')
                    ->from('evento_eve')
                    ->where('id_guia_gui', $guia->id_guia_gui);
            })
            ->exists();
    }
}
