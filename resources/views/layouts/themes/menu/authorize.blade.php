<li>@role('SuperUser|JefeMateriales|SubGerente')
    <button type="button" aria-controls="dropdown-authorize" data-collapse-toggle="dropdown-authorize" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
        @include('layouts.themes.icons.authorize')
        <span class="flex-1 ml-3 text-left whitespace-nowrap">Atorización</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
    </button>
    <ul id="dropdown-authorize" class="hidden py-2 space-y-2">
        @role('SuperUser|JefeMateriales')
        <li>
            <a href="{{ route('indexAutorize') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                @include('layouts.themes.icons.authMateriales')
                <span class="flex-1 ml-3 whitespace-nowrap">Materiales</span>
            </a>
        </li>
        @endrole
        @role('SuperUser|SubGerente')
        <li>
            <a href="{{ route('indexAutorizes') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                @include('layouts.themes.icons.authSubger')
                <span class="flex-1 ml-3 whitespace-nowrap">Subgerencia</span>
            </a>
        </li>
        @endrole
    </ul>
    @endrole
</li>
