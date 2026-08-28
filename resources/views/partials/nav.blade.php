<nav class="app-nav">
    <a href="{{ route('appointments.index') }}" class="{{ request()->routeIs('appointments.index') ? 'active' : '' }}"
        >Appointments</a>
    <a href="{{ route('appointments.create') }}" class="{{ request()->routeIs('appointments.create') ? 'active' : '' }}"
        >New Appointment</a>
</nav>

<style lang="css">
    .app-nav {
        display: flex;
        align-self: stretch;
        gap: 20px;
        padding: 15px 20px;
        border-bottom: 1px solid #ddd;
        font-family: Helvetica, serif;
    }
    .app-nav a {
        color: inherit;
        text-decoration: none;
    }
    .app-nav a:hover,
    .app-nav a.active {
        text-decoration: underline;
        font-weight: bold;
    }
</style>
