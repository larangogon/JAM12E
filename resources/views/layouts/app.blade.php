<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tiendas JAM</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="{{asset('js/app.js') }}" defer></script>

    <!-- Font Awesome Icons -->
    <link href="{{asset('plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet" >

    <!-- Fonts -->
    <link href="{{asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700')}}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{asset('dist/css/adminlte.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{mix('css/app.css') }}" rel="stylesheet">


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div id="app">
        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <!-- SEARCH FORM -->
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar"  name="search" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <form action="{{route('vitrina.index')}}" method="get">
                                <label for=""></label><input type="text" name="category" id="" value="Hogar" hidden>
                                <button type="submit" class="btn btn-link">Hogar</button>
                            </form>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <form action="{{route('vitrina.index')}}" method="get">
                                <input type="text" name="category" id="" value="Hombre" hidden>
                                <button type="submit" class="btn btn-link">Hombre</button>
                            </form>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <form action="{{route('vitrina.index')}}" method="get">
                                <input type="text" name="category" id="" value="Mujer" hidden>
                                <button type="submit" class="btn btn-link">Mujer</button>
                            </form>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                     <li class="nav-item dropdown">
                        <div class="container">
                            <a class="navbar-brand" href="{{ url('/vitrina') }}">
                                <i class="fas fa-shopping-bag"></i>JAM Store
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" >
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                     </li>

                     <li class="nav-item dropdown">
                        <ul class="navbar-nav ml-auto">
                            <div class="container" class="collapse navbar-collapse" id="navbarSupportedContent">
                                <a class="navbar-brand" class="nav-link dropdown-toggle" href="{{ url('cart/show') }}">
                                    <i class="fas fa-cart-arrow-down ">
                                        @auth
                                            @if (count(auth()->user()->cart->products))
                                                <span class="badge badge-danger">
                                                    {{(count(auth()->user()->cart->products))}}
                                                </span>
                                            @endif
                                        @endauth
                                    </i>
                                </a>
                            </div>
                        </ul>
                     </li>
                     <li class="nav-item dropdown">
                         <div class="container">
                             <a class="navbar-brand" href="">
                                 <i class="fas fa-phone-alt"></i>+57 300 213 3568
                             </a>
                         </div>
                     </li>
                 </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="{{ url('/') }}" class="brand-link">
                    <img src="{{asset('dist/img/descarga (1).png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light"> JAM Stores</span>
                </a>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ asset('dist/img/photo4.jpg')}}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">
                                @guest
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                                @else
                                {{ Auth::user()->name }}
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                    Cerrar Sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                @endguest
                            </a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <div class="info">
                                <li class="nav-item">
                                    <a href="{{url('nosotros')}}"class="{{ Request::path() === '/' ? 'nav-link active' : 'nav-link' }}">
                                        <p>
                                            Quienes somos!
                                        </p>
                                    </a>
                                </li>
                            </div>
                            @can('Administrator')
                                <div class="info">
                                    <li class="nav-item">
                                        <a href="{{route('nosotros.indexApi')}}"class="{{ Request::path() === '/' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="fas fa-file-medical-alt"></i>
                                            <p>
                                                Como consumir nuestra API!
                                            </p>
                                        </a>
                                    </li>
                                </div>
                            @endcan
                            @can('Administrator')
                                <div class="info">
                                    <li class="nav-item">
                                        <a href="{{route('reports.index')}}" class="{{ Request::path() === '/' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="fas fa-flag"></i>
                                            <p>
                                                Generar reportes
                                            </p>
                                        </a>
                                    </li>
                                </div>
                            @endcan
                            @can('Administrator')
                                <div class="info">
                                    <li class="nav-item">
                                        <a href="{{route('metrics.index')}}" class="{{ Request::path() === '/' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="fas fa-file-alt"></i>
                                            <p>
                                                Metricas
                                            </p>
                                        </a>
                                    </li>
                                </div>
                            @endcan
                            <div class="info">
                                <li class="nav-item">
                                    <a href="/" class="{{ Request::path() === '/' ? 'nav-link active' : 'nav-link' }}">
                                        <i class="nav-icon fas fa-home"></i>
                                        <p>
                                            Inicio
                                        </p>
                                    </a>
                                </li>
                            </div>

                            @can('Administrator')
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-shopping-bag"></i>
                                        <p>Usuarios<i class="fas fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview" cass="nav nav-pills nav-sidebar flex-column">
                                        <li class="nav-item has-treeview">
                                            <a href="{{url('users')}}" class="nav-link"
                                               class="{{ Request::path() === '/' ? 'nav-link active' : 'nav-link' }}">
                                                <i class="far fa-check-circle"></i>
                                                <p>
                                                    Todos usuarios
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview">
                                            <a href="#" class="nav-link"
                                               class="{{ Request::path() === 'vitrina' ? 'nav-link active' : 'nav-link' }}">
                                                <i class="nav-icon fas fa-users"></i>
                                                <p>
                                                    Empleados
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview" cass="nav nav-pills nav-sidebar flex-column">
                                                <li class="nav-item has-treeview">
                                                    <a href="#" class="nav-link"
                                                       class="{{ Request::path() === 'vitrina' ? 'nav-link active' : 'nav-link' }}">
                                                        <form action="{{route('users.index')}}" method="get">
                                                            <input type="text" name="role" id="" value="Administrator" hidden>
                                                            <button type="submit"  class="btn-dark btn-sm btn-block text-left">
                                                                <i class="far fa-check-circle"></i>
                                                                <p>Administrator</p>
                                                            </button>
                                                        </form>
                                                    </a>
                                                </li>
                                                <li class="nav-item has-treeview">
                                                    <a href="#" class="nav-link"
                                                       class="{{ Request::path() === 'vitrina' ? 'nav-link active' : 'nav-link' }}">
                                                        <form action="{{route('users.index')}}" method="get">
                                                            <input type="text" name="role" id="" value="Guest" hidden>
                                                            <button type="submit"  class="btn-dark btn-sm btn-block text-left">
                                                                <i class="far fa-check-circle"></i>
                                                                <p>Guest</p>
                                                            </button>
                                                        </form>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            @endcan
                            @can('Administrator')
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <p><i class="far fa-file"></i> Ordenes</p>
                                    </a>
                                    <ul class="nav nav-treeview" cass="nav nav-pills nav-sidebar flex-column">
                                        <li class="nav-item has-treeview">
                                            <a href="{{url('orders')}}"
                                               class="{{ Request::path() === 'orders' ? 'nav-link active' : 'nav-link' }}">
                                                <i class="far fa-check-circle"></i>
                                                <p>Todas la ordenes</p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-sort"></i>
                                                <p>Filtro por estado</p>
                                            </a>
                                            <ul class="nav nav-treeview" cass="nav nav-pills flex-column">
                                                <li class="nav-item has-treeview">
                                                    <a href="#" class="nav-link">
                                                        <form action="{{route('orders.index')}}" method="get">
                                                            <input type="text" name="search" id="" value="APPROVED" hidden>
                                                            <button type="submit"  class="btn-dark btn-sm btn-block text-left"
                                                                    class="{{ Request::path() === 'approved' ? 'nav-link active' : 'nav-link' }}">
                                                                <i class="far fa-check-circle"></i>
                                                                <p>Aprovadas</p>
                                                            </button>
                                                        </form>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link">
                                                        <form action="{{route('orders.index')}}" method="get">
                                                            <input type="text" name="search" id="" value="REJECTED" hidden>
                                                            <button type="submit"  class="btn-dark btn-sm btn-block text-left"
                                                                    class="{{ Request::path() === 'approved' ? 'nav-link active' : 'nav-link' }}">
                                                                <i class="far fa-check-circle"></i>
                                                                <p>Rechazadas</p>
                                                            </button>
                                                        </form>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link">
                                                        <form action="{{route('orders.index')}}" method="get">
                                                            <input type="text" name="search" id="" value="PENDING" hidden>
                                                            <button type="submit"  class="btn-dark btn-sm btn-block text-left"
                                                                    class="{{ Request::path() === 'approved' ? 'nav-link active' : 'nav-link' }}">
                                                                <i class="far fa-check-circle"></i>
                                                                <p>Pendientes</p>
                                                            </button>
                                                        </form>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            @endcan
                            @can('Administrator')
                              <li class="nav-item has-treeview">
                                  <a href="#" class="nav-link">
                                      <i class="fas fa-wrench"></i>
                                      <p>Crear herramientas<i class="fas fa-angle-left right"></i></p>
                                  </a>
                                  <ul class="nav nav-treeview">
                                      <li class="nav-item">
                                          <a href="{{url('categories')}}"
                                             class="{{ Request::path() === 'categories' ? 'nav-link active' : 'nav-link' }}">
                                              <i class="fas fa-wrench"></i>
                                              <p>Categories</p>
                                          </a>
                                      </li>
                                      <li class="nav-item">
                                          <a href="{{url('colors')}}"
                                              class="{{ Request::path() === 'colors' ? 'nav-link active' : 'nav-link' }}">
                                              <i class="fas fa-wrench"></i>
                                              <p>Colors</p>
                                          </a>
                                      </li>
                                      <li class="nav-item">
                                          <a href="{{url('sizes')}}"
                                             class="{{ Request::path() === 'sizes' ? 'nav-link active' : 'nav-link' }}">
                                              <i class="fas fa-wrench"></i>
                                              <p>Sizes</p>
                                          </a>
                                      </li>
                                      <li class="nav-item">
                                          <a href="{{url('roles')}}"
                                              class="{{ Request::path() === 'roles' ? 'nav-link active' : 'nav-link' }}">
                                              <i class="fas fa-wrench"></i>
                                              <p>Roles</p>
                                          </a>
                                      </li>
                                  </ul>
                                @endcan
                            @can('hasrole')
                                <li class="nav-item">
                                    <a href="{{url('products')}}"
                                        class="{{ Request::path() === 'products' ? 'nav-link active' : 'nav-link' }}">
                                        <i class="fas fa-warehouse"></i>
                                        <p>Bodega de productos</p>
                                    </a>
                                </li>
                            @endcan
                            <li class="nav-item">
                                @auth
                                    @if(count(auth()->user()->orders))
                                <a href="{{route('orders.showv', auth()->id())}}"
                                   class="{{ Request::path() === 'clients' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="fas fa-cash-register"></i>
                                    <p>Historial de compra</p>
                                </a>
                                    @endif
                                @endauth
                            </li>
                            <li class="nav-item has-treeview">
                              <a href="#" class="nav-link">
                                  <i class="fas fa-shopping-bag"></i>
                                  <p>Vitrina<i class="fas fa-angle-left right"></i></p>
                              </a>
                              <ul class="nav nav-treeview" cass="nav nav-pills nav-sidebar flex-column">
                                  <li class="nav-item">
                                      <a href="{{url('vitrina')}}"
                                         class="{{ Request::path() === 'vitrina' ? 'nav-link active' : 'nav-link' }}">
                                          <i class="far fa-check-circle"></i>
                                          <p>Todos los productos</p>
                                      </a>
                                  </li>
                                  <li class="nav-item has-treeview">
                                      <a href="#" class="nav-link">
                                          <i class="fas fa-tshirt"></i>
                                          <p>Moda<i class="fas fa-angle-left right"></i></p>
                                      </a>
                                      <ul class="nav nav-treeview">
                                          <li class="nav-item">
                                              <a href="#" class="nav-link">
                                                  <form action="{{route('vitrina.index')}}" method="get">
                                                      <input type="text" name="category" id="" value="Hombre" hidden>
                                                      <button type="submit"  class="btn-dark btn-sm btn-block text-left"
                                                              class="{{ Request::path() === 'hombre' ? 'nav-link active' : 'nav-link' }}">
                                                          <i class="far fa-check-circle"></i>
                                                          <p>Hombre</p>
                                                      </button>
                                                  </form>
                                              </a>
                                          </li>
                                          <li class="nav-item">
                                              <a href="#" class="nav-link" >
                                                  <form action="{{route('vitrina.index')}}" method="get">
                                                      <input type="text" name="category" id="" value="Mujer" hidden>
                                                      <button type="submit"  class="btn-dark btn-sm btn-block text-left"
                                                              class="{{ Request::path() === 'hombre' ? 'nav-link active' : 'nav-link' }}">
                                                          <i class="far fa-check-circle"></i>
                                                          <p>Mujer</p>
                                                      </button>
                                                  </form>
                                              </a>
                                          </li>
                                      </ul>
                                  <li class="nav-item has-treeview">
                                      <a href="#" class="nav-link">
                                          <i class="fas fa-home"></i>
                                          <p>Hogar<i class="fas fa-angle-left right"></i></p>
                                      </a>
                                      <ul class="nav nav-treeview">
                                          <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <form action="{{route('vitrina.index')}}" method="get">
                                                    <input type="text" name="category" id="" value="Hogar" hidden>
                                                    <button type="submit"  class="btn-dark btn-sm btn-block text-left"
                                                        class="{{ Request::path() === 'hombre' ? 'nav-link active' : 'nav-link' }}">
                                                        <i class="far fa-check-circle"></i>
                                                        <p>Todo para tu hogar</p>
                                                    </button>
                                                </form>
                                            </a>
                                          </li>
                                      </ul>
                                  </li>
                              </ul>
                          </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="content-wrapper">
                <div class="content-header">
                </div>
                <section class="content">
                    @yield('content')
                </section>
            </div>
            <footer class="main-footer">
                <strong>JAM Stores</strong>
            </footer>
            <aside class="control-sidebar control-sidebar-dark">
            </aside>
        </div>
    </div>
</body>

</html>
