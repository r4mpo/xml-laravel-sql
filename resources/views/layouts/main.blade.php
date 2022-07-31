<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <title>@yield('title')</title>
</head>
<body>
    <meta name="csrf-token" content="{{ csrf_token() }}">    
    <header class="header">
        <nav class="navbar navbar-expand-lg bg-dark">
            <a class="navbar-brand" style="color: white; margin-left: 25px;" href="/">Mercadorias</a>
            <div class="dropdown">
                <a class="btn btn-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Nova Mercadoria
                </a>
              
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">Importar</a></li>
                  <li><a class="dropdown-item" href="/mercadorias/create">Cadastrar</a></li>
                </ul>
              </div>
            </div>
        </nav>
    </header>

    @yield('content')
    
    <footer class="footer">
        <p>Mercadorias | Arquivos XML | @r4mpo &copy;</p>
    </footer>
    
    @include('modal')
</body>
</html>