<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Registros de Trabajo') }}
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="container mx-auto px-4 py-6">
                    <h1 class="text-3xl font-bold mb-4">Registros de Trabajo</h1>

                    <div class="flex gap-4 mt-4 mb-4">
                        <a href="{{ route('work_records.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            + Nuevo Registro
                        </a>
                        <a href="{{ route('work_records.export') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Exportar CSV
                        </a>
                    </div>

                    @if (session('status'))
                        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="border-collapse table-auto w-full text-lg leading-loose text-center">
                            <thead class="bg-gray-200 border-b">
                                <tr>
                                    <th class="p-4 text-left">ID</th>
                                    <th class="p-4 text-left">Título</th>
                                    <th class="p-4 text-left">Descripción</th>
                                    <th class="p-4 text-left">Inicio</th>
                                    <th class="p-4 text-left">Fin</th>
                                    <th class="p-4 text-left">Prioridad</th>
                                    <th class="p-4 text-left">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($workRecords as $record)
                                                            <tr class="border-b">
                                                                <td class="p-4">{{ $record->id }}</td>
                                                                <td class="p-4">{{ Str::limit($record->title, limit: 25) }}</td>
                                                                <td class="p-4">{{ Str::limit($record->description, 40) }}</td>
                                                                <td class="p-4">
                                                                    {{ \Carbon\Carbon::parse($record->start_time)->format('d/m/Y') }}</td>
                                                                <td class="p-4">
                                                                    {{ $record->end_time ? \Carbon\Carbon::parse($record->end_time)->format('d/m/Y') : 'En progreso' }}
                                                                </td>
                                                                <td>{{ $record->priority_label }}</td>
                                                                <td class="p-4">
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" class="text-gray-700 hover:text-gray-700 focus:outline-none">
            ⋮
        </button>
        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-md py-1 border">
            <a href="{{ route('work_records.show', $record) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">👁️ Ver</a>
            <a href="{{ route('work_records.edit', $record) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">✏️ Editar</a>
            <form action="{{ route('work_records.destroy', $record) }}" method="POST"
                onsubmit="return confirm('¿Seguro que deseas eliminar este registro?');">
                @csrf @method('DELETE')
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">🗑️ Eliminar</button>
            </form>
        </div>
    </div>
</td>
                                                            </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-4 text-center text-gray-500">No hay registros de trabajo.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                        <div class="mt-4">
    {{ $workRecords->links() }}
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>