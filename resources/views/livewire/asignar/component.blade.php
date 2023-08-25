<div>
    <div class="pb-4 font-medium text-gray-900 whitespace-nowrap dark:text-white justify-self-auto">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{$componentName}} | {{$pageTitle}}</h3>
    </div>
    <div class="flex items-center justify-between pb-4 bg-white ma-3 dark:bg-gray-900">
        <div class="justify-self-auto">
            <label for="default" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona un Rol</label>
            <select wire:model="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="Elegir">Elije una opcion</option>
                @foreach ($roles as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="justify-self-auto">
            <button type="button" wire:click.prevent='SyncAll' class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    Sincronizar Todos
                </span>
              </button>
              <button type="button" onclick="Revocar()" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    Revocar Todos
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
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        PERMISO
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ROLES CON EL PERMISO
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permisos as $permiso)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">
                        {{$permiso->id}}
                    </td>
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex items-center mb-4">
                            <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                <input
                                    wire:change="SyncPermiso(document.getElementById('p{{ $permiso->id }}').checked, '{{ $permiso->name }}');"
                                    value="{{$permiso->id}}"
                                    id="p{{$permiso->id}}"
                                    type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    {{$permiso->checked == 1 ? 'checked':''}}
                                    >
                                    {{$permiso->name}}
                            </label>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        {{\App\Models\User::permission($permiso->name)->count()}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $permisos->links()}}
    {{-- @include('livewire.asignar.form') --}}
</div>
<script>
    function Revocar()
    {
        swal({
            title: 'CONFIRMAR',
            text: '¿CONFIRMAS REVOCAR TODOS LOS PERMISOS?',
            type: 'warning',
            showCancelButton: true,
            cancelBtuttonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3B3f5C'
        }).then( function (result){
            if (result.value){
                window.livewire.emit('revokeall')
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
