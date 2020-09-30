@if ( !empty ( $products->id) )
<div class="table-responsive-lg">
<table class="table">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
           <tr>
                <td>
                    <div class="form-group">
                        <label for="name" class="negrita">Name:</label>
                        <div>
                            <input class="form-control" placeholder="products" required="required" name="name" type="text" id="name" value="{{ $products->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="negrita">Description:</label>
                        <div>
                            <textarea class="form-control" placeholder="description" required="required" name="description" type="text" id="description" >{{ $products->description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="price" class="negrita">Price:</label>
                        <div>
                            <input class="form-control" placeholder="4.500" required="required" name="price" type="text" id="price" value="{{ $products->price }}">
                        </div>
                    </div>

                </td>

               <td>

                    <div class="form-group">
                        <label for="stock" class="negrita">Selecciona una categoria</label>
                        <select name="category" class="form-control">
                            <option selected disabled>elige una category para este producto</option>
                            @foreach ($categories as $category )
                            @if($products->tieneCategory()->contains($category->name))
                            <option value="{{$category->id}}"selected>{{$category->name}}</option>
                            @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('category')
                        {{$message}}
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stock" class="negrita">Selecciona un color</label>
                        <div class="list-group-scr">
                            @foreach  ($colors as $key => $color)
                                    <li class="list-group-item" data-spy="scroll">
                                        <input  type="checkbox"  @if($products->tieneColor()->contains($color->name))
                                        checked @endif
                                        name="color[]" value="{{$color->id}}"/>
                                        {{$color->name}}
                                    </li>
                            @endforeach
                        </div>
                    </div>
                    @error('color')
                    {{$message}}
                    @enderror
               </td>

               <td>
                   <div class="form-group">
                       <label for="stock" class="negrita">Stock:</label>
                       <div>
                           <input class="form-control" placeholder="40" required="required" name="stock" type="text" id="stock" value="{{ $products->stock }}">
                       </div>
                   </div>

                    <div class="form-group">
                        <label for="stock" class="negrita">Selecciona una talla: </label>
                        <div>
                        @foreach  ($sizes as $key => $size)
                            <input type="checkbox"  @if($products->tieneSize()->contains($size->name)) checked @endif
                            name="size[]" value="{{$size->id}}"/>
                            {{$size->name}}
                        @endforeach
                        </div>
                    </div>
                    @error('size')
                    {{$message}}
                    @enderror

                    <div class="form-group">
                        <label for="img" class="negrita">Selecciona una imagen:</label>
                        <div>
                            <input name="img[]" type="file" id="img" multiple="multiple">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@else


<table class="table">
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="form-group">
                            <label for="name" class="negrita">Name:</label>
                            <div>
                                <input class="form-control" placeholder="producto" required="required" name="name" type="text" id="name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="negrita">Description:</label>
                            <div>
                                <textarea name="description" placeholder="description"  class="form-control" required="required"  id="description"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="price" class="negrita">Price:</label>
                            <div>
                                <input class="form-control" placeholder="price" required="required" name="price" type="text" id="price">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="stock" class="negrita">Stock:</label>
                            <div>
                                <input class="form-control" placeholder="stock" required="required" name="stock" type="text" id="stock">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            {{Form::label('color[]', 'Selecciona un color:')}}
                        <div class="list-group-scr">
                            @foreach  ($colors as $color )
                                <li class="list-group-item" data-spy="scroll">
                                    {{Form::checkbox('color[]', $color->id)}} {{$color->name}}
                                </li>
                            @endforeach
                        </div>
                        @error('color')
                        {{$message}}
                        @enderror
                        <div class="form-group">
                            {{Form::label('size[]', 'Selecciona una talla:')}}
                        <div>
                            @foreach  ($sizes as $size )
                                {{Form::checkbox('size[]', $size->id)}} {{$size->name}},
                            @endforeach
                        </div>
                        @error('size')
                        {{$message}}
                        @enderror

                        <div class="form-group">
                            <label for="stock" class="negrita">Selecciona una categoria:</label>
                            <select name="category[]" class="form-control">
                                <option selected disabled>elige una category para este producto</option>
                                @foreach ($categories as $category )
                                <option value="{{ $category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                            {{$message}}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="img" class="negrita">Selecciona una imagen:</label>
                            <div>
                                <input name="img[]" type="file" id="img" multiple="multiple">
                            </div>
                        </div>
                        @error('img')
                        {{$message}}
                        @enderror

                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
                    <td>
                </tr>
         </tbody>
   </table>

@endif

