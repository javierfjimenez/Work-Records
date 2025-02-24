<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ isset($workRecord) ? __('Editar Registro De Trabajo') : __('Crear Registro De Trabajo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ isset($workRecord) ? __('Editar Registro De Trabajo') : __('Crear Registro De Trabajo') }}
                            </h2>

                            <!-- <p class="mt-1 text-sm text-gray-600">
                                {{ __("Log your work sessions with start time, end time, priority level, and description.") }}
                            </p> -->
                        </header>

                        <form method="post"
                            action="{{ isset($workRecord) ? route('work_records.update', $workRecord) : route('work_records.store') }}"
                            class="mt-6 space-y-6">
                            @csrf
                            @isset($workRecord)
                                @method('PUT')
                            @endisset

                            <!-- Title -->
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <input id="title" name="title" type="text"
                                    value="{{ old('title', $workRecord->title ?? '') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <!-- Start Time -->
                            <div>
                                <x-input-label for="start_time" :value="__('Start Time')" />
                                <x-text-input id="start_time" name="start_time" type="datetime-local"
                                    value="{{ old('start_time', isset($workRecord) ? \Carbon\Carbon::parse($workRecord->start_time)->format('Y-m-d\TH:i') : '') }}"
                                    class="mt-1 block w-full" required />
                                <x-input-error class="mt-2" :messages="$errors->get('start_time')" />
                            </div>

                            <!-- End Time -->
                            <div>
                                <x-input-label for="end_time" :value="__('End Time')" />
                                <x-text-input id="end_time" name="end_time" type="datetime-local"
                                    value="{{ old('end_time', isset($workRecord) && $workRecord->end_time ? \Carbon\Carbon::parse($workRecord->end_time)->format('Y-m-d\TH:i') : '') }}"
                                    class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('end_time')" />
                            </div>

                            <!-- Priority -->
                            <div>
                                <x-input-label for="priority" :value="__('Priority')" />
                                <select id="priority" name="priority"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
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
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $workRecord->description ?? '') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <!-- Save Button -->
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ isset($workRecord) ? __('Update') : __('Save') }}</x-primary-button>

                                @if (session('status') === 'work_record_saved' || session('status') === 'work_record_updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition
                                        x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                        {{ isset($workRecord) ? __('Updated successfully.') : __('Saved successfully.') }}
                                    </p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>