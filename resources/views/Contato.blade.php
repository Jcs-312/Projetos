@extends('layouts.app')

@section('title', 'Contato')

@section('content')
<div class="container" style="max-width:960px; margin:0 auto; padding:0;">

  {{-- HEADER COM HAMBÚRGUER --}}
<header style="
  background: linear-gradient(90deg,#1e40af,#2563eb);
  color:#fff; padding:12px 16px; display:flex; align-items:center; gap:12px;">
  <button id="menu-toggle"
          aria-label="Abrir menu"
          aria-controls="side-menu"
          aria-expanded="false"
          style="background:transparent;border:none;display:flex;align-items:center;justify-content:center;width:40px;height:40px;cursor:pointer;border-radius:8px;">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
      <rect x="3" y="6"  width="18" height="2" fill="White"/>
      <rect x="3" y="11" width="18" height="2" fill="White"/>
      <rect x="3" y="16" width="18" height="2" fill="White"/>
    </svg>
  </button>

  <h1 style="margin:0 0 0 8px; font-weight:800; font-size:clamp(1.4rem,4vw,2.2rem);">
    Entre em Contato
  </h1>
</header>

{{-- OVERLAY PARA O MENU --}}
<div id="overlay" style="
  position:fixed; inset:0; background:rgba(2,6,23,.5);
  opacity:0; pointer-events:none; transition:opacity .2s ease;"></div>

{{-- MENU LATERAL ESQUERDO (itens como na imagem) --}}
<nav id="side-menu" aria-hidden="true" style="
  position:fixed; top:0; left:0; height:100vh; width:280px;
  background:#0f172a; color:#e2e8f0;
  transform:translateX(-100%); transition:transform .25s ease;
  box-shadow:2px 0 14px rgba(0,0,0,.25);
  display:flex; flex-direction:column; align-items:center; /* centraliza a coluna */
  padding:16px; z-index:50;">
  <div style="display:flex; align-items:center; justify-content:space-between; gap:8px; width:100%; max-width:220px;">
    <strong style="font-size:1.1rem;">Menu</strong>
    <button id="menu-close" aria-label="Fechar menu" style="background:transparent;border:none;color:#fff;cursor:pointer;width:36px;height:36px;display:flex;align-items:center;justify-content:center;">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
        <path d="M6 6L18 18M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
      </svg>
    </button>
  </div>

  <hr style="border:none; border-top:1px solid rgba(255,255,255,.12); margin:12px 0; width:100%; max-width:220px;">

  {{-- LINKS: largura fixa, ícone à esquerda, texto alinhado à esquerda --}}
  @php $w = 'max-width:220px; width:100%;'; @endphp

  <a href="{{ route('home') }}" style=
    "display:flex; align-items:center; gap:10px;
     padding:10px 12px; border-radius:10px; text-decoration:none;
     color:#e2e8f0; text-align:left; justify-content:flex-start;">
    🏠 <span style="font-size:1rem;">Início</span>
  </a>

  <a href="{{ route('teste.show') }}" style=
    "display:flex; align-items:center; gap:10px;
     padding:10px 12px; border-radius:10px; text-decoration:none;
     color:#e2e8f0; text-align:left; justify-content:flex-start;">
    🧠 <span style="font-size:1rem;">Teste de Personalidade</span>
  </a>

  <a href="{{ route('contato.show') }}" aria-current="page" style=
  "display:flex; align-items:center; gap:10px;
     padding:10px 12px; border-radius:10px; text-decoration:none;
     color:#e2e8f0; text-align:left; justify-content:flex-start;
     background:tr rgba(30,64,175,.25);">
    ✉️ <span style="font-size:1rem;">Fale Conosco</span>
  </a>

  <a href="{{ route('sobrenos.show') }}" style=
    "display:flex; align-items:center; gap:10px;
     padding:10px 12px; border-radius:10px; text-decoration:none;
     color:#e2e8f0; text-align:left; justify-content:flex-start;">
    ℹ️ <span style="font-size:1rem;">Sobre Nós</span>
  </a>

  <div style="margin-top:auto; font-size:.85rem; color:#94a3b8;">
    © {{ date('Y') }} Projeto João Saraiva
  </div>
</nav>

{{-- SCRIPT DO MENU --}}
<script>
  const btnOpen  = document.getElementById('menu-toggle');
  const btnClose = document.getElementById('menu-close');
  const drawer   = document.getElementById('side-menu');
  const overlay  = document.getElementById('overlay');

  function openMenu(){
    drawer.style.transform = 'translateX(0)';
    overlay.style.opacity = '1';
    overlay.style.pointerEvents = 'auto';
    btnOpen?.setAttribute('aria-expanded','true');
    drawer?.setAttribute('aria-hidden','false');
  }
  function closeMenu(){
    drawer.style.transform = 'translateX(-100%)';
    overlay.style.opacity = '0';
    overlay.style.pointerEvents = 'none';
    btnOpen?.setAttribute('aria-expanded','false');
    drawer?.setAttribute('aria-hidden','true');
  }

  btnOpen?.addEventListener('click', openMenu);
  btnClose?.addEventListener('click', closeMenu);
  overlay?.addEventListener('click', closeMenu);
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });
</script>

  {{-- CONTEÚDO / FORM --}}
  <div style="max-width:640px; margin:28px auto; text-align:center; padding:0 16px;">
    <p style="color:#475569; margin-bottom:18px;">
      <strong>Dúvidas, sugestões ou parcerias?</strong> Preencha o formulário abaixo e entraremos em contato.
    </p>

    @if (session('success'))
      <div role="status" style="background:#dcfce7; border:1px solid #22c55e; padding:10px; border-radius:8px; margin-bottom:20px; color:#166534;">
        {{ session('success') }}
      </div>
    @endif

    @if ($errors->any())
      <div role="alert" style="background:#fee2e2; border:1px solid #ef4444; padding:10px; border-radius:8px; margin-bottom:20px; color:#991b1b;">
        <strong>Ops!</strong> Corrija os campos destacados abaixo.
      </div>
    @endif

    <form method="POST" action="{{ route('contato.enviar') }}" style="text-align:left; background:#ffffff; border:1px solid #e2e8f0; border-radius:12px; padding:16px; box-shadow:0 2px 8px rgba(2,6,23,.06);">
      @csrf

      <div style="display:grid; gap:16px;">
        <div>
          <label for="nome" style="font-weight:600;">Nome</label>
          <input id="nome" type="text" name="nome" value="{{ old('nome') }}"
                 style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
          @error('nome')
            <div style="color:#dc2626; font-size:0.875rem; margin-top:4px;">{{ $message }}</div>
          @enderror
        </div>

        <div>
          <label for="email" style="font-weight:600;">E-mail</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}"
                 style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
          @error('email')
            <div style="color:#dc2626; font-size:0.875rem; margin-top:4px;">{{ $message }}</div>
          @enderror
        </div>

        <div>
          <label for="telefone" style="font-weight:600;">Telefone</label>
          <input id="telefone" type="text" name="telefone" value="{{ old('telefone') }}"
                 style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
          @error('telefone')
            <div style="color:#dc2626; font-size:0.875rem; margin-top:4px;">{{ $message }}</div>
          @enderror
        </div>

        <div>
          <label for="mensagem" style="font-weight:600;">Mensagem</label>
          <textarea id="mensagem" name="mensagem" rows="5"
                    style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">{{ old('mensagem') }}</textarea>
          @error('mensagem')
            <div style="color:#dc2626; font-size:0.875rem; margin-top:4px;">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div style="margin-top:20px; display:flex; flex-wrap:wrap; justify-content:center; gap:10px;">
        <button type="submit"
                style="background-color:#1e40af; color:white; border:none; border-radius:10px; padding:10px 20px; font-weight:700; cursor:pointer;">
          Enviar Mensagem
        </button>

        <a href="{{ route('home') }}"
           style="background:#e2e8f0; color:#0f172a; text-decoration:none; border-radius:10px; padding:10px 20px; font-weight:700;">
          Voltar
        </a>
      </div>
    </form>

    <footer style="margin:22px 0 32px; color:#64748b; font-size:0.9rem; text-align:center;">
      Responderemos seu contato o mais breve possível 💬
    </footer>
  </div>
</div>
@endsection
