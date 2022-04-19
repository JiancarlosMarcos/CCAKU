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
        {{ __('Clientes') }}
    </h2>
</x-slot>

<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
        </tr>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    @livewireScripts()

</script>