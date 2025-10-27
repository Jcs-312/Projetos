@extends('layouts.app')

@section('title', 'Sobre Nós')

@section('content')
<div class="container" style="text-align:center; padding:40px 20px;">

  {{-- HEADER --}}
  <header style="background: linear-gradient(90deg,#1e40af,#2563eb); color:#fff; padding:12px 16px; display:flex; align-items:center; gap:12px;">
    <button id="menu-toggle" aria-label="Abrir menu" aria-controls="side-menu" aria-expanded="false"
      style="background:transparent;border:none;display:flex;align-items:center;justify-content:center;width:40px;height:40px;cursor:pointer;border-radius:8px;">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
        <rect x="3" y="6"  width="18" height="2" fill="White"/>
        <rect x="3" y="11" width="18" height="2" fill="White"/>
        <rect x="3" y="16" width="18" height="2" fill="White"/>
      </svg>
    </button>

    <h1 style="margin:20px; font-weight:800; font-size:clamp(1.4rem,4vw,2.2rem); text-align:center;">
      {{ $sobrenos['titulo'] }}
    </h1>
  </header>

  {{-- MENU LATERAL --}}
  <div id="overlay" style="position:fixed; inset:0; background:rgba(2,6,23,.5); opacity:0; pointer-events:none; transition:opacity .2s ease;"></div>

  <nav id="side-menu" aria-hidden="true" style="position:fixed; top:0; left:0; height:100vh; width:280px; background:#0f172a; color:white; transform:translateX(-100%); transition:transform .25s ease; box-shadow:2px 0 14px rgba(0,0,0,.25); display:flex; flex-direction:column; padding:16px; z-index:50;">
    <div style="display:flex; align-items:center; justify-content:space-between; gap:8px;">
      <strong style="font-size:1.1rem;">Menu</strong>
      <button id="menu-close" aria-label="Fechar menu" style="background:transparent;border:none;color:#fff;cursor:pointer;width:36px;height:36px;display:flex;align-items:center;justify-content:center;">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
          <path d="M6 6L18 18M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </button>
    </div>

    <hr style="border:none; border-top:1px solid rgba(255,255,255,.12); margin:12px 0;">

    <a href="{{ route('home') }}" style="color:#e2e8f0; text-decoration:none; padding:10px 8px; border-radius:8px;">🏠 Início</a>
    <a href="{{ route('teste.show') }}" style="color:#e2e8f0; text-decoration:none; padding:10px 8px; border-radius:8px;">🧠 Teste de Personalidade</a>
    <a href="{{ route('contato.show') }}" style="color:#e2e8f0; text-decoration:none; padding:10px 8px; border-radius:8px;">✉️ Fale Conosco</a>
    <a href="{{ route('sobrenos.show') }}" style="color:#e2e8f0; text-decoration:none; padding:10px 8px; border-radius:8px;">ℹ️ Sobre Nós</a>


    <div style="margin-top:auto; font-size:.85rem; color:#94a3b8;">© {{ date('Y') }} Projeto João Saraiva</div>
  </nav>

  <script>
    const btnOpen=document.getElementById('menu-toggle');
    const btnClose=document.getElementById('menu-close');
    const drawer=document.getElementById('side-menu');
    const overlay=document.getElementById('overlay');
    function openMenu(){drawer.style.transform='translateX(0)';overlay.style.opacity='1';overlay.style.pointerEvents='auto';}
    function closeMenu(){drawer.style.transform='translateX(-100%)';overlay.style.opacity='0';overlay.style.pointerEvents='none';}
    btnOpen.addEventListener('click',openMenu);
    btnClose.addEventListener('click',closeMenu);
    overlay.addEventListener('click',closeMenu);
    document.addEventListener('keydown',e=>{if(e.key==='Escape')closeMenu();});
  </script>

  {{-- INTRODUÇÃO --}}
  <section style="max-width:780px; margin:24px auto 16px;">
    <p style="color:#475569; line-height:1.7;">{{ $sobrenos['introducao'] }}</p>
  </section>

  {{-- MISSÃO / VISÃO / INDICADORES --}}
  <section style="display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:18px; margin:18px auto; max-width:1000px;">
    <div style="background:#fff; border:1px solid #e2e8f0; border-radius:12px; padding:16px; text-align:left;">
      <h3 style="color:#1e3a8a; margin:0 0 8px;">Missão</h3>
      <p>{{ $sobrenos['missao'] }}</p>
    </div>
    <div style="background:#fff; border:1px solid #e2e8f0; border-radius:12px; padding:16px; text-align:left;">
      <h3 style="color:#1e3a8a; margin:0 0 8px;">Visão</h3>
      <p>{{ $sobrenos['visao'] }}</p>
    </div>
    <div style="background:#fff; border:1px solid #e2e8f0; border-radius:12px; padding:16px; text-align:left;">
      <h3 style="color:#1e3a8a; margin:0 0 8px;">Indicadores</h3>
      <div style="display:flex; gap:12px; flex-wrap:wrap;">
        @foreach($sobrenos['indicadores'] as $ind)
          <div style="flex:1 1 120px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:12px; text-align:center;">
            <strong style="color:#0f172a; font-size:1.1rem;">{{ $ind['valor'] }}</strong>
            <div style="color:#64748b; font-size:.9rem;">{{ $ind['rotulo'] }}</div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- VALORES --}}
  <section style="max-width:1000px; margin:22px auto 0;">
    <h3 style="color:#1e3a8a; margin:0 0 10px;">Nossos valores</h3>
    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:16px;">
      @foreach($sobrenos['valores'] as $v)
        <div style="background:#fff; border:1px solid #e2e8f0; border-radius:10px; padding:14px; text-align:left;">
          <div style="font-size:1.2rem; margin-bottom:6px;">{{ $v['icone'] }} <strong style="color:#0f172a;">{{ $v['titulo'] }}</strong></div>
          <p style="color:#475569; margin:0;">{{ $v['descricao'] }}</p>
        </div>
      @endforeach
    </div>
  </section>

  {{-- EQUIPE --}}
  <section style="max-width:1000px; margin:28px auto 0;">
    <h3 style="color:#1e3a8a; margin:0 0 10px;">Nossa equipe</h3>
    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:18px;">
      @foreach($sobrenos['equipe'] as $m)
        <article style="background:#fff; border:1px solid #e2e8f0; border-radius:12px; padding:14px; display:table-cell; gap:12px; align-items:flex-start;">
          <img src="{{ $m['img'] }}" alt="Foto de {{ $m['nome'] }}" width="64" height="64" style="border-radius:12px; object-fit:cover;">
          <div>
            <div style="font-weight:700; color:#0f172a;">{{ $m['nome'] }}</div>
            <div style="color:#2563eb; font-weight:600;">{{ $m['cargo'] }}</div>
            <p style="color:#475569;">{{ $m['bio'] }}</p>
          </div>
        </article>
      @endforeach
    </div>
  </section>

  {{-- LINHA DO TEMPO --}}
  <section style="max-width:860px; margin:28px auto 0;">
    <h3 style="color:#1e3a8a;">Nossa jornada</h3>
    <ul style="list-style:none; padding:0; margin:0;">
      @foreach($sobrenos['linha_do_tempo'] as $item)
        <li style="display:flex; gap:12px; padding:10px 0; border-bottom:1px dashed #e2e8f0;">
          <div style="min-width:74px; color:#1e3a8a; font-weight:700;">{{ $item['ano'] }}</div>
          <div style="color:#475569;">{{ $item['evento'] }}</div>
        </li>
      @endforeach
    </ul>
  </section>

  {{-- FAQ --}}
  <section style="max-width:860px; margin:28px auto 0; text-align:left;">
    <h3 style="color:#1e3a8a;">Perguntas frequentes</h3>
    <div style="display:grid; gap:12px;">
      @foreach($sobrenos['faqs'] as $f)
        <details style="background:#fff; border:1px solid #e2e8f0; border-radius:10px; padding:12px 14px;">
          <summary style="cursor:pointer; font-weight:700; color:#0f172a;">{{ $f['pergunta'] }}</summary>
          <div style="margin-top:8px; color:#475569;">{{ $f['resposta'] }}</div>
        </details>
      @endforeach
    </div>
  </section>

  {{-- CTA --}}
  <section style="max-width:860px; margin:30px auto 0; text-align:center; background:linear-gradient(90deg,#1e40af1a,#2563eb1a); border:1px solid #e2e8f0; border-radius:14px; padding:18px;">
    <div style="display:flex; gap:12px; justify-content:center; flex-wrap:wrap;">
      <a href="{{ $sobrenos['cta']['botao_principal']['link'] }}" style="padding:12px 20px; background:#1e40af; color:#fff; border-radius:10px; text-decoration:none; font-weight:700;">
        {{ $sobrenos['cta']['botao_principal']['texto'] }}
      </a>
      <a href="{{ $sobrenos['cta']['botao_secundario']['link'] }}" style="padding:12px 20px; background:#1e40af; color:#fff; border-radius:10px; text-decoration:none; font-weight:700;">
        {{ $sobrenos['cta']['botao_secundario']['texto'] }}
      </a>
    </div>
  </section>

  <hr style="margin:40px auto; width:80%; border:none; border-top:1px solid rgba(2,6,23,.1);" />

  <footer style="color:#64748b; font-size:0.9rem;">
    <p>© {{ date('Y') }} Projeto João Saraiva. Todos os direitos reservados.</p>
  </footer>

</div>
@endsection
