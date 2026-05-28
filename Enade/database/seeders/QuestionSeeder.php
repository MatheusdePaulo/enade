<?php

namespace Database\Seeders;

use App\Models\Alternative;
use App\Models\Course;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedCourse('Engenharia de Computação', $this->engComp());
        $this->seedCourse('Ciência da Computação',    $this->cienciaComp());
        $this->seedCourse('Sistemas de Informação',   $this->sistemasInfo());
    }

    private function seedCourse(string $name, array $questions): void
    {
        $course = Course::firstOrCreate(['name' => $name]);

        // Idempotent: skip if course already has questions
        if ($course->questions()->count() > 0) {
            return;
        }

        foreach ($questions as $qData) {
            $question = Question::create([
                'statement'   => $qData['statement'],
                'year'        => $qData['year'],
                'course_id'   => $course->id,
                'component'   => $qData['component'],
                'explanation' => $qData['explanation'],
            ]);

            foreach ($qData['alternatives'] as $altData) {
                Alternative::create([
                    'text'        => $altData['text'],
                    'is_correct'  => $altData['is_correct'],
                    'question_id' => $question->id,
                ]);
            }
        }
    }

    // ═══════════════════════════════════════════════════════
    //  ENGENHARIA DE COMPUTAÇÃO — 15 questões
    // ═══════════════════════════════════════════════════════
    private function engComp(): array
    {
        return [
            [
                'statement'   => 'Um engenheiro de computação é contratado para desenvolver um sistema de reconhecimento facial para uso em espaços públicos. Durante o desenvolvimento, ele descobre que o sistema apresenta taxas de erro significativamente maiores para determinados grupos étnicos. Considerando os princípios éticos da engenharia, qual atitude o profissional deveria adotar?',
                'year'        => 2021,
                'component'   => 'Geral',
                'explanation' => 'O Código de Ética do profissional de engenharia exige transparência e compromisso com o bem-estar coletivo. Identificar e comunicar vieses algorítmicos que afetam grupos específicos é obrigação ética fundamental. Apenas documentar e propor soluções técnicas atende tanto à responsabilidade ética (comunicar) quanto à técnica (corrigir), sendo a conduta correta exigida pelo CONFEA e pelo IEEE Code of Ethics.',
                'alternatives' => [
                    ['text' => 'Prosseguir com o desenvolvimento, pois a empresa contratante é a única responsável pelo uso do sistema.', 'is_correct' => false],
                    ['text' => 'Documentar o problema e informar à contratante sobre os vieses identificados, propondo soluções técnicas para mitigá-los.', 'is_correct' => true],
                    ['text' => 'Abandonar o projeto imediatamente sem comunicar os problemas encontrados à equipe.', 'is_correct' => false],
                    ['text' => 'Implementar o sistema normalmente, pois pequenos vieses são inevitáveis em qualquer algoritmo de IA.', 'is_correct' => false],
                    ['text' => 'Consultar apenas colegas engenheiros da empresa, sem envolver a contratante ou outras partes interessadas.', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'O consumo energético dos data centers globais representa uma parcela crescente do total de energia elétrica consumida no mundo. Com base nesse contexto, avalie as seguintes afirmativas:

I. A virtualização de servidores contribui para a redução do consumo energético, pois permite consolidar múltiplos servidores físicos em menos máquinas.
II. A computação em nuvem necessariamente aumenta o consumo de energia, pois requer infraestrutura permanentemente ligada.
III. O uso de energias renováveis em data centers é uma prática adotada por grandes empresas de tecnologia como forma de reduzir sua pegada de carbono.

É correto o que se afirma em:',
                'year'        => 2019,
                'component'   => 'Geral',
                'explanation' => 'A virtualização (I) consolida cargas em menos servidores físicos, reduzindo consumo. A computação em nuvem (II) pode ser mais eficiente que infraestruturas locais — incorreta. O uso de renováveis (III) é prática real de Google, Microsoft e Amazon — correta. Portanto apenas I e III.',
                'alternatives' => [
                    ['text' => 'I, apenas.', 'is_correct' => false],
                    ['text' => 'II, apenas.', 'is_correct' => false],
                    ['text' => 'I e III, apenas.', 'is_correct' => true],
                    ['text' => 'II e III, apenas.', 'is_correct' => false],
                    ['text' => 'I, II e III.', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'A Lei Brasileira de Inclusão (Lei nº 13.146/2015) estabelece que os sítios da internet e os aplicativos para uso do público em geral devem ser acessíveis à pessoa com deficiência. Qual das seguintes práticas de desenvolvimento web contribui DIRETAMENTE para a acessibilidade de pessoas com deficiência visual que utilizam leitores de tela?',
                'year'        => 2021,
                'component'   => 'Geral',
                'explanation' => 'O atributo alt em imagens é fundamental para leitores de tela (NVDA, JAWS, VoiceOver), que o usam para descrever o conteúdo visual ao usuário cego. As demais opções são boas práticas, mas não impactam diretamente usuários com deficiência visual que dependem de leitores de tela.',
                'alternatives' => [
                    ['text' => 'Utilizar animações CSS para tornar a interface mais dinâmica e atraente visualmente.', 'is_correct' => false],
                    ['text' => 'Inserir textos alternativos (atributo alt) descritivos e significativos em todas as imagens do site.', 'is_correct' => true],
                    ['text' => 'Usar fontes com tamanho mínimo de 12px em todo o conteúdo textual da página.', 'is_correct' => false],
                    ['text' => 'Implementar um layout responsivo que se adapta a diferentes tamanhos de dispositivos móveis.', 'is_correct' => false],
                    ['text' => 'Utilizar paleta de cores com alto contraste entre fundo e texto para facilitar a leitura.', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'A Lei Geral de Proteção de Dados (LGPD — Lei nº 13.709/2018) estabelece regras para o tratamento de dados pessoais no Brasil. Sobre os princípios do Art. 6º, analise:

I. O princípio da finalidade determina que dados pessoais devem ser coletados para propósitos explícitos, legítimos e específicos.
II. O princípio da necessidade permite coletar o máximo de dados possível para garantir o funcionamento adequado do sistema.
III. O princípio da transparência exige que informações claras sobre o tratamento de dados sejam disponibilizadas ao titular.

Estão corretas apenas:',
                'year'        => 2023,
                'component'   => 'Geral',
                'explanation' => 'Finalidade (I) ✓ — dados só para fins específicos e legítimos. Necessidade (II) ✗ — esse princípio exige o mínimo de dados necessários, não o máximo. Transparência (III) ✓ — o titular deve receber informações claras. Logo, apenas I e III.',
                'alternatives' => [
                    ['text' => 'I e II, apenas.', 'is_correct' => false],
                    ['text' => 'I e III, apenas.', 'is_correct' => true],
                    ['text' => 'II e III, apenas.', 'is_correct' => false],
                    ['text' => 'I, apenas.', 'is_correct' => false],
                    ['text' => 'I, II e III.', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'A disseminação de notícias falsas (fake news) nas redes sociais representa um desafio para a democracia. Do ponto de vista tecnológico, qual mecanismo tem sido amplamente utilizado para DETECTAR automaticamente conteúdos potencialmente falsos?',
                'year'        => 2023,
                'component'   => 'Geral',
                'explanation' => 'Modelos de Processamento de Linguagem Natural (PLN) e Machine Learning são treinados com exemplos de notícias verdadeiras e falsas, aprendendo padrões linguísticos que distinguem os dois tipos. Técnicas como análise de sentimento e fact-checking automatizado são amplamente usadas por plataformas como Facebook e Twitter.',
                'alternatives' => [
                    ['text' => 'Algoritmos de compressão de dados para identificar padrões anômalos de armazenamento.', 'is_correct' => false],
                    ['text' => 'Sistemas de firewall de próxima geração para bloquear conteúdos não verificados.', 'is_correct' => false],
                    ['text' => 'Protocolos de rede para rastrear a origem geográfica exata das publicações suspeitas.', 'is_correct' => false],
                    ['text' => 'Modelos de processamento de linguagem natural e machine learning para identificar padrões linguísticos de desinformação.', 'is_correct' => true],
                    ['text' => 'Sistemas de criptografia assimétrica para autenticar a identidade dos autores de publicações.', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'Considere os algoritmos de ordenação e suas complexidades no caso médio: Bubble Sort O(n²), Merge Sort O(n log n), Quick Sort O(n log n), Heap Sort O(n log n). Um sistema embarcado com memória limitada precisa ordenar 500.000 registros sem alocações extras. Qual algoritmo é mais adequado?',
                'year'        => 2023,
                'component'   => 'Específico',
                'explanation' => 'Para n = 500.000, algoritmos O(n²) são inviáveis (~125 bi operações). O Merge Sort exige O(n) de memória auxiliar — inviável em sistema embarcado. O Quick Sort usa O(log n) de pilha no caso médio, mas O(n) no pior caso. O Heap Sort ordena in-place (O(1) de memória auxiliar) com O(n log n) garantido no pior caso, sendo ideal quando memória é restrita.',
                'alternatives' => [
                    ['text' => 'Bubble Sort, por ser simples de implementar e não requerer memória auxiliar significativa.', 'is_correct' => false],
                    ['text' => 'Merge Sort, por ter complexidade O(n log n) garantida em todos os casos.', 'is_correct' => false],
                    ['text' => 'Heap Sort, pois possui O(n log n) e ordena in-place, sem necessidade de memória auxiliar proporcional a n.', 'is_correct' => true],
                    ['text' => 'Quick Sort, pois é o algoritmo mais rápido na prática para qualquer conjunto de dados.', 'is_correct' => false],
                    ['text' => 'Todos os algoritmos O(n log n) são equivalentes para este cenário, pois possuem a mesma complexidade.', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'Em um banco de dados relacional, a tabela PEDIDO(pedido_id, cliente_nome, cliente_email, produto_id, produto_nome, produto_preco, quantidade) viola a 3FN. Identifique a violação e a decomposição correta:',
                'year'        => 2021,
                'component'   => 'Específico',
                'explanation' => 'Há dependência transitiva: pedido_id → produto_id → produto_nome/produto_preco. Produto_nome e produto_preco dependem transitivamente de pedido_id via produto_id, violando a 3FN. A solução correta é decompor em PEDIDO(pedido_id, cliente_nome, cliente_email, produto_id, quantidade) e PRODUTO(produto_id, produto_nome, produto_preco).',
                'alternatives' => [
                    ['text' => 'A tabela está na 1FN; a dependência transitiva produto_id → produto_nome/produto_preco deve ser eliminada criando uma tabela PRODUTO separada para atingir a 3FN.', 'is_correct' => true],
                    ['text' => 'A tabela já está na 3FN, pois todos os atributos não-chave dependem diretamente da chave primária pedido_id.', 'is_correct' => false],
                    ['text' => 'A violação é de 1FN, pois cliente_nome e cliente_email são atributos relacionados ao mesmo cliente.', 'is_correct' => false],
                    ['text' => 'Para atingir a 3FN, basta separar os dados do cliente em uma tabela CLIENTE, mantendo produto na tabela PEDIDO.', 'is_correct' => false],
                    ['text' => 'A tabela viola a 2FN, pois produto_nome e produto_preco têm dependência parcial da chave primária composta.', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'Em sistemas computacionais com hierarquia de memória, avalie:

I. A localidade temporal indica que um dado acessado recentemente tem alta probabilidade de ser acessado novamente em breve.
II. A localidade espacial afirma que, se um endereço foi acessado, endereços próximos também tendem a ser acessados em breve.
III. O princípio da localidade explica por que programas com laços se beneficiam mais de memórias cache do que programas puramente sequenciais sem repetição.

É correto o que se afirma em:',
                'year'        => 2019,
                'component'   => 'Específico',
                'explanation' => 'Todas corretas. (I) Localidade temporal: variáveis em loops são acessadas repetidamente. (II) Localidade espacial: ao acessar array[0], array[1] tende a ser acessado logo depois — a cache carrega um bloco contíguo de uma vez. (III) Loops exploram ambos: temporal (instrução executada repetidamente) e espacial (acesso sequencial a arrays).',
                'alternatives' => [
                    ['text' => 'I, apenas.', 'is_correct' => false],
                    ['text' => 'I e II, apenas.', 'is_correct' => false],
                    ['text' => 'II e III, apenas.', 'is_correct' => false],
                    ['text' => 'I e III, apenas.', 'is_correct' => false],
                    ['text' => 'I, II e III.', 'is_correct' => true],
                ],
            ],
            [
                'statement'   => 'No Modelo OSI, associe cada função à sua camada correta:

I. Endereçamento lógico (IP) e roteamento entre redes → Camada ( )
II. Controle de fluxo, detecção de erros e endereçamento MAC → Camada ( )
III. Estabelecimento de conexão confiável fim a fim (TCP) → Camada ( )

A sequência correta é:',
                'year'        => 2019,
                'component'   => 'Específico',
                'explanation' => '(I) Camada 3 — Rede: endereçamento IP e roteamento. (II) Camada 2 — Enlace: endereçamento MAC, detecção de erros (CRC), controle de fluxo em nível de enlace. (III) Camada 4 — Transporte: TCP garante entrega confiável fim a fim com controle de erros e retransmissão.',
                'alternatives' => [
                    ['text' => 'I → Camada 2; II → Camada 3; III → Camada 5.', 'is_correct' => false],
                    ['text' => 'I → Camada 3; II → Camada 2; III → Camada 4.', 'is_correct' => true],
                    ['text' => 'I → Camada 4; II → Camada 3; III → Camada 2.', 'is_correct' => false],
                    ['text' => 'I → Camada 3; II → Camada 4; III → Camada 2.', 'is_correct' => false],
                    ['text' => 'I → Camada 5; II → Camada 3; III → Camada 4.', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'As quatro condições necessárias para a ocorrência de deadlock, identificadas por Coffman et al. (1971), são:',
                'year'        => 2023,
                'component'   => 'Específico',
                'explanation' => 'As condições de Coffman: (1) Exclusão Mútua — recurso não compartilhável; (2) Posse e Espera — processo retém recurso enquanto aguarda outro; (3) Não Preempção — recursos não podem ser retirados forçosamente; (4) Espera Circular — cadeia circular P1→P2→...→Pn→P1. Eliminar qualquer uma previne o deadlock.',
                'alternatives' => [
                    ['text' => 'Starvation, prioridade de processos, espera circular e preempção forçada.', 'is_correct' => false],
                    ['text' => 'Exclusão mútua, compartilhamento de recursos, preempção garantida e espera linear.', 'is_correct' => false],
                    ['text' => 'Exclusão mútua, posse e espera, não preempção e espera circular.', 'is_correct' => true],
                    ['text' => 'Sincronização por mutex, uso de semáforos, espera por evento e prioridade de processos.', 'is_correct' => false],
                    ['text' => 'Exclusão mútua, preempção forçada, alocação total de recursos e espera circular.', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'O padrão de projeto que define uma interface para criar um objeto, mas deixa as subclasses decidirem qual classe concreta instanciar, promovendo o princípio Aberto/Fechado (OCP), é denominado:',
                'year'        => 2023,
                'component'   => 'Específico',
                'explanation' => 'O Factory Method é um padrão criacional que delega às subclasses a decisão de qual classe concreta instanciar. Respeita o OCP: novas classes podem ser adicionadas sem modificar o código existente. Difere do Abstract Factory (famílias de objetos), do Builder (construção em etapas) e do Singleton (instância única).',
                'alternatives' => [
                    ['text' => 'Singleton, pois garante que uma classe tenha apenas uma instância em toda a aplicação.', 'is_correct' => false],
                    ['text' => 'Observer, pois notifica automaticamente objetos dependentes sobre mudanças de estado.', 'is_correct' => false],
                    ['text' => 'Decorator, pois adiciona responsabilidades a objetos de forma dinâmica sem alterar sua classe.', 'is_correct' => false],
                    ['text' => 'Factory Method, pois define uma interface para criação de objetos deixando as subclasses decidirem qual classe concreta instanciar.', 'is_correct' => true],
                    ['text' => 'Strategy, pois define uma família de algoritmos encapsulados e os torna intercambiáveis em tempo de execução.', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'Considere a hierarquia de classes em Java: Forma (abstract calcularArea()), Circulo e Retangulo estendem Forma. O código percorre um array Forma[] chamando f.calcularArea(). O conceito de POO que permite tratar Circulo e Retangulo uniformemente, com o método correto invocado em tempo de execução, é:',
                'year'        => 2021,
                'component'   => 'Específico',
                'explanation' => 'O polimorfismo permite que objetos de diferentes classes sejam tratados por uma interface comum. O método correto é invocado em tempo de execução via dynamic dispatch (late binding). Embora herança seja necessária para habilitar o polimorfismo de subtipo, o conceito central aqui é o polimorfismo — a capacidade de um mesmo código operar sobre tipos distintos.',
                'alternatives' => [
                    ['text' => 'Encapsulamento, pois os atributos raio, base e altura estão declarados como private nas subclasses.', 'is_correct' => false],
                    ['text' => 'Herança, pois Circulo e Retangulo estendem a classe Forma e reutilizam sua estrutura.', 'is_correct' => false],
                    ['text' => 'Polimorfismo, pois o mesmo método calcularArea() é chamado com comportamentos distintos conforme o tipo real do objeto em tempo de execução.', 'is_correct' => true],
                    ['text' => 'Abstração, pois a classe Forma define apenas o contrato sem fornecer implementação concreta.', 'is_correct' => false],
                    ['text' => 'Composição, pois Forma agrega diferentes implementações de cálculo de área.', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'Dado o conjunto inserido em uma ABB vazia nessa ordem: 50, 30, 70, 20, 40, 60, 80. Qual é o resultado do percurso em-ordem (in-order) e qual propriedade ele demonstra?',
                'year'        => 2019,
                'component'   => 'Específico',
                'explanation' => 'O percurso em-ordem visita: esquerda → raiz → direita. Para esta ABB, visita: 20, 30, 40, 50, 60, 70, 80 — demonstrando a propriedade fundamental da ABB: o percurso em-ordem sempre retorna os elementos em ordem crescente. Essa propriedade é explorada em algoritmos de busca eficiente O(log n).',
                'alternatives' => [
                    ['text' => '50, 30, 70, 20, 40, 60, 80 — demonstra a ordem de inserção na árvore.', 'is_correct' => false],
                    ['text' => '50, 30, 20, 40, 70, 60, 80 — demonstra o percurso em pré-ordem (pre-order).', 'is_correct' => false],
                    ['text' => '20, 40, 30, 60, 80, 70, 50 — demonstra o percurso em pós-ordem (post-order).', 'is_correct' => false],
                    ['text' => '20, 30, 40, 50, 60, 70, 80 — demonstra que o percurso em-ordem de uma ABB retorna os elementos em ordem crescente.', 'is_correct' => true],
                    ['text' => '80, 70, 60, 50, 40, 30, 20 — demonstra o percurso em-ordem reverso da ABB.', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'Na Álgebra de Boole, aplicando os Teoremas de De Morgan, qual é a expressão equivalente a NOT(A AND B AND C)?',
                'year'        => 2019,
                'component'   => 'Específico',
                'explanation' => 'O Teorema de De Morgan generalizado: NOT(A AND B AND C) = NOT(A) OR NOT(B) OR NOT(C). Formalmente: ¬(A ∧ B ∧ C) = ¬A ∨ ¬B ∨ ¬C. Esse resultado corresponde diretamente a uma porta NAND de 3 entradas, que é implementada eficientemente em circuitos digitais. Os teoremas de De Morgan permitem converter entre implementações AND/OR usando portas universais NAND ou NOR.',
                'alternatives' => [
                    ['text' => 'NOT(A) AND NOT(B) AND NOT(C)', 'is_correct' => false],
                    ['text' => 'NOT(A) OR NOT(B) OR NOT(C)', 'is_correct' => true],
                    ['text' => 'A OR B OR C', 'is_correct' => false],
                    ['text' => 'NOT(A OR B OR C)', 'is_correct' => false],
                    ['text' => 'NOT(A) AND (B OR C)', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'Em aprendizado de máquina, sobre a divisão dos dados em treinamento, validação e teste:

I. O conjunto de treinamento é usado para ajustar os parâmetros internos (pesos) do modelo durante a otimização.
II. O conjunto de validação é utilizado para selecionar hiperparâmetros e monitorar overfitting durante o treinamento.
III. O conjunto de teste deve ser consultado repetidamente durante o desenvolvimento para guiar as decisões de modelagem.

Estão corretas apenas:',
                'year'        => 2023,
                'component'   => 'Específico',
                'explanation' => 'I ✓ — o training set ajusta pesos via backpropagation. II ✓ — o validation set monitora overfitting e guia a escolha de hiperparâmetros. III ✗ — o test set deve ser usado APENAS UMA VEZ ao final; usá-lo repetidamente causa data leakage implícito e estimativas otimistas do desempenho real.',
                'alternatives' => [
                    ['text' => 'I, apenas.', 'is_correct' => false],
                    ['text' => 'III, apenas.', 'is_correct' => false],
                    ['text' => 'I e II, apenas.', 'is_correct' => true],
                    ['text' => 'II e III, apenas.', 'is_correct' => false],
                    ['text' => 'I, II e III.', 'is_correct' => false],
                ],
            ],
        ];
    }

    // ═══════════════════════════════════════════════════════
    //  CIÊNCIA DA COMPUTAÇÃO — 5 questões
    // ═══════════════════════════════════════════════════════
    private function cienciaComp(): array
    {
        return [
            [
                'statement'   => 'Em Teoria da Computação, um Autômato Finito Determinístico (AFD) M = (Q, Σ, δ, q0, F) reconhece uma linguagem L(M). Sobre a relação entre autômatos finitos e linguagens formais, avalie:

I. Todo Autômato Finito Não-Determinístico (AFND) pode ser convertido em um AFD equivalente que reconhece a mesma linguagem, embora o AFD possa ter mais estados.
II. As linguagens reconhecidas por autômatos finitos são exatamente as linguagens regulares, que formam a classe mais ampla da Hierarquia de Chomsky.
III. Uma linguagem que não pode ser reconhecida por nenhum autômato finito pode, ainda assim, ser reconhecida por uma Máquina de Turing.

É correto o que se afirma em:',
                'year'        => 2021,
                'component'   => 'Específico',
                'explanation' => 'I ✓ — pelo Teorema da Equivalência AFD-AFND (construção de subconjuntos), todo AFND tem um AFD equivalente, possivelmente com 2^n estados. II ✗ — as linguagens regulares são a classe MENOS ampla da Hierarquia de Chomsky (Tipo 3), não a mais ampla. A hierarquia é: regulares ⊂ livres de contexto ⊂ sensíveis ao contexto ⊂ recursivamente enumeráveis. III ✓ — linguagens não-regulares (como {aⁿbⁿ | n≥0}) podem ser reconhecidas por máquinas mais poderosas, como APs (linguagens livres de contexto) e Máquinas de Turing.',
                'alternatives' => [
                    ['text' => 'I, apenas.', 'is_correct' => false],
                    ['text' => 'II, apenas.', 'is_correct' => false],
                    ['text' => 'I e II, apenas.', 'is_correct' => false],
                    ['text' => 'I e III, apenas.', 'is_correct' => true],
                    ['text' => 'I, II e III.', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'No processo de compilação de um programa, as fases são realizadas em sequência. Considere as seguintes afirmativas sobre as fases de análise (front-end) de um compilador:

I. A análise léxica (scanning) é responsável por agrupar sequências de caracteres em tokens, ignorando espaços e comentários.
II. A análise sintática (parsing) verifica se a sequência de tokens está de acordo com a gramática da linguagem, construindo uma Árvore Sintática Abstrata (AST).
III. A análise semântica verifica aspectos como compatibilidade de tipos e declaração de variáveis antes do uso, o que não pode ser verificado apenas pela gramática livre de contexto.

Está correto o que se afirma em:',
                'year'        => 2019,
                'component'   => 'Específico',
                'explanation' => 'I ✓ — o scanner/lexer agrupa caracteres em tokens (identificadores, literais, operadores) e descarta whitespace e comentários. II ✓ — o parser verifica a estrutura sintática contra a gramática (BNF/EBNF) e constrói a AST. III ✓ — a análise semântica verifica regras que gramáticas livres de contexto não capturam: tipos, escopo, uso antes de declaração. Todas as afirmativas estão corretas.',
                'alternatives' => [
                    ['text' => 'I, apenas.', 'is_correct' => false],
                    ['text' => 'I e II, apenas.', 'is_correct' => false],
                    ['text' => 'II e III, apenas.', 'is_correct' => false],
                    ['text' => 'I e III, apenas.', 'is_correct' => false],
                    ['text' => 'I, II e III.', 'is_correct' => true],
                ],
            ],
            [
                'statement'   => 'Em algoritmos de busca em grafos, a Busca em Largura (BFS) e a Busca em Profundidade (DFS) possuem características distintas. Sobre essas duas estratégias, avalie:

I. A BFS utiliza uma fila (FIFO) como estrutura auxiliar e garante encontrar o caminho de menor número de arestas entre a origem e qualquer vértice em grafos não ponderados.
II. A DFS utiliza uma pilha (LIFO) — implicitamente pela recursão ou explicitamente — e é adequada para detectar ciclos e calcular a ordenação topológica de grafos dirigidos acíclicos (DAGs).
III. Para grafos com pesos negativos nas arestas, tanto BFS quanto DFS garantem encontrar o caminho de custo mínimo entre dois vértices.

É correto apenas o que se afirma em:',
                'year'        => 2023,
                'component'   => 'Específico',
                'explanation' => 'I ✓ — BFS explora camada por camada; em grafo não ponderado, a primeira vez que um vértice é descoberto corresponde ao caminho com menor nº de arestas. II ✓ — DFS usa pilha; é a base para detecção de ciclos (via back edges) e ordenação topológica (DFS reversa ou algoritmo de Kahn). III ✗ — nem BFS nem DFS garantem custo mínimo em grafos ponderados; para isso usa-se Dijkstra (pesos não-negativos) ou Bellman-Ford (pesos negativos).',
                'alternatives' => [
                    ['text' => 'I, apenas.', 'is_correct' => false],
                    ['text' => 'III, apenas.', 'is_correct' => false],
                    ['text' => 'I e III, apenas.', 'is_correct' => false],
                    ['text' => 'II e III, apenas.', 'is_correct' => false],
                    ['text' => 'I e II, apenas.', 'is_correct' => true],
                ],
            ],
            [
                'statement'   => 'Os paradigmas de programação definem diferentes formas de estruturar e raciocinar sobre programas. Associe corretamente cada paradigma às suas características:

I. No paradigma funcional, funções são cidadãs de primeira classe, imutabilidade é incentivada e efeitos colaterais são evitados, tendo como base o cálculo lambda.
II. No paradigma lógico, programas são expressos como fatos e regras em lógica de predicados, e a execução consiste em provar objetivos por meio de unificação e backtracking.
III. No paradigma imperativo orientado a objetos, o estado do programa é encapsulado em objetos e modificado por meio de mensagens (chamadas de métodos).

Está correto o que se afirma em:',
                'year'        => 2021,
                'component'   => 'Específico',
                'explanation' => 'I ✓ — paradigma funcional (Haskell, Erlang, Clojure): funções puras, imutabilidade, base no cálculo-λ de Church. II ✓ — paradigma lógico (Prolog): fatos + regras em lógica de predicados de primeira ordem; execução via unificação e backtracking. III ✓ — paradigma OO (Java, C++, Python): estado encapsulado em objetos, interação por mensagens/métodos. Todas corretas.',
                'alternatives' => [
                    ['text' => 'I, apenas.', 'is_correct' => false],
                    ['text' => 'I e II, apenas.', 'is_correct' => false],
                    ['text' => 'II e III, apenas.', 'is_correct' => false],
                    ['text' => 'I e III, apenas.', 'is_correct' => false],
                    ['text' => 'I, II e III.', 'is_correct' => true],
                ],
            ],
            [
                'statement'   => 'A computação quântica representa um novo paradigma de processamento de informação. Sobre os fundamentos da computação quântica e suas diferenças em relação à computação clássica, é correto afirmar que:',
                'year'        => 2023,
                'component'   => 'Específico',
                'explanation' => 'O qubit pode existir em superposição de estados |0⟩ e |1⟩ simultaneamente (diferente do bit clássico que é 0 OU 1). O entrelaçamento quântico (entanglement) permite que qubits correlacionados afetem uns aos outros instantaneamente, mesmo a distância. O algoritmo de Shor (fatoração polinomial) quebraria a criptografia RSA em computadores quânticos suficientemente grandes. O algoritmo de Grover oferece busca em O(√n) vs O(n) clássico — speedup quadrático, não exponencial.',
                'alternatives' => [
                    ['text' => 'Um qubit só pode assumir os valores 0 ou 1, assim como um bit clássico, mas processa múltiplos cálculos em paralelo por ter frequência de clock superior.', 'is_correct' => false],
                    ['text' => 'O entrelaçamento quântico (entanglement) permite que qubits correlacionados sejam medidos independentemente, sem qualquer influência mútua.', 'is_correct' => false],
                    ['text' => 'Um qubit pode existir em superposição de |0⟩ e |1⟩ simultaneamente; o algoritmo de Shor explora isso para fatorar inteiros em tempo polinomial, ameaçando a criptografia RSA.', 'is_correct' => true],
                    ['text' => 'O algoritmo de Grover oferece speedup exponencial sobre algoritmos clássicos de busca em listas não ordenadas.', 'is_correct' => false],
                    ['text' => 'Computadores quânticos já substituem os computadores clássicos em todas as tarefas computacionais, pois são universalmente mais eficientes.', 'is_correct' => false],
                ],
            ],
        ];
    }

    // ═══════════════════════════════════════════════════════
    //  SISTEMAS DE INFORMAÇÃO — 5 questões
    // ═══════════════════════════════════════════════════════
    private function sistemasInfo(): array
    {
        return [
            [
                'statement'   => 'Os Sistemas de Planejamento de Recursos Empresariais (ERP) integram processos de negócio em uma única plataforma. Sobre as características e implicações da adoção de sistemas ERP nas organizações, avalie:

I. Um ERP integra diferentes módulos (financeiro, RH, estoque, vendas) em um banco de dados centralizado, eliminando a redundância e inconsistência de dados entre departamentos.
II. A customização extensiva de um ERP para adaptar-se 100% aos processos da empresa é sempre recomendada, pois garante total aderência às necessidades do negócio.
III. A implementação de um ERP envolve necessariamente a reengenharia de alguns processos de negócio, pois o sistema impõe boas práticas e fluxos padronizados do setor.

É correto o que se afirma em:',
                'year'        => 2021,
                'component'   => 'Específico',
                'explanation' => 'I ✓ — banco de dados centralizado é a característica definidora do ERP, garantindo fonte única de verdade. II ✗ — customizações extensivas são problemáticas: dificultam atualizações, aumentam custo de manutenção e podem introduzir bugs. A prática recomendada é adaptar os processos ao ERP (best practices do setor), não o contrário. III ✓ — implementar um ERP normalmente exige reengenharia de processos (BPR) para alinhar com os fluxos padronizados do sistema.',
                'alternatives' => [
                    ['text' => 'I, apenas.', 'is_correct' => false],
                    ['text' => 'II, apenas.', 'is_correct' => false],
                    ['text' => 'I e II, apenas.', 'is_correct' => false],
                    ['text' => 'I e III, apenas.', 'is_correct' => true],
                    ['text' => 'I, II e III.', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'A notação BPMN (Business Process Model and Notation) é um padrão amplamente utilizado para modelagem de processos de negócio. Sobre os elementos e uso do BPMN, é INCORRETO afirmar que:',
                'year'        => 2019,
                'component'   => 'Específico',
                'explanation' => 'Em BPMN, as Gateways representam pontos de decisão e ramificação do fluxo — não os participantes/responsáveis. Os participantes são representados por Pools (processo de uma organização) e Lanes (subdivisões de responsabilidade dentro do pool). Os eventos (início, intermediário, fim) representam algo que acontece no processo. Tarefas/atividades representam unidades de trabalho. A afirmativa que atribui a função de representar participantes às gateways está incorreta.',
                'alternatives' => [
                    ['text' => 'Os eventos de início (círculo simples), intermediário (círculo duplo) e fim (círculo espesso) representam ocorrências que disparam, interrompem ou finalizam um processo.', 'is_correct' => false],
                    ['text' => 'As Gateways (losangos) são usadas para representar os participantes e responsáveis por cada etapa do processo de negócio.', 'is_correct' => true],
                    ['text' => 'Pools e Lanes permitem representar os diferentes participantes e responsabilidades dentro de um processo colaborativo entre organizações.', 'is_correct' => false],
                    ['text' => 'As tarefas (retângulos arredondados) representam unidades atômicas de trabalho realizadas por participantes humanos ou sistemas automatizados.', 'is_correct' => false],
                    ['text' => 'Os fluxos de sequência (setas sólidas) indicam a ordem de execução das atividades, enquanto os fluxos de mensagem (setas tracejadas) representam comunicação entre pools distintos.', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'A segurança da informação é sustentada por três pilares fundamentais conhecidos como a Tríade CIA. Um sistema hospitalar sofreu um ataque em que hackers criptografaram todos os arquivos de pacientes e exigiram resgate para restaurar o acesso. Qual pilar da Tríade CIA foi primariamente violado e qual tipo de ataque foi perpetrado?',
                'year'        => 2023,
                'component'   => 'Específico',
                'explanation' => 'A Tríade CIA: Confidencialidade (acesso apenas a autorizados), Integridade (dados corretos e não alterados) e Disponibilidade (sistema acessível quando necessário). No cenário descrito, os arquivos foram criptografados e o acesso foi bloqueado — o hospital não consegue acessar seus próprios dados. Isso viola primariamente a DISPONIBILIDADE. O tipo de ataque é Ransomware — malware que criptografa dados e exige resgate. Note que a confidencialidade também pode ter sido violada (os atacantes leram os dados), mas o objetivo principal e o impacto descrito é a indisponibilidade.',
                'alternatives' => [
                    ['text' => 'Integridade — ataque de injeção de SQL que corrompeu os registros dos pacientes no banco de dados.', 'is_correct' => false],
                    ['text' => 'Confidencialidade — ataque de phishing que capturou credenciais dos médicos e expôs os prontuários.', 'is_correct' => false],
                    ['text' => 'Disponibilidade — ataque de ransomware que criptografou os arquivos e bloqueou o acesso aos dados hospitalares.', 'is_correct' => true],
                    ['text' => 'Integridade — ataque man-in-the-middle que alterou dados de exames durante a transmissão entre sistemas.', 'is_correct' => false],
                    ['text' => 'Confidencialidade — ataque DDoS que sobrecarregou os servidores e impediu o acesso ao sistema por horas.', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'Em sistemas de banco de dados, as propriedades ACID garantem a confiabilidade das transações. Uma transação bancária transfere R$ 1.000,00 da conta A para a conta B. Durante a execução, após debitar a conta A, o servidor falha antes de creditar a conta B. Qual propriedade ACID garante que, ao reiniciar, o sistema desfará o débito na conta A, deixando ambas as contas no estado anterior à transação?',
                'year'        => 2021,
                'component'   => 'Específico',
                'explanation' => 'As propriedades ACID: (A) Atomicidade — a transação é tudo ou nada; (C) Consistência — transação leva o BD de um estado consistente a outro; (I) Isolamento — transações concorrentes não interferem; (D) Durabilidade — após commit, mudanças persistem mesmo com falha. No cenário, a falha ocorre após operação parcial (débito sem crédito). A ATOMICIDADE garante que a transação incompleta seja desfeita (rollback) no restart, restaurando o estado original. O SGBD usa logs de transação (WAL — Write-Ahead Logging) para implementar o rollback.',
                'alternatives' => [
                    ['text' => 'Consistência, pois garante que o banco de dados sempre permaneça em um estado válido antes e após a transação.', 'is_correct' => false],
                    ['text' => 'Isolamento, pois impede que outras transações leiam o estado intermediário da transferência em andamento.', 'is_correct' => false],
                    ['text' => 'Atomicidade, pois garante que a transação seja tratada como uma unidade indivisível — ou executa completamente ou é inteiramente desfeita.', 'is_correct' => true],
                    ['text' => 'Durabilidade, pois assegura que os dados gravados antes da falha sejam preservados e não se percam.', 'is_correct' => false],
                    ['text' => 'Consistência e Isolamento em conjunto, pois ambas são necessárias para garantir a integridade referencial em transações financeiras.', 'is_correct' => false],
                ],
            ],
            [
                'statement'   => 'A Governança de TI refere-se ao sistema pelo qual o uso atual e futuro da Tecnologia da Informação é dirigido e controlado. Sobre os frameworks e boas práticas de Governança de TI, avalie:

I. O COBIT (Control Objectives for Information and Related Technologies) é um framework de governança de TI focado em alinhar a TI com os objetivos de negócio, gerenciar riscos e garantir a conformidade.
II. O ITIL (Information Technology Infrastructure Library) é um conjunto de boas práticas para o gerenciamento de serviços de TI, com foco na entrega de valor ao negócio por meio de serviços bem definidos.
III. A Governança de TI é responsabilidade exclusiva do departamento de TI da organização, não envolvendo a alta administração ou o conselho de diretores.

É correto apenas o que se afirma em:',
                'year'        => 2019,
                'component'   => 'Específico',
                'explanation' => 'I ✓ — COBIT (ISACA) é framework de governança e gestão de TI corporativa, alinhando TI a objetivos estratégicos do negócio. II ✓ — ITIL é biblioteca de boas práticas para gerenciamento de serviços de TI (ITSM), focada no ciclo de vida do serviço. III ✗ — a Governança de TI é responsabilidade da ALTA ADMINISTRAÇÃO (board, C-level), não apenas do departamento de TI. ISO/IEC 38500 e COBIT explicitam que a governança de TI deve ser exercida pelo board e executivos seniores.',
                'alternatives' => [
                    ['text' => 'I, apenas.', 'is_correct' => false],
                    ['text' => 'III, apenas.', 'is_correct' => false],
                    ['text' => 'I e III, apenas.', 'is_correct' => false],
                    ['text' => 'I e II, apenas.', 'is_correct' => true],
                    ['text' => 'I, II e III.', 'is_correct' => false],
                ],
            ],
        ];
    }
}
