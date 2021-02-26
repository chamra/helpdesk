<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('agent.dashboard') }}">Help Desk</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('agent.dashboard') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ticket.index') }}">Tickes</a>
            </li>
            
        </ul>
        @auth
            <div>
                <span class="navbar-text">
                    <a class="nav-link" href="{{ route('agent.logout') }}">logout</a>
                </span>
            </div>
        @endauth
    </div>
</nav>