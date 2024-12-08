<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahan styling untuk sidebar */
        .sidebar {
            height: 100vh;
            background-color: #f8f9fa;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            transform: translateX(-250px);
            transition: transform 0.3s ease-in-out;
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .nav-link.active {
            background-color: #0d6efd !important;
            color: white !important;
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <nav class="nav flex-column mt-4">
                <a href="#" class="nav-link" id="home">Home</a>
                <a href="#" class="nav-link" id="about">About</a>
                <a href="#" class="nav-link" id="services">Services</a>
                <a href="#" class="nav-link" id="contact">Contact</a>
            </nav>
        </div>

        <!-- Content -->
        <div class="content" style="margin-left: 250px;">
            <nav class="navbar navbar-light bg-light">
                <button class="btn btn-primary" id="toggleSidebar">☰ Toggle Sidebar</button>
            </nav>
            <div class="container mt-4">
                <h1>Main Content</h1>
                <p>Isi konten utama di sini.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script untuk toggle sidebar
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        });

        // Script untuk menambahkan class active pada link yang di-klik
        const links = document.querySelectorAll('.nav-link');
        links.forEach(link => {
            link.addEventListener('click', function () {
                links.forEach(link => link.classList.remove('active')); // Reset semua link
                this.classList.add('active'); // Tambahkan active pada link yang di-klik
            });
        });
    </script>
</body>
</html>
