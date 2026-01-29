@extends('Layouts.admin')

@section('title', 'Messagerie KeepFit')

@section('content')

    <div class="chat-layout-wrapper">
        <div class="chat-list-panel">
            <div class="panel-header">
                <div class="header-top-row">
                    <h3>
                        <i class="fas fa-running" style="color: var(--primary); margin-right: 8px;"></i>Discussions
                    </h3>
                    <button class="btn-new-chat" onclick="openNewChatModal()" title="Nouvelle conversation">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>

                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher un athlète...">
                </div>
            </div>

            <div class="conversations-scroller">
                @if(isset($conv['data']) && count($conv['data']) > 0)
                   @foreach($conv['data'] as $chatItem)
                        <div class="conversation-card" onclick="console.log('Open chat: {{ $chatItem['id'] }}')">
                            <div class="card-avatar">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($chatItem['name'] ?? 'Inconnu') }}&background=random&color=fff" alt="Avatar">
                            </div>
                            <div class="card-info">
                                <div class="card-top">
                                    <span class="name">{{ $chatItem['name'] ?? 'Inconnu' }}</span>
                                    <span class="time">
                                        @if(isset($chatItem['updatedAt']))
                                            {{ \Carbon\Carbon::parse($chatItem['updatedAt'])->format('H:i') }}
                                        @endif
                                    </span>
                                </div>
                                <p class="preview">Cliquez pour afficher...</p>
                            </div>
                        </div>
                   @endforeach
                @else
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; color: var(--gray); text-align: center; padding: 1rem;">
                        <i class="far fa-comments" style="font-size: 2rem; margin-bottom: 0.5rem; opacity: 0.5;"></i>
                        <p style="font-size: 0.9rem;">Aucune discussion</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="chat-main-panel">
            <div style="height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; color: var(--gray);">
                <div style="background: white; padding: 2rem; border-radius: 50%; margin-bottom: 1rem; box-shadow: var(--shadow-sm);">
                    <i class="fas fa-paper-plane" style="font-size: 2.5rem; color: var(--primary);"></i>
                </div>
                <h3>Vos messages</h3>
                <p>Sélectionnez une discussion ou démarrez-en une nouvelle.</p>
                <button onclick="openNewChatModal()" style="margin-top: 1rem; padding: 0.8rem 1.5rem; background: var(--primary); color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">
                    Nouvelle conversation
                </button>
            </div>
        </div>
    </div>

    <div id="newChatModal" class="modal-backdrop">
        <div class="modal-window">
            <div class="modal-header">
                <h3>Nouvelle Conversation</h3>
                <button onclick="closeNewChatModal()" class="close-btn"><i class="fas fa-times"></i></button>
            </div>
            
            <div class="modal-body">
                <div class="modal-tabs">
                    <button class="tab-btn active" onclick="switchTab('direct')">Direct</button>
                    {{-- <button class="tab-btn" onclick="switchTab('group')">Groupe</button> --}}
                </div>

                <div id="tab-direct" class="tab-content active">
                    <div class="modal-search">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchUserDirect" placeholder="Rechercher une personne..." onkeyup="filterUsers()">
                    </div>

                    <div class="users-list-suggestion" id="usersListContainer">
                        <p class="list-label">Suggestions</p>
                        
                        @if(isset($users['data']) && count($users['data']) > 0)
                            @foreach($users['data'] as $user)
                                <div class="user-suggestion-item" data-name="{{ strtolower($user['name']) }}">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user['name']) }}&background=random&color=fff" alt="User">
                                    <div class="user-suggestion-info">
                                        <span class="name">{{ $user['name'] }}</span>
                                        <span class="role">{{ $user['roleName'] ?? 'Membre' }}</span>
                                    </div>
                                    <button class="btn-start" onclick="startPrivateChat('{{ $user['id'] }}')">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <p style="padding: 10px; color: var(--gray); font-size: 0.9rem;">Aucun utilisateur disponible.</p>
                        @endif

                    </div>
                </div>

                <div id="tab-group" class="tab-content" style="display: none;">
                    
                    <div class="group-name-input">
                        <label>Nom du groupe</label>
                        <input type="text" placeholder="Ex: Team Crossfit, Prépa Marathon...">
                    </div>

                    <div class="modal-search small-margin">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Ajouter des membres...">
                    </div>

                    <div class="users-list-checklist">
                        <p class="list-label">Sélectionner les membres</p>
                        
                        @if(isset($users['data']) && count($users['data']) > 0)
                            @foreach($users['data'] as $user)
                                <label class="user-check-item">
                                    <input type="checkbox" name="group_members[]" value="{{ $user['id'] }}">
                                    <div class="check-content">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user['name']) }}&background=random&color=fff" alt="User">
                                        <div class="info">
                                            <span class="name">{{ $user['name'] }}</span>
                                            <span class="role">{{ $user['roleName'] ?? 'Membre' }}</span>
                                        </div>
                                        <div class="checkbox-visual"></div>
                                    </div>
                                </label>
                            @endforeach
                        @endif

                    </div>

                    <button class="btn-create-group">
                        Créer le groupe
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script>
        function openNewChatModal() {
            document.getElementById('newChatModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeNewChatModal() {
            document.getElementById('newChatModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('newChatModal');
            if (event.target == modal) {
                closeNewChatModal();
            }
        }

        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));

            document.getElementById('tab-' + tabName).style.display = 'block';
            
            const buttons = document.querySelectorAll('.tab-btn');
            if(tabName === 'direct') buttons[0].classList.add('active');
            if(tabName === 'group') buttons[1].classList.add('active');
        }

        function filterUsers() {
            const input = document.getElementById('searchUserDirect');
            const filter = input.value.toLowerCase();
            const list = document.getElementById('usersListContainer');
            const items = list.getElementsByClassName('user-suggestion-item');

            for (let i = 0; i < items.length; i++) {
                const nameAttr = items[i].getAttribute('data-name');
                if (nameAttr.indexOf(filter) > -1) {
                    items[i].style.display = "flex";
                } else {
                    items[i].style.display = "none";
                }
            }
        }

        function startPrivateChat(targetUserId) {
            if(window.event) window.event.preventDefault();

            const btn = window.event ? window.event.currentTarget : null;
            const originalContent = btn ? btn.innerHTML : '';
            
            if(btn) {
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                btn.disabled = true;
            }

            fetch("{{ route('admin.chat.create') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ 
                    targetUserId: targetUserId 
                })
            })
            .then(response => {
                return response.json().then(data => {
                    return {
                        ok: response.ok,
                        data: data
                    };
                });
            })
            .then(result => {
                if (result.ok) {
                    closeNewChatModal();
                    window.location.reload();
                } else {
                    console.log(result.data);
                    alert("Erreur : " + (result.data.error || "Impossible de créer la discussion"));
                }
            })
            .catch(error => {
                console.error("Erreur JS :", error);
                alert("Une erreur technique est survenue.");
            })
            .finally(() => {
                if(btn) {
                    btn.innerHTML = originalContent;
                    btn.disabled = false;
                }
            });
        }
    </script>

    <style>
        .chat-layout-wrapper {
            display: flex;
            height: calc(100vh - 85px); 
            margin: -2rem; 
            width: calc(100% + 4rem);
            background: white;
            overflow: hidden;
            border-top: 1px solid var(--gray-light);
        }

        .chat-list-panel {
            width: 340px;
            border-right: 1px solid var(--gray-light);
            display: flex; flex-direction: column; background: white; z-index: 2;
        }

        .panel-header { padding: 1.5rem; border-bottom: 1px solid var(--gray-light); }
        .header-top-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
        .panel-header h3 { font-size: 1.2rem; font-weight: 700; margin: 0; color: var(--dark); display: flex; align-items: center; }

        .btn-new-chat {
            background-color: var(--light); color: var(--primary); border: 1px solid var(--gray-light);
            width: 36px; height: 36px; border-radius: 8px; cursor: pointer; transition: all 0.2s;
            display: flex; align-items: center; justify-content: center; font-size: 1rem;
        }
        .btn-new-chat:hover { background-color: var(--primary); color: white; border-color: var(--primary); transform: translateY(-1px); }

        .search-bar { position: relative; }
        .search-bar input {
            width: 100%; padding: 0.7rem 1rem 0.7rem 2.5rem; border-radius: 0.5rem;
            border: 1px solid var(--gray-light); background: var(--light); font-size: 0.9rem; outline: none; transition: all 0.2s;
        }
        .search-bar input:focus { border-color: var(--primary); background: white; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
        .search-bar i { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--gray); }

        .conversations-scroller { flex: 1; overflow-y: auto; }
        .conversation-card {
            display: flex; align-items: center; padding: 0.85rem 1.5rem; cursor: pointer;
            border-bottom: 1px solid var(--light); transition: all 0.2s; border-left: 4px solid transparent;
        }
        .conversation-card:hover { background-color: var(--light); }
        .conversation-card.active { background-color: rgba(59, 130, 246, 0.05); border-left-color: var(--primary); }

        .card-avatar { position: relative; margin-right: 1rem; }
        .card-avatar img { width: 46px; height: 46px; border-radius: 50%; object-fit: cover; border: 2px solid white; box-shadow: var(--shadow-xs); }
        .group-avatar-placeholder {
            width: 46px; height: 46px; border-radius: 50%; background: var(--gray-light); color: var(--gray);
            display: flex; align-items: center; justify-content: center; font-size: 1.2rem; border: 2px solid white;
        }

        .dot { width: 11px; height: 11px; border: 2px solid white; border-radius: 50%; position: absolute; bottom: 0; right: 0; }
        .dot.online { background: var(--secondary); }
        .dot.busy { background: var(--danger); }
        .dot.offline { background: var(--gray); }

        .card-info { flex: 1; min-width: 0; }
        .card-top { display: flex; justify-content: space-between; margin-bottom: 0.2rem; }
        .name { font-weight: 600; font-size: 0.95rem; color: var(--dark); }
        .time { font-size: 0.75rem; color: var(--gray); }
        .preview { color: var(--gray); font-size: 0.85rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin: 0; }
        .conversation-card.unread .preview { font-weight: 600; color: var(--dark); }
        .badge-count { background: var(--primary); color: white; font-size: 0.7rem; padding: 2px 6px; border-radius: 10px; float: right; }

        .chat-main-panel {
            flex: 1; display: flex; flex-direction: column; position: relative; background-color: var(--light);
            background-image: repeating-linear-gradient(45deg, var(--gray-light) 25%, transparent 25%, transparent 75%, var(--gray-light) 75%, var(--gray-light)), repeating-linear-gradient(45deg, var(--gray-light) 25%, var(--light) 25%, var(--light) 75%, var(--gray-light) 75%, var(--gray-light));
            background-position: 0 0, 10px 10px; background-size: 20px 20px;
        }
        .chat-main-panel::before { content: ''; position: absolute; top:0; left:0; right:0; bottom:0; background: rgba(255,255,255,0.8); pointer-events: none; }

        .chat-topbar {
            height: 70px; background: white; border-bottom: 1px solid var(--gray-light);
            display: flex; justify-content: space-between; align-items: center; padding: 0 1.5rem; flex-shrink: 0; position: relative; z-index: 2;
        }
        .user-details { display: flex; align-items: center; gap: 0.8rem; }
        .user-details img { width: 42px; height: 42px; border-radius: 50%; border: 2px solid var(--gray-light); }
        .user-details h4 { margin: 0; font-size: 1rem; font-weight: 700; color: var(--dark); }
        .user-details .status { font-size: 0.8rem; color: var(--secondary); display: flex; align-items: center; font-weight: 500;}

        .btn-icon { background: none; border: none; font-size: 1.1rem; color: var(--gray); cursor: pointer; width: 40px; height: 40px; border-radius: 50%; transition: 0.2s; display: flex; align-items: center; justify-content: center; }
        .btn-icon:hover { color: var(--primary); background: var(--light); }

        .messages-scroll-area { flex: 1; overflow-y: auto; padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem; position: relative; z-index: 1; }
        .msg { display: flex; align-items: flex-end; gap: 0.75rem; max-width: 75%; }
        .msg.received { align-self: flex-start; }
        .msg.sent { align-self: flex-end; flex-direction: row-reverse; }
        .msg img { width: 30px; height: 30px; border-radius: 50%; border: 1px solid var(--gray-light); }
        .bubble { padding: 0.75rem 1rem; border-radius: 1rem; font-size: 0.95rem; line-height: 1.5; box-shadow: var(--shadow-sm); }
        .received .bubble { background: white; color: var(--dark); border-bottom-left-radius: 2px; }
        .sent .bubble { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; border-bottom-right-radius: 2px; font-weight: 500; }
        .timestamp { display: block; font-size: 0.7rem; color: var(--gray); margin-top: 4px; font-weight: 500; }
        .sent .timestamp { text-align: right; color: var(--gray); }
        .seen-icon { color: var(--secondary); margin-left: 4px; } 

        .chat-input-zone { padding: 1rem 1.5rem; background: white; border-top: 1px solid var(--gray-light); display: flex; align-items: center; gap: 0.8rem; position: relative; z-index: 2; }
        .text-input-wrapper { flex: 1; position: relative; }
        .text-input-wrapper input { width: 100%; padding: 0.8rem 1rem; padding-right: 2.5rem; border: 1px solid var(--gray-light); border-radius: 2rem; background: var(--light); outline: none; transition: all 0.2s; }
        .text-input-wrapper input:focus { background: white; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
        .btn-emoji { position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--gray); cursor: pointer; font-size: 1.1rem; }
        .btn-attach, .btn-send { width: 45px; height: 45px; border-radius: 50%; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s; }
        .btn-attach { background: var(--light); color: var(--gray); font-size: 1.1rem;}
        .btn-attach:hover { background: var(--gray-light); color: var(--dark); }
        .btn-send { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; font-size: 1.1rem; box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2); }
        .btn-send:hover { transform: translateY(-2px) scale(1.05); box-shadow: 0 6px 8px rgba(59, 130, 246, 0.3); }

        .modal-backdrop {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;
            backdrop-filter: blur(2px);
        }

        .modal-window {
            background: white; width: 500px; max-width: 90%;
            border-radius: 12px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            overflow: hidden; animation: slideDown 0.3s ease-out; display: flex; flex-direction: column;
            max-height: 90vh;
        }

        @keyframes slideDown { from { transform: translateY(-20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        .modal-header {
            padding: 1.25rem; border-bottom: 1px solid var(--gray-light);
            display: flex; justify-content: space-between; align-items: center; background: #f9fafb;
        }
        .modal-header h3 { margin: 0; font-size: 1.1rem; font-weight: 700; color: var(--dark); }
        .close-btn { background: none; border: none; font-size: 1.2rem; cursor: pointer; color: var(--gray); }
        .close-btn:hover { color: var(--danger); }

        .modal-body { padding: 1.5rem; overflow-y: auto; }

        .modal-tabs {
            display: flex; gap: 1rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--gray-light);
        }
        .tab-btn {
            background: none; border: none; padding-bottom: 0.75rem; font-size: 0.95rem; font-weight: 600; color: var(--gray);
            cursor: pointer; border-bottom: 2px solid transparent; transition: 0.2s;
        }
        .tab-btn:hover { color: var(--primary); }
        .tab-btn.active { color: var(--primary); border-bottom-color: var(--primary); }

        .modal-search { position: relative; margin-bottom: 1rem; }
        .modal-search.small-margin { margin-bottom: 1rem; }
        .modal-search input {
            width: 100%; padding: 0.8rem 1rem 0.8rem 2.5rem; border: 1px solid var(--gray-light);
            border-radius: 8px; font-size: 1rem; outline: none;
        }
        .modal-search input:focus { border-color: var(--primary); }
        .modal-search i { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--gray); }

        .group-name-input { margin-bottom: 1.5rem; }
        .group-name-input label { display: block; font-size: 0.85rem; font-weight: 600; color: var(--dark); margin-bottom: 0.5rem; }
        .group-name-input input {
            width: 100%; padding: 0.8rem; border: 1px solid var(--gray-light); border-radius: 8px; font-size: 1rem; outline: none;
        }
        .group-name-input input:focus { border-color: var(--primary); }

        .users-list-suggestion, .users-list-checklist { max-height: 300px; overflow-y: auto; }
        .list-label { font-size: 0.8rem; font-weight: 600; color: var(--gray); text-transform: uppercase; margin-bottom: 0.75rem; }

        .user-suggestion-item {
            display: flex; align-items: center; padding: 0.75rem; border-radius: 8px; transition: 0.2s; cursor: pointer;
        }
        .user-suggestion-item:hover { background: #f3f4f6; }
        .user-suggestion-item img { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 1rem; }
        .user-suggestion-info { flex: 1; }
        .user-suggestion-info .name { display: block; font-weight: 600; color: var(--dark); }
        .user-suggestion-info .role { display: block; font-size: 0.8rem; color: var(--gray); }
        .btn-start {
            background: white; border: 1px solid var(--gray-light); color: var(--primary);
            width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: 0.2s;
        }
        .user-suggestion-item:hover .btn-start { background: var(--primary); color: white; border-color: var(--primary); }

        .user-check-item { display: block; margin-bottom: 0.5rem; cursor: pointer; }
        .user-check-item input[type="checkbox"] { display: none; } 
        
        .check-content {
            display: flex; align-items: center; padding: 0.75rem; border-radius: 8px; border: 1px solid transparent; transition: 0.2s;
        }
        .check-content:hover { background: #f3f4f6; }
        .user-check-item input:checked + .check-content { background: rgba(59, 130, 246, 0.05); border-color: var(--primary); }
        
        .check-content img { width: 36px; height: 36px; border-radius: 50%; object-fit: cover; margin-right: 1rem; }
        .check-content .info { flex: 1; }
        .check-content .name { display: block; font-weight: 600; font-size: 0.95rem; }
        .check-content .role { display: block; font-size: 0.8rem; color: var(--gray); }

        .checkbox-visual {
            width: 20px; height: 20px; border: 2px solid var(--gray); border-radius: 50%; position: relative; transition: 0.2s;
        }
        .user-check-item input:checked + .check-content .checkbox-visual {
            background: var(--primary); border-color: var(--primary);
        }
        .user-check-item input:checked + .check-content .checkbox-visual::after {
            content: '\f00c'; font-family: 'Font Awesome 5 Free'; font-weight: 900; color: white;
            font-size: 10px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
        }

        .btn-create-group {
            width: 100%; padding: 1rem; background: var(--primary); color: white; border: none;
            border-radius: 8px; font-weight: 600; margin-top: 1.5rem; cursor: pointer; transition: 0.2s;
        }
        .btn-create-group:hover { background: var(--primary-dark); }
    </style>
@endsection