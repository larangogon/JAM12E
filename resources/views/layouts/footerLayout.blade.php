<footert class="hold-transition sidebar-mini layout-fixed">
    <section class="footers border  pt-2 pb-2 container-fluid">
        <div class="row justify-content-end col-md-12" >
            <div class="col-md-3 footers-one ">
                <div class="footers-info md-1">
                    <p>Cras sociis natoque penatibus et magnis Lorem Ipsum tells about the compmany right now the best.</p>
                </div>
                <div class="social-icons">
                    <a href="https://www.facebook.com/"><i id="social-fb" class="fab fa-facebook-square fa-2x social"></i></a>
                    <a href="https://twitter.com/"><i id="social-tw" class="fab fa-twitter-square fa-2x social"></i></a>
                    <a href="https://plus.google.com/"><i id="social-gp" class="fab fa-google-plus-square fa-2x social"></i></a>
                    <a href="mailto:bootsnipp@gmail.com"><i id="social-em" class="fa fa-envelope-square fa-2x social"></i></a>
                </div>
            </div>
            <div class="col-md-2 footers-two">
                <h5 class="tool">Essentials </h5>
                <ul class="list-unstyled">
                    <li><a id="social-fb" href="{{ url('nosotros') }}">Quienes Somos</a></li>
                    <li><a id="social-fb" href="{{ route('login') }}">Login</a></li>
                    <li><a id="social-fb"href="{{ route('register') }}">Registrate</a></li>
                    <li><a id="social-fb" href="{{ url('/home') }}">Inicio</a></li>
                    <li><a id="social-fb" href="{{ url('vitrina') }}">Store</a></li>
                </ul>
            </div>
            <div class="col-md-2 footers-three">
                <h5 class="tool">Information </h5>
                <ul class="list-unstyled">
                    <li><a id="social-tw" href="{{url('messages')}}">Contactenos</a></li>
                    <li><a id="social-tw" href="{{url('vitrina')}}">Tienda</a></li>
                    <li><a id="social-tw" href="#">Videos</a></li>
                    <li>
                        @auth
                            @if(count(auth()->user()->orders))
                                <a id="social-tw" href="{{route('orders.showv', auth()->id())}}">Tu historial de compra</a>
                            @endif
                        @endauth

                    </li>
                    <li><a href="{{url('nosotros/indexApi')}}">Nuestra Api</a></li>
                </ul>
            </div>
            <div class="col-md-2 footers-four">
                <h5 class="tool">Tiendas </h5>
                <ul class="list-unstyled">
                    <li><a id="social-gp" href="#">Medellin</a></li>
                    <li><a id="social-gp" href="#">Bogota</a></li>
                    <li><a id="social-gp" href="#">Cali</a></li>
                    <li><a id="social-gp" href="#">Barranquilla</a></li>
                    <li><a id="social-gp" href="#">Bucaramanga</a></li>
                </ul>
            </div>
            <div class="col-md-2 footers-five">
                <h5 class="tool">Company </h5>
                <ul class="list-unstyled">
                    <li><a id="social-em" href="{{url('messages')}}">Felicitaciones</a></li>
                    <li><a id="social-em" href="{{url('messages')}}">Sugerencias</a></li>
                    <li><a id="social-em" href="{{url('messages')}}">Quejas</a></li>
                    <li><a id="social-em" href="{{url('messages')}}">Reclamos</a></li>
                    <li><a id="social-em" href="{{url('messages')}}">Peticiones</a></li>
                </ul>
            </div>

        </div>
    </section>
    <section class="copyright border">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12">
                    <p class="text-muted">© 2020 JAM12E. S.A.S.</p>
                </div>
            </div>
        </div>
    </section>
</footert>
