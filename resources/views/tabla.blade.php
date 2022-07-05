<table class="tabla" cellspacing=0>
    <thead>
        <th class="capitalize">Sel</th>
        <th class="capitalize">ID</th>
        <th class="capitalize">Nombre</th>
        <th class="capitalize">Descripción</th>
        <th class="capitalize">Color</th>
        <th class="capitalize">Stock</th>
    </thead>
    <tbody>
        @foreach ($datos as $dato)
            <tr>
                
                <td>
                    <input type="checkbox" name="" id="">
                </td>
                <td> {{ $dato->id }} </td>
                <td> {{ $dato->nombre }} </td>
                <td> {{ $dato->descripcion }} </td>
                <td> {{ $dato->color }} </td>
                <td> {{ $dato->stock }} </td>
            </tr>
        @endforeach
    </tbody>
</table>
