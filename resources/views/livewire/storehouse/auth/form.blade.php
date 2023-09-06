@include('common.ver.headModal')


<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    CANTIDAD
                </th>
                <th scope="col" class="px-6 py-3">
                    CÓDIGO
                </th>
                <th scope="col" class="px-6 py-3">
                    UNIDAD
                </th>
                <th scope="col" class="px-6 py-3">
                    DESCRIPCIÓN
                </th>
                <th scope="col" class="px-6 py-3">
                    COSTO
                </th>
                <th scope="col" class="px-6 py-3">
                    TOTAL
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$item->catidad}}
                    </th>
                    <td class="px-6 py-4">
                        {{$item->numInv}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->measurementunits->name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->descripcion}}
                    </td>
                    <td class="px-6 py-4">
                        {{'$ ' . number_format($item->costo, 2)}}
                    </td>
                    <td class="px-6 py-4">
                        {{'$ ' . number_format($item->total, 2)}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@include('common.ver.footerModal')
