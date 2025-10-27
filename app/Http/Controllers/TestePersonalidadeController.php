<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str; // 🔹 Import necessário para gerar tokens únicos

class TestePersonalidadeController extends Controller
{
    /**
     * Perguntas base — sempre na mesma estrutura,
     * mas a ordem e as opções serão embaralhadas no método show().
     */
    private array $questions = [
        [
    
        'id' => 'q1',
        'text' => 'Quando enfrento um novo desafio, eu costumo…',
        'options' => [
            'A' => ['label' => 'procurar maneiras criativas e diferentes de resolvê-lo', 'trait' => 'O'],
            'B' => ['label' => 'fazer um plano detalhado antes de agir', 'trait' => 'C'],
            'C' => ['label' => 'conversar com outras pessoas para trocar ideias', 'trait' => 'E'],
            'D' => ['label' => 'pedir ajuda e tentar manter o clima harmonioso', 'trait' => 'A'],
            'E' => ['label' => 'ficar ansioso(a) e pensar em tudo o que pode dar errado', 'trait' => 'N'],
        ],
    ],
    [
        'id' => 'q2',
        'text' => 'No meu tempo livre, eu prefiro…',
        'options' => [
            'A' => ['label' => 'aprender algo novo ou explorar novos lugares', 'trait' => 'O'],
            'B' => ['label' => 'organizar tarefas e colocar a vida em ordem', 'trait' => 'C'],
            'C' => ['label' => 'estar com amigos e conhecer pessoas novas', 'trait' => 'E'],
            'D' => ['label' => 'ajudar alguém próximo ou fazer algo útil para os outros', 'trait' => 'A'],
            'E' => ['label' => 'ficar em casa descansando e evitando preocupações', 'trait' => 'N'],
        ],
    ],
    [
        'id' => 'q3',
        'text' => 'Quando preciso tomar uma decisão importante…',
        'options' => [
            'A' => ['label' => 'analisar ideias diferentes e pensar em possibilidades criativas', 'trait' => 'O'],
            'B' => ['label' => 'avaliar riscos e seguir um plano estruturado', 'trait' => 'C'],
            'C' => ['label' => 'pedir a opinião de várias pessoas antes de decidir', 'trait' => 'E'],
            'D' => ['label' => 'pensar em como isso pode afetar os outros', 'trait' => 'A'],
            'E' => ['label' => 'ficar inseguro(a) e ter medo de escolher errado', 'trait' => 'N'],
        ],
    ],
    [
        'id' => 'q4',
        'text' => 'Em um grupo de trabalho, eu sou aquele(a) que…',
        'options' => [
            'A' => ['label' => 'sugere ideias inovadoras e fora da caixa', 'trait' => 'O'],
            'B' => ['label' => 'garante que tudo seja feito no prazo', 'trait' => 'C'],
            'C' => ['label' => 'motiva o grupo e mantém todos animados', 'trait' => 'E'],
            'D' => ['label' => 'ouve as opiniões e busca consenso', 'trait' => 'A'],
            'E' => ['label' => 'prefere ficar mais na minha, observando', 'trait' => 'N'],
        ],
    ],
    [
        'id' => 'q5',
        'text' => 'Quando as coisas não saem como o planejado…',
        'options' => [
            'A' => ['label' => 'tento ver o lado bom e aprender com isso', 'trait' => 'O'],
            'B' => ['label' => 'reorganizo tudo para voltar ao controle', 'trait' => 'C'],
            'C' => ['label' => 'falo sobre o que aconteceu com alguém próximo', 'trait' => 'E'],
            'D' => ['label' => 'tento acalmar as pessoas envolvidas', 'trait' => 'A'],
            'E' => ['label' => 'fico irritado(a) ou preocupado(a) por muito tempo', 'trait' => 'N'],
        ],
    ],
    [
        'id' => 'q6',
        'text' => 'Sobre minha rotina diária, eu…',
        'options' => [
            'A' => ['label' => 'gosto de variar e experimentar coisas novas', 'trait' => 'O'],
            'B' => ['label' => 'tenho horários e hábitos bem definidos', 'trait' => 'C'],
            'C' => ['label' => 'costumo conversar e interagir com várias pessoas', 'trait' => 'E'],
            'D' => ['label' => 'tento sempre ser agradável e ajudar onde posso', 'trait' => 'A'],
            'E' => ['label' => 'fico incomodado(a) se algo sai do planejado', 'trait' => 'N'],
        ],
    ],
    [
        'id' => 'q7',
        'text' => 'Quando alguém me critica…',
        'options' => [
            'A' => ['label' => 'reflito sobre o que posso aprender com isso', 'trait' => 'O'],
            'B' => ['label' => 'tento melhorar e corrigir o que foi apontado', 'trait' => 'C'],
            'C' => ['label' => 'converso para entender o ponto de vista da pessoa', 'trait' => 'E'],
            'D' => ['label' => 'evito conflitos e mantenho o bom relacionamento', 'trait' => 'A'],
            'E' => ['label' => 'levo para o lado pessoal e fico mal por um tempo', 'trait' => 'N'],
        ],
    ],
    [
        'id' => 'q8',
        'text' => 'Em um fim de semana ideal, eu gostaria de…',
        'options' => [
            'A' => ['label' => 'visitar um lugar diferente ou tentar um hobby novo', 'trait' => 'O'],
            'B' => ['label' => 'colocar tarefas pendentes em dia', 'trait' => 'C'],
            'C' => ['label' => 'estar com várias pessoas, festas ou eventos', 'trait' => 'E'],
            'D' => ['label' => 'passar tempo com quem eu amo, em paz', 'trait' => 'A'],
            'E' => ['label' => 'ficar em casa relaxando, sem surpresas', 'trait' => 'N'],
        ],
    ],
    [
        'id' => 'q9',
        'text' => 'Quando algo inesperado acontece…',
        'options' => [
            'A' => ['label' => 'encaro como uma oportunidade de aprender', 'trait' => 'O'],
            'B' => ['label' => 'penso rápido em como reorganizar as coisas', 'trait' => 'C'],
            'C' => ['label' => 'tento resolver com a ajuda de alguém', 'trait' => 'E'],
            'D' => ['label' => 'ajo com calma para evitar conflitos', 'trait' => 'A'],
            'E' => ['label' => 'fico nervoso(a) e perco o foco por um tempo', 'trait' => 'N'],
        ],
    ],


        [
            'id' => 'q10',
            'text' => 'Na vida eu gosto de…',
            'options' => [
                'A' => ['label' => 'descobrir perspectivas diferentes', 'trait' => 'O'],
                'B' => ['label' => 'entregar com qualidade e consistência', 'trait' => 'C'],
                'C' => ['label' => 'reunir pessoas e celebrar conquistas', 'trait' => 'E'],
                'D' => ['label' => 'trabalhar em equipe com empatia', 'trait' => 'A'],
                'E' => ['label' => 'evitar riscos e buscar segurança', 'trait' => 'N'],
            ],
        ],
    ];

