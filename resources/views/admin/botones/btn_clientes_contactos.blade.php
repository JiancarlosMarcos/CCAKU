<div style="padding-left:30%">
                   <button class="btn btn-primary btn-sm"  data-toggle="modal" id="mostrar{{$id}}" 
                     data-target="#editModal{{$id}}" title="Editar" value="{{$id}}"
                     style="display:none">
                     <i class="fas fa-pencil-alt" aria-hidden="true"></i></button>

                     <button class="btn btn-primary btn-sm btn-editar"
                     style="position:absolute; margin:auto;"
                     onclick="mostrar_vista(<?php echo $id; ?>);">
                     <i class="fas fa-pencil-alt" aria-hidden="true"></i></button>

                    <a class="btn btn-danger btn-sm btn-eliminar hidden" 
                    style="position:absolute;margin:auto;"
                    href="{{route('eliminar_contacto_cliente',$id)}}" id="delete" title="Eliminar" type="button" >
                      <i class="fas fa-trash-alt"
                        aria-hidden="true"></i></a>
</div>