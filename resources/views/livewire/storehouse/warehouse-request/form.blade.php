@include('common.buscar.headModal')
@if ($selected_id == 0)
    <form class="space-y-1">
        <div class="px-5 py-1 justify-self-auto">
            @include('common.search')
        </div>
        <div class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-1">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                SELECCIONE
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                DESCRIPCIÓN
                            </th>
                            <th scope="col" class="px-6 py-3">
                                EXISTENCIA
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" wire:model="article" value="{{$item->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    {{$item->id}}
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$item->descripcion}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$item->existencia}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        <div>
    </form>
    <div class="flex justify-between">
        <div>
            {{$data->links()}}
        </div>
    </div>
@else
    <form class="space-y-1">
        <div class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-1">
            <div class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-1">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    DESCRIPCIÓN
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    PRECIO
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    CANTIDAD
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white dark:bg-gray-800">
                                <td class="px-6 py-4">
                                    {{$editId}}
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$editName}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$editCosto}}
                                </td>
                                <td class="px-6 py-4">
                                    <input type="numbre" wire:model='editQty' value="editQty" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <div>
    </form>
@endif

@include('common.buscar.footerModal')
