<?php
/**
 * Processador de Currículo
 * Recebe dados do formulário e gera currículo formatado
 */

// Configuração para caracteres especiais
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset', 'utf-8');

// Classe para processar o currículo
class CurriculoProcessor {
    
    private $dados;
    
    public function __construct($postData) {
        $this->dados = $this->sanitizarDados($postData);
    }
    
    /**
     * Sanitizar e validar dados recebidos
     */
    private function sanitizarDados($data) {
        $dadosLimpos = [];
        
        // Dados pessoais
        $dadosLimpos['nome_completo'] = htmlspecialchars(trim($data['nome_completo'] ?? ''));
        $dadosLimpos['email'] = filter_var($data['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $dadosLimpos['telefone'] = htmlspecialchars(trim($data['telefone'] ?? ''));
        $dadosLimpos['data_nascimento'] = $data['data_nascimento'] ?? '';
        $dadosLimpos['estado_civil'] = htmlspecialchars(trim($data['estado_civil'] ?? ''));
        $dadosLimpos['endereco'] = htmlspecialchars(trim($data['endereco'] ?? ''));
        $dadosLimpos['cidade'] = htmlspecialchars(trim($data['cidade'] ?? ''));
        $dadosLimpos['objetivo'] = htmlspecialchars(trim($data['objetivo'] ?? ''));
        
        // Calcular idade
        if ($dadosLimpos['data_nascimento']) {
            $nascimento = new DateTime($dadosLimpos['data_nascimento']);
            $hoje = new DateTime();
            $dadosLimpos['idade'] = $hoje->diff($nascimento)->y;
        }
        
        // Formação acadêmica
        $dadosLimpos['formacao'] = [];
        if (isset($data['formacao_curso']) && is_array($data['formacao_curso'])) {
            for ($i = 0; $i < count($data['formacao_curso']); $i++) {
                if (!empty(trim($data['formacao_curso'][$i]))) {
                    $dadosLimpos['formacao'][] = [
                        'curso' => htmlspecialchars(trim($data['formacao_curso'][$i])),
                        'instituicao' => htmlspecialchars(trim($data['formacao_instituicao'][$i] ?? '')),
                        'ano_inicio' => (int)($data['formacao_ano_inicio'][$i] ?? 0),
                        'ano_fim' => (int)($data['formacao_ano_fim'][$i] ?? 0),
                        'status' => htmlspecialchars(trim($data['formacao_status'][$i] ?? ''))
                    ];
                }
            }
        }
        
        // Experiência profissional
        $dadosLimpos['experiencia'] = [];
        if (isset($data['experiencia_cargo']) && is_array($data['experiencia_cargo'])) {
            for ($i = 0; $i < count($data['experiencia_cargo']); $i++) {
                if (!empty(trim($data['experiencia_cargo'][$i]))) {
                    $dadosLimpos['experiencia'][] = [
                        'cargo' => htmlspecialchars(trim($data['experiencia_cargo'][$i])),
                        'empresa' => htmlspecialchars(trim($data['experiencia_empresa'][$i] ?? '')),
                        'inicio' => $data['experiencia_inicio'][$i] ?? '',
                        'fim' => $data['experiencia_fim'][$i] ?? '',
                        'atual' => isset($data['experiencia_atual'][$i]),
                        'descricao' => htmlspecialchars(trim($data['experiencia_descricao'][$i] ?? ''))
                    ];
                }
            }
        }
        
        // Habilidades
        $dadosLimpos['habilidades_tecnicas'] = htmlspecialchars(trim($data['habilidades_tecnicas'] ?? ''));
        $dadosLimpos['habilidades_pessoais'] = htmlspecialchars(trim($data['habilidades_pessoais'] ?? ''));
        $dadosLimpos['idiomas'] = htmlspecialchars(trim($data['idiomas'] ?? ''));
        
        // Referências
        $dadosLimpos['referencias'] = [];
        if (isset($data['referencia_nome']) && is_array($data['referencia_nome'])) {
            for ($i = 0; $i < count($data['referencia_nome']); $i++) {
                if (!empty(trim($data['referencia_nome'][$i]))) {
                    $dadosLimpos['referencias'][] = [
                        'nome' => htmlspecialchars(trim($data['referencia_nome'][$i])),
                        'cargo' => htmlspecialchars(trim($data['referencia_cargo'][$i] ?? '')),
                        'telefone' => htmlspecialchars(trim($data['referencia_telefone'][$i] ?? '')),
                        'email' => filter_var($data['referencia_email'][$i] ?? '', FILTER_SANITIZE_EMAIL)
                    ];
                }
            }
        }
        
        return $dadosLimpos;
    }
    
    /**
     * Gerar HTML do currículo
     */
    public function gerarHTML() {
        $html = $this->getHTMLTemplate();
        return $html;
    }
    
    /**
     * Template HTML do currículo
     */
    private function getHTMLTemplate() {
        $dados = $this->dados;
        
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Currículo - <?= $dados['nome_completo'] ?></title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    line-height: 1.6;
                    color: #333;
                }
                
                .curriculo-container {
                    max-width: 800px;
                    margin: 0 auto;
                    background: white;
                    box-shadow: 0 0 20px rgba(0,0,0,0.1);
                }
                
                .header-curriculo {
                    background: linear-gradient(135deg, #2c3e50, #3498db);
                    color: white;
                    padding: 40px;
                    text-align: center;
                }
                
                .nome-principal {
                    font-size: 2.5rem;
                    font-weight: bold;
                    margin-bottom: 10px;
                }
                
                .info-contato {
                    font-size: 1.1rem;
                    opacity: 0.9;
                }
                
                .secao-curriculo {
                    padding: 30px 40px;
                }
                
                .titulo-secao {
                    color: #2c3e50;
                    border-bottom: 3px solid #3498db;
                    padding-bottom: 10px;
                    margin-bottom: 25px;
                    font-weight: bold;
                    font-size: 1.3rem;
                    text-transform: uppercase;
                }
                
                .item-experiencia, .item-formacao, .item-referencia {
                    margin-bottom: 25px;
                    padding: 20px;
                    border-left: 4px solid #3498db;
                    background: #f8f9fa;
                }
                
                .cargo-empresa {
                    font-weight: bold;
                    color: #2c3e50;
                    font-size: 1.1rem;
                }
                
                .periodo {
                    color: #7f8c8d;
                    font-style: italic;
                    margin-bottom: 10px;
                }
                
                .descricao {
                    color: #555;
                }
                
                .habilidades-lista {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 10px;
                }
                
                .habilidade-tag {
                    background: #3498db;
                    color: white;
                    padding: 5px 15px;
                    border-radius: 20px;
                    font-size: 0.9rem;
                }
                
                .btn-download {
                    position: fixed;
                    bottom: 20px;
                    right: 20px;
                    background: #27ae60;
                    color: white;
                    border: none;
                    border-radius: 50px;
                    padding: 15px 25px;
                    font-size: 1.1rem;
                    cursor: pointer;
                    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
                    z-index: 1000;
                }
                
                .btn-download:hover {
                    background: #219a52;
                    transform: translateY(-2px);
                }
                
                @media print {
                    .btn-download { display: none; }
                    body { margin: 0; }
                    .curriculo-container { box-shadow: none; }
                }
            </style>
        </head>
        <body>
            <div class="curriculo-container" id="curriculo-content">
                
                <!-- HEADER -->
                <div class="header-curriculo">
                    <div class="nome-principal"><?= $dados['nome_completo'] ?></div>
                    <div class="info-contato">
                        <?php if ($dados['idade']): ?>
                            <i class="fas fa-birthday-cake me-2"></i><?= $dados['idade'] ?> anos
                        <?php endif; ?>
                        
                        <?php if ($dados['email']): ?>
                            <br><i class="fas fa-envelope me-2"></i><?= $dados['email'] ?>
                        <?php endif; ?>
                        
                        <?php if ($dados['telefone']): ?>
                            <br><i class="fas fa-phone me-2"></i><?= $dados['telefone'] ?>
                        <?php endif; ?>
                        
                        <?php if ($dados['endereco']): ?>
                            <br><i class="fas fa-map-marker-alt me-2"></i><?= $dados['endereco'] ?>
                            <?php if ($dados['cidade']): ?>
                                - <?= $dados['cidade'] ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        <?php if ($dados['estado_civil']): ?>
                            <br><i class="fas fa-heart me-2"></i><?= ucfirst($dados['estado_civil']) ?>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- OBJETIVO -->
                <?php if ($dados['objetivo']): ?>
                <div class="secao-curriculo">
                    <h3 class="titulo-secao"><i class="fas fa-bullseye me-2"></i>Objetivo Profissional</h3>
                    <p class="descricao"><?= nl2br($dados['objetivo']) ?></p>
                </div>
                <?php endif; ?>
                
                <!-- FORMAÇÃO ACADÊMICA -->
                <?php if (!empty($dados['formacao'])): ?>
                <div class="secao-curriculo">
                    <h3 class="titulo-secao"><i class="fas fa-graduation-cap me-2"></i>Formação Acadêmica</h3>
                    
                    <?php foreach ($dados['formacao'] as $formacao): ?>
                    <div class="item-formacao">
                        <div class="cargo-empresa"><?= $formacao['curso'] ?></div>
                        <?php if ($formacao['instituicao']): ?>
                            <div class="text-muted"><?= $formacao['instituicao'] ?></div>
                        <?php endif; ?>
                        
                        <?php if ($formacao['ano_inicio'] || $formacao['ano_fim']): ?>
                        <div class="periodo">
                            <?php if ($formacao['ano_inicio']): ?>
                                <?= $formacao['ano_inicio'] ?>
                            <?php endif; ?>
                            
                            <?php if ($formacao['ano_inicio'] && $formacao['ano_fim']): ?>
                                - <?= $formacao['ano_fim'] ?>
                            <?php elseif ($formacao['status'] === 'cursando'): ?>
                                - Cursando
                            <?php endif; ?>
                            
                            <?php if ($formacao['status']): ?>
                                (<?= ucfirst($formacao['status']) ?>)
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                
                <!-- EXPERIÊNCIA PROFISSIONAL -->
                <?php if (!empty($dados['experiencia'])): ?>
                <div class="secao-curriculo">
                    <h3 class="titulo-secao"><i class="fas fa-briefcase me-2"></i>Experiência Profissional</h3>
                    
                    <?php foreach ($dados['experiencia'] as $exp): ?>
                    <div class="item-experiencia">
                        <div class="cargo-empresa"><?= $exp['cargo'] ?></div>
                        <?php if ($exp['empresa']): ?>
                            <div class="text-muted"><?= $exp['empresa'] ?></div>
                        <?php endif; ?>
                        
                        <?php if ($exp['inicio'] || $exp['fim']): ?>
                        <div class="periodo">
                            <?php if ($exp['inicio']): ?>
                                <?= date('m/Y', strtotime($exp['inicio'])) ?>
                            <?php endif; ?>
                            
                            <?php if ($exp['atual']): ?>
                                - Atual
                            <?php elseif ($exp['fim']): ?>
                                - <?= date('m/Y', strtotime($exp['fim'])) ?>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($exp['descricao']): ?>
                            <div class="descricao"><?= nl2br($exp['descricao']) ?></div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                
                <!-- HABILIDADES -->
                <div class="secao-curriculo">
                    <h3 class="titulo-secao"><i class="fas fa-cogs me-2"></i>Habilidades e Competências</h3>
                    
                    <?php if ($dados['habilidades_tecnicas']): ?>
                    <div class="mb-4">
                        <h5><i class="fas fa-laptop-code me-2"></i>Habilidades Técnicas</h5>
                        <div class="habilidades-lista">
                            <?php 
                            $tecnicas = explode(',', $dados['habilidades_tecnicas']);
                            foreach ($tecnicas as $habilidade): 
                                $habilidade = trim($habilidade);
                                if ($habilidade):
                            ?>
                                <span class="habilidade-tag"><?= $habilidade ?></span>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($dados['habilidades_pessoais']): ?>
                    <div class="mb-4">
                        <h5><i class="fas fa-users me-2"></i>Habilidades Pessoais</h5>
                        <div class="descricao"><?= nl2br($dados['habilidades_pessoais']) ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($dados['idiomas']): ?>
                    <div class="mb-4">
                        <h5><i class="fas fa-globe me-2"></i>Idiomas</h5>
                        <div class="descricao"><?= nl2br($dados['idiomas']) ?></div>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- REFERÊNCIAS -->
                <?php if (!empty($dados['referencias'])): ?>
                <div class="secao-curriculo">
                    <h3 class="titulo-secao"><i class="fas fa-users me-2"></i>Referências Pessoais</h3>
                    
                    <?php foreach ($dados['referencias'] as $ref): ?>
                    <div class="item-referencia">
                        <div class="cargo-empresa"><?= $ref['nome'] ?></div>
                        <?php if ($ref['cargo']): ?>
                            <div class="text-muted"><?= $ref['cargo'] ?></div>
                        <?php endif; ?>
                        
                        <div class="descricao">
                            <?php if ($ref['telefone']): ?>
                                <i class="fas fa-phone me-1"></i><?= $ref['telefone'] ?>
                            <?php endif; ?>
                            
                            <?php if ($ref['email']): ?>
                                <?php if ($ref['telefone']): ?> | <?php endif; ?>
                                <i class="fas fa-envelope me-1"></i><?= $ref['email'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- BOTÃO DE DOWNLOAD -->
            <button class="btn-download" onclick="baixarCurriculo()">
                <i class="fas fa-download me-2"></i>Baixar PDF
            </button>
            
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
            <script>
                function baixarCurriculo() {
                    const elemento = document.getElementById('curriculo-content');
                    const nomeArquivo = 'curriculo_<?= preg_replace("/[^a-zA-Z0-9]/", "_", strtolower($dados['nome_completo'])) ?>.pdf';
                    
                    const opcoes = {
                        margin: 10,
                        filename: nomeArquivo,
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { scale: 2 },
                        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                    };
                    
                    html2pdf().set(opcoes).from(elemento).save();
                }
                
                // Também permitir impressão
                function imprimirCurriculo() {
                    window.print();
                }
                
                // Atalhos de teclado
                document.addEventListener('keydown', function(e) {
                    if (e.ctrlKey && e.key === 'p') {
                        e.preventDefault();
                        imprimirCurriculo();
                    }
                    if (e.ctrlKey && e.key === 's') {
                        e.preventDefault();
                        baixarCurriculo();
                    }
                });
            </script>
        </body>
        </html>
        <?php
        return ob_get_clean();
    }
    
    /**
     * Salvar dados em JSON para histórico
     */
    public function salvarDados() {
        $arquivo = '../storage/curriculos/' . date('Y-m-d_H-i-s') . '_' . 
                   preg_replace("/[^a-zA-Z0-9]/", "_", strtolower($this->dados['nome_completo'])) . '.json';
        
        // Criar diretório se não existir
        $dir = dirname($arquivo);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        
        file_put_contents($arquivo, json_encode($this->dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return $arquivo;
    }
}

// Processar dados se formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $processor = new CurriculoProcessor($_POST);
        
        // Salvar dados
        $processor->salvarDados();
        
        // Gerar e exibir currículo
        echo $processor->gerarHTML();
        
    } catch (Exception $e) {
        echo "<div class='alert alert-danger m-4'>Erro ao processar currículo: " . $e->getMessage() . "</div>";
    }
} else {
    // Redirecionar para formulário se acessado diretamente
    header('Location: curriculo.php');
    exit;
}
?>