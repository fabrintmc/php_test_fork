<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Currículo - Sistema Web</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            flex: 1;
        }
        
        /* Header */
        .header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px 0;
            margin-bottom: 40px;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .time {
            font-size: 16px;
            color: #666;
        }
        
        /* Title Section */
        .title-section {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .main-title {
            font-size: 36px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 16px;
        }
        
        .subtitle {
            font-size: 18px;
            color: #7f8c8d;
            margin-bottom: 32px;
        }
        
        /* Search Bar */
        .search-container {
            max-width: 600px;
            margin: 0 auto 48px auto;
            position: relative;
        }
        
        .search-field {
            width: 100%;
            padding: 16px 24px 16px 60px;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            font-size: 16px;
            background: white;
            transition: all 0.3s ease;
        }
        
        .search-field:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        
        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #95a5a6;
            font-size: 18px;
        }
        
        /* Tiles Grid */
        .tiles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
            margin-bottom: 48px;
        }
        
        .tile {
            background: white;
            border-radius: 16px;
            padding: 32px 24px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }
        
        .tile:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            border-color: #3498db;
        }
        
        .tile.primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
        }
        
        .tile.primary:hover {
            border-color: #2980b9;
        }
        
        .tile-icon {
            width: 60px;
            height: 60px;
            background: #f8f9fa;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px auto;
            font-size: 24px;
            color: #3498db;
        }
        
        .tile.primary .tile-icon {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        
        .tile-label {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .tile.primary .tile-label {
            color: white;
        }
        
        /* Features Section */
        .features-section {
            background: white;
            border-radius: 16px;
            padding: 40px;
            margin-bottom: 48px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .features-title {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 32px;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }
        
        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }
        
        .feature-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #27ae60, #219a52);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            flex-shrink: 0;
        }
        
        .feature-content h4 {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 4px;
        }
        
        .feature-content p {
            font-size: 14px;
            color: #7f8c8d;
            line-height: 1.5;
        }
        
        /* Bottom Navigation */
        .bottom-nav {
            background: white;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
            padding: 16px 0;
            margin-top: auto;
        }
        
        .nav-tabs {
            display: flex;
            justify-content: center;
            gap: 48px;
        }
        
        .nav-tab {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #95a5a6;
            transition: color 0.3s ease;
        }
        
        .nav-tab.active {
            color: #3498db;
        }
        
        .nav-tab:hover {
            color: #3498db;
            text-decoration: none;
        }
        
        .nav-icon {
            font-size: 24px;
            margin-bottom: 4px;
        }
        
        .nav-label {
            font-size: 12px;
            font-weight: 500;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .tiles-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .nav-tabs {
                gap: 24px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-file-alt"></i> Gerador de Currículo
                </div>
                <div class="time" id="current-time">12:30</div>
            </div>
        </div>
    </header>

    <div class="container">
        <!-- Title Section -->
        <div class="title-section">
            <h1 class="main-title">Crie seu Currículo Profissional</h1>
            <p class="subtitle">Ferramenta completa para criação de currículos com design moderno e funcionalidades avançadas</p>
        </div>

        <!-- Search Bar -->
        <div class="search-container">
            <div class="search-icon">
                <i class="fas fa-search"></i>
            </div>
            <input type="text" class="search-field" placeholder="Buscar modelos ou habilidades">
        </div>

        <!-- Main Tiles -->
        <div class="tiles-grid">
            <div class="tile primary" onclick="location.href='curriculo.php'">
                <div class="tile-icon">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="tile-label">Criar CV</div>
            </div>
            
            <div class="tile" onclick="alert('Funcionalidade em desenvolvimento')">
                <div class="tile-icon">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="tile-label">Editar CV</div>
            </div>
            
            <div class="tile" onclick="alert('Funcionalidade em desenvolvimento')">
                <div class="tile-icon">
                    <i class="fas fa-th-large"></i>
                </div>
                <div class="tile-label">Modelos</div>
            </div>
            
            <div class="tile" onclick="alert('Funcionalidade em desenvolvimento')">
                <div class="tile-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <div class="tile-label">Dicas</div>
            </div>
            
            <div class="tile" onclick="alert('Funcionalidade em desenvolvimento')">
                <div class="tile-icon">
                    <i class="fas fa-share-alt"></i>
                </div>
                <div class="tile-label">Compartilhar</div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="features-section">
            <h2 class="features-title">✨ Funcionalidades Principais</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Cálculo Automático de Idade</h4>
                        <p>JavaScript calcula automaticamente a partir da data de nascimento</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Campos Dinâmicos</h4>
                        <p>Adicione experiências e referências conforme necessário</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Interface Responsiva</h4>
                        <p>Funciona perfeitamente em desktop e dispositivos móveis</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Download em PDF</h4>
                        <p>Baixe seu currículo formatado com um clique</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Processamento Seguro</h4>
                        <p>Dados seguros e formatação profissional em PHP</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Design Moderno</h4>
                        <p>Layout profissional e atrativo para impressionar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation -->
    <nav class="bottom-nav">
        <div class="nav-tabs">
            <a href="#" class="nav-tab active">
                <div class="nav-icon"><i class="fas fa-home"></i></div>
                <div class="nav-label">Início</div>
            </a>
            <a href="#" class="nav-tab">
                <div class="nav-icon"><i class="fas fa-th-large"></i></div>
                <div class="nav-label">Modelos</div>
            </a>
            <a href="#" class="nav-tab">
                <div class="nav-icon"><i class="fas fa-folder"></i></div>
                <div class="nav-label">Projetos</div>
            </a>
            <a href="#" class="nav-tab">
                <div class="nav-icon"><i class="fas fa-user"></i></div>
                <div class="nav-label">Perfil</div>
            </a>
        </div>
    </nav>

    <script>
        // Update current time
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('pt-BR', { 
                hour: '2-digit', 
                minute: '2-digit',
                hour12: false 
            });
            document.getElementById('current-time').textContent = timeString;
        }

        // Update time every minute
        updateTime();
        setInterval(updateTime, 60000);

        // Search functionality
        document.querySelector('.search-field').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            // Here you can implement search functionality
            console.log('Searching for:', searchTerm);
        });
    </script>
</body>
</html>