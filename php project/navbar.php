<nav class="navbar">
    <div class="logo">Mtgrkm</div>
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    <ul class="nav-links">
        <li><a href="/index.php">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#">Services</a></li>
        <li id="login" class="auth">
            <a href="/Auth/login.php" class="login-btn" id="login-btn" style="color: white;">Login</a>
        </li>
        <li id="user-welcome" class="auth" style="display: none;">
            <a style=" text-decoration: none;" href="#" id="welcome-message"></a>
        </li>
    </ul>
</nav>

<script>
    const username = localStorage.getItem('username');
    const isAdmin = localStorage.getItem('is_admin');

    function updateNavbar() {
        const loginButton = document.getElementById('login');
        const userWelcome = document.getElementById('user-welcome');
        const welcomeMessage = document.getElementById('welcome-message');

        if (username) {
            userWelcome.style.display = 'block';
            welcomeMessage.textContent = `Welcome, ${username}!`;
            loginButton.style.display = 'none';

            welcomeMessage.onclick = function() {

    setTimeout(function() {
        if (isAdmin == '1') {
            window.location.replace('/admin.php');
        } else {
            window.location.replace('/customer.php');
        }
    }, 100);
};


        } else {
            userWelcome.style.display = 'none';
            loginButton.style.display = 'block';
        }
    }

    updateNavbar();

    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        navLinks.classList.toggle('active');
        const menuToggle = document.querySelector('.menu-toggle');
        menuToggle.textContent = navLinks.classList.contains('active') ? '✖' : '☰';
    }
</script>
