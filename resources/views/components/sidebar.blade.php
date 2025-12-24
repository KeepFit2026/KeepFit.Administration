<aside class="sidebar">
    <div class="sidebar-header">
        <h2><i class="fas fa-dumbbell"></i>KeepFit Admin</h2>
    </div>

    <nav class="sidebar-nav">
        <ul>
            @foreach($items as $item)
                @if(isset($item['submenu']) && count($item['submenu']) > 0)
                    {{-- PARENT --}}
                    <li class="nav-item has-submenu {{ $item['isActive'] ? 'open' : '' }}">
                        <a href="javascript:void(0)" onclick="toggleSubmenu(this)">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <i class="{{ $item['icon'] ?? 'fas fa-circle' }}"></i> 
                                {{ $item['title'] }}
                            </div>
                            <i class="fas fa-chevron-right arrow-icon"></i>
                        </a>
                        
                        <div class="submenu-wrapper">
                            <div class="submenu-inner">
                                <ul class="submenu">
                                    @foreach($item['submenu'] as $subItem)
                                        {{-- ENFANT --}}
                                        <li class="nav-item {{ $subItem['isActive'] ? 'active' : '' }}">
                                            <a href="{{ $subItem['url'] }}">
                                                {{ $subItem['title'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                @else
                    {{-- ITEM STANDARD --}}
                    <li class="nav-item {{ $item['isActive'] ? 'active' : '' }}">
                        <a href="{{ $item['url'] }}">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <i class="{{ $item['icon'] ?? 'fas fa-dumbbell' }}"></i> {{ $item['title'] }}
                            </div>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('login.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </button>
        </form>
    </div>
</aside>

<script>
    // Ouverture
    function toggleSubmenu(element) {
        const parentLi = element.closest('.nav-item');
        parentLi.classList.toggle('open');
    }
</script>

<style>
    .nav-item.has-submenu > a {
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
    }

    .submenu-wrapper {
        display: grid;
        grid-template-rows: 0fr;
        transition: grid-template-rows 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .nav-item.open .submenu-wrapper {
        grid-template-rows: 1fr;
    }

    .submenu-inner {
        overflow: hidden;
    }

    .submenu {
        list-style: none;
        padding: 0;
        margin: 0;
        margin-left: 28px;
        border-left: 1px solid #4b5563;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .submenu .nav-item {
        margin: 0;
        background: none;
    }

    .submenu .nav-item a {
        padding: 10px 15px 10px 15px;
        margin-left: 12px;
        font-size: 0.9rem;
        color: #9ca3af;
        border-left: 4px solid transparent;
        border-radius: 4px;
        transition: all 0.2s;
        display: block;
    }

    .submenu .nav-item a:hover {
        color: white;
        background-color: rgba(255, 255, 255, 0.05);
    }

    .submenu .nav-item.active a {
        background-color: #374151 !important;
        border-left-color: var(--secondary) !important;
        color: white !important;
        font-weight: 600;
        box-shadow: 0 1px 3px rgba(0,0,0,0.2);
    }

    .submenu .nav-item.active {
        background: none !important;
        margin: 0 !important;
    }

    .arrow-icon {
        font-size: 0.75rem;
        transition: transform 0.4s ease;
    }
    .nav-item.open .arrow-icon {
        transform: rotate(90deg);
    }
</style>