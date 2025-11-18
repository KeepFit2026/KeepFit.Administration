<aside class="sidebar">
    <div class="sidebar-header">
        <h2><i class="fas fa-dumbbell"></i>KeepFit Admin</h2>
    </div>

    <nav class="sidebar-nav">
        <ul>
            @foreach($items as $item)

                @php
                            $routeName = $item['route'] ?? null;
                @endphp

                <li class="nav-item {{ request()->routeIs($routeName) ? 'active' : '' }}">
                    <a href="{{ $routeName && Route::has($routeName) ? route($routeName) : '#' }}">
                        <i class="{{ $item['icon'] ?? 'fas fa-dumbbell' }}"></i> {{ $item['title'] }}
                    </a>
                </li>
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