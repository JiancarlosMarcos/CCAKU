<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;

class UsuarioController extends Controller
{
    public function usuarios()
    {
        return view('admin.usuarios.usuarios');
    }
    public function vista_usuarios(Request $request)
    {

        return DataTables::of(User::select(
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
        ))
            // ->editColumn('created_at', function (Transportista $prueba) {
            //     return $prueba->created_at->format('d/m/Y');
            // })
            ->addColumn('btn_usuarios', 'admin.botones.btn_usuarios')
            ->rawColumns(['btn_usuarios'])
            ->toJson();
    }
    public function form_editar_usuario(Request $request)
    {
        $id = $request->id;
        $usuario = User::findOrFail($id);


        return view("admin.usuarios.editar_usuario", ["usuario" => $usuario]);
    }

    public function editar_usuario(Request $request)
    {
        $request->validate(
            [],
            []
        );


        $id = $request->id;
        $usuario = User::findOrFail($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        // $usuario->id_via_ingreso = $request->id_via_ingreso;
        // $usuario->id_indicador = $request->id_indicador;
        // $usuario->responsable_registro = $request->usuario;

        $usuario->save();

        $contador = $request->contador;
        // $usuario = $request->usuario;

        //Elimina todos los contactos de determinada usuario
        //Contacto::where('id',$id)->delete();

        //Inserta la nueva lista de contactos actualizada
        $ids_eliminar = $request->ids_eliminar;

        $id_eliminar = explode(",", $ids_eliminar);
        $contador_id = count($id_eliminar);




        $notification = array(
            'mensaje' => 'Cliente actualizado correctamente!' . $ids_eliminar,
            'tipo' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function eliminar_usuario($id)
    {

        $usuarios =  User::findOrFail($id);
        $usuarios->delete();

        $notification = array(
            'mensaje' => "Usuario de eliminado correctamente!",
            'tipo' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
