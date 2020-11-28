<html>
<head>
    <meta charset="UTF-8">
    <title>Crear nuevo mensaje</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    <style>
        .htmlst{
            background:black;
            color:white;
        }
        .color{
            color:black;
        }
    </style>
</head>
<body class="htmlst">
<br>
<br>
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-body text-sm-left">
                <div class="card-header color">
                    Nuevo Mensaje
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{route('messages.store')}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{auth()->user()->id}}" name="sender_id">
                        <div class="form-group">
                            @if(auth()->user()->hasRole('Administrator'))
                            <select name="recipient_id" class="form-control selectpicker" data-live-search="true">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            @else
                                <select  name="recipient_id" class="form-control">
                                    <option value="Selecciona el usuario"></option>
                                    @foreach($admins as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <div class="form-group">
                            <textarea name="body" class="form-control" placeholder="Escribe aqui tu mensaje"></textarea>
                        </div>

                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Enviar
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
</body>
@include('layouts.footer')
</html>
