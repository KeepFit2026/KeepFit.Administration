{{-- resources/views/filament/tables/custom-generic-table.blade.php --}}
<div class="table-container-wrapper shadow-sm rounded-xl overflow-hidden border border-gray-200 dark:border-gray-800">
    <div class="table-container bg-white dark:bg-gray-900">
        
        <div class="bg-[#1f2937] text-white px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2 text-base font-medium">
                <i class="bi bi-list-ul text-emerald-500"></i>
                <span>{{ $this->getTable()->getHeading() ?? 'Gestion' }}</span>
            </div>
            <div class="flex gap-2">
                {{-- Bouton Exporter --}}
                <button class="bg-gray-700 hover:bg-gray-600 px-3 py-1.5 rounded-lg text-sm flex items-center gap-2 transition-colors duration-200 border-0 cursor-pointer text-white">
                    <i class="bi bi-download"></i>
                    <span>Exporter</span>
                </button>
                
                <button x-on:click="$dispatch('open-table-filters')" 
                        class="bg-gray-700 hover:bg-gray-600 px-3 py-1.5 rounded-lg text-sm flex items-center gap-2 transition-colors duration-200 border-0 cursor-pointer text-white">
                    <i class="bi bi-funnel"></i>
                    <span>Filtrer</span>
                </button>
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

        {{-- PAGINATION --}}
        @php $records = $this->getTableRecords(); @endphp
        @if($records instanceof \Illuminate\Contracts\Pagination\Paginator && $records->hasPages())
            <div class="bg-white dark:bg-gray-900 px-6 py-4 border-t border-gray-100 dark:border-gray-800">
                {{ $records->links() }}
            </div>
        @endif
    </div>
</div>