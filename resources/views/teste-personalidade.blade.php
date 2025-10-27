@extends('layouts.app')

@section('title', 'Teste de Personalidade')

@section('content')
  <div class="container">
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
    Teste de Personalidade
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
     background:transparent rgba(30,64,175,.25);">
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
    <div class="grid">
      {{-- CARD 1: Formulário --}}
      <div class="card" id="card1">
        <h2>Seus dados</h2>

        @if ($errors->any())
          <div class="error"><strong>Ops!</strong> Corrija os campos em destaque abaixo.</div>
        @endif

        <form method="post" action="{{ route('teste.submit') }}">
          @csrf

          <div class="row cols-2" style="display:grid;grid-template-columns:1fr;gap:12px">
            <div>
              <label for="name">Nome</label>
              <input id="name" type="text" name="name" value="{{ old('name') }}" />
              @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div>
              <label for="email">E-mail</label>
              <input id="email" type="email" name="email" value="{{ old('email') }}" />
              @error('email')<div class="error">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="row" style="display:grid;grid-template-columns:1fr;gap:12px;margin-top:12px">
            <div>
              <label for="phone">Telefone (opcional)</label>
              <input id="phone" type="text" name="phone" placeholder="(11) 9 9999-9999" value="{{ old('phone') }}" />
              @error('phone')<div class="error">{{ $message }}</div>@enderror
            </div>
          </div>

          <hr style="margin:18px 0; border:none; border-top:1px solid rgba(2,6,23,.10);" />

          <h2>Questões (1–10)</h2>
          <div class="row" style="display:grid;grid-template-columns:1fr;gap:12px">
            @foreach ($questions as $q)
              <div class="question">
                <div class="q-title">{{ $q['text'] }}</div>

                {{-- ✅ ALTERADO: opções em FRASES (A..E) --}}
                <div class="options" style="display:grid; gap:8px; margin-top:8px;">
                  @foreach(($q['options'] ?? []) as $key => $opt)
                    @php $field = $q['id']; @endphp
                    <label style="display:flex; align-items:center; gap:10px;">
                      <input type="radio"
                             name="{{ $field }}"
                             value="{{ $key }}"
                             {{ old($field) == $key ? 'checked' : '' }}
                             required>
                      <span>{{ $opt['label'] ?? $key }}</span>
                    </label>
                  @endforeach
                </div>

                @error($q['id'])<div class="error">{{ $message }}</div>@enderror
              </div>
            @endforeach
          </div>

          <div style="margin-top:14px; display:flex; gap:10px;">
            <button class="btn-primary" type="submit">Calcular meu perfil</button>
            <a class="pill" href="{{ route('teste.show') }}">Limpar</a>
          </div>
        </form>
      </div>

      {{-- CARD 2: Resultado --}}
      <div class="card" id="card2" style="border: 2px solid #0f172a;">
        <h2>Resultado</h2>

        @if (!empty($result))
          @php
            $percents = [];
            foreach ($result['averages'] as $k => $avg) {
              $percents[$k] = (int) round(($avg / 5) * 100);
            }
          @endphp

          <div class="result">
            <div class="resposta">
              <div><span class="pill">Nome:</span> {{ $result['name'] }} </div>
              <div><span class="pill">E-mail:</span> {{ $result['email'] }}</div>
              <div >@if (!empty($result['phone'])) <span class="pill">Tel.:</span> {{ $result['phone'] }}@endif 
              </div>
            </div>

            <div>
              <div class="pill">Traço predominante</div>
              <div style="font-weight:700; font-size:16px; margin-top:6px;">
                {{ $result['top']['label'] }} ({{ $result['top']['value'] }}/5)
              </div>
              <div style="margin-top:6px; color:#64748b;">
                {{ $result['insights'][$result['top']['key']] }}
              </div>
            </div>

            <div>
              <div class="pill">Seus escores (1–5)</div>
              @foreach ($result['averages'] as $k => $avg)
                <div style="display:flex; align-items:center; gap:10px; margin-top:8px;">
                  <div style="width:130px; white-space:nowrap;">{{ $result['labels'][$k] }}:</div>
                  <div class="bar">
                    <span style="{{ 'width:' . $percents[$k] . '%' }}"></span>
                  </div>
                  <div style="width:38px; text-align:right;">{{ $avg }}</div>
                </div>
              @endforeach
            </div>

            <div style="font-size:12px; color:#64748b; margin-top:6px;">
              Observação: este é um teste indicativo e não substitui avaliações profissionais.
            </div>
          </div>
        @else
          <p style="color:#64748b;">Preencha o formulário à esquerda e clique em “Calcular meu perfil”. O resultado aparecerá aqui.</p>
        @endif
      </div>
    </div>

    <footer style="margin-top:28px; text-align:center; color:#64748b; font-size:12px;">
      Exemplo feito por João Saraiva. Adapte para salvar no banco ou enviar e-mail.
    </footer>
  </div>

  {{-- Scroll automático até o resultado --}}
  @if (!empty($result))
    <script>
      setTimeout(() => {
        window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
      }, 120);
    </script>
  @endif
@endsection
