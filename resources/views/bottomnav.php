<style>
    .bottom-nav {
        position: fixed;
        bottom: 18px;
        left: 50%;
        transform: translateX(-50%);
        width: min(475px, calc(100% - 32px));
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 8px 14px;
        background: rgba(255,255,255,.95);
        backdrop-filter: blur(8px);
        border: 1.5px solid #cfdccf;
        border-radius: 40px;
        box-shadow: 0 12px 35px rgba(30,50,38,.12);
        z-index: 50;
    }

    .bottom-nav a {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 3px;
        color: #8fa596;
        font-size: 12px;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 20px;
        transition: .2s;
        text-decoration: none;
    }

    .bottom-nav a svg {
        width: 24px;
        height: 24px;
    }

    .bottom-nav a:hover {
        color: #315c46;
    }

    .bottom-nav a.active {
        color: #315c46;
        background: #edf3ed;
    }
</style>

<nav class="bottom-nav" aria-label="Navigasi bawah">

    <a href="{{ url('/') }}"
        class="{{ request()->is('/') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1z"/>
            </svg>
            Home
    </a>

    <a href="{{ url('/masjid-terdekat') }}"
       class="{{ request()->is('masjid-terdekat') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
            <path d="m9 4-6 2v14l6-2 6 2 6-2V4l-6 2z"/>
            <path d="M9 4v14M15 6v14"/>
        </svg>
        Masjid
    </a>

    <a href="{{ url('/komunitas') }}"
       class="{{ request()->is('komunitas*') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
            <circle cx="9" cy="8" r="3.5"/>
            <path d="M2 20c0-3.5 3-6 7-6s7 2.5 7 6"/>
            <circle cx="17" cy="9" r="2.5"/>
            <path d="M17 14c2.8 0 5 1.8 5 4.5"/>
        </svg>
        Komunitas
    </a>

    <a href="{{ url('/profil') }}"
       class="{{ request()->is('profil*') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <circle cx="12" cy="10" r="3.5"/>
            <path d="M5.5 19c1.5-3 4-4 6.5-4s5 1 6.5 4"/>
        </svg>
        Profil
    </a>

</nav>
