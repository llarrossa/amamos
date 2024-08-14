<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="lni lni-menu"></i>
        </button>
        <div class="sidebar-logo">

        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="/quem-somos" class="sidebar-link">
                <i class="lni lni-question-circle" title="Quem somos"></i>
                <span>Quem somos</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="/atualidades" class="sidebar-link">
                <i class="lni lni-hourglass" title="Atualidades"></i>
                <span>Atualidades</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#search" aria-expanded="false" aria-controls="search">
                <i class="lni lni-search"></i>
                <span>Busca</span>
            </a>
            <ul id="search" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href='/buscar/nome' class="sidebar-link">Nome</a>
                </li>
                <li class="sidebar-item">
                    <a href='/buscar/categoria' class="sidebar-link">Categoria</a>
                </li>
                <li class="sidebar-item">
                    <a href='/buscar/risco' class="sidebar-link">Risco</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="lni lni-quotation" title="Referências"></i>
                <span>Referências</span>
            </a>
        </li>
        @auth
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                   data-bs-target="#cadastrar" aria-expanded="false" aria-controls="search">
                    <i class="lni lni-circle-plus" title="Cadastrar medicamento"></i>
                    <span>Cadastrar</span>
                </a>
                <ul id="cadastrar" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{ route('categoria.index') }}" class="sidebar-link">Categoria</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('medicamento.index') }}" class="sidebar-link">Medicamento</a>
                    </li>
                </ul>
            </li>
    </ul>
    <div class="sidebar-footer">
        <a href="{{ route('logout') }}" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
        </a>
    </div>
    @endauth
</aside>
