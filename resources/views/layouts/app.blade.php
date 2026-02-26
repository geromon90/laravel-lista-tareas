<!DOCTYPE html>
<html>
    <head>
        <title>CRUD Tareas</title>
    </head>

    <body>

        <h1>Mi Aplicacion de Tareas</h1>

        @if(session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    
    </body>
</html>