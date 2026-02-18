<div class="table-container-wrapper shadow-sm rounded-xl overflow-hidden border border-gray-200 dark:border-gray-800">
    <div class="table-container bg-white dark:bg-gray-900">
        {{-- HEADER --}}
        <div class="bg-[#1f2937] text-white px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2 text-base font-medium">
                <i class="bi bi-list-ul text-emerald-500"></i>
                <span>{{ $this->getTable()->getHeading() ?? 'Gestion' }}</span>
            </div>
            <div class="flex gap-2 items-center">
                @if($this->getTable()->isSearchable())
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <x-heroicon-o-magnifying-glass class="w-4 h-4 text-gray-400" />
                        </div>
                        <input
                            type="text"
                            wire:model.live.debounce.500ms="tableSearch"
                            placeholder="Rechercher..."
                            class="pl-10 pr-10 py-1.5 w-64 bg-gray-700 border border-gray-600 rounded-lg text-sm text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                        />
                    </div>
                @endif

                <button class="bg-gray-700 hover:bg-gray-600 px-3 py-1.5 rounded-lg text-sm flex items-center gap-2 transition-colors duration-200 border-0 cursor-pointer text-white">
                    <x-heroicon-o-arrow-down-tray class="w-4 h-4" />
                    <span>Exporter</span>
                </button>

                @if($this->getTable()->getFilters() && count($this->getTable()->getFilters()) > 0)
                    <button x-data="" x-on:click="$dispatch('open-modal', { id: 'table-filters' })" class="bg-gray-700 hover:bg-gray-600 px-3 py-1.5 rounded-lg text-sm flex items-center gap-2 transition-colors duration-200 border-0 cursor-pointer text-white">
                        <x-heroicon-o-funnel class="w-4 h-4" />
                        <span>Filtrer</span>
                    </button>
                @endif
            </div>
        </div>

        {{-- CORPS DU TABLEAU --}}
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-[#1f2937] text-white uppercase text-[11px] font-bold tracking-widest border-b border-gray-700">
                        @foreach($this->getTable()->getColumns() as $column)
                            @if($column->isVisible())
                                <th @if($column->isSortable()) wire:click="sortTable('{{ $column->getName() }}')" @endif
                                    class="px-6 py-4 text-left border-0 {{ $column->isSortable() ? 'cursor-pointer hover:text-emerald-400 transition-colors' : '' }}">
                                    <div class="flex items-center gap-1">
                                        {{ $column->getLabel() }}
                                        @if($column->isSortable() && $this->getTableSortColumn() === $column->getName())
                                            @if($this->getTableSortDirection() === 'asc')
                                                <x-heroicon-s-chevron-up class="w-3 h-3" />
                                            @else
                                                <x-heroicon-s-chevron-down class="w-3 h-3" />
                                            @endif
                                        @elseif($column->isSortable())
                                            <x-heroicon-s-chevron-up-down class="w-3 h-3 opacity-30" />
                                        @endif
                                    </div>
                                </th>
                            @endif
                        @endforeach
                        <th class="px-6 py-4 text-right border-0 w-32">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @forelse($this->getTableRecords() as $record)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors duration-200 group">
                            @foreach($this->getTable()->getColumns() as $column)
                                @if($column->isVisible())
                                    @php
                                        $column->record($record);
                                        $columnName = $column->getName();
                                        $rawValue = $column->getState();
                                        
                                        $isInteractive = $column instanceof \Filament\Tables\Columns\ToggleColumn || $column instanceof \Filament\Tables\Columns\SelectColumn;
                                        $hasBadge = method_exists($column, 'isBadge') && $column->isBadge();
                                        $formattedState = !$isInteractive ? $column->formatState($rawValue) : null;
                                    @endphp

                                    <td class="px-6 py-5 align-middle border-0 text-left">
                                        {{-- CAS 1 : COLONNES INTERACTIVES (Toggle/Select) --}}
                                        @if($isInteractive)
                                            <div class="flex items-center">
                                                {{ $column }}
                                            </div>

                                        {{-- CAS 2 : PREMIÈRE COLONNE (Identité) --}}
                                        @elseif($loop->first)
                                            @php
                                                // Fallback si la valeur est nulle (problème de casse PascalCase/camelCase)
                                                $displayValue = $formattedState ?: ($record->Name ?? $record->name ?? $record->label ?? $record->title ?? 'N/A');
                                            @endphp
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-lg bg-emerald-500 text-white flex items-center justify-center flex-shrink-0 shadow-sm transition group-hover:scale-110">
                                                    @php
                                                        $icon = method_exists($record, 'getIcon') ? $record->getIcon() : 'bi-lightning-charge';
                                                        if (!str_starts_with($icon, 'bi-')) {
                                                            $icon = 'bi-' . $icon;
                                                        }
                                                    @endphp
                                                    <i class="{{ $icon }}"></i>
                                                </div>
                                                <div class="flex flex-col">
                                                    <div class="font-bold text-gray-900 dark:text-white mb-0.5 leading-tight">
                                                        {{ $displayValue }}
                                                    </div>
                                                    <div class="text-[10px] text-gray-400 uppercase tracking-tight">
                                                        {{ ($record->created_at ?? null) ? $record->created_at->diffForHumans() : ($record->getKey() ?? 'N/A') }}
                                                    </div>
                                                </div>
                                            </div>

                                        {{-- CAS 3 : BADGES (Dynamique via Filament) --}}
                                        @elseif($hasBadge)
                                            @php
                                                $color = $column->getColor($rawValue) ?? 'gray';
                                                $colorClasses = match($color) {
                                                    'danger'    => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800',
                                                    'info'      => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 border border-blue-200 dark:border-blue-800',
                                                    'success'   => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800',
                                                    'warning'   => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800',
                                                    'primary'   => 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400 border border-indigo-200 dark:border-indigo-800',
                                                    'secondary' => 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400 border border-gray-200 dark:border-gray-700',
                                                    default     => 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400 border border-gray-200 dark:border-gray-700',
                                                };
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider {{ $colorClasses }}">
                                                {{ $formattedState }}
                                            </span>

                                        {{-- CAS 4 : TEXTE SIMPLE --}}
                                        @else
                                            <span class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ $formattedState }}
                                            </span>
                                        @endif
                                    </td>
                                @endif
                            @endforeach

                            <td class="px-6 py-5 align-middle border-0">
                                <div class="flex gap-2 justify-end">
                                    @php 
                                        $recordKey = $record->getKey(); 
                                        $resource = $this->getResource();
                                        $hasEditPage = false;
                                        try {
                                            $hasEditPage = $resource::hasPage('edit');
                                        } catch (\Exception $e) {}
                                    @endphp

                                    @if($hasEditPage)
                                        <a href="{{ $resource::getUrl('edit', ['record' => $record]) }}" class="w-8 h-8 flex items-center justify-center rounded-md bg-gray-100 text-gray-600 hover:bg-gray-600 hover:text-white transition-all border-0 cursor-pointer shadow-sm">
                                            <x-heroicon-o-pencil-square class="w-4 h-4" />
                                        </a>
                                    @else
                                        <button wire:click="mountTableAction('edit', '{{ $recordKey }}')" class="w-8 h-8 flex items-center justify-center rounded-md bg-gray-100 text-gray-600 hover:bg-gray-600 hover:text-white transition-all border-0 cursor-pointer shadow-sm">
                                            <x-heroicon-o-pencil-square class="w-4 h-4" />
                                        </button>
                                    @endif

                                    <button wire:click="mountTableAction('delete', '{{ $recordKey }}')" class="w-8 h-8 flex items-center justify-center rounded-md bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all border-0 cursor-pointer shadow-sm" onclick="return confirm('Confirmer la suppression ?')">
                                        <x-heroicon-o-trash class="w-4 h-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="px-6 py-12 text-center border-0 text-gray-400 italic">Aucun élément trouvé</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @php $records = $this->getTableRecords(); @endphp
        @if($records instanceof \Illuminate\Contracts\Pagination\Paginator)
            <div class="bg-white dark:bg-gray-900 px-6 py-4 border-t border-gray-100 dark:border-gray-800">
                <x-filament::pagination
                    :paginator="$records"
                    :page-options="$this->getTable()->getPaginationPageOptions()"
                />
            </div>
        @endif
    </div>
