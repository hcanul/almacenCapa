<div>
    <div class="flex flex-row">
        <div class="mr-5 text-2xl basis-2/3">
            <div class="flex justify-between">
                <div>
                    <span class="mb-5 text-lg font-medium text-gray-600 mr-52 dark:text-white">LISTA DE MATERIALES</span>
                </div>
                <div>
                    <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                        <span class="relative px-3 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            AGREGAR ARTICULO
                        </span>
                    </button>
                </div>
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
            @error('cart')
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                <span class="font-medium">{{ $message }}</span>
                </div>
            </div>
            @enderror
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 rounded-l-lg">
                                Descripcion
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Cantidad
                            </th>
                            <th scope="col" class="px-6 py-3 rounded-r-lg">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3 rounded-l-lg">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $item)
                            <tr class="bg-white dark:bg-gray-800">
                                <td class="px-6 py-4">
                                    {{$item->id}}
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @if(strlen($item->name) > 30)
                                        {{substr($item->name, 0, 30)}}
                                    @else
                                        {{$item->name}}
                                    @endif
                                </th>
                                <td class="px-6 py-4">
                                    {{$item->quantity}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$item->price}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex justify-between">
                                        <div>
                                            <a href="javascript:void(0)" wire:click='Editar({{$item->id}})' data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#5406a4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon></svg>
                                            </a>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0)" onclick='Confirm({{$item->id}})' class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#5406a4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="font-semibold text-gray-900 dark:text-white">
                            <th scope="row" class="px-6 py-3 text-base">Totales</th>
                            <td class="px-6 py-3"></td>
                            <td class="px-6 py-3">{{$itemsQuantity}}</td>
                            <td class="px-6 py-3">{{$total}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
        <div class="text-2xl basis-1/3">
            <div class="flex justify-between">
                <div>
                    <span class="mb-5 text-lg font-medium text-gray-600 dark:text-white">Datos de Entrada</span>
                </div>
                <div>
                    <button wire:click.prevent="Store" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            GENERAR ENTRADA
                        </span>
                    </button>
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-1">
                <div>
                    <label for="proveedor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Proveedor</label>
                    <input type="text" id="proveedor" id="proveedor" wire:model="proveedor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nombre Proveedor">
                    @error('proveedor')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
                <div>
                    <label for="nomComer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Comercial</label>
                    <input type="text" name="nomComer" id="nomComer" wire:model="nomComer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nombre Comercial">
                    @error('nomComer')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="fecha" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha</label>
                    <input type="date" id="fecha" id="fecha" wire:model="fecha" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Fecha">
                    @error('fecha')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
                <div>
                    <label for="fol_entrada" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Folio</label>
                    <input type="text" name="fol_entrada" id="fol_entrada" wire:model="fol_entrada" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="000001" >
                    @error('fol_entrada')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>

                <div>
                    <label for="factura" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo Comprobante</label>
                    <select id="factura" id="factura" wire:model="factura" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Fecha">
                        <option value="Elegir">Elija una opción</option>
                        <option value="Factura">Factura</option>
                        <option value="Nota">Nota</option>
                        <option value="Sal. Almacen Gral.">Sal. Almacen Gral</option>
                    </select>
                    @error('factura')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
                <div>
                    <label for="nFactura" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Núm. Factura</label>
                    <input type="text" name="nFactura" id="nFactura" wire:model="nFactura" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="000001" >
                    @error('nFactura')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
                <div>
                    <label for="ordenCompra" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Orden de Compra</label>
                    <input type="text" name="ordenCompra" id="ordenCompra" wire:model="ordenCompra" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="000001">
                    @error('ordenCompra')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
                <div>
                    <label for="depSolici" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departamento</label>
                    <select id="depSolici" id="depSolici" wire:model="depSolici" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Fecha">
                        <option value="Elegir">Elija una opción</option>
                        @foreach ($deptos as $depto )
                            <option value="{{$depto->id}}">{{$depto->name}}</option>
                        @endforeach
                    </select>
                    @error('depSolici')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
                <div>
                    <label for="nReq" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Núm. Requerimiento</label>
                    <input type="text" name="nReq" id="nReq" wire:model="nReq" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('nReq')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
                <div>
                    <label for="oSolicitante" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Núm. Oficio Sol.</label>
                    <input type="text" name="oSolicitante" id="oSolicitante" wire:model="oSolicitante" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('oSolicitante')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
                <div>
                    <label for="tCompraContrato" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de Adquisición</label>
                    <select name="tCompraContrato" id="tCompraContrato" wire:model="tCompraContrato" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="Elegir">Elije una Opción</option>
                        <option value="Solicitud">Solicitud</option>
                        <option value="Asignacion">Asignación</option>
                        <option value="SalidaAlmacen">Salida Almacén</option>
                        <option value="Compra">Compra</option>
                    </select>
                    @error('tCompraContrato')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
                <div>
                    <label for="nombrerecibe" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre quien Recibe</label>
                    <input type="text" name="nombrerecibe" id="nombrerecibe" wire:model="nombrerecibe" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('nombrerecibe')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-1">
                <div>
                    <label for="observaciones" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="overflow:auto;resize:none">Observaciones</label>
                    <textarea rows="4" name="observaciones" id="observaciones" wire:model="observaciones" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                    @error('observaciones')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
            </div>
        </div>

    </div>
    @include('livewire.storehouse.warehouse.form')
</div>
<script>
    function Confirm(id)
    {
        swal({
            title: 'CONFIRMAR',
            text: '¿CONFIRMAS ELIMINAR EL ARTICULO?',
            type: 'warning',
            showCancelButton: true,
            cancelBtuttonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3B3f5C'
        }).then( function (result){
            if (result.value){
                window.livewire.emit('removeItems', id)
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
            // noty(msg);
        }

        function onItemUpdated(msg) {
            hideModal();
            // noty(msg); // Supongo que noty es una función definida en otro lugar de tu código
        }

        function onItemDeleted(msg) {
            // noty(msg); // Supongo que noty es una función definida en otro lugar de tu código
        }

        window.livewire.on('item-added', onItemAdded);
        window.livewire.on('item-updated', onItemUpdated);
        window.livewire.on('item-deleted', onItemDeleted);
        window.livewire.on('hide-modal', hideModal);
        window.livewire.on('show-modal', showModal);
    });

</script>
