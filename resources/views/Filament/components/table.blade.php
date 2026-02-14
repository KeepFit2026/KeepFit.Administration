<div class="table-container-wrapper shadow-sm rounded-xl overflow-hidden border border-gray-200 dark:border-gray-800">
    <div class="table-container bg-white dark:bg-gray-900">        
        <div class="bg-[#1f2937] text-white px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2 text-base font-medium">
                <i class="bi bi-list-ul text-emerald-500"></i>
                <span>{{ $this->getTable()->getHeading() ?? 'Gestion' }}</span>
            </div>
            <div class="flex gap-2 items-center">
                @if($this->getTable()->isSearchable())
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </div>
                        <input 
                            type="text"
                            wire:model.live.debounce.500ms="tableSearch"
                            placeholder="Rechercher..."
                            class="pl-10 pr-10 py-1.5 w-64 bg-gray-700 border border-gray-600 rounded-lg text-sm text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                        />
                        @if(!empty($this->tableSearch))
                            <button 
                                wire:click="$set('tableSearch', '')"
                                type="button"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-white"
                            >
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        @endif
                    </div>
                @endif

                <button class="bg-gray-700 hover:bg-gray-600 px-3 py-1.5 rounded-lg text-sm flex items-center gap-2 transition-colors duration-200 border-0 cursor-pointer text-white">
                    <i class="bi bi-download"></i>
                    <span>Exporter</span>
                </button>
                
                @if($this->getTable()->getFilters() && count($this->getTable()->getFilters()) > 0)
                    <button 
                        x-data=""
                        x-on:click="$dispatch('open-modal', { id: 'table-filters' })"
                        class="bg-gray-700 hover:bg-gray-600 px-3 py-1.5 rounded-lg text-sm flex items-center gap-2 transition-colors duration-200 border-0 cursor-pointer text-white">
                        <i class="bi bi-funnel"></i>
                        <span>Filtrer</span>
                    </button>
                @endif
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-[#1f2937] text-white uppercase text-[11px] font-bold tracking-widest border-b border-gray-700">
                        @foreach($this->getTable()->getColumns() as $column)
                            @if($column->isVisible())
                                <th class="px-6 py-4 text-left border-0">
                                    {{ $column->getLabel() }}
                                </th>
                            @endif
                        @endforeach
                        <th class="px-6 py-4 text-right border-0 w-32">
                            Actions
                        </th>
                    </tr>
                </thead>
                
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @forelse($this->getTableRecords() as $record)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors duration-200 group">
                            @foreach($this->getTable()->getColumns() as $column)
                                @if($column->isVisible())
                                    @php 
                                        $column->record($record);
                                        $state = $column->getState();
                                    @endphp
                                    <td class="px-6 py-5 align-middle border-0">
                                        @if($loop->first)
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-lg bg-emerald-500 text-white flex items-center justify-center flex-shrink-0 shadow-sm transition group-hover:scale-110">
                                                    <i class="bi bi-lightning-charge"></i>
                                                </div>
                                                <div class="flex flex-col text-left">
                                                    <div class="font-bold text-gray-900 dark:text-white mb-0.5 leading-tight">
                                                        {{ $state }}
                                                    </div>
                                                    <div class="text-[10px] text-gray-400 uppercase tracking-tight text-left">
                                                        Créé le {{ $record->created_at?->format('d/m/Y') ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2 leading-relaxed text-left">
                                                {{ $state ?? '-' }}
                                            </div>
                                        @endif
                                    </td>
                                @endif
                            @endforeach

                            <td class="px-6 py-5 align-middle border-0">
                                <div class="flex gap-2 justify-end">
                                    @php
                                        $resourceClass = $this->getResource();
                                        $actions = $this->getTable()->getActions();
                                        $recordKey = $record->getKey();
                                    @endphp

                                    @foreach($actions as $action)
                                        @php $actionName = $action->getName(); @endphp
                                        
                                        @if($actionName === 'edit')
                                            @if($resourceClass::hasPage('edit'))
                                                <a href="{{ $resourceClass::getUrl('edit', ['record' => $recordKey]) }}" 
                                                   class="w-8 h-8 flex items-center justify-center rounded-md bg-gray-100 text-gray-600 hover:bg-gray-600 hover:text-white transition-all duration-200 no-underline shadow-sm"
                                                   title="Modifier">
                                                    <i class="bi bi-pencil-square text-sm"></i>
                                                </a>
                                            @else
                                                <button wire:click="mountTableAction('edit', '{{ $recordKey }}')"
                                                        class="w-8 h-8 flex items-center justify-center rounded-md bg-gray-100 text-gray-600 hover:bg-gray-600 hover:text-white transition-all duration-200 border-0 cursor-pointer shadow-sm"
                                                        title="Modifier">
                                                    <i class="bi bi-pencil-square text-sm"></i>
                                                </button>
                                            @endif

                                        @elseif($actionName === 'delete')
                                            <button wire:click="mountTableAction('delete', '{{ $recordKey }}')"
                                                    class="w-8 h-8 flex items-center justify-center rounded-md bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all duration-200 border-0 cursor-pointer shadow-sm"
                                                    title="Supprimer"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')">
                                                <i class="bi bi-trash text-sm"></i>
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="px-6 py-12 text-center border-0">
                                <div class="flex flex-col items-center justify-center text-gray-400 text-center">
                                    <i class="bi bi-inbox text-5xl mb-3 opacity-30 text-center"></i>
                                    <p class="text-gray-500 text-base italic text-center">Aucun élément trouvé</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @php $records = $this->getTableRecords(); @endphp
        @if($records instanceof \Illuminate\Contracts\Pagination\Paginator && $records->hasPages())
            <div class="bg-white dark:bg-gray-900 px-6 py-4 border-t border-gray-100 dark:border-gray-800">
                {{ $records->links() }}
            </div>
        @endif
    </div>
</div>

{{-- MODAL DE FILTRES DYNAMIQUE --}}
@if($this->getTable()->getFilters() && count($this->getTable()->getFilters()) > 0)
    <x-filament::modal id="table-filters" width="2xl">
        <x-slot name="heading">
            Filtrer {{ Str::lower($this->getTable()->getHeading() ?? 'les éléments') }}
        </x-slot>

        <div class="space-y-4">
            @php
                $filters = collect($this->getTable()->getFilters())->filter(fn($filter) => $filter->isVisible());
            @endphp
            
            @foreach($filters as $filterKey => $filter)
                @php
                    $filterName = $filter->getName();
                    try {
                        $options = $filter->getOptions();
                    } catch (\Exception $e) {
                        $options = [];
                    }
                    
                    if (!is_array($options) && !($options instanceof \Traversable)) {
                        $options = [];
                    }
                @endphp
                
                <div wire:key="filter-{{ $filterKey }}">
                    <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                        {{ $filter->getLabel() }}
                    </label>
                    <select 
                        wire:model.defer="tableFilters.{{ $filterName }}.value"
                        class="fi-select-input block w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:border-primary-600 focus:ring-primary-600 dark:bg-gray-800 dark:text-white dark:focus:border-primary-600 py-2 px-3"
                    >
                        <option value="">Tout</option>
                        @foreach($options as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>

        <x-slot name="footerActions">
            <x-filament::button
                color="gray"
                x-on:click="$dispatch('close-modal', { id: 'table-filters' })"
            >
                Annuler
            </x-filament::button>
            
            <x-filament::button
                color="gray"
                wire:click="resetTableFiltersForm"
            >
                Réinitialiser
            </x-filament::button>

            <x-filament::button
                wire:click="$refresh"
                x-on:click="$dispatch('close-modal', { id: 'table-filters' })"
            >
                Appliquer
            </x-filament::button>
        </x-slot>
    </x-filament::modal>
@endif