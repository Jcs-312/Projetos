<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Meu Site')</title>

  <style>
    /* ===== RESET ===== */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell;
      background: #f5f7fa;
      color: #1e293b;
    }

    /* ===== HEADER AZUL E BRANCO ===== */
    header {
      position: fixed; top: 0; left: 0; width: 100%; height: 75px;
      background: linear-gradient(90deg, #2563eb, #1e40af);
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 40px; color: #fff; z-index: 100;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }
    .logo { font-size: 1.6rem; font-weight: 700; letter-spacing: .5px; }
    nav ul { display: flex; list-style: none; gap: 30px; }
    nav ul li a { text-decoration: none; color: #e0f2fe; font-weight: 500; transition: color .3s; }
    nav ul li a:hover { color: #fff; border-bottom: 2px solid #fff; padding-bottom: 3px; }
    .header-right { display: flex; align-items: center; gap: 14px; }
    .btn {
      border: 2px solid #fff; background: transparent; color: #fff;
      border-radius: 999px; padding: 8px 16px; cursor: pointer; font-weight: 600;
      transition: all .3s ease;
    }
    .btn:hover { background: #fff; color: #1e40af; }

    /* ===== CONTEÚDO ===== */
    main { padding: 30px; padding-top: 120px; } /* espaço p/ header fixo */

    /* ===== UTILIDADES DA PÁGINA FILHA ===== */
    .container { max-width: 980px; margin: 0 auto; }
    .header { text-align: center; margin-bottom: 28px; }
    .title { font-size: 28px; font-weight: 800; letter-spacing: .2px; }
    .subtitle { color: #fff; margin-top: 6px; }
    .resposta { display: flex; flex-direction: column; gap: 2px;}
    .resposta span {width: max-content;}
    .telefone {height: max-content;}

    .grid { display: grid; grid-template-columns: 1fr; gap: 16px; align-items: start; } /* importante */
    @media (min-width: 900px) { .grid { grid-template-columns: 1.2fr .8fr; } }

    .card {
      background: linear-gradient(180deg, rgba(255,255,255,.95), rgba(255,255,255,.9));
      border: 1px solid rgba(2,6,23,.08);
      border-radius: 16px; padding: 20px;
      box-shadow: 0 1px 3px rgba(2,6,23,.06);
    }
    .card h2 { margin: 0 0 12px; font-size: 18px; }

    label { font-size: 13px; color: #475569; display: block; margin-bottom: 6px; }
    input[type="text"], input[type="email"], select {
      width: 100%; border: 1px solid rgba(2,6,23,.16); background: #e7f0ff; color: #0b1320;
      padding: 10px 12px; border-radius: 10px; outline: none; transition: box-shadow .15s, border-color .15s;
    }
    input:focus, select:focus { box-shadow: 0 0 0 4px rgba(37,99,235,.25); border-color: #2563eb; }

    .question { padding: 12px; border-radius: 12px; border: 1px dashed rgba(2,6,23,.12); margin-bottom: 10px; }
    .q-title { font-weight: 600; margin-bottom: 8px; }
    /* Centraliza o texto dentro das caixinhas */
    .scale select {
      width: 100%;
      text-align: center;           /* centraliza o texto selecionado */
      text-align-last: center;      /* centraliza a opção exibida */
      padding: 6px;
      border-radius: 8px;
      border: 1px solid #2563eb;
      background-color: #e7f0ff;
      appearance: none;             /* remove seta padrão p/ estilizar */
    }

    /* Centraliza também o texto das opções na lista suspensa */
    .scale select option {
      text-align: center;
}

    /* .scale { display: grid; grid-template-columns: repeat(5, 1fr); gap: 8px; }
    .scale select { text-align: center; } */
    

    .error {
      color: #991b1b; background: rgba(239,68,68,.08); border: 1px solid rgba(239,68,68,.35);
      padding: 8px 10px; border-radius: 10px; margin: 6px 0 12px; font-size: 13px;
    }

    .btn-primary {
      appearance: none; background: #2563eb; color: #fff; border: none; border-radius: 12px;
      padding: 12px 14px; font-weight: 700; cursor: pointer; transition: transform .06s ease, filter .2s;
    }
    .btn-primary:hover { filter: brightness(1.05); }
    .btn-primary:active { transform: translateY(1px); }

    .pill {
      display: inline-block;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid rgba(2, 6, 23, .14);
      background: rgba(2, 6, 23, .04);
      font-size: 12px;
      color: #64748b;
      align-content: center;
    }

    .result { display: grid; gap: 12px; }
    .bar { height: 10px; background: rgba(2,6,23,.08); border-radius: 999px; overflow: hidden; }
    .bar > span { display: block; height: 100%; background: linear-gradient(90deg, #22c55e, #a7f3d0); width: 0%; }

    a { color: #2563eb; text-decoration: none; }
    footer { margin-top: 28px; text-align: center; color: #64748b; font-size: 12px; }

    /* card2 não esticar */
    #card2 { align-self: start; }
    /* ===== ESTRELAS ===== */
    .stars {
      display: flex;
      flex-direction: row-reverse;
      justify-content: center;
      gap: 5px;
    }

    .stars input {
      display: none;
    }

    .stars label {
      font-size: 28px;
      color: #cbd5e1; /* cinza claro (apagado) */
      cursor: pointer;
      transition: color 0.2s;
    }

    .stars label:hover,
    .stars label:hover ~ label {
      color: #fde047; /* amarelo hover */
    }

    .stars input:checked ~ label {
      color: #facc15; /* amarelo selecionado */
    }

  </style>
</head>
<body>

  <header>
    <div class="logo">
      {{-- Se quiser imagem de logo: <img src="{{ asset('imagens/logo.png') }}" alt="Logo" style="height:45px;margin-right:10px;vertical-align:middle;"> --}}
      MeuSite
    </div>

    <nav>
      <ul>
        <li><a href="/">Início</a></li>
        <li><a href="#">Serviços</a></li>
        <li><a href="#">Sobre</a></li>
        <li><a href="#">Contato</a></li>
      </ul>
    </nav>

    <div class="header-right">
      <button class="btn">Entrar</button>
      <button class="btn">Cadastrar</button>
    </div>
  </header>

  <main>
    @yield('content')
  </main>

</body>
</html>
