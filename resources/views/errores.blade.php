@if(!empty($errors->all()))
    <div class="notification is-danger" style="background:#683b34;color:#cdc1c1;padding:4px;border-radius:5px;width:100%;text-align:center">
        <h4 class="is-size-4">Por favor, valida los siguientes errores:</h4>
        <ul style="width:50%;text-align:left">
            @foreach ($errors->all() as $mensaje)
                <li>
                    {{$mensaje}}
                </li>
            @endforeach
        </ul>
 
    </div>
@endif