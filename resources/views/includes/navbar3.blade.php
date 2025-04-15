<style>
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 10px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 1000;
        min-height: 70px;
    }

    .navbar img {
        height: 50px;
        object-fit: contain;
    }

    .navbar h2 {
        font-size: 1.6rem;
        color: #197BBF;
        font-weight: bold;
        margin: 0;
        text-align: center;
        flex-grow: 1;
    }

    .navbar form {
        margin: 0;
    }

    .btn-logout {
        background: #e74c3c;
        color: white;
        font-size: 0.95rem;
        padding: 8px 18px;
        border-radius: 25px;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.2);
    }

    .btn-logout:hover {
        background-color: #c0392b;
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    @media (max-width: 768px) {
        .navbar {
            flex-direction: column;
            align-items: center;
            padding: 10px 20px;
        }

        .navbar h2 {
            font-size: 1.4rem;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .btn-logout {
            margin-top: 10px;
        }
    }
</style>

<nav class="navbar">
    <img src="{{ asset('image/logo.png') }}" alt="Medical Systems Logo">
    
    <h2><i class="fas fa-cogs"></i> Ingénieur Section</h2>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn-logout">
            <i class="fas fa-sign-out-alt"></i> Déconnexion
        </button>
    </form>
</nav>
