<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function show()
    {
        return view('contato');
    }

    public function enviar(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'telefone' => 'required|max:15|',
            'mensagem' => 'required|string|max:1000',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'telefone.string' => 'O campo telefone é obrigatório.',
        ]);

        // Aqui você pode:
        // - salvar no banco
        // - enviar por e-mail
        // - enviar para um webhook, etc.
        // Exemplo:
        // Contato::create($dados);
        // ou Mail::to('admin@site.com')->send(new ContatoMail($dados));

        return back()->with('success', 'Mensagem enviada com sucesso! 😊');
    }
}
