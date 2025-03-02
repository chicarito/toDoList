<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container">
        <a href="#" class="navbar-brand">ToDoList</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a href="/admin" class="nav-link {{ Request::is('admin') ? 'active' : '' }}">Home</a>
                    </li>
                @endif
                @if (Auth::user()->role == 'tasker')
                    <li class="nav-item">
                        <a href="/tasker" class="nav-link {{ Request::is('tasker') ? 'active' : '' }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="/all-quest" class="nav-link {{ Request::is('all-quest') ? 'active' : '' }}">Quest</a>
                    </li>
                @endif
                @if (Auth::user()->role == 'worker')
                    <li class="nav-item">
                        <a href="/worker" class="nav-link {{ Request::is('worker') ? 'active' : '' }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="/all-task" class="nav-link {{ Request::is('all-task') ? 'active' : '' }}">My Task</a>
                    </li>
                    <li class="nav-item">
                        <a href="/quest" class="nav-link position-relative {{ Request::is('quest') ? 'active' : '' }}">
                            Quest
                            @if ($questCount > 0)
                                <span
                                    class="position-absolute top-3 start-96 translate-middle badge rounded-pill bg-danger">
                                    {{ $questCount }}
                                </span>
                            @endif
                        </a>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle"
                        data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                    <ul class="dropdown-menu">
                        <li><a href="/logout" class="dropdown-item">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
