<style>
    /* Navbar Styling */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        background: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 10px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .navbar img {
        height: 50px;
    }
</style>

<nav class="navbar">
    <img src="{{ asset('image/logo.png') }}" alt="Medical Systems Logo">
</nav>