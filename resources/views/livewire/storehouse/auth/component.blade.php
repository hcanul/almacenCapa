<div>
    <div class="pb-4 font-medium text-gray-900 whitespace-nowrap dark:text-white justify-self-auto">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{$componentName}} | {{$pageTitle}}</h3>
    </div>
    <div class="flex items-center justify-between pb-4 bg-white ma-3 dark:bg-gray-900">
        <div class="justify-self-auto">
            @include('common.search')
        </div>
        {{-- <div class="justify-self-auto">
            <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800" type="button">
                <span class="block relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    Crear nuevo
                </span>
            </button>
        </div> --}}
    </div>
    @if (session()->has('message'))
        <div  class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium">{{ session('message') }}</span>
            </div>
        </div>
    @endif
    @if (session()->has('delete'))
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium">{{ session('delete') }}</span>
            </div>
        </div>
    @endif
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Usuario
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actividad
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">
                        {{$item->id}}
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$item->user->name}}
                    </th>
                    <td class="px-6 py-4">
                        {{"$ " . number_format($item->total, 2)}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->actividad}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->created_at->format('d-m-Y')}}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-between">
                            <div class="mr-5">
                                <a data-tooltip-target="tooltip-hover" data-tooltip-trigger="hover" href="javascript:void(0)" wire:click='Ver({{$item->id}})' data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    @include('layouts.themes.icons.eye')
                                </a>
                                <div id="tooltip-hover" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    VER DETALLES
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>
                            @role('SuperUser|SubGerente|JefeMateriales|Almacenista')
                                <div class="mr-5">
                                    <a data-tooltip-target="tooltipaprobar-hover" data-tooltip-trigger="hover" href="javascript:void(0)" onclick='Approved({{$item->id}})' class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        @include('layouts.themes.icons.approve')
                                    </a>
                                    <div id="tooltipaprobar-hover" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        APROBAR REQ.
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </div>
                            @endrole
                            @role('SuperUser|SubGerente|JefeMateriales')
                                <div class="mr-5">
                                    <a data-tooltip-target="tooltipcancelar-hover" data-tooltip-trigger="hover" href="javascript:void(0)" onclick='Confirm({{$item->id}})' class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        @include('layouts.themes.icons.cancelar')
                                    </a>
                                    <div id="tooltipcancelar-hover" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        CANCELAR REQ.
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </div>
                            @endrole
                            @if ($item->pfstatus == 'Aprobado' && $item->sfstatus == 'Aprobado' && $item->status == 'Aprobado')
                                @role('SuperUser|SubGerente|JefeMateriales|Almacenista')
                                    <div class="mr-5">
                                        <a data-tooltip-target="tooltipprint-hover" data-tooltip-trigger="hover" href="javascript:void(0)" onclick='Printer({{$item->id}})' class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            @include('layouts.themes.icons.printer')
                                        </a>
                                        <div id="tooltipprint-hover" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                            IMPRIMIR SALIDA
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                    </div>
                                @endrole
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $data->links()}}
    @include('livewire.storehouse.auth.form')
</div>
<script>
    function Confirm(id)
    {
        swal({
            title: 'CONFIRMAR',
            text: '¿CONFIRMAS CANCELAR EL REGISTRO?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3B3f5C'
        }).then( function (result){
            if (result.value){
                swal({
                    title: 'CANCELAR',
                    input: 'textarea',
                    inputLabel: 'Capture el motivo de la cancelación',
                    inputPalceholder: 'Capture el motivo de cancelación...',
                    inputAttributes: {
                        'aria-label': 'Capture el motivo de cancelación...'
                    },
                    showCancelButton: true,
                }).then(function (res){
                    if(res.value){
                        window.livewire.emit('cancelarReq', [id, res.value])
                        swal.close()
                    }
                });

            }
        })
    }

    function Approved(id)
    {
        swal({
            title: 'CONFIRMAR',
            text: '¿CONFIRMAS APROBAR EL REGISTRO?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3B3f5C'
        }).then( function (result){
            if (result.value){
                window.livewire.emit('approvedReq', id)
                swal.close()
            }
        })
    }

    function Printer(id)
    {
        swal({
            title: 'CONFIRMAR',
            text: '¿CONFIRMAS IMPRIMIR LA SALIDA?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3B3f5C'
        }).then( function (result){
            if (result.value){
                window.livewire.emit('PrintedReq', id)
                swal.close()
            }
        })
    }

    document.addEventListener('DOMContentLoaded', function() {
        const defaultModal = document.getElementById('defaultModal');
        const erElements = document.querySelectorAll('.er');

        function hideModal() {
            defaultModal.style.display = 'none';
        }

        function showModal() {
            defaultModal.style.display = 'block';
        }

        function onItemAdded(msg) {
            hideModal();
        }

        function onItemUpdated(msg) {
            hideModal();
        }

        function onItemDeleted(msg) {
            hideModal();
            // noty(msg); // Supongo que noty es una función definida en otro lugar de tu código
        }

        function onItemCancelado(msg){
            swal({
                title:'Cancelado',
                text:msg,
                type:'warning',
            });
        }

        window.livewire.on('item-added', onItemAdded);
        window.livewire.on('item-updated', onItemUpdated);
        window.livewire.on('item-deleted', onItemDeleted);
        window.livewire.on('item-canceled', onItemCancelado);
        window.livewire.on('hide-modal', hideModal);
        window.livewire.on('show-modal', showModal);
    });

</script>
