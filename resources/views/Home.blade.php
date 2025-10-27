@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')
  <div class="container" style="text-align:center; padding:40px 20px;">

    {{-- HERO --}}
   <header style="
  background: linear-gradient(90deg,#1e40af,#2563eb);
  color:#fff;
  padding:12px 16px;
  display:flex;
  align-items:center;
  gap:12px;
">
  {{-- Botão hambúrguer à esquerda --}}
  <button id="menu-toggle"
          aria-label="Abrir menu"
          aria-controls="side-menu"
          aria-expanded="false"
          style="
            background:transparent;
            border:none;
            display:flex;
            align-items:center;
            justify-content:center;
            width:40px;height:40px;
            cursor:pointer;
            border-radius:8px;
          ">
    {{-- Ícone (SVG 3 listras) --}}
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
         xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <rect x="3" y="6"  width="18" height="2" fill="white"/>
      <rect x="3" y="11" width="18" height="2" fill="white"/>
      <rect x="3" y="16" width="18" height="2" fill="white"/>
    </svg>
  </button>

  {{-- Título central (ajuste conforme seu layout) --}}
  <h1 style="margin:20px; text-align:center, font-weight:800; font-size:clamp(1.4rem,4vw,2.2rem);">
    Bem-vindo(a) ao Portal de Testes
  </h1>
</header>

{{-- Overlay para “escurecer” o fundo quando o menu abre --}}
<div id="overlay" style="
  position:fixed; inset:0;
  background:rgba(2,6,23,.5);
  opacity:0; pointer-events:none;
  transition:opacity .2s ease;
"></div>

{{-- Drawer lateral esquerdo --}}
<nav id="side-menu" aria-hidden="true" style="
  position:fixed; top:0; left:0; height:100vh; width:280px;
  background:#0f172a; color:white;
  transform:translateX(-100%);
  transition:transform .25s ease;
  box-shadow:2px 0 14px rgba(0,0,0,.25);
  display:flex; flex-direction:column;
  padding:16px;
  z-index:50;
">
  <div style="display:flex; align-items:center; justify-content:space-between; gap:8px;">
    <strong style="font-size:1.1rem;">Menu</strong>
    <button id="menu-close" aria-label="Fechar menu" style="
      background:transparent; border:none; color:#fff; cursor:pointer;
      width:36px; height:36px; display:flex; align-items:center; justify-content:center;
    ">
      {{-- X --}}
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
        <path d="M6 6L18 18M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
      </svg>
    </button>
  </div>

  <hr style="border:none; border-top:1px solid rgba(255,255,255,.12); margin:12px 0;">

  {{-- Links do menu --}}
  <a href="{{ route('home') }}" style="color:#e2e8f0; text-decoration:none; padding:10px 8px; border-radius:8px;">🏠 Início</a>
  <a href="{{ route('teste.show') }}" style="color:#e2e8f0; text-decoration:none; padding:10px 8px; border-radius:8px;">🧠 Teste de Personalidade</a>
  <a href="{{ route('contato.show') }}" style="color:#e2e8f0; text-decoration:none; padding:10px 8px; border-radius:8px;">✉️ Fale Conosco</a>
  <a href="{{ route('sobrenos.show') }}" style="color:#e2e8f0; text-decoration:none; padding:10px 8px; border-radius:8px;">ℹ️ Sobre Nós</a>

  {{-- Rodapé do menu --}}
  <div style="margin-top:auto; font-size:.85rem; color:#94a3b8;">
    © {{ date('Y') }} Projeto João Saraiva
  </div>
</nav>

<script>
  const btnOpen  = document.getElementById('menu-toggle');
  const btnClose = document.getElementById('menu-close');
  const drawer   = document.getElementById('side-menu');
  const overlay  = document.getElementById('overlay');

  function openMenu() {
    drawer.style.transform = 'translateX(0)';
    overlay.style.opacity = '1';
    overlay.style.pointerEvents = 'auto';
    btnOpen.setAttribute('aria-expanded', 'true');
    drawer.setAttribute('aria-hidden', 'false');
  }

  function closeMenu() {
    drawer.style.transform = 'translateX(-100%)';
    overlay.style.opacity = '0';
    overlay.style.pointerEvents = 'none';
    btnOpen.setAttribute('aria-expanded', 'false');
    drawer.setAttribute('aria-hidden', 'true');
  }

  btnOpen.addEventListener('click', openMenu);
  btnClose.addEventListener('click', closeMenu);
  overlay.addEventListener('click', closeMenu);

  // Fecha com ESC
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeMenu();
  });
