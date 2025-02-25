<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Trabajo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Ver Detalles del Trabajo') }}
                            </h2>
                        </header>

                        <div class="mt-6 space-y-6">

                            <!-- Title -->
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <input id="title" name="title" type="text"
                                    value="{{ old('title', $workRecord->title ?? '') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" disabled/>
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <!-- Start Time -->
                            <div>
                                <x-input-label for="start_time" :value="__('Start Time')" />
                                <x-text-input id="start_time" name="start_time" type="datetime-local"
                                    value="{{ old('start_time', isset($workRecord) ? \Carbon\Carbon::parse($workRecord->start_time)->format('Y-m-d\TH:i') : '') }}"
                                    class="mt-1 block w-full" disabled/>
                                <x-input-error class="mt-2" :messages="$errors->get('start_time')" />
                            </div>

                            <!-- End Time -->
                            <div>
                                <x-input-label for="end_time" :value="__('End Time')" />
                                <x-text-input id="end_time" name="end_time" type="datetime-local"
                                    value="{{ old('end_time', isset($workRecord) && $workRecord->end_time ? \Carbon\Carbon::parse($workRecord->end_time)->format('Y-m-d\TH:i') : '') }}"
                                    class="mt-1 block w-full" disabled/>
                                <x-input-error class="mt-2" :messages="$errors->get('end_time')" />
                            </div>

                            <!-- Priority -->
                            <div>
                                <x-input-label for="priority" :value="__('Priority')" />
                                <select id="priority" name="priority"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" disabled>
                                    <option value="baja" {{ old('priority', $workRecord->priority ?? '') == 'baja' ? 'selected' : '' }}>
                                        {{ __('Low') }}
                                    </option>
                                    <option value="media" {{ old('priority', $workRecord->priority ?? '') == 'media' ? 'selected' : '' }}>
                                        {{ __('Medium') }}
                                    </option>
                                    <option value="alta" {{ old('priority', $workRecord->priority ?? '') == 'alta' ? 'selected' : '' }}>
                                        {{ __('High') }}
                                    </option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('priority')" />
                            </div>

                            <!-- Description -->
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" disabled>{{ old('description', $workRecord->description ?? '') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <!-- Save Button -->
                            <div class="flex items-center gap-4">
                                <x-nav-link class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" :href="route('work_records.index')"
                                    :active="request()->routeIs('work_records.index')">
                                    📂 Ver Registros
                                </x-nav-link>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>