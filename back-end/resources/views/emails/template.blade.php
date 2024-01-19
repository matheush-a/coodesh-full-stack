<!DOCTYPE html>
<html lang="pt-BR">
<body>
    <section style="width:100%; text-align:center; display:flex; flex-direction:column; justify-content:center; align-items:center;">
      <div style="box-shadow:0 0 6px #5559; line-height:1.5; padding:30px; flex-wrap:wrap;">
          <h1 style="font-size:26px; font-weight:500; margin: 0 0 5px; color:#f37350; display:block; width:100%;">@yield('title')</h1>
          <div style="margin-top:5px; width:100%; align-items:center">
              @yield('content')
          </div>
      </div>
    </section>
</body>
</html>