</script>



    {{-- SEÇÃO DESTAQUE (contexto e propósito) --}}
    <section style="max-width:680px; margin:0 auto 24px auto;">
      <h2 style="font-size:1.35rem; font-weight:700; color:#1e3a8a; margin-bottom:6px;">
        Descubra sua personalidade em minutos
      </h2>
      <p style="color:#475569; line-height:1.6;">
        Nosso teste foi pensado para oferecer um retrato claro dos seus principais traços —
        útil para <strong>autoconhecimento</strong>, <strong>estudos</strong> e até <strong>orientação profissional</strong>.
      </p>
    </section>

    {{-- AVATAR + CTA PRINCIPAL --}}
    <div style="display:flex; flex-direction:column; align-items:center; gap:20px; margin-top:10px;">
      <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png"
           alt="Ícone de personalidade"
           width="120" height="120"
           style="opacity:0.95;">

      <a href="{{ route('teste.show') }}"
         class="btn-primary"
         style="display:inline-block; padding:12px 24px; background-color:#1e40af; color:#ffffff; border-radius:8px; text-decoration:none; font-weight:700;">
        Fazer o Teste de Personalidade
      </a>

      <p style="font-size:0.95rem; color:#475569; margin-top:2px;">
        Leva menos de 5 minutos! 💫
      </p>
    </div>

    {{-- BENEFÍCIOS (3 cards) --}}
    <div style="display:flex; justify-content:center; gap:18px; margin-top:36px; flex-wrap:wrap;">
      <div style="background:#ffffff; border:1px solid #e2e8f0; border-radius:10px; padding:16px; width:220px; box-shadow:0 2px 8px rgba(2,6,23,.06);">
        <h4 style="color:#1e3a8a; margin-bottom:6px;">🎯 Rápido</h4>
        <p style="font-size:14px; color:#475569; margin:0;">10 perguntas objetivas para um perfil inicial.</p>
      </div>
      <div style="background:#ffffff; border:1px solid #e2e8f0; border-radius:10px; padding:16px; width:220px; box-shadow:0 2px 8px rgba(2,6,23,.06);">
        <h4 style="color:#1e3a8a; margin-bottom:6px;">🧠 Claro</h4>
        <p style="font-size:14px; color:#475569; margin:0;">Resultados fáceis de entender e aplicar no dia a dia.</p>
      </div>
      <div style="background:#ffffff; border:1px solid #e2e8f0; border-radius:10px; padding:16px; width:220px; box-shadow:0 2px 8px rgba(2,6,23,.06);">
        <h4 style="color:#1e3a8a; margin-bottom:6px;">💬 Personalizado</h4>
        <p style="font-size:14px; color:#475569; margin:0;">Feedback breve com seus traços predominantes.</p>
      </div>
    </div>

    {{-- BOTÃO FALE CONOSCO --}}
    <a href="{{ route('contato.show') }}"
       class="btn-secondary"
       style="display:inline-block; padding:12px 24px; background-color:#1e40af; color:#ffffff; border-radius:8px; text-decoration:none; font-weight:700; margin-top:24px;">
      Fale Conosco
    </a>
    
    <a href="{{ route('sobrenos.show') }}"
       class="btn-tertiary"
       style="display:inline-block; padding:12px 24px; background-color:#1e40af; color:#ffffff; border-radius:8px; text-decoration:none; font-weight:700; margin-top:24px;">
      Sobre Nós
    </a>
    {{-- PREVIEW DO RESULTADO --}}
    <section style="max-width:720px; margin:48px auto 0 auto; text-align:center;">
      <h3 style="color:#1e3a8a; font-size:1.2rem; margin-bottom:8px;">Exemplo de Resultado</h3>
      <p style="color:#475569; font-size:0.95rem; margin-bottom:14px;">
        <strong>Traço predominante:</strong> Analítico (4.3/5) — foco em lógica, planejamento e melhoria contínua.
      </p>

      {{-- Barrinhas ilustrativas (apenas visual) --}}
      @php
        $labels = ['Analítico' => 86, 'Criativo' => 68, 'Colaborativo' => 74, 'Pragmático' => 62];
      @endphp

      <div style="text-align:left; margin:0 auto; max-width:520px;">
        @foreach($labels as $label => $percent)
          <div style="display:flex; align-items:center; gap:10px; margin:10px 0;">
            <div style="width:140px; color:#0f172a; font-size:14px; white-space:nowrap;">{{ $label }}:</div>
            <div style="flex:1; height:10px; background:#e2e8f0; border-radius:999px; overflow:hidden;">
              <span style="display:block; height:100%; width: {{ $percent }}%; background:#1e40af;"></span>
            </div>
            <div style="width:42px; text-align:right; color:#475569; font-size:13px;">{{ round($percent/20,1) }}/5</div>
          </div>
        @endforeach
      </div>

      <div style="font-size:12px; color:#64748b; margin-top:8px;">
        *Exemplo ilustrativo. O resultado real aparece após enviar o teste.
      </div>
    </section>

    <hr style="margin:50px auto; width:80%; border:none; border-top:1px solid rgba(2,6,23,.1);" />

    {{-- RODAPÉ COM PROPÓSITO --}}
    <footer style="color:#64748b; font-size:0.9rem;">
           <p style="margin:0;">© {{ date('Y') }} Projeto João Saraiva. Todos os direitos reservados.</p>
    </footer>
  </div>
@endsection
