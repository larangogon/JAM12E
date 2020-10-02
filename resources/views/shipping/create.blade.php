
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('shipping.store', $order->id) }}" method="POST">
    @csrf

<div class="container" style="margin-top: 5px">
    <div class="table-responsive-lg">
        <table class="table ">
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="name_recipient" class="negrita">Name_recipient:</label>
                                <div>
                                    <input class="form-control" placeholder="name_recipient" required="required" name="name_recipient" type="text"
                                    id="name_recipient">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone_recipient" class="negrita">Phone_recipient</label>
                                <div>
                                    <input class="form-control" placeholder="phone_recipient" required="required" name="phone_recipient" type="text"
                                    id="phone_recipient">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cellphone_recipient" class="negrita">Cellphone_recipient:</label>
                                <div>
                                    <input class="form-control" placeholder="cellphone_recipient" required="required" name="cellphone_recipient" type="text"
                                    id="cellphone_recipient">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="document_recipient" class="negrita">Document_recipient:</label>
                                <div>
                                    <input class="form-control" placeholder="document_recipient" required="required" name="document_recipient" type="text"
                                    id="document_recipient">
                                </div>
                            </div>

                        </td>

                        <td>

                            <div class="form-group">
                                <label for="address_recipient" class="negrita">Address_recipient:</label>
                                <div>
                                    <input class="form-control" placeholder="address_recipient" required="required" name="address_recipient" type="text"
                                    id="address_recipient">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email_recipient" class="negrita">Email_recipient:</label>
                                <div>
                                    <input class="form-control" placeholder="email_recipient@gmail.com" required="required" name="email_recipient" type="email"
                                    id="email_recipient">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="country_recipient" class="negrita">Country_recipient:</label>
                                <div>
                                    <input class="form-control" placeholder="country_recipient" required="required" name="country_recipient" type="text"
                                    id="country_recipient">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="city_recipient" class="negrita">City_recipient:</label>
                                <div>
                                    <input class="form-control" placeholder="city_recipient" required="required" name="city_recipient" type="text"
                                    id="city_recipient">
                                </div>
                            </div>

                            <input type="hidden" value="{{$order->id}}" name="order_id">

                            <button type="submit" class="btn btn-block btn-sm btn-primary">
                                Agregar datos del envio
                            </button>
                        </td>
                    </tr>
            </table>
        </div>
    </div>
</form>
