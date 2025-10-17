@extends('layouts.app')

@section('title', 'Teste de Personalidade')

@section('content')
  <div class="container">
    <header class="header">
      <div class="title">Formulário de Contato + Teste de Personalidade</div>
      <div class="subtitle">Responda as 10 questões e veja o perfil resumido.</div>
    </header>

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

          <h2>Questões (1–5)</h2>
          <div class="row" style="display:grid;grid-template-columns:1fr;gap:12px">
            @foreach ($questions as $q)
              <div class="question">
                <div class="q-title">{{ $q['text'] }}</div>
                
                {{-- ⭐ Avaliação por estrelas --}}
                <div class="stars" data-question="{{ $q['id'] }}">
                  @for ($i = 5; $i >= 1; $i--)
                    <input type="radio" id="{{ $q['id'] }}_{{ $i }}" name="{{ $q['id'] }}" value="{{ $i }}" 
                      {{ old($q['id']) == $i ? 'checked' : '' }} required />
                    <label for="{{ $q['id'] }}_{{ $i }}" title="{{ $i }} estrela{{ $i > 1 ? 's' : '' }}">★</label>
                  @endfor
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
      Exemplo feito por João Saraiva.
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
