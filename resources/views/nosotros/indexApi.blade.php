@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content-box-large">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card-body">
                            <div>
                                <h3>
                                    Descripción endpoint Api
                                </h3>
                                <p class="text">
                                    API JAM es un servisio que expondrá endpoints para añadir, eliminar, editar
                                    y consultar diferentes productos, categorias, colores y tallas.
                                    se utilizaran los metodos POST, PUT, GET y DELETE para la entidad Product.
                                    <br>
                                    El API de JAM está basado en REST, retorna respuestas con codificación JSON.
                                </p>
                                <h4>
                                    En modo prueba
                                </h4>
                                <h5>Registro de un usuario</h5>
                                <p class="text">
                                    Hacemos una petición POST y registramos un usuario con sus datos.<br>
                                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                        <div class="card-header">
                                            http://127.0.0.1:8000/api/auth/signup
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">
                                                "name" = "juan",<br>
                                                "email" = "ejemplo@gmail.com",<br>
                                                "address" = "Cra 123-94-87",<br>
                                                "document" = "19076477510",<br>
                                                "cellphone" = "3002133378",<br>
                                                "phone" = "48976813",<br>
                                                "password" = "123456784",<br>
                                            </p>
                                        </div>
                                    </div>
                                    <p>
                                        Todos los campos son requeridos
                                    </p>

                                </p>
                                <h5>Login de un usuario</h5>
                                <p class="text">
                                    Hacemos una petición POST y logeamos un usuario con sus datos,
                                    podemos iniciar sesión, y obtener un access_token,
                                    que nos permitirá identificarnos ante la API.
                                    <br>
                                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                        <div class="card-header">
                                            http://127.0.0.1:8000/api/auth/login
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">
                                                "email" = "ejemplo@gmail.com",<br>
                                                "password" = "123456784",<br>
                                            </p>
                                        </div>
                                    </div>
                                </p>
                                <h5>
                                    Auth
                                </h5>
                                <p class="text">
                                    Podemos consultar rutas protegidas enviando
                                    el token que obtuvimos anteriormente.
                                </p>
                                <h5>
                                    Cerrar session
                                </h5>
                                <p class="text">
                                    Si hacemos una petición GET a la ruta de logout con nuestro token, éste será invalidado.<br>

                                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                        <div class="card-header">
                                            http://127.0.0.1:8000/api/auth/logout
                                        </div>
                                    </div>
                                </p>
                                <h5>
                                    Ver lista de productos
                                </h5>
                                <p class="text">
                                    Podemos consultar rutas protegidas enviando el token que obtuvimos
                                    anteriormente al autenticarnos.
                                </p>
                                <p class="text">
                                    Si hacemos una petición GET a la ruta de product y con nuestro token,
                                    se mostrara la lista de productos que se encunetra almacenada el la base de datos .<br>

                                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                    <div class="card-header">
                                        http://127.0.0.1:8000/api/auth/product
                                    </div>
                                </div>
                                </p>
                                <h5>
                                    Ver detalle de un solo producto
                                </h5>
                                <p class="text">
                                    Podemos consultar rutas protegidas enviando el token que obtuvimos
                                    anteriormente al autenticarnos.
                                </p>
                                <p class="text">
                                    Si hacemos una petición GET a la ruta de product mas el id del producto y
                                    con nuestro token, veremos la informacion del producto con el id requerido.<br>

                                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                    <div class="card-header">
                                        http://127.0.0.1:8000/api/auth/product/1
                                    </div>
                                </div>
                                </p>
                                <h5>
                                    Eliminar un producto
                                </h5>
                                <p class="text">
                                    Podemos consultar rutas protegidas enviando el token que obtuvimos
                                    anteriormente al autenticarnos.
                                </p>
                                <p class="text">
                                    Si hacemos una petición DELETE a la ruta de product mas el id del producto y con nuestro token, se eliminara este producto.<br>

                                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                    <div class="card-header">
                                        http://127.0.0.1:8000/api/auth/product/1
                                    </div>
                                </div>
                                </p>
                                <h5>
                                    Editar producto
                                </h5>
                                <p class="text">
                                    Podemos consultar rutas protegidas enviando el token que obtuvimos
                                    anteriormente al autenticarnos.
                                </p>
                                <p class="text">
                                    Si hacemos una petición PUT a la ruta de product,
                                    el id y con nuestro token, éste editara un producto.<br>

                                    <div class="card text-white bg-dark mb-3" style="max-width: 25rem;">
                                        <div class="card-header">
                                            http://127.0.0.1:8000/api/auth/product/1
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">
                                                "name" = "nombreDelProducto",  *campo requerido<br>
                                                "description" = "descrip del producto",<br>
                                                "price" = "324455",<br>
                                                "stock" = "5",  *campo requerido<br>
                                                "color" = "4",   *campo requerido<br>
                                                "category" = "2",<br>
                                                "size" = "1",  *campo requerido<br>
                                                "img" = "jdhshfbhsd.jpg",<br>
                                            </p>
                                        </div>
                                    </div>
                                </p>
                                <h5>
                                    Crear producto
                                </h5>
                                <p class="text">
                                    Podemos consultar rutas protegidas enviando el token que obtuvimos
                                    anteriormente al autenticarnos.
                                </p>
                                <p class="text">
                                    Si hacemos una petición POST a la ruta de logout con nuestro token, éste será invalidado.<br>

                                    <div class="card text-white bg-dark mb-3" style="max-width: 25rem;">
                                        <div class="card-header">
                                            http://127.0.0.1:8000/api/auth/product/
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">
                                                "name" = "nombreDelProducto",  *campo requerido<br>
                                                "description" = "descrip del producto", *campo requerido<br>
                                                "price" = "324455", *campo requerido<br>
                                                "stock" = "5",  *campo requerido<br>
                                                "color" = "4",   *campo requerido<br>
                                                "category" = "2", *campo requerido<br>
                                                "size" = "1",  *campo requerido<br>
                                                "img" = "jdhshfbhsd.jpg", *campo requerido<br>
                                            </p>
                                        </div>
                                    </div>
                                </p>
                                <h5>
                                    Consultar categories
                                </h5>
                                <p class="text">
                                    Podemos consultar rutas protegidas enviando el token que obtuvimos
                                    anteriormente al autenticarnos.
                                </p>
                                    <p class="text">
                                        Si hacemos una petición GET a la ruta de category con nuestro token,
                                        éste nos mostrara las categorias existentes.<br>

                                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                        <div class="card-header">
                                            http://127.0.0.1:8000/api/auth/category
                                        </div>
                                    </div>
                                </p>
                                <h5>
                                    Consultar tallas
                                </h5>
                                <p class="text">
                                    Podemos consultar rutas protegidas enviando el token que obtuvimos
                                    anteriormente al autenticarnos.
                                </p>
                                <p class="text">
                                    Si hacemos una petición GET a la ruta de size con nuestro token,
                                    éste nos mostrara las tallas existentes.<br>

                                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                    <div class="card-header">
                                        http://127.0.0.1:8000/api/auth/size
                                    </div>
                                </div>
                                </p>
                                <h5>
                                    Consultar colores
                                </h5>
                                <p class="text">
                                    Podemos consultar rutas protegidas enviando el token que obtuvimos
                                    anteriormente al autenticarnos.
                                </p>
                                <p class="text">
                                    Si hacemos una petición GET a la ruta de color con nuestro token,
                                    éste nos mostrara los colores existentes.<br>

                                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                    <div class="card-header">
                                        http://127.0.0.1:8000/api/auth/color
                                    </div>
                                </div>
                                </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
