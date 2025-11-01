<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Currículo - Gerador de Currículo</title>
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
            max-width: 800px;
            margin: 0 auto;
            padding: 0 24px;
            flex: 1;
        }
        
        /* System Header */
        .system-header {
            background: white;
            padding: 16px 24px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .back-button {
            background: none;
            border: none;
            font-size: 18px;
            color: #666;
            cursor: pointer;
            padding: 8px;
        }
        
        .time-display {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }
        
        .status-icons {
            font-size: 16px;
            color: #666;
        }
        
        /* Main Content */
        .main-content {
            padding: 24px 0;
        }
        
        /* Title Section */
        .title-section {
            text-align: center;
            margin-bottom: 32px;
        }
        
        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }
        
        .page-subtitle {
            font-size: 16px;
            color: #7f8c8d;
        }
        
        /* Form Sections */
        .form-section {
            background: white;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 8px;
            border-bottom: 2px solid #f1f3f4;
        }
        
        /* Input Fields */
        .input-field-regular, .input-field-long, .input-field-phone {
            margin-bottom: 16px;
        }
        
        .input-field-regular input,
        .input-field-long textarea,
        .input-field-phone input,
        select {
            width: 100%;
            padding: 16px;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            font-size: 16px;
            background: white;
            transition: all 0.3s ease;
            font-family: inherit;
        }
        
        .input-field-regular input:focus,
        .input-field-long textarea:focus,
        .input-field-phone input:focus,
        select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        
        .input-field-long textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        /* Phone Field */
        .phone-container {
            display: flex;
            gap: 12px;
        }
        
        .country-code {
            background: #f8f9fa;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            padding: 16px;
            font-size: 16px;
            color: #666;
            min-width: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .phone-input {
            flex: 1;
        }
        
        /* Grid Layout */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        
        .form-grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
        }
        
        /* Age Display */
        .age-display {
            color: #3498db;
            font-weight: 600;
            margin-top: 8px;
            font-size: 14px;
        }
        
        /* Dynamic Fields */
        .dynamic-field {
            background: #f8f9fa;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            position: relative;
        }
        
        .remove-button {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #e74c3c;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }
        
        .add-button {
            background: #27ae60;
            border: none;
            border-radius: 12px;
            color: white;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            margin-top: 16px;
        }
        
        .add-button:hover {
            background: #219a52;
            transform: translateY(-1px);
        }
        
        /* Primary Button */
        .button-primary {
            position: fixed;
            bottom: 100px;
            right: 24px;
            z-index: 50;
        }
        
        .primitive-button {
            background: linear-gradient(135deg, #3498db, #2980b9);
            border: none;
            border-radius: 12px;
            padding: 16px 24px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
            transition: all 0.3s ease;
        }
        
        .primitive-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(52, 152, 219, 0.4);
        }
        
        /* Bottom Navigation */
        .navigation-bottom {
            background: white;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
            padding: 16px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
        }
        
        .tab-bar-buttons {
            display: flex;
            justify-content: center;
            gap: 48px;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .tab {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #95a5a6;
            transition: color 0.3s ease;
        }
        
        .tab.active {
            color: #3498db;
        }
        
        .icon, .icon-2 {
            font-size: 24px;
            margin-bottom: 4px;
        }
        
        .label-2, .label-3, .label-4 {
            font-size: 12px;
            font-weight: 500;
        }
        
        /* Form Labels */
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .form-grid-3 {
                grid-template-columns: 1fr;
            }
            
            .phone-container {
                flex-direction: column;
            }
            
            .tab-bar-buttons {
                gap: 24px;
            }
        }
        
        /* Spacing */
        .spacing-medium {
            height: 24px;
        }
        
        .spacing-large {
            height: 32px;
        }
        
        /* Bottom padding for fixed navigation */
        .main-content {
            padding-bottom: 120px;
        }
    </style>
</head>
<body>
    <!-- System Header -->
    <div class="system-header">
        <div class="header-content">
            <button class="back-button" onclick="history.back()">
                <i class="fas fa-arrow-left"></i>
            </button>
            <div class="time-display" id="current-time">12:30</div>
            <div class="status-icons">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="main-content">
            <!-- Title Section -->
            <div class="title-section">
                <h1 class="page-title">Criar Currículo</h1>
                <p class="page-subtitle">Preencha os dados para gerar seu currículo profissional</p>
            </div>

            <form id="curriculoForm" method="POST" action="processar_curriculo.php">
                
                <!-- Dados Pessoais -->
                <div class="form-section">
                    <h2 class="section-title">👤 Dados Pessoais</h2>
                    
                    <div class="input-field-regular">
                        <label class="form-label">Nome Completo *</label>
                        <input type="text" id="nome_completo" name="nome_completo" placeholder="Digite seu nome completo" required>
                    </div>
                    
                    <div class="input-field-regular">
                        <label class="form-label">E-mail *</label>
                        <input type="email" id="email" name="email" placeholder="seu.email@exemplo.com" required>
                    </div>
                    
                    <div class="input-field-phone">
                        <label class="form-label">Telefone *</label>
                        <div class="phone-container">
                            <div class="country-code">+55</div>
                            <div class="phone-input">
                                <input type="tel" id="telefone" name="telefone" placeholder="(11) 99999-9999" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-grid">
                        <div class="input-field-regular">
                            <label class="form-label">Data de Nascimento *</label>
                            <input type="date" id="data_nascimento" name="data_nascimento" required>
                            <div id="idade_display" class="age-display"></div>
                        </div>
                        <div class="input-field-regular">
                            <label class="form-label">Estado Civil</label>
                            <select id="estado_civil" name="estado_civil">
                                <option value="">Selecione</option>
                                <option value="solteiro">Solteiro(a)</option>
                                <option value="casado">Casado(a)</option>
                                <option value="divorciado">Divorciado(a)</option>
                                <option value="viuvo">Viúvo(a)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-grid">
                        <div class="input-field-regular">
                            <label class="form-label">Endereço</label>
                            <input type="text" id="endereco" name="endereco" placeholder="Rua, número, bairro">
                        </div>
                        <div class="input-field-regular">
                            <label class="form-label">Cidade</label>
                            <input type="text" id="cidade" name="cidade" placeholder="Sua cidade">
                        </div>
                    </div>
                </div>

                <!-- Objetivo Profissional -->
                <div class="form-section">
                    <h2 class="section-title">🎯 Objetivo Profissional</h2>
                    <div class="input-field-long">
                        <label class="form-label">Descreva seu objetivo profissional</label>
                        <textarea id="objetivo" name="objetivo" placeholder="Descreva suas metas e objetivos profissionais..."></textarea>
                    </div>
                </div>
                
                <!-- Formação Acadêmica -->
                <div class="form-section">
                    <h2 class="section-title">🎓 Formação Acadêmica</h2>
                    
                    <div id="formacao_container">
                        <div class="dynamic-field">
                            <div class="form-grid">
                                <div class="input-field-regular">
                                    <label class="form-label">Curso</label>
                                    <input type="text" name="formacao_curso[]" placeholder="Ex: Análise e Desenvolvimento de Sistemas">
                                </div>
                                <div class="input-field-regular">
                                    <label class="form-label">Instituição</label>
                                    <input type="text" name="formacao_instituicao[]" placeholder="Ex: Universidade XYZ">
                                </div>
                            </div>
                            <div class="form-grid-3">
                                <div class="input-field-regular">
                                    <label class="form-label">Ano Início</label>
                                    <input type="number" name="formacao_ano_inicio[]" min="1950" max="2030">
                                </div>
                                <div class="input-field-regular">
                                    <label class="form-label">Ano Fim</label>
                                    <input type="number" name="formacao_ano_fim[]" min="1950" max="2030">
                                </div>
                                <div class="input-field-regular">
                                    <label class="form-label">Status</label>
                                    <select name="formacao_status[]">
                                        <option value="concluido">Concluído</option>
                                        <option value="cursando">Cursando</option>
                                        <option value="incompleto">Incompleto</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" class="add-button" onclick="adicionarFormacao()">
                        <i class="fas fa-plus"></i> Adicionar Formação
                    </button>
                </div>
                
                <!-- Experiência Profissional -->
                <div class="form-section">
                    <h2 class="section-title">💼 Experiência Profissional</h2>
                    
                    <div id="experiencia_container">
                        <div class="dynamic-field">
                            <div class="form-grid">
                                <div class="input-field-regular">
                                    <label class="form-label">Cargo</label>
                                    <input type="text" name="experiencia_cargo[]" placeholder="Ex: Desenvolvedor Web">
                                </div>
                                <div class="input-field-regular">
                                    <label class="form-label">Empresa</label>
                                    <input type="text" name="experiencia_empresa[]" placeholder="Ex: Tech Solutions Ltda">
                                </div>
                            </div>
                            <div class="form-grid-3">
                                <div class="input-field-regular">
                                    <label class="form-label">Data Início</label>
                                    <input type="month" name="experiencia_inicio[]">
                                </div>
                                <div class="input-field-regular">
                                    <label class="form-label">Data Fim</label>
                                    <input type="month" name="experiencia_fim[]">
                                </div>
                                <div class="input-field-regular" style="display: flex; align-items: end;">
                                    <label style="display: flex; align-items: center; gap: 8px; padding: 16px 0;">
                                        <input type="checkbox" name="experiencia_atual[]" value="1">
                                        Trabalho atual
                                    </label>
                                </div>
                            </div>
                            <div class="input-field-long">
                                <label class="form-label">Descreva suas experiências</label>
                                <textarea name="experiencia_descricao[]" placeholder="Descreva suas principais atividades e responsabilidades..."></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" class="add-button" onclick="adicionarExperiencia()">
                        <i class="fas fa-plus"></i> Adicionar Experiência
                    </button>
                </div>
                
                <!-- Habilidades -->
                <div class="form-section">
                    <h2 class="section-title">⚡ Habilidades e Competências</h2>
                    
                    <div class="input-field-long">
                        <label class="form-label">Descreva suas habilidades</label>
                        <textarea id="habilidades_tecnicas" name="habilidades_tecnicas" placeholder="Ex: PHP, JavaScript, HTML, CSS, MySQL..."></textarea>
                    </div>
                    
                    <div class="input-field-long">
                        <label class="form-label">Habilidades Pessoais</label>
                        <textarea id="habilidades_pessoais" name="habilidades_pessoais" placeholder="Ex: Trabalho em equipe, Liderança, Comunicação..."></textarea>
                    </div>
                    
                    <div class="input-field-long">
                        <label class="form-label">Idiomas</label>
                        <textarea id="idiomas" name="idiomas" placeholder="Ex: Inglês (Avançado), Espanhol (Intermediário)..."></textarea>
                    </div>
                </div>
                
                <!-- Referências -->
                <div class="form-section">
                    <h2 class="section-title">👥 Referências Pessoais</h2>
                    
                    <div id="referencias_container">
                        <div class="dynamic-field">
                            <div class="form-grid">
                                <div class="input-field-regular">
                                    <label class="form-label">Nome Completo</label>
                                    <input type="text" name="referencia_nome[]" placeholder="Ex: João Silva">
                                </div>
                                <div class="input-field-regular">
                                    <label class="form-label">Cargo/Relação</label>
                                    <input type="text" name="referencia_cargo[]" placeholder="Ex: Gerente de TI / Ex-supervisor">
                                </div>
                            </div>
                            <div class="form-grid">
                                <div class="input-field-regular">
                                    <label class="form-label">Telefone</label>
                                    <input type="tel" name="referencia_telefone[]" placeholder="(11) 99999-9999">
                                </div>
                                <div class="input-field-regular">
                                    <label class="form-label">E-mail</label>
                                    <input type="email" name="referencia_email[]" placeholder="joao@empresa.com">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" class="add-button" onclick="adicionarReferencia()">
                        <i class="fas fa-plus"></i> Adicionar Referência
                    </button>
                </div>

                <!-- Submit Button -->
                <div class="button-primary">
                    <button type="submit" class="primitive-button">
                        <div class="label">Gerar Currículo</div>
                    </button>
                </div>
                
            </form>
        </div>
    </div>

    <!-- Bottom Navigation -->
    <div class="navigation-bottom">
        <div class="tab-bar-buttons">
            <a href="index.php" class="tab">
                <div class="icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="label-2">Início</div>
            </a>
            <a href="#" class="tab active">
                <div class="icon-2">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <div class="label-3">Criar</div>
            </a>
            <a href="#" class="tab">
                <div class="icon-2">
                    <i class="fas fa-user"></i>
                </div>
                <div class="label-4">Perfil</div>
            </a>
        </div>
    </div>

    <script>
        // Update time
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('pt-BR', { 
                hour: '2-digit', 
                minute: '2-digit',
                hour12: false 
            });
            document.getElementById('current-time').textContent = timeString;
        }

        updateTime();
        setInterval(updateTime, 60000);

        // Age calculation
        document.getElementById('data_nascimento').addEventListener('change', function() {
            const dataNascimento = new Date(this.value);
            const hoje = new Date();
            let idade = hoje.getFullYear() - dataNascimento.getFullYear();
            const mes = hoje.getMonth() - dataNascimento.getMonth();
            
            if (mes < 0 || (mes === 0 && hoje.getDate() < dataNascimento.getDate())) {
                idade--;
            }
            
            if (idade >= 0) {
                document.getElementById('idade_display').innerHTML = `<i class="fas fa-birthday-cake"></i> Idade: ${idade} anos`;
            }
        });
        
        // Dynamic field functions
        function adicionarFormacao() {
            const container = document.getElementById('formacao_container');
            const novaFormacao = document.createElement('div');
            novaFormacao.className = 'dynamic-field';
            novaFormacao.innerHTML = `
                <button type="button" class="remove-button" onclick="removerElemento(this)">
                    <i class="fas fa-times"></i>
                </button>
                <div class="form-grid">
                    <div class="input-field-regular">
                        <label class="form-label">Curso</label>
                        <input type="text" name="formacao_curso[]" placeholder="Ex: Análise e Desenvolvimento de Sistemas">
                    </div>
                    <div class="input-field-regular">
                        <label class="form-label">Instituição</label>
                        <input type="text" name="formacao_instituicao[]" placeholder="Ex: Universidade XYZ">
                    </div>
                </div>
                <div class="form-grid-3">
                    <div class="input-field-regular">
                        <label class="form-label">Ano Início</label>
                        <input type="number" name="formacao_ano_inicio[]" min="1950" max="2030">
                    </div>
                    <div class="input-field-regular">
                        <label class="form-label">Ano Fim</label>
                        <input type="number" name="formacao_ano_fim[]" min="1950" max="2030">
                    </div>
                    <div class="input-field-regular">
                        <label class="form-label">Status</label>
                        <select name="formacao_status[]">
                            <option value="concluido">Concluído</option>
                            <option value="cursando">Cursando</option>
                            <option value="incompleto">Incompleto</option>
                        </select>
                    </div>
                </div>
            `;
            container.appendChild(novaFormacao);
        }
        
        function adicionarExperiencia() {
            const container = document.getElementById('experiencia_container');
            const novaExperiencia = document.createElement('div');
            novaExperiencia.className = 'dynamic-field';
            novaExperiencia.innerHTML = `
                <button type="button" class="remove-button" onclick="removerElemento(this)">
                    <i class="fas fa-times"></i>
                </button>
                <div class="form-grid">
                    <div class="input-field-regular">
                        <label class="form-label">Cargo</label>
                        <input type="text" name="experiencia_cargo[]" placeholder="Ex: Desenvolvedor Web">
                    </div>
                    <div class="input-field-regular">
                        <label class="form-label">Empresa</label>
                        <input type="text" name="experiencia_empresa[]" placeholder="Ex: Tech Solutions Ltda">
                    </div>
                </div>
                <div class="form-grid-3">
                    <div class="input-field-regular">
                        <label class="form-label">Data Início</label>
                        <input type="month" name="experiencia_inicio[]">
                    </div>
                    <div class="input-field-regular">
                        <label class="form-label">Data Fim</label>
                        <input type="month" name="experiencia_fim[]">
                    </div>
                    <div class="input-field-regular" style="display: flex; align-items: end;">
                        <label style="display: flex; align-items: center; gap: 8px; padding: 16px 0;">
                            <input type="checkbox" name="experiencia_atual[]" value="1">
                            Trabalho atual
                        </label>
                    </div>
                </div>
                <div class="input-field-long">
                    <label class="form-label">Descreva suas experiências</label>
                    <textarea name="experiencia_descricao[]" placeholder="Descreva suas principais atividades e responsabilidades..."></textarea>
                </div>
            `;
            container.appendChild(novaExperiencia);
        }
        
        function adicionarReferencia() {
            const container = document.getElementById('referencias_container');
            const novaReferencia = document.createElement('div');
            novaReferencia.className = 'dynamic-field';
            novaReferencia.innerHTML = `
                <button type="button" class="remove-button" onclick="removerElemento(this)">
                    <i class="fas fa-times"></i>
                </button>
                <div class="form-grid">
                    <div class="input-field-regular">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" name="referencia_nome[]" placeholder="Ex: João Silva">
                    </div>
                    <div class="input-field-regular">
                        <label class="form-label">Cargo/Relação</label>
                        <input type="text" name="referencia_cargo[]" placeholder="Ex: Gerente de TI / Ex-supervisor">
                    </div>
                </div>
                <div class="form-grid">
                    <div class="input-field-regular">
                        <label class="form-label">Telefone</label>
                        <input type="tel" name="referencia_telefone[]" placeholder="(11) 99999-9999">
                    </div>
                    <div class="input-field-regular">
                        <label class="form-label">E-mail</label>
                        <input type="email" name="referencia_email[]" placeholder="joao@empresa.com">
                    </div>
                </div>
            `;
            container.appendChild(novaReferencia);
        }
        
        function removerElemento(botao) {
            botao.closest('.dynamic-field').remove();
        }
        
        // Form validation
        document.getElementById('curriculoForm').addEventListener('submit', function(e) {
            const nome = document.getElementById('nome_completo').value;
            const email = document.getElementById('email').value;
            const telefone = document.getElementById('telefone').value;
            const dataNascimento = document.getElementById('data_nascimento').value;
            
            if (!nome || !email || !telefone || !dataNascimento) {
                e.preventDefault();
                alert('Por favor, preencha todos os campos obrigatórios marcados com *');
                return false;
            }
        });
    </script>
</body>
</html>