<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Tracker</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            /* Palette Modern 2024/2025 */
            --primary-color: #6366f1; /* Indigo: Modern, Trustworthy */
            --primary-hover: #4f46e5;
            --bg-body: #f3f4f6;       /* Cool Gray: Mata tidak cepat lelah */
            --text-dark: #1f2937;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            
            /* Status Colors (Soft) */
            --success-soft: #d1fae5;
            --success-text: #065f46;
            --danger-soft: #fee2e2;
            --danger-text: #991b1b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-dark);
        }

        h1, h2, h3, h4, h5, .navbar-brand {
            font-family: 'Poppins', sans-serif;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #ffffff;
            box-shadow: var(--card-shadow);
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        .navbar-brand {
            color: var(--primary-color) !important;
            font-weight: 700;
            font-size: 1.5rem;
        }
        .nav-link {
            color: #6b7280 !important;
            font-weight: 500;
            transition: color 0.3s;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--primary-color) !important;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 16px; /* Lebih bulat */
            box-shadow: var(--card-shadow);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-2px); /* Efek melayang sedikit saat di-hover */
        }

        /* Button Styling */
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 500;
        }
        .btn-primary:hover {
            background-color: var(--primary-hover);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-wallet me-2"></i>Budget<span style="color:#1f2937">Tracker</span>.
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="fas fa-bars text-secondary"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto gap-3">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Dompet</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary text-white shadow-sm" href="tambah_transaksi.php">
                        <i class="fas fa-plus me-1"></i> Transaksi
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">