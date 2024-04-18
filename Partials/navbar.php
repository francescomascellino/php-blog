<nav class='navbar navbar-expand-lg bg-body-tertiary'>
    <div class='container-fluid'>
        <span class='navbar-brand'>PHP My Blog</span>

        <?php if (isset($_SESSION['user_id'])) : ?>

            <span class="fw-bold"> Welcome,
                <?php
                echo $_SESSION['user_name'] . ' (ID: ' . $_SESSION['user_id'] . ')';
                ?>
            </span>

        <?php endif; ?>

        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNavAltMarkup' aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse justify-content-end' id='navbarNavAltMarkup'>
            <div class='navbar-nav'>

                <a class='nav-link active me-auto' aria-current='page' href='/'>Home</a>

                <?php if (!isset($_SESSION['user_id'])) : ?>

                    <a class='nav-link active' href='../authentication.php'>Login</a>

                <?php else : ?>

                    <form method="POST" action="logout.php">
                        <a href="logout.php" class="nav-link active" role="button">Logout</a>
                    </form>

                <?php endif; ?>

                <a class='nav-link active' href='#'>Dashboard</a>

            </div>
        </div>
    </div>
</nav>