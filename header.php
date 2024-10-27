<head>
        <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #393053;
   
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
        }
 
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #6E62A4;
            user-select: none;
        }
        .menu-toggle {
            display: none;
            color: #6E62A4;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }
        nav ul {
            display: flex;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        nav li {
            margin-left: 0.5rem;
        }
        nav a {
            display: block;
            padding: 0.5rem 1rem;
            color: #6E62A4;
            text-decoration: none;
            background-color: rgba(110, 98, 164, 0.2);
            border-radius: 0.375rem;
        }
        .dropdown {
            position: relative;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background: linear-gradient(to top, #393053, #443C68);
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 0.375rem;
        }
        .dropdown-content a {
            color: #6E62A4;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
            nav {
                display: none;
            }
            nav.active {
                display: block;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: #393053;
            }
            nav ul {
                flex-direction: column;
            }
            nav li {
                margin: 0;
            }
            nav a {
                padding: 1rem;
            }
            .dropdown-content {
                position: static;
                background: none;
                box-shadow: none;
            }
        }
    </style>

    
</head>

<header class="fixed top-0 left-0 right-0  z-10">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <span class="text-primary text-2xl font-bold cursor-pointer" ondblclick="window.location.href='?page=login'">&lt;/&gt;evandro</span>
            <button class="lg:hidden text-primary text-2xl" id="menu-toggle">☰</button>
            <nav class="hidden lg:block" id="nav">
                <ul class="flex space-x-6">
                    <li><a href="?page=home" class="text-primary hover:text-white">HOME</a></li>
                    <li><a href="?page=downloads" class="text-primary hover:text-white">DOWNLOADS</a></li>
                    <li><a href="?page=enviar-arquivos" class="text-primary hover:text-white">ENVIAR ARQUIVOS</a></li>
                    <li class="relative">
                        <a href="#" class="text-primary hover:text-white" onclick="toggleDropdown('segundo-dropdown'); return false;">SEGUNDO ▼</a>
                        <div id="segundo-dropdown" class="absolute left-0 mt-2 w-48 bg-secondary rounded-md shadow-lg hidden">
                            <a href="?page=class-page&year=segundo&class=2-51" class="block px-4 py-2 text-sm text-primary hover:bg-accent">2-51</a>
                            <a href="?page=class-page&year=segundo&class=2-52" class="block px-4 py-2 text-sm text-primary hover:bg-accent">2-52</a>
                            <a href="?page=class-page&year=segundo&class=2-53" class="block px-4 py-2 text-sm text-primary hover:bg-accent">2-53</a>
                            <a href="?page=class-page&year=segundo&class=2-54" class="block px-4 py-2 text-sm text-primary hover:bg-accent">2-54</a>
                        </div>
                    </li>
                    <li class="relative">
                        <a href="#" class="text-primary hover:text-white" onclick="toggleDropdown('terceirao-dropdown'); return false;">TERCEIRAO ▼</a>
                        <div id="terceirao-dropdown" class="absolute left-0 mt-2 w-48 bg-secondary rounded-md shadow-lg hidden">
                            <a href="?page=class-page&year=terceirao&class=3-51" class="block px-4 py-2 text-sm text-primary hover:bg-accent">3-51</a>
                            <a href="?page=class-page&year=terceirao&class=3-52" class="block px-4 py-2 text-sm text-primary hover:bg-accent">3-52</a>
                            <a href="?page=class-page&year=terceirao&class=3-53" class="block px-4 py-2 text-sm text-primary hover:bg-accent">3-53</a>
                            <a href="?page=class-page&year=terceirao&class=3-54" class="block px-4 py-2 text-sm text-primary hover:bg-accent">3-54</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <script src="js/scripts.js"></script>
</header>
