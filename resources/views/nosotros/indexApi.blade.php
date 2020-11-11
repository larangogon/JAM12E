@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 class="display-4">Descripción endpoint Api</h1>
                <p class="text">
                    API JAM es un servisio que expondrá endpoints para añadir, eliminar, editar
                    y consultar diferentes productos, categorias, colores y tallas.
                    se utilizaran los metodos <mark>POST, PUT, GET y DELETE </mark>para la entidad Product.<br>
                    El API de JAM está basado en REST, retorna respuestas con codificación JSON.
                </p>
                <p class="h2">Modo prueba</p>


                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Registro
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <p class="h4">Registro de un usuario</p>

                                <p class="text">
                                    Hacemos una petición <mark>POST</mark> y registramos un usuario con sus datos.<br>
                                    <u>http://127.0.0.1:8000/api/auth/signup</u><br>
                                <div class="col-md-8">
                                    <table class="table-sm table table-dark">
                                        <tr>
                                            <th>"name" = "juan",</th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                        <tr><th>"email" = "ejemplo@gmail.com",</th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                        <tr><th>"address" = "Cra 123-94-87",</th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                        <tr><th>"document" = "19076477510",</th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                        <tr><th>"cellphone" = "3002133378",</th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                        <tr><th>"phone" = "48976813",</th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                    </table>
                                </div>
                                <p>
                                    <em>Todos los campos son requeridos</em>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Login
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <p class="h4">Login de un usuario</p><p class="text">
                                    Hacemos una petición <mark>POST</mark> y logeamos un usuario con sus datos,
                                    podemos iniciar sesión, y obtener un access_token,
                                    que nos permitirá identificarnos ante la API.<br>
                                    <u>http://127.0.0.1:8000/api/auth/login</u><br>
                                <div class="col-md-7">
                                    <div class="card text-white bg-dark mb-3" >
                                        <div class="card-body">
                                            "email" = "ejemplo@gmail.com",<br>
                                            "password" = "123456784",<br>
                                        </div>
                                    </div>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Auth
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <h5>
                                    Auth
                                </h5>
                                <p class="text">
                                    Podemos consultar rutas protegidas enviando
                                    el token que obtuvimos anteriormente.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                   Logout
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <h5>
                                    Cerrar session
                                </h5>
                                <p class="text">
                                    Si hacemos una petición <mark>GET</mark> a la ruta de logout con nuestro token,
                                    éste será invalidado.<br>
                                    <u>http://127.0.0.1:8000/api/auth/logout</u><br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="h2">Gestion de productos</p>

                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Todos los Productos
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <h5>
                                    Ver lista de productos
                                </h5>
                                <p class="text">

                                    Podemos consultar rutas protegidas enviando el token que obtuvimos
                                    anteriormente al autenticarnos.
                                </p>
                                <p class="text">
                                    Si hacemos una petición <mark>GET</mark> a la ruta de product y con nuestro token,
                                    se mostrara la lista de productos que se encunetra almacenada el la base de datos .<br>
                                    <u>http://127.0.0.1:8000/api/auth/product</u><br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Detalle de un producto
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <h5>
                                    Ver detalle de un solo producto
                                </h5>
                                <p class="text">
                                    Podemos consultar rutas protegidas enviando el token que obtuvimos
                                    anteriormente al autenticarnos.
                                </p>
                                <p class="text">
                                    Si hacemos una petición <mark>GET a</mark> la ruta de product mas el id del producto y
                                    con nuestro token, veremos la informacion del producto con el id requerido.<br>
                                    <u>http://127.0.0.1:8000/api/auth/product/1</u><br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Eliminar Producto
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <h5>
                                    Eliminar un producto
                                </h5>
                                <p class="text">
                                    Podemos consultar rutas protegidas enviando el token que obtuvimos
                                    anteriormente al autenticarnos.
                                </p>
                                <p class="text">
                                    Si hacemos una petición <mark>DELETE</mark> a la ruta de product
                                    mas el id del producto y con nuestro token, se eliminara este producto.<br>
                                    <u>http://127.0.0.1:8000/api/auth/product/1</u><br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Editar Producto
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <h5>
                                    Editar producto
                                </h5>
                                <p class="text">
                                    Podemos consultar rutas protegidas enviando el token que obtuvimos
                                    anteriormente al autenticarnos.
                                </p>
                                    Si hacemos una petición <mark>PUT</mark> a la ruta de product,
                                    el id y con nuestro token, éste editara un producto.<br>
                                    <u>http://127.0.0.1:8000/api/auth/product/1</u><br>
                                <div class="col-md-8">
                                    <table class="table-sm table table-dark">
                                        <tr>
                                            <th>"name" = "nombreDelProducto",</th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                        <tr><th>"description" = "descrip del producto",</th>
                                            <td></td>
                                        </tr>
                                        <tr><th>"price" = "324455",</th>
                                            <td></td>
                                        </tr>
                                        <tr><th>"stock" = "5",</th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                        <tr><th>"color" = "4",</th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                        <tr><th>"category" = "2",</th>
                                            <td></td>
                                        </tr>
                                        <tr><th>"size" = "1", </th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                        <tr><th>"img" = "jdhshfbhsd.jpg",</th>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Crear producto
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <h5>
                                    Crear producto
                                </h5>
                                <p class="text">
                                    Podemos consultar rutas protegidas enviando el token que obtuvimos
                                    anteriormente al autenticarnos.
                                </p>
                                <p class="text">
                                    Si hacemos una petición <mark>POST</mark> a la
                                    ruta de logout con nuestro token, éste será invalidado.<br>
                                    <u>http://127.0.0.1:8000/api/auth/product/</u><br>
                                </p>
                                <div class="col-md-8">
                                    <table class="table-sm table table-dark">
                                        <tr>
                                            <th>"name" = "nombreDelProducto",</th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                        <tr><th>"description" = "descrip del producto",</th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                        <tr><th>"price" = "324455",</th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                        <tr><th>"barcode" = "324455656574",</th>
                                            <td><mark>campo requerido,#,unico</mark></td>
                                        </tr>
                                        <tr><th>"stock" = "5",</th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                        <tr><th>"color" = "4",</th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                        <tr><th>"category" = "2",</th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                        <tr><th>"size" = "1", </th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                        <tr><th>"img" = "jdhshfbhsd.jpg",</th>
                                            <td><mark>campo requerido</mark></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Consultar categorias
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <h5>
                                    categories
                                </h5>
                                <p class="text">
                                    Podemos consultar rutas protegidas enviando el token que obtuvimos
                                    anteriormente al autenticarnos.
                                </p>
                                <p class="text">
                                    Si hacemos una petición <mark>GET</mark> a la ruta de category con nuestro token,
                                    éste nos mostrara las categorias existentes.<br>
                                    <u>http://127.0.0.1:8000/api/auth/category</u><br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Consultar tallas
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <h5>
                                    Tallas
                                </h5>
                                <p class="text">
                                    Podemos consultar rutas protegidas enviando el token que obtuvimos
                                    anteriormente al autenticarnos.
                                </p>
                                <p class="text">
                                    Si hacemos una petición <mark>GET</mark> a la ruta de size con nuestro token,
                                    éste nos mostrara las tallas existentes.<br>
                                    <u>http://127.0.0.1:8000/api/auth/size</u><br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Consultar colores
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <h5>
                                    Consultar colores
                                </h5>
                                <p class="text">
                                    Podemos consultar rutas protegidas enviando el token que obtuvimos
                                    anteriormente al autenticarnos.
                                </p>
                                <p class="text">
                                    Si hacemos una petición <mark>GET</mark> a la ruta de color con nuestro token,
                                    éste nos mostrara los colores existentes.<br>
                                    <u>http://127.0.0.1:8000/api/auth/color</u><br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
