<!-- component -->
<style>
    .table{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
    }
    .botones{
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    margin: 0 auto;
}
    </style>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center">
        {{ __('transportistas') }}
    </h2>
    
</x-slot>
<div class="table w-3/4 p-2">
    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 my-3" wire:click="modal">Ingresar Transportista</button>
    @if ($modal=true)
        {{-- @include('livewire.crear-cliente') --}}
    @endif
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-50 border-b">
                <th class="border-r p-2">
                    <input type="checkbox">
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        ID
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg>
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        Nombre
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg>
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        DNI_RUC
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg>
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        Razon Social
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg>
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        ID tipo
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg>
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        Direccion
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg>
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        Pagina web
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg>
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        Action
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>

            {{-- <tr class="bg-gray-50 text-center">
                <td class="p-2 border-r">
                    
                </td>
                <td class="p-2 border-r">
                    <input type="text" class="border p-1">
                </td>
                <td class="p-2 border-r">
                    <input type="text" class="border p-1">
                </td>
                <td class="p-2 border-r">
                    <input type="text" class="border p-1">
                </td>
                <td class="p-2 border-r">
                    <input type="text" class="border p-1">
                </td>
                <td class="p-2 border-r">
                    <input type="text" class="border p-1">
                </td>
                
                
            </tr> --}}
            @foreach ($transportistas as $transportista)
            <tr class="bg-gray-100 text-center border-b text-sm text-gray-600">
                <td class="p-2 border-r">
                    <input type="checkbox">
                </td>
                <td class="p-2 border-r">{{$transportista->id}}</td>
                <td class="p-2 border-r">{{$transportista->nombre}}</td>
                <td class="p-2 border-r">{{$transportista->dni_ruc}}</td>
                <td class="p-2 border-r">{{$transportista->razon_social}}</td>
                <td class="p-2 border-r">{{$transportista->id_tipo}}</td>
                <td class="p-2 border-r">{{$transportista->direccion}}</td>
                <td class="p-2 border-r">{{$transportista->pagina_web}}</td>
                <td class="botones">
                    <a href="#" class="bg-blue-500 p-2 text-white hover:shadow-lg text-xs font-thin">Editar</a>
                    <a href="#" class="bg-red-500 p-2 text-white hover:shadow-lg text-xs font-thin">Eliminar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>