    /** 🔹 Mostra o teste (embaralha perguntas e opções) */
    public function show()
    {
        $questions = $this->questions;
        shuffle($questions); // embaralha a ordem das perguntas

        $optionMap = []; // guarda tokens -> traços
        $shuffledQuestions = [];

        foreach ($questions as $q) {
            // embaralha a ordem das opções
            $options = $q['options'];
            $optionsList = array_values($options);
            shuffle($optionsList);

            $displayOptions = [];
            foreach ($optionsList as $opt) {
                $token = Str::random(10);
                $displayOptions[$token] = ['label' => $opt['label']];
                $optionMap[$q['id']][$token] = $opt['trait'];
            }

            $shuffledQuestions[] = [
                'id' => $q['id'],
                'text' => $q['text'],
                'options' => $displayOptions,
            ];
        }

        // salva o mapa na sessão
        session(['option_map' => $optionMap]);

        return view('teste-personalidade', [
            'questions' => $shuffledQuestions,
            'result' => null,
        ]);
    }

    /** 🔹 Recebe e calcula com base no mapa da sessão */
    public function submit(Request $request)
    {
        $rules = [
            'name'  => ['required','string','max:120'],
            'email' => ['required','email','max:160'],
            'phone' => ['required','string','max:40','min:11'],
        ];

        $optionMap = session('option_map', []);
        foreach ($this->questions as $q) {
            $qid = $q['id'];
            $allowed = implode(',', array_keys($optionMap[$qid] ?? []));
            $rules[$qid] = ['required', "in:$allowed"];
        }

        $validated = $request->validate($rules);
        session()->forget('option_map'); // apaga o mapa após o uso

        $scores = ['O'=>0,'C'=>0,'E'=>0,'A'=>0,'N'=>0];
        foreach ($this->questions as $q) {
            $qid = $q['id'];
            $token = $validated[$qid];
            $trait = $optionMap[$qid][$token] ?? null;
            if ($trait) {
                $scores[$trait] += 1;
            }
        }

        $total = count($this->questions);
        $averages = [];
        foreach ($scores as $t => $v) {
            $averages[$t] = $total ? round(($v / $total) * 5, 2) : 0;
        }

        $labels = [
            'O' => 'Abertura',
            'C' => 'Conscienciosidade',
            'E' => 'Extroversão',
            'A' => 'Amabilidade',
            'N' => 'Neuroticismo',
        ];
        $insights = [
            'O' => 'Valorização de novidades e criatividade.',
            'C' => 'Organização e responsabilidade.',
            'E' => 'Energia social elevada.',
            'A' => 'Empatia e cooperação.',
            'N' => 'Sensibilidade a estresse; rotinas ajudam.',
        ];

        arsort($averages);
        $top = array_key_first($averages);

        $result = [
            'averages' => $averages,
            'labels' => $labels,
            'insights' => $insights,
            'top' => [
                'key' => $top,
                'label' => $labels[$top],
                'value' => $averages[$top],
            ],
            'name'  => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ];

        return view('teste-personalidade', [
            'questions' => $this->questions,
            'result' => $result,
        ]);
    }
}