</div>

{{-- MODAL DES FILTRES --}}
@if($this->getTable()->getFilters() && count($this->getTable()->getFilters()) > 0)
    <x-filament::modal id="table-filters" width="2xl">
        <x-slot name="heading">Filtrer {{ Str::lower($this->getTable()->getHeading() ?? 'les données') }}</x-slot>
        <div class="space-y-4">
            @foreach(collect($this->getTable()->getFilters())->filter(fn($f) => $f->isVisible()) as $filter)
                <div>
                    <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">{{ $filter->getLabel() }}</label>
                    <select wire:model.live="tableFilters.{{ $filter->getName() }}.value" class="block w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-emerald-500 dark:bg-gray-800 dark:text-white py-2 px-3">
                        <option value="">Tout</option>
                        @foreach($filter->getOptions() as $val => $lab)
                            <option value="{{ $val }}">{{ $lab }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>
        <x-slot name="footerActions">
            <x-filament::button color="gray" x-on:click="$dispatch('close-modal', { id: 'table-filters' })">Annuler</x-filament::button>
            <x-filament::button wire:click="$refresh" x-on:click="$dispatch('close-modal', { id: 'table-filters' })" class="bg-emerald-600">Appliquer</x-filament::button>
        </x-slot>
    </x-filament::modal>
@endif
