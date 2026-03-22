<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>McDonald's Builder | Monte seu Lanche</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --mc-red: #DA291C;
            --mc-yellow: #FFC72C;
            --mc-dark: #27251F;
            --mc-light: #F8F8F8;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 20px rgba(0,0,0,0.12);
            --shadow-lg: 0 8px 40px rgba(0,0,0,0.15);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fff5f5 0%, #fff9e6 100%);
            min-height: 100vh;
            color: var(--mc-dark);
            padding-bottom: 100px;
            overflow-x: hidden;
            width: 100vw;
        }

        /* Header Styles */
        .main-header {
            background: linear-gradient(135deg, var(--mc-red) 0%, #b81f14 100%);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow-md);
        }

        .main-header .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .main-header .logo-img {
            height: 45px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
            transition: var(--transition);
        }

        .main-header .logo-img:hover {
            transform: scale(1.05);
        }

        .main-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .main-header .tagline {
            color: rgba(255,255,255,0.9);
            font-size: 0.95rem;
            margin-top: 4px;
            font-weight: 300;
        }

        /* Category Navigation */
        .category-nav {
            background: white;
            padding: 0.75rem 0;
            position: sticky;
            top: 72px;
            z-index: 999;
            box-shadow: var(--shadow-sm);
            overflow-x: auto;
            scrollbar-width: none;
        }

        .category-nav::-webkit-scrollbar { display: none; }

        .category-nav .nav-pills {
            flex-wrap: nowrap;
            padding: 0 1rem;
            gap: 8px;
        }

        .category-nav .nav-link {
            background: var(--mc-light);
            color: var(--mc-dark);
            border: 2px solid transparent;
            border-radius: 50px;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            font-size: 0.9rem;
            transition: var(--transition);
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .category-nav .nav-link:hover {
            background: #ffebee;
            border-color: var(--mc-red);
            transform: translateY(-2px);
        }

        .category-nav .nav-link.active {
            background: var(--mc-red);
            color: white;
            border-color: var(--mc-red);
            box-shadow: 0 4px 12px rgba(218, 41, 28, 0.3);
        }

        .category-nav .nav-link i {
            font-size: 1.1rem;
        }

        /* Product Cards */
        .section-title {
            font-weight: 600;
            color: var(--mc-dark);
            margin: 2rem 0 1.25rem;
            padding-left: 1rem;
            border-left: 4px solid var(--mc-yellow);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.3rem;
        }

        .product-card {
            background: white;
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            height: 100%;
            position: relative;
            max-width: 100%;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--mc-red), var(--mc-yellow));
            opacity: 0;
            transition: var(--transition);
        }

        .product-card:hover::before {
            opacity: 1;
        }

        .product-image {
            height: 140px;
            object-fit: cover;
            width: 100%;
            background: linear-gradient(135deg, #fff5e6, #ffeef5);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .product-image img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            transition: var(--transition);
            width: 100%;
            height: auto;
        }

        .product-card:hover .product-image img {
            transform: scale(1.08);
        }

        .card-body {
            padding: 1rem;
            text-align: center;
        }

        .card-title {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.25rem;
            color: var(--mc-dark);
            min-height: 44px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-price {
            color: var(--mc-red);
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0.5rem 0;
        }

        .add-btn {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--mc-red), #b81f14);
            color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(218, 41, 28, 0.3);
            margin: 0 auto;
        }

        .add-btn:hover {
            transform: scale(1.15) rotate(90deg);
            box-shadow: 0 6px 20px rgba(218, 41, 28, 0.5);
            background: linear-gradient(135deg, #b81f14, var(--mc-red));
        }

        .add-btn:active {
            transform: scale(0.95);
        }

        /* Cart Panel */
        .cart-panel {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            border-radius: 20px 20px 0 0;
            box-shadow: 0 -4px 30px rgba(0,0,0,0.15);
            padding: 1rem 1.25rem;
            z-index: 1000;
            transform: translateY(0);
            transition: var(--transition);
            max-width: 100vw;
            margin: 0 auto;
        }

        .cart-panel.collapsed {
            transform: translateY(calc(100% - 70px));
        }

        .cart-toggle {
            position: absolute;
            top: -14px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--mc-yellow);
            border: none;
            width: 40px;
            height: 28px;
            border-radius: 14px 14px 0 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--mc-dark);
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
            transition: var(--transition);
        }

        .cart-toggle:hover {
            background: #ffc107;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #eee;
            margin-bottom: 0.75rem;
        }

        .cart-title {
            font-weight: 600;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .cart-items {
            max-height: 150px;
            overflow-y: auto;
            margin-bottom: 0.75rem;
            scrollbar-width: thin;
        }

        .cart-items::-webkit-scrollbar {
            width: 4px;
        }

        .cart-items::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 2px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.4rem 0;
            font-size: 0.9rem;
            border-bottom: 1px dashed #f0f0f0;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item-name {
            display: flex;
            align-items: center;
            gap: 6px;
            flex: 1;
        }

        .cart-item-qtd {
            background: var(--mc-light);
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .cart-item-price {
            font-weight: 600;
            color: var(--mc-red);
            margin-left: 8px;
        }

        .remove-btn {
            background: #ffebee;
            color: var(--mc-red);
            border: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
            margin-left: 8px;
        }

        .remove-btn:hover {
            background: var(--mc-red);
            color: white;
            transform: scale(1.1);
        }

        .cart-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .cart-total {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--mc-dark);
        }

        .cart-total span {
            color: var(--mc-red);
            font-size: 1.5rem;
        }

        .btn-checkout {
            background: linear-gradient(135deg, var(--mc-red), #b81f14);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(218, 41, 28, 0.4);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(218, 41, 28, 0.6);
            color: white;
        }

        .btn-clear {
            background: var(--mc-light);
            color: #666;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.85rem;
            transition: var(--transition);
        }

        .btn-clear:hover {
            background: #ffebee;
            color: var(--mc-red);
        }

        /* Empty State */
        .empty-cart {
            text-align: center;
            padding: 1.5rem 0;
            color: #999;
            font-size: 0.95rem;
        }

        .empty-cart i {
            font-size: 2.5rem;
            opacity: 0.5;
            margin-bottom: 0.5rem;
            display: block;
        }

        /* Toast Customization */
        .toast {
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            border: none;
        }

        .toast.bg-success {
            background: linear-gradient(135deg, #28a745, #20c997) !important;
        }

        .toast.bg-danger {
            background: linear-gradient(135deg, var(--mc-red), #ff6b6b) !important;
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: var(--shadow-lg);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--mc-red), #b81f14);
            color: white;
            border-radius: 20px 20px 0 0;
            border: none;
            padding: 1.25rem 1.5rem;
        }

        .modal-title {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .order-summary {
            background: var(--mc-light);
            border-radius: 12px;
            padding: 1rem;
            margin: 1rem 0;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 0.4rem 0;
            border-bottom: 1px dashed #ddd;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-total {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--mc-red);
            text-align: right;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 2px solid var(--mc-yellow);
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            padding: 0.75rem 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--mc-red);
            box-shadow: 0 0 0 4px rgba(218, 41, 28, 0.1);
        }

        .form-label {
            font-weight: 500;
            color: var(--mc-dark);
        }

        /* Animations */
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-slide {
            animation: slideUp 0.4s ease-out;
        }

        .pulse {
            animation: pulse 0.3s ease-in-out;
        }

        /* Category Colors */
        .category-pao .add-btn { background: linear-gradient(135deg, #f5a623, #d48806); }
        .category-recheio .add-btn { background: linear-gradient(135deg, var(--mc-red), #b81f14); }
        .category-complemento .add-btn { background: linear-gradient(135deg, #28a745, #20c997); }
        .category-bebida .add-btn { background: linear-gradient(135deg, #007bff, #0056b3); }

        .category-pao .add-btn:hover { box-shadow: 0 6px 20px rgba(245, 166, 35, 0.5); }
        .category-recheio .add-btn:hover { box-shadow: 0 6px 20px rgba(218, 41, 28, 0.5); }
        .category-complemento .add-btn:hover { box-shadow: 0 6px 20px rgba(40, 167, 69, 0.5); }
        .category-bebida .add-btn:hover { box-shadow: 0 6px 20px rgba(0, 123, 255, 0.5); }

        /* == RESPONSIVIDADE AVANÇADA == */
        @media (max-width: 576px) {
            body { padding-bottom: 160px; font-size: 0.95rem; }
            .main-header { padding: 0.75rem 0; top: 0; }
            .main-header h1 { font-size: 1.2rem; }
            .main-header .tagline { font-size: 0.85rem; margin-top: 2px; }
            .main-header .logo-img { height: 38px; }
            .category-nav { top: 58px; padding: 0.5rem 0; }
            .category-nav .nav-link { padding: 0.4rem 1rem; font-size: 0.85rem; min-width: max-content; }
            .category-nav .nav-link i { font-size: 1rem; }
            .section-title { font-size: 1.1rem; margin: 1.5rem 0 1rem; padding-left: 0.75rem; }
            .product-card { border-radius: 12px; }
            .product-image { height: 110px; }
            .card-title { font-size: 0.9rem; min-height: 38px; }
            .card-price { font-size: 1rem; margin: 0.25rem 0; }
            .add-btn { width: 40px; height: 40px; font-size: 1rem; }
            .cart-panel { border-radius: 16px 16px 0 0; padding: 0.75rem 1rem; }
            .cart-panel.collapsed { transform: translateY(calc(100% - 56px)); }
            .cart-toggle { width: 36px; height: 24px; top: -12px; font-size: 1rem; }
            .cart-header { padding-bottom: 0.5rem; margin-bottom: 0.5rem; }
            .cart-title { font-size: 1rem; }
            .cart-items { max-height: 120px; margin-bottom: 0.5rem; }
            .cart-item { font-size: 0.85rem; padding: 0.3rem 0; }
            .cart-footer { flex-direction: column; gap: 8px; align-items: stretch; }
            .cart-total { font-size: 1.1rem; text-align: center; }
            .cart-total span { font-size: 1.3rem; }
            .btn-checkout { width: 100%; justify-content: center; padding: 0.6rem 1rem; font-size: 0.95rem; }
            .btn-clear { padding: 0.35rem 0.75rem; font-size: 0.8rem; }
            .modal-content { margin: 0.5rem; border-radius: 16px; }
            .modal-header { padding: 1rem 1.25rem; border-radius: 16px 16px 0 0; }
            .modal-title { font-size: 1.1rem; }
            .modal-body { padding: 1.25rem; }
            .order-summary { padding: 0.75rem; }
            .order-total { font-size: 1.2rem; }
            .form-control { padding: 0.6rem 0.85rem; font-size: 0.95rem; }
            .position-fixed.top-0.end-0 { right: 8px !important; left: 8px !important; width: auto; }
            .toast { width: 100%; max-width: none; }
        }

        @media (min-width: 577px) and (max-width: 991px) {
            body { padding-bottom: 130px; }
            .product-image { height: 130px; }
            .card-title { font-size: 0.95rem; }
            .cart-panel { padding: 0.875rem 1.25rem; }
            .cart-items { max-height: 140px; }
        }

        @media (min-width: 992px) {
            .container { max-width: 1200px; }
            .product-card:hover { transform: translateY(-8px); }
        }

        @media (max-width: 360px) {
            .col-6 { flex: 0 0 100%; max-width: 100%; }
            .product-image { height: 100px; }
            .card-title { font-size: 0.85rem; min-height: 34px; }
            .card-price { font-size: 0.95rem; }
            .add-btn { width: 36px; height: 36px; font-size: 0.9rem; }
        }

        @media (hover: none) and (pointer: coarse) {
            .add-btn, .remove-btn, .btn-checkout, .nav-link, .cart-toggle {
                min-height: 44px; min-width: 44px; display: flex; align-items: center; justify-content: center;
            }
            .add-btn { width: 48px !important; height: 48px !important; }
        }

        input, select, textarea { font-size: 16px !important; }

        .nav-link:focus-visible, .add-btn:focus-visible, .btn-checkout:focus-visible {
            outline: 3px solid var(--mc-yellow); outline-offset: 2px;
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important; animation-iteration-count: 1 !important; transition-duration: 0.01ms !important;
            }
            .product-card:hover { transform: none !important; }
        }
    </style>
</head>
<body>