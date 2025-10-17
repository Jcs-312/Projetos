<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


class TestePersonalidadeController extends Controller
{
	private array $questions = [
// Abertura (O)
['id' => 'q1', 'trait' => 'O', 'text' => 'Sou curioso(a) e gosto de explorar ideias novas.'],
['id' => 'q6', 'trait' => 'O', 'text' => 'Aprecio arte, música ou literatura e presto atenção a detalhes estéticos.'],
// Conscienciosidade (C)
['id' => 'q2', 'trait' => 'C', 'text' => 'Sou organizado(a) e cumpro prazos com facilidade.'],
['id' => 'q7', 'trait' => 'C', 'text' => 'Planejo antes de agir e reviso meu trabalho.'],
// Extroversão (E)
['id' => 'q3', 'trait' => 'E', 'text' => 'Sinto-me energizado(a) ao estar com outras pessoas.'],
['id' => 'q8', 'trait' => 'E', 'text' => 'Gosto de liderar conversas ou atividades em grupo.'],
// Amabilidade (A)
['id' => 'q4', 'trait' => 'A', 'text' => 'Procuro ser gentil e cooperativo(a) com os outros.'],
['id' => 'q9', 'trait' => 'A', 'text' => 'Sou empático(a) e tento ver as situações pelo ponto de vista alheio.'],
// Neuroticismo (N)
['id' => 'q5', 'trait' => 'N', 'text' => 'Costumo ficar preocupado(a) ou ansioso(a) com facilidade.'],
['id' => 'q10', 'trait' => 'N', 'text' => 'Meu humor oscila com certa frequência.'],
    ];
function show()
{
    return view('teste-personalidade', [
        'questions' => $this->questions,
        'result' => null,
    ]);
}

function store(Request $request) {}

public function submit(Request $request)
{
// Regras de validação
$rules = [
'name' => ['required','string','max:120'],
'email' => ['required','email','max:160'],
'phone' => ['required','string','max:40'],
];
foreach ($this->questions as $q) {
$rules[$q['id']] = ['required','integer','between:1,5'];
}

$validated = $request->validate($rules);


// Cálculo das pontuações
$scores = [ 'O' => 0, 'C' => 0, 'E' => 0, 'A' => 0, 'N' => 0 ];
$count = [ 'O' => 0, 'C' => 0, 'E' => 0, 'A' => 0, 'N' => 0 ];



foreach ($this->questions as $q) {
$val = (int) $validated[$q['id']];
$scores[$q['trait']] += $val;
$count[$q['trait']]++;
}


$averages = [];
foreach ($scores as $trait => $sum) {
$averages[$trait] = $count[$trait] ? round($sum / $count[$trait], 2) : 0;
}


$labels = [
'O' => 'Abertura',
'C' => 'Conscienciosidade',
'E' => 'Extroversão',
'A' => 'Amabilidade',
'N' => 'Neuroticismo',
];


$insights = [
'O' => 'Tendência a valorizar novidades, criatividade e experiências variadas.',
'C' => 'Forte senso de responsabilidade, organização e foco em objetivos.',
'E' => 'Energia social elevada; prefere ambientes dinâmicos e colaborativos.',
'A' => 'Empatia e cooperação; busca harmonia e relações de confiança.',
'N' => 'Maior sensibilidade ao estresse; benefício em rotinas e autocuidado.',
];


arsort($averages);
$topTraitKey = array_key_first($averages);
$topTraitValue = $averages[$topTraitKey];


$result = [
'averages' => $averages,
'labels' => $labels,
'insights' => $insights,
'top' => [ 'key' => $topTraitKey, 'label' => $labels[$topTraitKey], 'value' => $topTraitValue ],
'name' => $validated['name'],
'email' => $validated['email'],
'phone' => $validated['phone'],
];


return view('teste-personalidade', [
'questions' => $this->questions,
'result' => $result,
]);
}
}