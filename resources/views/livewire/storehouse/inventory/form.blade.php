@include('common.headModal')
<form class="space-y-6">
    <div class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-2">
        <div>
            <label for="numInv" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número de Inventario</label>
            <input type="text" wire:model='numInv' id="numInv" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            @error('numInv')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
            @enderror
        </div>
        <div>
            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
            <input type="text" wire:model='descripcion' id="descripcion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            @error('descripcion')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
            @enderror
        </div>
        <div>
            <label for="family_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Familia</label>
            <select wire:model='family_id' id="family_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                <option value="Elegir">Elija una opción</option>
                @foreach ($familias as $familia)
                    <option value="{{$familia->id}}">{{$familia->name}}</option>
                @endforeach
            </select>
            @error('family_id')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
            @enderror
        </div>
        <div>
            <label for="measurementunits_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unidad</label>
            <select wire:model='measurementunits_id' id="measurementunits_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="Elegir" selected>Debe elegir una opcion</option>
                @foreach ($unidades as $unidad)
                    <option value="{{ $unidad->id}}">{{ $unidad->name}}</option>
                @endforeach
            </select>
            @error('measurementunits_id')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
            @enderror
        </div>
        @if($select_id != 0)
            <div>
                <label for="existencia" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Existencia</label>
                <input type="number" wire:model='existencia' id="existencia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('existencia')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                @enderror
            </div>
        @else
            <div>
                <label for="existencia" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Existencia</label>
                <input type="number" wire:model='existencia' id="existencia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                @error('existencia')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                @enderror
            </div>
        @endif
        <div>
            <label for="exisinicial" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Existencia Inicial</label>
            <input type="number" wire:model='exisInicial' id="exisInicial" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            @error('exisInicial')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
            @enderror
        </div>
        <div>
            <label for="costo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Costo</label>
            <input type="number" wire:model='costo' id="costo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            @error('costo')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
            @enderror
        </div>
    <div>
</form>
@include('common.footerModal')
