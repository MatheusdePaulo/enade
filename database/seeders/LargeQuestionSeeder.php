<?php

namespace Database\Seeders;

use App\Models\Alternative;
use App\Models\Course;
use App\Models\Question;
use Illuminate\Database\Seeder;

class LargeQuestionSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->data() as [$courseName, $questions]) {
            $course = Course::firstOrCreate(['name' => $courseName]);
            foreach ($questions as $q) {
                $question = Question::create([
                    'statement'   => $q['s'],
                    'year'        => $q['y'],
                    'course_id'   => $course->id,
                    'component'   => $q['c'],
                    'explanation' => $q['e'],
                ]);
                foreach ($q['a'] as $i => $alt) {
                    Alternative::create([
                        'text'        => $alt[0],
                        'is_correct'  => $alt[1],
                        'question_id' => $question->id,
                    ]);
                }
            }
        }
    }

    private function data(): array
    {
        return [
            ['Jornalismo',             $this->jornalismo()],
            ['Direito',                $this->direito()],
            ['Administração',          $this->administracao()],
            ['Psicologia',             $this->psicologia()],
            ['Pedagogia',              $this->pedagogia()],
            ['Enfermagem',             $this->enfermagem()],
            ['Arquitetura e Urbanismo',$this->arquitetura()],
            ['Ciência da Computação',  $this->cienciaComp()],
            ['Sistemas de Informação', $this->sistemasInfo()],
            ['Análise e Desenvolvimento de Sistemas', $this->ads()],
            ['Engenharia de Software', $this->engSoftware()],
        ];
    }

    // ── helpers ────────────────────────────────────────────────
    private function q(string $s, int $y, string $c, string $e, array $a): array
    {
        return ['s' => $s, 'y' => $y, 'c' => $c, 'e' => $e, 'a' => $a];
    }

    // ── JORNALISMO ─────────────────────────────────────────────
    private function jornalismo(): array { return [
        $this->q(
            'O Código de Ética dos Jornalistas Brasileiros (aprovado pela FENAJ em 2007) estabelece como dever fundamental do jornalista a divulgação de informações precisas e verificadas. Sobre o princípio da veracidade jornalística, é correto afirmar que:',
            2021, 'Específico',
            'O Código de Ética dos Jornalistas Brasileiros proíbe o jornalista de divulgar informações falsas ou inverídicas, obrigando-o a apurar os fatos antes de publicá-los. O princípio da veracidade não exige certeza absoluta — o jornalista deve informar ao público quando há incerteza — mas proíbe a publicação consciente de mentiras. A retificação é obrigatória quando erros são descobertos após a publicação.',
            [['Garante ao jornalista o direito de publicar informações sem verificação prévia quando há urgência informativa.', false],
             ['Obriga o jornalista a verificar os fatos antes de publicar e a corrigir publicamente erros cometidos.', true],
             ['Permite a publicação de boatos e rumores desde que identificados como tais.', false],
             ['Restringe-se apenas a matérias de interesse público, não se aplicando ao entretenimento.', false],
             ['Só se aplica ao jornalismo impresso, sendo opcional para jornalistas digitais.', false]]
        ),
        $this->q(
            'A convergência midiática, conceito desenvolvido por Henry Jenkins, transformou o ecossistema jornalístico contemporâneo. Analise as afirmações:

I. A convergência midiática implica apenas a unificação tecnológica das plataformas de distribuição de conteúdo.
II. No contexto da convergência, o jornalismo multiplataforma exige que o repórter produza conteúdo adaptado às especificidades de cada suporte (texto, áudio, vídeo, interativo).
III. A convergência promoveu o surgimento do jornalismo participativo, no qual o público deixa de ser receptor passivo e passa a contribuir com a produção de informação.

É correto afirmar que:',
            2023, 'Específico',
            'Jenkins define convergência como fluxo de conteúdos por múltiplas plataformas, cooperação entre mercados e comportamento migratório dos públicos. A afirmativa I está errada: convergência não é apenas tecnológica — é cultural, empresarial e de conteúdo. A II está correta: o jornalismo multiplataforma exige adaptação editorial a cada suporte. A III está correta: a convergência democratizou a produção de informação, criando o "prosumer" (produtor-consumidor) e o jornalismo cidadão.',
            [['Apenas I está correta.', false],
             ['Apenas II está correta.', false],
             ['Apenas I e III estão corretas.', false],
             ['Apenas II e III estão corretas.', true],
             ['I, II e III estão corretas.', false]]
        ),
        $this->q(
            'O jornalismo investigativo diferencia-se do jornalismo cotidiano por suas características metodológicas específicas. Qual das seguintes características é ESSENCIAL e define o jornalismo investigativo?',
            2019, 'Específico',
            'O jornalismo investigativo caracteriza-se principalmente pela iniciativa do próprio veículo/repórter em revelar fatos que alguém quer manter oculto, pela profundidade de apuração com cruzamento de diversas fontes e documentos, e pelo impacto público de suas denúncias. Difere-se do factual por não apenas registrar eventos, mas investigar causas, responsáveis e consequências. O investigativo frequentemente envolve grande trabalho com dados públicos, documentos vazados e fontes protegidas.',
            [['A publicação imediata dos fatos assim que descobertos, sem aguardar confirmação de fontes adicionais.', false],
             ['A cobertura de eventos do cotidiano com maior profundidade de análise e contextualização histórica.', false],
             ['A revelação sistemática de informações que alguém quer manter ocultas, por meio de apuração rigorosa com múltiplas fontes e documentos.', true],
             ['O uso exclusivo de fontes oficiais e documentos governamentais para garantir credibilidade.', false],
             ['A necessidade de aprovação prévia da pauta por um editor especializado em investigação.', false]]
        ),
        $this->q(
            'A Lei de Acesso à Informação (Lei nº 12.527/2011) é uma ferramenta fundamental para o jornalismo investigativo no Brasil. Sobre os direitos e obrigações estabelecidos por essa lei, avalie:

I. Todo cidadão pode solicitar informações a órgãos públicos sem necessidade de justificar o pedido.
II. Os órgãos públicos têm prazo máximo de 20 dias (prorrogável por mais 10) para responder às solicitações.
III. Informações sigilosas classificadas como "ultrassecretas" nunca poderão ser divulgadas.

Está correto apenas o que se afirma em:',
            2021, 'Geral',
            'I ✓ — Art. 10, §3º da LAI: o solicitante não é obrigado a informar os motivos do pedido. II ✓ — Art. 11: prazo de 20 dias prorrogável por mais 10 mediante justificativa. III ✗ — Informações classificadas têm prazo máximo de sigilo (ultrassecreto: até 25 anos, prorrogável uma vez), mas após o prazo tornam-se públicas. Nenhuma informação pode ser sigilosa para sempre, conforme a LAI e o princípio da publicidade constitucional.',
            [['Apenas I.', false],
             ['Apenas I e II.', true],
             ['Apenas II e III.', false],
             ['Apenas III.', false],
             ['I, II e III.', false]]
        ),
        $this->q(
            'Os gêneros jornalísticos organizam as diferentes formas de narrar e interpretar a realidade. Assinale a alternativa que apresenta corretamente a característica do gênero opinativo denominado "editorial":',
            2019, 'Específico',
            'O editorial é o texto opinativo oficial do veículo de comunicação — expressa a posição institucional da empresa jornalística sobre temas relevantes. Não é assinado por jornalistas individuais (o autor é o veículo). Diferencia-se da coluna (assinada por colunistas), do artigo (texto de especialistas externos), da crônica (gênero literário-jornalístico) e da nota (informação breve sem opinião institucional).',
            [['Texto assinado por jornalista especializado que expressa sua opinião pessoal sobre temas de interesse público.', false],
             ['Texto não assinado que expressa a posição oficial e institucional do veículo de comunicação sobre temas relevantes.', true],
             ['Texto de especialista externo convidado pelo veículo para comentar temas de sua área de conhecimento.', false],
             ['Texto breve que relata fato recente sem comentários avaliativos, inserido na seção de opinião.', false],
             ['Texto de entretenimento que mistura realidade e ficção, publicado nos finais de semana.', false]]
        ),
        $this->q(
            'O fenômeno das fake news representa um dos maiores desafios para o jornalismo contemporâneo. Do ponto de vista jornalístico e democrático, qual é a principal distinção entre "desinformação" (disinformation) e "malinformação" (malinformation)?',
            2023, 'Específico',
            'A pesquisadora Claire Wardle (First Draft) distingue três categorias: (1) Misinformation: informação falsa sem intenção de causar dano; (2) Disinformation: informação falsa criada e disseminada com intenção deliberada de enganar; (3) Malinformation: informação verdadeira divulgada com intenção de causar dano (ex: vazamento de dados privados, informações fora de contexto). A distinção é importante para o jornalismo porque define as estratégias de resposta e verificação (fact-checking).',
            [['Desinformação usa tecnologia deepfake; malinformação usa apenas texto escrito.', false],
             ['Desinformação é produzida por bots; malinformação é produzida exclusivamente por políticos.', false],
             ['Desinformação envolve conteúdo falso criado para enganar; malinformação usa informação verdadeira com intenção de causar dano.', true],
             ['Desinformação circula em redes sociais; malinformação só aparece na mídia tradicional.', false],
             ['Desinformação afeta apenas eleições; malinformação afeta apenas a saúde pública.', false]]
        ),
        $this->q(
            'O telejornalismo brasileiro passou por transformações significativas desde o surgimento do Jornal Nacional (Rede Globo, 1969). Sobre as características do gênero telejornalístico e sua linguagem específica, é correto afirmar:',
            2021, 'Específico',
            'O telejornalismo utiliza linguagem predominantemente coloquial e acessível (diferente do impresso), combinando imagem, som e texto em narrativa audiovisual. O off (texto narrado pelo repórter sobre imagens) e a passagem (aparição do repórter em câmera no local do fato) são recursos específicos do gênero. A pirâmide invertida adaptada para TV privilegia a imagem como elemento narrativo central. A edição de vídeo é fundamental para a construção da narrativa telejornalística.',
            [['O telejornalismo utiliza linguagem técnica e especializada para demonstrar credibilidade ao espectador.', false],
             ['A imagem no telejornalismo é apenas ilustrativa do texto narrado, sem valor narrativo próprio.', false],
             ['O telejornalismo combina linguagem coloquial, imagem, som e texto, sendo a passagem e o off recursos narrativos centrais do gênero.', true],
             ['O formato telejornalístico é invariável, não permitindo adaptações às diferentes plataformas digitais.', false],
             ['O âncora do telejornalismo deve sempre evitar opiniões, diferenciando-se completamente do jornalista impresso.', false]]
        ),
        $this->q(
            'A concentração de propriedade dos meios de comunicação é um tema central na economia política da comunicação. Sobre os impactos da concentração midiática para a democracia e o pluralismo informativo no Brasil, avalie:

I. A concentração midiática em poucos grupos empresariais pode limitar a pluralidade de vozes e perspectivas no espaço público.
II. O Brasil é considerado um dos países com maior concentração de propriedade midiática da América Latina, com grupos familiares controlando múltiplas emissoras.
III. A regulação da propriedade cruzada (mesmo grupo controlando jornal, TV e rádio na mesma praça) é proibida de forma absoluta pela Constituição Federal de 1988.

Está correto apenas o que se afirma em:',
            2023, 'Geral',
            'I ✓ — a concentração midiática limita o pluralismo, pois poucos grupos editoriais controlam a agenda e o enquadramento das notícias. II ✓ — o Brasil tem alta concentração midiática, com grupos como Globo, Record e SBT dominando audiências. III ✗ — a CF/88 (Art. 220) estabelece que a lei regulará as comunicações, mas a regulação da propriedade cruzada não é proibição absoluta constitucional — é matéria de legislação ordinária (que historicamente foi pouco regulada no Brasil).',
            [['Apenas I.', false],
             ['Apenas I e II.', true],
             ['Apenas II.', false],
             ['Apenas I e III.', false],
             ['I, II e III.', false]]
        ),
        $this->q(
            'O jornalismo de dados (data journalism) emergiu como uma nova especialidade jornalística impulsionada pela disponibilidade de grandes bases de dados públicos. Qual das seguintes práticas caracteriza CORRETAMENTE o jornalismo de dados?',
            2023, 'Específico',
            'O jornalismo de dados envolve coleta, limpeza, análise e visualização de grandes conjuntos de dados para encontrar padrões, tendências e histórias que não seriam visíveis na cobertura factual tradicional. Ferramentas como Python, R, Excel avançado e softwares de visualização (Flourish, Datawrapper) são utilizadas. O Guardian, NYT e, no Brasil, a Agência Pública são referências. Diferencia-se do jornalismo tradicional pela metodologia baseada em evidências quantitativas.',
            [['Consiste na publicação de infográficos estáticos para ilustrar matérias já apuradas por métodos tradicionais.', false],
             ['Limita-se à cobertura de temas econômicos e financeiros, onde os dados numéricos são naturalmente abundantes.', false],
             ['Envolve coleta, análise e visualização de grandes conjuntos de dados para revelar padrões e histórias de interesse público não evidentes na cobertura factual.', true],
             ['Exige que o jornalista seja programador profissional, sendo inacessível a profissionais sem formação técnica em TI.', false],
             ['É sinônimo de jornalismo científico, diferenciando-se apenas pela plataforma de publicação.', false]]
        ),
        $this->q(
            'A Teoria do Agendamento (Agenda-Setting), desenvolvida por Maxwell McCombs e Donald Shaw (1972), é uma das teorias fundamentais do jornalismo. Qual é a tese central desta teoria?',
            2019, 'Específico',
            'A teoria do agendamento (agenda-setting) propõe que a mídia não diz às pessoas o que pensar, mas sobre o que pensar — transferindo a saliência de temas da agenda midiática para a agenda pública. McCombs e Shaw estudaram a eleição presidencial americana de 1968 em Chapel Hill. Posteriormente, desenvolveram o segundo nível do agendamento (framing/enquadramento): não apenas quais temas, mas como esses temas devem ser percebidos. É diferente da teoria hipodérmica (efeitos diretos) e da teoria crítica (dominação ideológica).',
            [['A mídia manipula diretamente a opinião pública, determinando tanto o que as pessoas pensam quanto como pensam sobre os temas.', false],
             ['A mídia não influencia a opinião pública; cada receptor reinterpreta as mensagens conforme sua cultura e experiência.', false],
             ['A mídia determina quais temas ganham destaque na consciência pública, influenciando a relevância percebida dos assuntos.', true],
             ['A mídia reflete passivamente a realidade social sem interferir na percepção do público sobre os acontecimentos.', false],
             ['A mídia serve exclusivamente aos interesses das classes dominantes, reproduzindo a ideologia hegemônica sem resistência.', false]]
        ),
    ]; }

    // ── DIREITO ────────────────────────────────────────────────
    private function direito(): array { return [
        $this->q(
            'A Constituição Federal de 1988 consagrou um amplo rol de direitos fundamentais. Sobre a teoria dos direitos fundamentais e sua aplicação no ordenamento jurídico brasileiro, avalie:

I. Os direitos fundamentais possuem aplicabilidade imediata, conforme o Art. 5º, §1º da CF/88.
II. Os direitos fundamentais são absolutos e não admitem restrições em nenhuma hipótese.
III. O princípio da proporcionalidade (adequação, necessidade e proporcionalidade em sentido estrito) é utilizado para resolver colisões entre direitos fundamentais.

Está correto apenas o que se afirma em:',
            2021, 'Específico',
            'I ✓ — Art. 5º, §1º, CF/88: as normas definidoras de direitos e garantias fundamentais têm aplicabilidade imediata. II ✗ — não existem direitos absolutamente ilimitados (exceto, possivelmente, a dignidade da pessoa humana como núcleo duro); a maioria dos direitos admite restrições proporcionais. III ✓ — o princípio da proporcionalidade (Verhältnismäßigkeit, desenvolvido pelo TCF alemão) é o principal método de resolução de colisões entre direitos fundamentais, adotado pelo STF.',
            [['Apenas I.', false],
             ['Apenas I e III.', true],
             ['Apenas II.', false],
             ['Apenas II e III.', false],
             ['I, II e III.', false]]
        ),
        $this->q(
            'No Direito Civil brasileiro (Código Civil de 2002), a teoria contratual é regida por princípios que renovaram o sistema clássico do século XIX. Sobre os princípios contratuais contemporâneos, qual alternativa os apresenta CORRETAMENTE?',
            2021, 'Específico',
            'O CC/2002 adotou a teoria social dos contratos, acrescentando à autonomia privada (clássica) os princípios da boa-fé objetiva (Art. 422 — dever de agir com lealdade, probidade e colaboração), da função social do contrato (Art. 421 — o contrato não pode prejudicar terceiros e deve atender ao interesse social) e do equilíbrio contratual (vedação à onerosidade excessiva — Arts. 478-480). A boa-fé objetiva gera deveres acessórios: informação, cooperação, proteção e lealdade.',
            [['Autonomia privada absoluta, pacta sunt servanda irrestrito e relatividade dos efeitos.', false],
             ['Boa-fé objetiva, função social do contrato e equilíbrio econômico entre as prestações.', true],
             ['Supremacia da ordem pública sobre qualquer acordo privado, vedando contratos atípicos.', false],
             ['Liberdade contratual irrestrita, desde que as partes sejam capazes e o objeto seja lícito.', false],
             ['Boa-fé subjetiva (intenção das partes) como único critério de validade contratual.', false]]
        ),
        $this->q(
            'A teoria do crime no Direito Penal brasileiro adota a estrutura analítica tripartida. Sobre os elementos do crime, identifique a sequência correta:',
            2019, 'Específico',
            'O finalismo de Hans Welzel (adotado pelo CP brasileiro) estrutura o crime em: (1) Fato típico — conduta, resultado, nexo causal e tipicidade (adequação da conduta ao tipo penal); (2) Ilicitude (antijuridicidade) — ausência de causa excludente (legítima defesa, estado de necessidade, estrito cumprimento do dever legal, exercício regular de direito); (3) Culpabilidade — imputabilidade, potencial consciência da ilicitude e exigibilidade de conduta diversa. Para Zaffaroni: tipo, antijuridicidade e culpabilidade (com imputabilidade na culpabilidade).',
            [['Tipicidade, culpabilidade e punibilidade.', false],
             ['Fato típico, ilicitude e culpabilidade.', true],
             ['Conduta, dolo e nexo causal.', false],
             ['Tipicidade formal, tipicidade material e imputabilidade.', false],
             ['Ação, resultado e nexo causal.', false]]
        ),
        $this->q(
            'O princípio do devido processo legal (due process of law) é garantia constitucional fundamental no processo brasileiro. Sobre suas dimensões, avalie:

I. O devido processo legal formal assegura que o processo siga os procedimentos previstos em lei (contraditório, ampla defesa, juiz natural).
II. O devido processo legal substantivo (substancial) permite ao Judiciário controlar o mérito e a razoabilidade das leis e dos atos do Estado.
III. O contraditório e a ampla defesa são garantias exclusivas do processo penal, não se aplicando ao processo civil.

Está correto apenas:',
            2023, 'Específico',
            'I ✓ — o devido processo legal formal (procedural due process) garante as regras do jogo: contraditório (Art. 5º, LV, CF/88), ampla defesa, juiz natural, proibição de provas ilícitas. II ✓ — o due process substantivo (substantive due process) permite ao Judiciário controlar a razoabilidade/proporcionalidade das normas, sendo base do controle de constitucionalidade das leis. III ✗ — o contraditório e ampla defesa (Art. 5º, LV) aplicam-se a litigantes tanto em processo judicial QUANTO em processo administrativo, sendo garantias gerais.',
            [['Apenas I.', false],
             ['Apenas I e II.', true],
             ['Apenas II e III.', false],
             ['Apenas III.', false],
             ['I, II e III.', false]]
        ),
        $this->q(
            'O Direito do Trabalho brasileiro tem como um de seus princípios fundamentais a proteção do trabalhador. Sobre os princípios trabalhistas, assinale a alternativa CORRETA:',
            2019, 'Específico',
            'O princípio protetor é o cardeal do Direito do Trabalho, desdobrando-se em: (1) in dubio pro operario — na dúvida interpretativa, favorece o trabalhador; (2) norma mais favorável — aplica-se a norma (dentre as existentes) mais benéfica ao empregado; (3) condição mais benéfica — direitos adquiridos do trabalhador não podem ser reduzidos. Esses princípios fundamentam a irrenunciabilidade dos direitos trabalhistas e a inalterabilidade contratual lesiva.',
            [['O princípio da autonomia da vontade permite que empregado e empregador negociem livremente a supressão de qualquer direito trabalhista.', false],
             ['O princípio protetor desdobra-se em in dubio pro operario, norma mais favorável e condição mais benéfica ao trabalhador.', true],
             ['O princípio da primazia da realidade determina que a forma documental do contrato sempre prevalece sobre os fatos reais.', false],
             ['O princípio da irrenunciabilidade permite ao empregado abrir mão de direitos trabalhistas em acordos individuais.', false],
             ['O princípio da continuidade da relação de emprego favorece a rescisão contratual pelo empregador a qualquer tempo.', false]]
        ),
        $this->q(
            'A hermenêutica jurídica estuda os métodos de interpretação do Direito. O método sistemático de interpretação das normas jurídicas caracteriza-se por:',
            2021, 'Específico',
            'O método sistemático interpreta a norma em conjunto com o sistema jurídico — considerando sua posição no ordenamento, sua relação com outras normas, os princípios gerais do direito e a unidade do sistema. Difere-se do literal/gramatical (texto da norma), histórico (intenção original do legislador), teleológico (finalidade da norma) e sociológico (adaptação às necessidades sociais). O STF frequentemente combina métodos, mas o sistemático-teleológico é predominante no controle de constitucionalidade.',
            [['Analisa a intenção original do legislador ao criar a norma, investigando os debates parlamentares e exposições de motivos.', false],
             ['Interpreta a norma considerando seu texto literal, sem buscar significados além das palavras empregadas.', false],
             ['Analisa a norma em relação ao conjunto do ordenamento jurídico, buscando coerência e harmonia entre os dispositivos legais.', true],
             ['Adapta o conteúdo da norma às necessidades sociais contemporâneas, independentemente do texto legal.', false],
             ['Investiga a finalidade econômica da norma para determinar sua aplicação nos casos concretos.', false]]
        ),
        $this->q(
            'O Código de Defesa do Consumidor (Lei nº 8.078/1990) estabelece a responsabilidade objetiva do fornecedor. Sobre essa responsabilidade, avalie:

I. Na responsabilidade objetiva do CDC, o consumidor deve provar a culpa ou dolo do fornecedor para obter indenização.
II. O fato do produto ou serviço (acidente de consumo) gera responsabilidade independentemente de culpa, bastando a prova do dano e do nexo causal.
III. O CDC adota a teoria do risco do empreendimento, segundo a qual quem lucra com a atividade deve responder pelos danos dela decorrentes.

Está correto o que se afirma em:',
            2023, 'Específico',
            'I ✗ — responsabilidade objetiva dispensa a prova de culpa; basta provar o dano e o nexo causal com o produto/serviço. II ✓ — Art. 12 e 14 do CDC: o fabricante/fornecedor responde objetivamente pelo fato do produto/serviço, sem necessidade de comprovação de culpa. III ✓ — o CDC adota a teoria do risco do empreendimento (ou risco criado): quem introduz produto/serviço no mercado e obtém lucro deve internalizar os riscos dessa atividade. Excludentes: fato exclusivo do consumidor/terceiro, e inexistência do defeito.',
            [['Apenas I.', false],
             ['Apenas II.', false],
             ['Apenas I e III.', false],
             ['Apenas II e III.', true],
             ['I, II e III.', false]]
        ),
        $this->q(
            'O Estatuto da Advocacia e da OAB (Lei nº 8.906/1994) estabelece direitos e deveres do advogado. Sobre a ética profissional na advocacia, qual afirmativa é CORRETA?',
            2021, 'Específico',
            'O sigilo profissional (Art. 7º, XIX e Art. 34, VII do EAOAB) é um dos pilares da advocacia — o advogado não pode revelar segredos do cliente nem ser obrigado a fazê-lo, exceto para defender-se em processo por crime de cliente contra ele mesmo. O dever de lealdade ao cliente coexiste com o dever de honestidade com a justiça. A advocacia pro bono (gratuita) é permitida e incentivada pela OAB. A captação de clientela com publicidade meramente informativa é permitida; a publicidade mercantil (propaganda) é vedada.',
            [['O advogado pode revelar segredos do cliente sempre que isso for necessário para o interesse da justiça.', false],
             ['O sigilo profissional protege as informações do cliente, só podendo ser quebrado para defender o próprio advogado de acusação do cliente.', true],
             ['É permitida qualquer forma de publicidade ao advogado, desde que aprovada previamente pela seccional da OAB.', false],
             ['O advogado deve sempre priorizar os interesses do tribunal sobre os do cliente, em razão do princípio da lealdade processual.', false],
             ['A captação de clientela por indicação de outros profissionais é expressamente proibida pelo Código de Ética.', false]]
        ),
        $this->q(
            'O controle de constitucionalidade no Brasil pode ser exercido de forma difusa ou concentrada. Sobre as diferenças entre essas modalidades, assinale a alternativa CORRETA:',
            2019, 'Específico',
            'Controle difuso (concreto): qualquer juízo/tribunal pode declarar a inconstitucionalidade incidentalmente em um caso concreto; os efeitos são inter partes (só para as partes do processo), podendo ser estendidos erga omnes por resolução do Senado (Art. 52, X, CF/88) — esta cláusula está em debate de mutação constitucional no STF. Controle concentrado (abstrato): STF (ADI, ADC, ADPF) e TJs estaduais; efeitos erga omnes e vinculantes com efeito ex tunc (regra).',
            [['No controle difuso, os efeitos da decisão de inconstitucionalidade são sempre erga omnes e vinculantes.', false],
             ['O controle concentrado é exercido exclusivamente pelo Supremo Tribunal Federal, em caráter originário.', false],
             ['No controle difuso, qualquer juiz pode reconhecer a inconstitucionalidade incidentalmente, com efeitos inter partes; no concentrado, os efeitos são erga omnes e vinculantes.', true],
             ['O controle concentrado só pode ser exercido por ação direta de inconstitucionalidade (ADI).', false],
             ['A cláusula de reserva de plenário do Art. 97 da CF/88 aplica-se exclusivamente ao controle concentrado.', false]]
        ),
        $this->q(
            'Os direitos humanos são reconhecidos internacionalmente e impõem obrigações aos Estados. Sobre o Sistema Interamericano de Direitos Humanos, ao qual o Brasil está vinculado, avalie:

I. A Convenção Americana sobre Direitos Humanos (Pacto de San José da Costa Rica, 1969) foi ratificada pelo Brasil em 1992.
II. A Corte Interamericana de Direitos Humanos pode condenar o Brasil e suas decisões têm caráter vinculante ao Estado brasileiro.
III. O Brasil nunca foi condenado pela Corte Interamericana de Direitos Humanos.

Está correto apenas:',
            2023, 'Geral',
            'I ✓ — o Brasil ratificou a Convenção Americana em 1992 (Decreto 678). II ✓ — a Corte IDH tem competência contenciosa; suas sentenças são vinculantes para o Brasil, que reconheceu a jurisdição da Corte em 1998. III ✗ — o Brasil já foi condenado diversas vezes pela Corte IDH: caso Ximenes Lopes (2006, saúde mental), caso Gomes Lund (2010, desaparecidos na Guerrilha do Araguaia), caso Herzog (2018, tortura na ditadura), entre outros.',
            [['Apenas I.', false],
             ['Apenas I e II.', true],
             ['Apenas III.', false],
             ['Apenas II e III.', false],
             ['I, II e III.', false]]
        ),
    ]; }

    // ── ADMINISTRAÇÃO ──────────────────────────────────────────
    private function administracao(): array { return [
        $this->q(
            'O planejamento estratégico é um instrumento fundamental da gestão organizacional. Sobre a análise SWOT (FOFA), ferramenta clássica do planejamento estratégico, é correto afirmar que:',
            2021, 'Específico',
            'A análise SWOT (Strengths, Weaknesses, Opportunities, Threats — Forças, Fraquezas, Oportunidades, Ameaças) é um framework de diagnóstico estratégico que analisa o ambiente interno (forças e fraquezas, controláveis) e externo (oportunidades e ameaças, não controláveis). Criada na Stanford Research Institute nos anos 1960-70. A matriz TOWS (derivada) propõe cruzamentos estratégicos: S+O (estratégias ofensivas), W+O (de reorientação), S+T (defensivas), W+T (sobrevivência).',
            [['Analisa apenas o ambiente externo à organização, identificando oportunidades de mercado e ameaças competitivas.', false],
             ['Avalia o ambiente interno (forças e fraquezas) e externo (oportunidades e ameaças) para subsidiar a formulação estratégica.', true],
             ['É utilizada exclusivamente em grandes corporações multinacionais, não sendo adequada para pequenas empresas.', false],
             ['Substitui completamente o planejamento operacional e tático, sendo suficiente para a gestão completa da empresa.', false],
             ['Considera apenas variáveis quantitativas, sendo um instrumento puramente financeiro de avaliação empresarial.', false]]
        ),
        $this->q(
            'A Teoria das Restrições (Theory of Constraints — TOC), desenvolvida por Eliyahu Goldratt, propõe uma abordagem sistêmica para a gestão organizacional. Qual é o conceito central desta teoria?',
            2019, 'Específico',
            'A TOC (Goldratt, 1984, "A Meta") propõe que todo sistema tem ao menos uma restrição (gargalo) que limita seu desempenho. O processo de melhoria contínua segue 5 passos: (1) Identificar a restrição; (2) Explorar ao máximo a restrição; (3) Subordinar tudo à decisão anterior; (4) Elevar a restrição; (5) Voltar ao passo 1. O Throughput (ganho pelo que é vendido), Inventário e Despesa Operacional são as três medidas fundamentais da TOC.',
            [['Toda organização deve maximizar a eficiência de todos os seus processos simultaneamente para aumentar a produtividade total.', false],
             ['Todo sistema possui ao menos uma restrição (gargalo) que limita seu desempenho, e a melhoria deve focar nessa restrição.', true],
             ['A qualidade total deve ser o objetivo central de qualquer organização, substituindo a visão de lucro como meta.', false],
             ['O estoque zero (just-in-time) é o único caminho para a eficiência operacional em qualquer tipo de empresa.', false],
             ['A terceirização de todas as atividades não-essenciais é a principal estratégia para eliminar restrições sistêmicas.', false]]
        ),
        $this->q(
            'O composto de marketing (marketing mix) foi desenvolvido por E. Jerome McCarthy e popularizado por Philip Kotler. Sobre os 4Ps do marketing e sua evolução para os 7Ps (em serviços), avalie:

I. Os 4Ps clássicos são: Produto, Preço, Praça (distribuição) e Promoção (comunicação).
II. A expansão para 7Ps acrescentou: Pessoas, Processos e Evidências Físicas (Physical Evidence), reconhecendo as especificidades do marketing de serviços.
III. O preço é a única variável do composto que gera receita; as demais apenas geram custos.

Está correto o que se afirma em:',
            2021, 'Específico',
            'I ✓ — 4Ps de McCarthy (1960). II ✓ — Booms e Bitner (1981) expandiram para 7Ps incluindo People (pessoas que prestam o serviço), Process (como o serviço é entregue) e Physical Evidence (tangíveis que comprovam o serviço — instalações, uniformes, certificados). III ✓ — o preço é o único elemento gerador de receita no composto; produto, praça e promoção são investimentos/custos. Essa é uma afirmação de Kotler que enfatiza a importância estratégica do pricing.',
            [['Apenas I e II.', false],
             ['Apenas I e III.', false],
             ['Apenas II e III.', false],
             ['I, II e III.', true],
             ['Apenas I.', false]]
        ),
        $this->q(
            'A Gestão de Pessoas passou por diversas transformações conceituais ao longo do século XX. Sobre as teorias motivacionais aplicadas à gestão, identifique a afirmativa CORRETA:',
            2023, 'Específico',
            'A hierarquia de necessidades de Maslow (pirâmide: fisiológicas, segurança, social/amor, estima, autorrealização) propõe que necessidades inferiores precisam ser satisfeitas antes das superiores. Herzberg (teoria dos dois fatores) distingue fatores higiênicos (ausência = insatisfação, ex: salário, condições de trabalho) dos motivacionais (presença = satisfação, ex: reconhecimento, realização). McGregor (Teoria X e Y) distingue gestores que assumem trabalhadores preguiçosos (X) dos que assumem trabalhadores motivados (Y). Vroom (expectância) baseia motivação em valência × instrumentalidade × expectativa.',
            [['Segundo Herzberg, o salário é o principal fator motivacional, sendo suficiente para gerar alta performance.', false],
             ['A teoria X de McGregor pressupõe que os trabalhadores são naturalmente motivados, criativos e responsáveis.', false],
             ['Herzberg diferencia fatores higiênicos (previnem insatisfação) dos motivacionais (geram satisfação), e salário é fator higiênico.', true],
             ['Maslow afirma que as necessidades de autorrealização devem ser atendidas antes das fisiológicas para garantir performance.', false],
             ['A teoria da expectância de Vroom considera que a motivação depende exclusivamente das recompensas financeiras oferecidas.', false]]
        ),
        $this->q(
            'A análise das demonstrações financeiras é fundamental para a tomada de decisão empresarial. Sobre os indicadores de liquidez e rentabilidade, avalie:

I. O índice de liquidez corrente (Ativo Circulante / Passivo Circulante) superior a 1 indica que a empresa possui recursos suficientes para honrar suas obrigações de curto prazo.
II. O ROE (Return on Equity — Retorno sobre o Patrimônio Líquido) mede a rentabilidade gerada para os acionistas em relação ao capital por eles investido.
III. Um alto índice de endividamento é sempre prejudicial à empresa, independentemente do custo do capital de terceiros e da rentabilidade dos ativos.

Está correto apenas:',
            2021, 'Específico',
            'I ✓ — LC > 1 significa que o ativo circulante cobre o passivo circulante; LC < 1 indica insolvência técnica de curto prazo. II ✓ — ROE = Lucro Líquido / PL; mede quanto a empresa gerou de retorno para cada real de capital próprio investido. III ✗ — o endividamento pode ser benéfico (alavancagem financeira): se o ROI (retorno sobre o investimento) for maior que o custo da dívida, o uso de capital de terceiros amplia o ROE dos acionistas. A MM (Modigliani-Miller) e a teoria do trade-off discutem os limites dessa alavancagem.',
            [['Apenas I.', false],
             ['Apenas I e II.', true],
             ['Apenas II.', false],
             ['Apenas I e III.', false],
             ['I, II e III.', false]]
        ),
        $this->q(
            'O empreendedorismo é reconhecido como motor de inovação e desenvolvimento econômico. Sobre a teoria schumpeteriana de empreendedorismo, qual é a contribuição central de Joseph Schumpeter?',
            2019, 'Geral',
            'Schumpeter (1911, "Teoria do Desenvolvimento Econômico") introduziu o conceito de destruição criativa: o capitalismo avança por ciclos de inovação onde novos produtos, processos e modelos de negócio destroem e substituem os antigos. O empreendedor schumpeteriano é o agente da inovação — não necessariamente o inventor, mas quem combina recursos de forma inédita para criar valor. As 5 formas de inovação de Schumpeter: novo produto, novo método de produção, novo mercado, nova fonte de matérias-primas, nova organização industrial.',
            [['Propôs que o empreendedorismo é uma habilidade inata, impossível de ser desenvolvida por treinamento ou educação.', false],
             ['Definiu empreendedorismo como a simples abertura de pequenas empresas locais como meio de subsistência.', false],
             ['Identificou o empreendedor como agente da destruição criativa, que inova combinando recursos de forma inédita, impulsionando o desenvolvimento econômico.', true],
             ['Limitou o empreendedorismo ao contexto de grandes corporações com departamentos de P&D formalmente estruturados.', false],
             ['Afirmou que a inovação é exclusivamente tecnológica, desconsiderando inovações de processos e modelos de negócio.', false]]
        ),
        $this->q(
            'A Responsabilidade Social Empresarial (RSE) e o conceito de ESG (Environmental, Social and Governance) tornaram-se centrais na gestão contemporânea. Sobre a evolução desses conceitos, é correto afirmar:',
            2023, 'Geral',
            'A RSE evoluiu da filantropia corporativa (doações) para a integração estratégica da sustentabilidade nos negócios. O conceito de triple bottom line (John Elkington, 1994) — People, Planet, Profit — antecede o ESG. O ESG (termo popularizado no Relatório "Who Cares Wins" do UN Global Compact, 2004) avalia empresas em: Environmental (gestão ambiental, carbono, recursos), Social (trabalhadores, comunidades, diversidade) e Governance (transparência, anti-corrupção, composição do conselho). Investidores ESG consideram esses critérios complementares ao retorno financeiro.',
            [['RSE e ESG são conceitos opostos: RSE foca no social, enquanto ESG prioriza exclusivamente questões ambientais.', false],
             ['O ESG limita-se a relatórios de sustentabilidade obrigatórios exigidos por legislação ambiental.', false],
             ['O ESG integra critérios ambientais, sociais e de governança como dimensões complementares ao retorno financeiro, avaliando o impacto amplo das empresas.', true],
             ['A responsabilidade social empresarial substitui completamente a obrigação de lucratividade das empresas.', false],
             ['O ESG aplica-se exclusivamente a empresas de capital aberto listadas em bolsas de valores.', false]]
        ),
        $this->q(
            'A gestão de supply chain (cadeia de suprimentos) é estratégica para a competitividade empresarial. O conceito de "bullwhip effect" (efeito chicote) na cadeia de suprimentos refere-se a:',
            2021, 'Específico',
            'O efeito chicote (Forrester, 1961; Lee et al., 1997) descreve o fenômeno em que pequenas variações na demanda do consumidor final são amplificadas progressivamente ao longo da cadeia de suprimentos (varejista → distribuidor → fabricante → fornecedor). Causas: previsão de demanda local, lotes mínimos de pedido, flutuação de preços e falta de informação compartilhada. Soluções: compartilhamento de dados em tempo real (VMI — Vendor Managed Inventory), redução de lotes, estabilização de preços (EDLP) e colaboração entre parceiros (CPFR).',
            [['A tendência das empresas de terceirizar a gestão logística para operadores especializados, reduzindo custos fixos.', false],
             ['A amplificação das variações de demanda ao longo da cadeia, onde pequenas oscilações no varejo geram grandes variações nos pedidos para os fornecedores.', true],
             ['O uso de tecnologia RFID para rastrear produtos ao longo de toda a cadeia de suprimentos em tempo real.', false],
             ['A estratégia de estoque zero (just-in-time) aplicada simultaneamente por todos os elos da cadeia.', false],
             ['O impacto das crises globais (pandemia, guerra) sobre a disponibilidade de matérias-primas importadas.', false]]
        ),
    ]; }

    // ── PSICOLOGIA ─────────────────────────────────────────────
    private function psicologia(): array { return [
        $this->q(
            'A psicanálise freudiana introduziu conceitos fundamentais para a compreensão do psiquismo humano. Sobre os conceitos de id, ego e superego (segunda tópica de Freud), avalie:

I. O id é a instância psíquica regida pelo princípio do prazer, que busca gratificação imediata dos impulsos.
II. O ego, regido pelo princípio da realidade, medeia as demandas do id, do superego e do mundo externo.
III. O superego representa exclusivamente as proibições morais, não incorporando os ideais positivos do sujeito.

Está correto apenas:',
            2021, 'Específico',
            'I ✓ — o id (reservatório da libido, inconsciente) opera pelo princípio do prazer — descarga imediata de tensão. II ✓ — o ego (parcialmente consciente) opera pelo princípio da realidade — posterga a satisfação considerando as condições do mundo externo. III ✗ — o superego tem duas faces: o ideal do ego (representação dos ideais positivos, de quem o sujeito quer ser) e a consciência moral (proibições, culpa). Não é apenas proibitivo — também inspira ideais.',
            [['Apenas I.', false],
             ['Apenas I e II.', true],
             ['Apenas II e III.', false],
             ['I, II e III.', false],
             ['Apenas III.', false]]
        ),
        $this->q(
            'A psicologia cognitivo-comportamental (TCC) fundamenta-se em premissas teóricas distintas da psicanálise. Qual é o pressuposto teórico central da TCC?',
            2021, 'Específico',
            'A TCC (Beck, Ellis) parte do pressuposto de que os pensamentos (cognições) influenciam as emoções e os comportamentos. As distorções cognitivas (pensamentos automáticos negativos, crenças nucleares disfuncionais) são o alvo terapêutico. O modelo ABC de Ellis: A (evento ativador) → B (crenças/pensamentos) → C (consequências emocionais/comportamentais). Diferencia-se da psicanálise (inconsciente, transferência) e do humanismo (autorrealização). A TCC é baseada em evidências e tem protocolos validados para depressão, ansiedade, TOC, TEPT.',
            [['O inconsciente é o principal determinante do comportamento, e a cura depende da rememoração de traumas infantis.', false],
             ['As cognições (pensamentos e crenças) influenciam diretamente as emoções e comportamentos, sendo o alvo central da intervenção terapêutica.', true],
             ['O comportamento humano é determinado exclusivamente pelo condicionamento ambiental, sem influência de processos mentais internos.', false],
             ['A autorrealização e o crescimento pessoal são os únicos objetivos legítimos da psicoterapia.', false],
             ['Apenas fatores biológicos e neurológicos determinam os transtornos psicológicos, tornando a psicoterapia complementar à farmacologia.', false]]
        ),
        $this->q(
            'Jean Piaget desenvolveu a teoria do desenvolvimento cognitivo, identificando estágios de desenvolvimento. Sobre a teoria piagetiana, identifique a sequência correta dos estágios e suas características principais:',
            2019, 'Específico',
            'Piaget identificou 4 estágios: (1) Sensoriomotor (0-2 anos): inteligência prática, construção do objeto permanente; (2) Pré-operatório (2-7 anos): linguagem, pensamento simbólico, egocentrismo, animismo, centração; (3) Operatório concreto (7-12 anos): operações lógicas com objetos concretos, conservação, reversibilidade, descentração; (4) Operatório formal (12+ anos): pensamento hipotético-dedutivo, abstração, raciocínio científico. Os estágios são invariantes em ordem e universais, mas o ritmo varia.',
            [['Sensoriomotor → Pré-operatório → Operatório formal → Operatório concreto.', false],
             ['Sensoriomotor → Pré-operatório → Operatório concreto → Operatório formal.', true],
             ['Pré-operatório → Sensoriomotor → Operatório concreto → Operatório formal.', false],
             ['Operatório concreto → Sensoriomotor → Pré-operatório → Operatório formal.', false],
             ['Sensoriomotor → Operatório concreto → Pré-operatório → Operatório formal.', false]]
        ),
        $this->q(
            'O Conselho Federal de Psicologia (CFP) regulamenta o exercício profissional no Brasil. Sobre o Código de Ética Profissional do Psicólogo, avalie:

I. O sigilo profissional é absoluto, nunca podendo ser quebrado em nenhuma circunstância.
II. O psicólogo pode quebrar o sigilo quando há risco de vida — do cliente ou de terceiros — comunicando às autoridades competentes.
III. O psicólogo não deve realizar avaliações ou emitir laudos sobre pessoas que nunca foram por ele atendidas diretamente.

Está correto apenas:',
            2023, 'Específico',
            'I ✗ — o sigilo não é absoluto: pode ser quebrado com justa causa (risco de vida, determinação legal), conforme Art. 10 do CEP/CFP. II ✓ — o CEP permite e, em certas interpretações, obriga a comunicação quando há risco de vida iminente ao cliente ou a terceiros identificáveis. III ✓ — o psicólogo não deve emitir laudos, pareceres ou opiniões diagnósticas sobre pessoas que não foram avaliadas diretamente por ele ("psicologismo" — Art. 6º do CEP). Declarações sobre figuras públicas sem avaliação direta são antiéticas.',
            [['Apenas I.', false],
             ['Apenas I e III.', false],
             ['Apenas II e III.', true],
             ['I, II e III.', false],
             ['Apenas II.', false]]
        ),
        $this->q(
            'A psicologia social estuda a influência dos grupos e da sociedade sobre o comportamento individual. O experimento de Stanley Milgram (1961-1963) sobre obediência à autoridade revelou que:',
            2019, 'Específico',
            'Milgram demonstrou que pessoas comuns eram capazes de aplicar choques elétricos potencialmente letais a outras pessoas quando instruídas por uma figura de autoridade (pesquisador de jaleco). Cerca de 65% dos participantes chegaram ao nível máximo de choque (450V). O experimento revelou que a obediência à autoridade é um mecanismo psicossocial poderoso, capaz de suprimir a resistência moral individual — fenômeno relacionado ao que Hannah Arendt chamou de "banalidade do mal" (Eichmann em Jerusalém). Levantou questões éticas fundamentais sobre pesquisa com seres humanos.',
            [['A maioria das pessoas recusou-se a aplicar choques letais, demonstrando forte resistência moral à autoridade.', false],
             ['Cerca de 65% dos participantes obedeceram até o nível máximo de choque, revelando a força da obediência à autoridade legítima.', true],
             ['O experimento demonstrou que apenas pessoas com traços autoritários de personalidade obedeciam às instruções.', false],
             ['Os resultados foram exclusivos do contexto norte-americano, não sendo replicados em outros países ou culturas.', false],
             ['O experimento foi invalidado por fraudes metodológicas descobertas décadas depois de sua publicação.', false]]
        ),
        $this->q(
            'A neuropsicologia estuda as relações entre cérebro e comportamento. Sobre as funções executivas e seus substratos neurais, é correto afirmar que:',
            2023, 'Específico',
            'As funções executivas (planejamento, inibição de resposta, flexibilidade cognitiva, memória de trabalho, tomada de decisão) têm como principal substrato neural o córtex pré-frontal (CPF), especialmente o dorsolateral (memória de trabalho, planejamento) e o ventromedial (tomada de decisão, processamento emocional-social). Lesões no CPF podem causar síndrome disexecutiva: impulsividade, desinibição, perseveração, déficit de planejamento. O caso Phineas Gage (1848) é histórico: lesão no CPF ventromedial alterou personalidade sem comprometer inteligência.',
            [['As funções executivas são mediadas principalmente pelo cerebelo, responsável pela coordenação de processos cognitivos complexos.', false],
             ['O hipocampo é a principal estrutura responsável pelas funções executivas, especialmente o planejamento e a tomada de decisão.', false],
             ['O córtex pré-frontal é o principal substrato das funções executivas, incluindo planejamento, inibição, flexibilidade cognitiva e memória de trabalho.', true],
             ['As funções executivas são inatas e não sofrem influência ambiental ou desenvolvimento ao longo da vida.', false],
             ['Lesões no córtex pré-frontal afetam exclusivamente a memória episódica, sem comprometer outras capacidades cognitivas.', false]]
        ),
    ]; }

    // ── PEDAGOGIA ──────────────────────────────────────────────
    private function pedagogia(): array { return [
        $this->q(
            'A Lei de Diretrizes e Bases da Educação Nacional (LDB — Lei nº 9.394/1996) organiza o sistema educacional brasileiro. Sobre os princípios e fundamentos da educação nacional previstos na LDB, avalie:

I. A LDB estabelece a gestão democrática do ensino público como um dos princípios que devem reger o ensino.
II. A educação básica é composta por educação infantil, ensino fundamental e ensino médio.
III. A LDB determina que o ensino religioso é de matrícula obrigatória nas escolas públicas de ensino fundamental.

Está correto apenas:',
            2021, 'Específico',
            'I ✓ — Art. 3º, VIII, LDB: gestão democrática do ensino público é princípio da educação nacional. II ✓ — Art. 21: educação básica = educação infantil + ensino fundamental + ensino médio. III ✗ — Art. 33 da LDB: o ensino religioso é disciplina de oferta obrigatória pelo sistema de ensino (a escola deve oferecer), mas a matrícula é de caráter optativo para o aluno. O STF (ADI 4439/2017) decidiu que é permitido o ensino religioso confessional nas escolas públicas, mas a adesão do aluno é facultativa.',
            [['Apenas I.', false],
             ['Apenas I e II.', true],
             ['Apenas II e III.', false],
             ['I, II e III.', false],
             ['Apenas III.', false]]
        ),
        $this->q(
            'A perspectiva histórico-cultural de Lev Vygotsky trouxe contribuições fundamentais para a pedagogia. O conceito de Zona de Desenvolvimento Proximal (ZDP) refere-se a:',
            2021, 'Específico',
            'A ZDP é a distância entre o nível de desenvolvimento real (o que a criança resolve sozinha) e o nível de desenvolvimento potencial (o que ela consegue com ajuda de um adulto ou par mais experiente). Para Vygotsky, a aprendizagem precede e impulsiona o desenvolvimento — ao contrário de Piaget, que via o desenvolvimento como pré-requisito da aprendizagem. O conceito de scaffolding (andaime) de Bruner é derivado da ZDP: suporte temporário dado pelo educador para que a criança alcance novos patamares de desenvolvimento.',
            [['A capacidade máxima de aprendizagem que uma criança pode atingir independentemente de qualquer intervenção educacional.', false],
             ['O conjunto de habilidades já consolidadas que a criança demonstra em situações de avaliação formal.', false],
             ['A distância entre o que a criança resolve sozinha e o que consegue com ajuda, representando o potencial de aprendizagem com mediação.', true],
             ['O período cronológico entre a idade mental e a idade cronológica, medido por testes de QI padronizados.', false],
             ['A fase em que a criança transita do pensamento concreto para o abstrato, segundo os estágios de Piaget.', false]]
        ),
        $this->q(
            'Paulo Freire é o educador brasileiro mais reconhecido internacionalmente. Sobre os conceitos centrais da Pedagogia do Oprimido (1968), assinale a alternativa CORRETA:',
            2019, 'Específico',
            'Freire critica a "educação bancária" — modelo onde o educador deposita conteúdos num aluno receptor passivo, sem problematização. Em oposição, propõe a "educação problematizadora" baseada no diálogo, na consciência crítica (conscientização) e na práxis (ação-reflexão-ação transformadora). A educação é ato político — não existe neutralidade pedagógica. O método Paulo Freire de alfabetização usa "palavras geradoras" ligadas à realidade do educando. Foi base das campanhas de alfabetização de adultos no nordeste brasileiro (início dos anos 1960).',
            [['A educação bancária é o modelo ideal de transmissão de conhecimento, garantindo eficiência e objetividade no processo pedagógico.', false],
             ['A pedagogia de Freire é apolítica, focando exclusivamente em técnicas didáticas para a alfabetização de adultos.', false],
             ['A educação bancária, criticada por Freire, trata o aluno como receptor passivo; em oposição, propõe a educação problematizadora baseada no diálogo e na conscientização.', true],
             ['A conscientização freireana limita-se ao domínio da leitura e escrita, sem implicações políticas ou sociais.', false],
             ['Freire propõe que o educador deve ser o único protagonista do processo educativo, transmitindo sua experiência aos alunos.', false]]
        ),
        $this->q(
            'A avaliação da aprendizagem é um dos temas centrais da didática. Sobre as modalidades de avaliação (diagnóstica, formativa e somativa), avalie:

I. A avaliação diagnóstica tem como função principal verificar os conhecimentos prévios dos alunos, orientando o planejamento pedagógico.
II. A avaliação formativa ocorre ao longo do processo de ensino-aprendizagem, fornecendo feedback contínuo para ajustar a prática pedagógica.
III. A avaliação somativa tem caráter exclusivamente punitivo, servindo para reprovar alunos com baixo desempenho.

Está correto apenas:',
            2023, 'Específico',
            'I ✓ — a diagnóstica (Bloom, 1956) identifica o ponto de partida dos alunos — conhecimentos prévios, dificuldades, ritmo de aprendizagem — para orientar o planejamento. II ✓ — a formativa (Scriven, 1967) acompanha o processo e fornece feedback contínuo, permitindo correções antes da avaliação final. III ✗ — a somativa não tem "caráter punitivo": é uma avaliação de síntese ao final de um período (nota, conceito), que registra o nível de aprendizagem alcançado. Pode ser usada para classificar, certificar ou diagnosticar necessidades de reforço.',
            [['Apenas I.', false],
             ['Apenas I e II.', true],
             ['Apenas III.', false],
             ['I, II e III.', false],
             ['Apenas II e III.', false]]
        ),
        $this->q(
            'A educação inclusiva é um direito garantido por legislação nacional e internacional. Sobre o marco legal da inclusão escolar no Brasil, qual afirmativa é CORRETA?',
            2023, 'Geral',
            'A Lei Brasileira de Inclusão (LBI — Lei 13.146/2015, Estatuto da Pessoa com Deficiência) garante o direito à educação inclusiva em todos os níveis — as escolas regulares devem receber e adaptar-se aos alunos com deficiência. A Resolução CNE/CEB nº 4/2009 definiu as Diretrizes Operacionais do AEE (Atendimento Educacional Especializado) no contraturno — complementar, não substitutivo ao ensino regular. A Declaração de Salamanca (UNESCO, 1994) influenciou diretamente a política educacional inclusiva brasileira.',
            [['As escolas especiais são consideradas o ambiente mais adequado para o desenvolvimento de alunos com deficiência, segundo a LBI.', false],
             ['O Atendimento Educacional Especializado (AEE) substitui o ensino regular para alunos com deficiências severas.', false],
             ['A LBI garante o direito à educação inclusiva nas escolas regulares, com AEE complementar no contraturno, não substitutivo ao ensino comum.', true],
             ['A inclusão escolar aplica-se apenas a alunos com deficiências físicas, não contemplando deficiências intelectuais ou transtornos do espectro autista.', false],
             ['A legislação permite que escolas particulares recusem matrículas de alunos com deficiência alegando falta de estrutura.', false]]
        ),
        $this->q(
            'O currículo escolar é um campo de disputas políticas e epistemológicas. Sobre as teorias curriculares, identifique corretamente as abordagens:',
            2021, 'Específico',
            'As teorias curriculares dividem-se em: (1) Tradicionais (Tyler, Bobbit): foco em objetivos, eficiência, neutralidade técnica — currículo como lista de conteúdos a transmitir; (2) Críticas (Giroux, Apple, Freire): currículo como campo de poder, reprodução social e resistência — a escola reproduz desigualdades mas também pode transformá-las; (3) Pós-críticas (Silva): identidade, diferença, gênero, raça, multiculturalismo — quem está incluído/excluído no currículo. A BNCC (2017/2018) é uma política curricular nacional que organiza competências e habilidades por etapa.',
            [['As teorias críticas veem o currículo como instrumento neutro de transmissão eficiente de conhecimentos científicos.', false],
             ['As teorias tradicionais focam nas relações de poder e nas disputas ideológicas presentes na seleção dos conhecimentos escolares.', false],
             ['As teorias críticas analisam o currículo como campo de poder e reprodução social, questionando quais saberes são legitimados pela escola.', true],
             ['As teorias pós-críticas rejeitam completamente a relevância das questões de identidade e diferença para o currículo escolar.', false],
             ['A BNCC representa uma perspectiva curricular crítica, pois foi construída exclusivamente por educadores progressistas.', false]]
        ),
    ]; }

    // ── ENFERMAGEM ─────────────────────────────────────────────
    private function enfermagem(): array { return [
        $this->q(
            'O Sistema Único de Saúde (SUS) é o sistema público de saúde do Brasil, garantido pela Constituição Federal de 1988. Sobre os princípios doutrinários e organizativos do SUS, avalie:

I. A universalidade garante o acesso de todos os cidadãos brasileiros às ações e serviços de saúde, independentemente de contribuição.
II. A equidade implica tratar igualmente todos os cidadãos, oferecendo os mesmos serviços a todos.
III. A descentralização é um princípio organizativo que distribui responsabilidades e recursos entre União, Estados e Municípios.

Está correto apenas:',
            2021, 'Específico',
            'I ✓ — universalidade (Art. 196, CF/88): saúde é direito de todos e dever do Estado, independentemente de contribuição ou condição socioeconômica. II ✗ — equidade não é igualdade: é tratar desigualmente os desiguais, oferecendo mais a quem mais precisa (priorizar grupos mais vulneráveis). A isonomia seria igualdade; equidade é discriminação positiva em saúde. III ✓ — descentralização (Lei 8.080/90): gestão compartilhada com municipalização dos serviços de saúde. Os outros princípios organizativos são: regionalização, hierarquização e participação social.',
            [['Apenas I.', false],
             ['Apenas I e III.', true],
             ['Apenas II e III.', false],
             ['I, II e III.', false],
             ['Apenas II.', false]]
        ),
        $this->q(
            'A Sistematização da Assistência de Enfermagem (SAE) é um método científico que organiza o trabalho do enfermeiro. Sobre as cinco etapas do Processo de Enfermagem (PE), assinale a alternativa que as apresenta na ordem CORRETA:',
            2021, 'Específico',
            'O Processo de Enfermagem (Resolução COFEN 358/2009) é composto por 5 etapas: (1) Coleta de dados (histórico de enfermagem) — levantamento de informações sobre o paciente; (2) Diagnóstico de enfermagem — análise dos dados e identificação das respostas humanas (NANDA-I); (3) Planejamento de enfermagem — definição de resultados esperados e intervenções; (4) Implementação — execução das intervenções planejadas; (5) Avaliação — verificação do alcance dos resultados. O ciclo é contínuo e dinâmico.',
            [['Diagnóstico → Coleta de dados → Planejamento → Implementação → Avaliação.', false],
             ['Coleta de dados → Diagnóstico → Planejamento → Implementação → Avaliação.', true],
             ['Planejamento → Coleta de dados → Diagnóstico → Implementação → Avaliação.', false],
             ['Coleta de dados → Planejamento → Diagnóstico → Avaliação → Implementação.', false],
             ['Diagnóstico → Planejamento → Coleta de dados → Avaliação → Implementação.', false]]
        ),
        $this->q(
            'A segurança do paciente é uma prioridade na assistência de saúde. Sobre os protocolos de segurança do paciente estabelecidos pelo Programa Nacional de Segurança do Paciente (PNSP — Portaria MS 529/2013), assinale a alternativa CORRETA:',
            2023, 'Específico',
            'O PNSP (2013) estabeleceu protocolos básicos de segurança do paciente: (1) Identificação correta do paciente (pulseira com nome, data de nascimento, número do prontuário); (2) Higiene das mãos; (3) Segurança na prescrição, uso e administração de medicamentos; (4) Cirurgia segura (checklist da OMS); (5) Prevenção de quedas; (6) Prevenção de úlceras por pressão. A meta 1 da OMS é a identificação correta do paciente — responsável pela maioria dos erros evitáveis em saúde.',
            [['A higiene das mãos é o único protocolo de segurança obrigatório em estabelecimentos de saúde brasileiros.', false],
             ['A identificação correta do paciente, higiene das mãos, segurança de medicamentos e cirurgia segura estão entre os protocolos básicos do PNSP.', true],
             ['Os protocolos de segurança do paciente aplicam-se exclusivamente às unidades de terapia intensiva (UTI).', false],
             ['A prevenção de quedas não é considerada protocolo de segurança, sendo responsabilidade exclusiva do fisioterapeuta.', false],
             ['O checklist cirúrgico da OMS é opcional no Brasil, sendo utilizado apenas em hospitais acreditados internacionalmente.', false]]
        ),
        $this->q(
            'A farmacologia é conhecimento essencial para a enfermagem na administração segura de medicamentos. Sobre os "10 certos" da administração de medicamentos, qual das seguintes sequências inclui apenas certos CORRETOS?',
            2019, 'Específico',
            'Os 10 certos da administração de medicamentos são: (1) Paciente certo; (2) Medicamento certo; (3) Via certa; (4) Dose certa; (5) Hora certa; (6) Registro certo; (7) Ação certa (o profissional deve conhecer o mecanismo de ação); (8) Forma certa; (9) Resposta certa (monitorar efeito); (10) Educação certa (orientar o paciente). Este protocolo reduz erros de medicação, que são uma das principais causas de eventos adversos evitáveis em saúde.',
            [['Paciente certo, dose certa, hora certa, via certa, medicamento certo.', true],
             ['Paciente certo, diagnóstico certo, hora certa, médico certo, prontuário certo.', false],
             ['Dose certa, enfermeiro certo, hospital certo, via certa, farmacêutico certo.', false],
             ['Via certa, quarto certo, leito certo, turno certo, medicamento certo.', false],
             ['Hora certa, temperatura certa, via certa, posição certa, paciente certo.', false]]
        ),
        $this->q(
            'A saúde do trabalhador é uma área de atuação da enfermagem. Sobre as principais doenças e agravos relacionados ao trabalho, avalie:

I. A LER/DORT (Lesão por Esforço Repetitivo / Distúrbio Osteomuscular Relacionado ao Trabalho) é causada por movimentos repetitivos, posturas inadequadas e pressão mecânica.
II. A pneumoconiose é uma doença respiratória causada pela inalação de poeiras minerais em ambientes de trabalho.
III. O acidente de trabalho e as doenças ocupacionais dão ao trabalhador direito à estabilidade de 12 meses após o retorno ao trabalho, conforme legislação brasileira.

Está correto o que se afirma em:',
            2023, 'Geral',
            'I ✓ — LER/DORT são distúrbios musculoesqueléticos causados por sobrecarga biomecânica: movimentos repetitivos, postura inadequada, pressão mecânica, vibração. II ✓ — pneumoconioses incluem silicose (sílica), asbestose (amianto), antracose (carvão) — doenças pulmonares fibróticas causadas por poeiras minerais inaladas no trabalho. III ✓ — Art. 118 da Lei 8.213/91 (PBPS): o segurado que sofreu acidente de trabalho tem garantia de emprego por 12 meses após a cessação do auxílio-doença acidentário (B91).',
            [['Apenas I e II.', false],
             ['Apenas I.', false],
             ['Apenas II e III.', false],
             ['I, II e III.', true],
             ['Apenas III.', false]]
        ),
    ]; }

    // ── ARQUITETURA E URBANISMO ────────────────────────────────
    private function arquitetura(): array { return [
        $this->q(
            'A acessibilidade no ambiente construído é regulamentada pela NBR 9050 (ABNT). Sobre os princípios do design universal e as normas de acessibilidade no Brasil, avalie:

I. O design universal propõe que ambientes e produtos sejam concebidos para uso por todas as pessoas, na maior extensão possível, sem necessidade de adaptação.
II. A NBR 9050 estabelece que a largura mínima de passeios (calçadas) para garantir a acessibilidade é de 0,90m de faixa livre.
III. A Lei Brasileira de Inclusão (Lei 13.146/2015) exige que todos os novos projetos arquitetônicos públicos e privados de uso coletivo atendam às normas de acessibilidade.

Está correto o que se afirma em:',
            2021, 'Específico',
            'I ✓ — o design universal (Ron Mace, 1985) tem 7 princípios: uso equitativo, flexibilidade, uso simples e intuitivo, informação de fácil percepção, tolerância ao erro, baixo esforço físico e dimensão e espaço para acesso/uso. II ✓ — a NBR 9050:2020 estabelece faixa livre mínima de 1,20m em calçadas, mas permite 0,90m em situações excepcionais; na versão anterior (2015) era 1,20m como mínimo absoluto. Verificação precisa da versão aplicada. III ✓ — a LBI (Art. 55) determina que projetos de construção de uso coletivo devem atender às normas de acessibilidade vigentes.',
            [['Apenas I.', false],
             ['Apenas I e III.', false],
             ['Apenas II.', false],
             ['I, II e III.', true],
             ['Apenas I e II.', false]]
        ),
        $this->q(
            'O conforto ambiental é fundamental no projeto arquitetônico sustentável. Sobre as estratégias bioclimáticas aplicadas ao clima brasileiro, qual afirmativa está CORRETA?',
            2019, 'Específico',
            'As estratégias bioclimáticas variam conforme o clima. No clima tropical úmido (norte/nordeste do Brasil): priorizar ventilação cruzada natural, proteção solar com brises e beirais, vegetação para sombreamento, coberturas ventiladas. No clima temperado (sul): aproveitamento da insolação no inverno, proteção nos ventos frios. A ABNT NBR 15220 (Desempenho Térmico de Edificações) classifica o Brasil em 8 zonas bioclimáticas. O PROCEL (Etiquetagem de Edificações) avalia eficiência energética. Coberturas verdes (telhados vegetados) são estratégia bioclimática contemporânea.',
            [['Em climas quentes e úmidos, a vedação hermética das aberturas é a principal estratégia para reduzir a carga térmica nas edificações.', false],
             ['A ventilação cruzada natural, proteção solar com brises e coberturas ventiladas são estratégias bioclimáticas adequadas para o clima tropical úmido.', true],
             ['O projeto bioclimático aplica-se exclusivamente a edificações residenciais, não sendo relevante para edificações comerciais ou industriais.', false],
             ['O vidro laminado incolor é o melhor material para vedação em todas as zonas bioclimáticas brasileiras por transmitir luz natural.', false],
             ['A orientação solar da edificação é irrelevante no Brasil, pois o sol nasce sempre a leste e se põe a oeste durante todo o ano.', false]]
        ),
        $this->q(
            'O planejamento urbano brasileiro é regulamentado pelo Estatuto da Cidade (Lei nº 10.257/2001). Sobre os instrumentos de política urbana previstos no Estatuto, avalie:

I. O Plano Diretor é obrigatório para cidades com mais de 20.000 habitantes e é o instrumento básico da política de desenvolvimento urbano.
II. O IPTU progressivo no tempo é um instrumento que penaliza o proprietário que não dá função social à sua propriedade urbana.
III. O direito de preempção permite ao poder público adquirir imóvel urbano objeto de alienação onerosa entre particulares, com preferência de compra.

Está correto o que se afirma em:',
            2023, 'Específico',
            'I ✓ — Art. 41 do Estatuto da Cidade: Plano Diretor é obrigatório para cidades com mais de 20.000 habitantes, integrantes de regiões metropolitanas, áreas de especial interesse turístico, etc. II ✓ — Arts. 5-8: IPTU progressivo é aplicado ao proprietário de solo urbano não edificado, subutilizado ou não utilizado (após notificação de parcelamento/edificação compulsória). III ✓ — Arts. 25-27: direito de preempção (preferência) do poder público na compra de imóvel em área delimitada por lei municipal, por prazo de 5 anos renovável.',
            [['Apenas I.', false],
             ['Apenas I e II.', false],
             ['Apenas II.', false],
             ['I, II e III.', true],
             ['Apenas I e III.', false]]
        ),
        $this->q(
            'O movimento modernista na arquitetura teve em Le Corbusier um de seus maiores expoentes. Sobre os "Cinco Pontos da Nova Arquitetura" propostos por Le Corbusier, assinale a alternativa que os apresenta CORRETAMENTE:',
            2019, 'Específico',
            'Os 5 pontos de Le Corbusier (manifesto com Pierre Jeanneret, 1927) são: (1) Pilotis — elevação da edificação sobre pilares, liberando o térreo; (2) Teto-jardim — aproveitamento da cobertura como área verde; (3) Planta livre — separação da estrutura das paredes, permitindo flexibilidade; (4) Fachada livre — as vedações são independentes da estrutura; (5) Janela em fita (fenêtre en longueur) — aberturas horizontais contínuas. Exemplificados na Villa Savoye (1929) e na Unidade de Habitação de Marselha. No Brasil, influenciaram Niemeyer e Lucio Costa (Brasília).',
            [['Pilotis, fachada de pedra, cobertura inclinada, simetria e elementos decorativos.', false],
             ['Pilotis, teto-jardim, planta livre, fachada livre e janela em fita (horizontal).', true],
             ['Estrutura metálica, vidro, planta aberta, cobertura plana e integração com a natureza.', false],
             ['Coluna dórica, arco pleno, abóbada de berço, frontão triangular e simetria bilateral.', false],
             ['Modulação estrutural, jardim interno, circulação vertical, iluminação zenital e flexibilidade de uso.', false]]
        ),
    ]; }

    // ── CIÊNCIA DA COMPUTAÇÃO (adicional) ─────────────────────
    private function cienciaComp(): array { return [
        $this->q(
            'A Máquina de Turing, modelo teórico proposto por Alan Turing (1936), é a base da teoria da computação. Sobre a Tese de Church-Turing e suas implicações, avalie:

I. A Tese de Church-Turing afirma que qualquer função efetivamente computável pode ser computada por uma Máquina de Turing.
II. O Problema da Parada (Halting Problem), demonstrado por Turing, prova que existe um algoritmo capaz de determinar se qualquer programa termina sua execução.
III. Linguagens recursivamente enumeráveis são reconhecidas por Máquinas de Turing, mas nem todas são decidíveis.

Está correto apenas:',
            2023, 'Específico',
            'I ✓ — a Tese de Church-Turing (não provável formalmente, mas amplamente aceita) equipara computabilidade efetiva à computabilidade por MT. II ✗ — Turing PROVOU que o Problema da Parada é INDECIDÍVEL: não existe algoritmo geral que determine se qualquer programa para ou executa indefinidamente. A prova usa diagonalização (similar à prova de Cantor). III ✓ — linguagens RE (recursivamente enumeráveis) são aceitas por MTs que param em "sim" mas podem looping em "não". Linguagens recursivas (decidíveis) são aceitas por MTs que sempre param.',
            [['Apenas I.', false],
             ['Apenas I e III.', true],
             ['Apenas II.', false],
             ['I, II e III.', false],
             ['Apenas II e III.', false]]
        ),
        $this->q(
            'A criptografia é fundamental para a segurança da informação. Sobre a criptografia assimétrica (de chave pública), avalie:

I. No RSA, a segurança baseia-se na dificuldade computacional de fatorar o produto de dois números primos grandes.
II. Na criptografia assimétrica, a chave pública é usada para cifrar mensagens, enquanto a chave privada é usada para decifrá-las.
III. A criptografia assimétrica é mais rápida que a simétrica, sendo preferida para cifrar grandes volumes de dados.

Está correto apenas:',
            2021, 'Específico',
            'I ✓ — o RSA (Rivest-Shamir-Adleman, 1977) baseia sua segurança no problema da fatoração de inteiros: N=p×q (p,q primos grandes). Computadores quânticos (algoritmo de Shor) podem resolver isso em tempo polinomial, ameaçando o RSA. II ✓ — na assimétrica: chave pública cifra / chave privada decifra (confidencialidade); ou chave privada assina / chave pública verifica (autenticidade). III ✗ — a criptografia assimétrica é significativamente MAIS LENTA que a simétrica (AES, 3DES). Por isso, na prática, usa-se assimétrica para trocar a chave de sessão simétrica (protocolo híbrido — como no TLS/SSL).',
            [['Apenas I.', false],
             ['Apenas I e II.', true],
             ['Apenas III.', false],
             ['I, II e III.', false],
             ['Apenas II e III.', false]]
        ),
        $this->q(
            'A computação paralela e distribuída é essencial para sistemas de alto desempenho. A Lei de Amdahl estabelece que:',
            2019, 'Específico',
            'A Lei de Amdahl (Gene Amdahl, 1967) determina que o speedup máximo de um programa paralelizado é limitado pela fração serial (não paralelizável) do programa: Speedup = 1 / (S + (1-S)/N), onde S é a fração serial e N é o número de processadores. Se 20% do programa é serial, o speedup máximo teórico com infinitos processadores é 1/0,2 = 5x. Isso mostra o gargalo das partes seriais — relevante para projetar arquiteturas paralelas e justifica o foco em reduzir a fração serial.',
            [['O speedup de um programa paralelo cresce linearmente e indefinidamente com o aumento do número de processadores.', false],
             ['O speedup máximo de um programa paralelizado é limitado pela fração do código que permanece serial e não pode ser paralelizada.', true],
             ['A paralelização sempre resulta em speedup proporcional ao número de processadores utilizados.', false],
             ['O overhead de comunicação entre processos paralelos é desprezível e não afeta o desempenho do sistema.', false],
             ['A Lei de Amdahl aplica-se exclusivamente a sistemas de memória compartilhada, não sendo válida para clusters distribuídos.', false]]
        ),
        $this->q(
            'Os sistemas de controle de versão são ferramentas essenciais no desenvolvimento de software colaborativo. Sobre o Git e o modelo de branching, avalie:

I. O Git é um sistema de controle de versão distribuído, onde cada desenvolvedor possui uma cópia completa do repositório.
II. O comando git merge integra mudanças de uma branch em outra, podendo gerar conflitos que devem ser resolvidos manualmente.
III. O git rebase modifica o histórico de commits, tornando-o mais linear, mas deve ser evitado em branches públicas compartilhadas.

Está correto o que se afirma em:',
            2023, 'Específico',
            'I ✓ — Git (Torvalds, 2005) é DVCS: cada clone é um repositório completo com todo o histórico. Diferente do SVN (centralizado). II ✓ — git merge cria um "merge commit" unindo duas branches; conflitos surgem quando o mesmo trecho foi modificado em ambas. III ✓ — git rebase reaplica commits sobre outra base, criando histórico linear; reescreve o histórico (muda os hash dos commits), portanto é perigoso em branches públicas (force push necessário, pode perder trabalho de colaboradores). "Golden Rule of Rebasing": nunca rebase branches compartilhadas.',
            [['Apenas I e II.', false],
             ['Apenas I.', false],
             ['Apenas II e III.', false],
             ['I, II e III.', true],
             ['Apenas I e III.', false]]
        ),
    ]; }

    // ── SISTEMAS DE INFORMAÇÃO (adicional) ────────────────────
    private function sistemasInfo(): array { return [
        $this->q(
            'A Inteligência de Negócios (Business Intelligence — BI) utiliza dados para apoiar a tomada de decisão gerencial. Sobre a arquitetura de BI e seus componentes, avalie:

I. O Data Warehouse (DW) é um repositório centralizado de dados históricos, integrados de múltiplas fontes e organizados por assunto.
II. O processo ETL (Extract, Transform, Load) extrai dados de fontes operacionais, transforma-os para garantir qualidade e consistência, e os carrega no DW.
III. O OLAP (Online Analytical Processing) é otimizado para transações operacionais de alta frequência, como os sistemas de PDV (ponto de venda).

Está correto apenas:',
            2021, 'Específico',
            'I ✓ — Inmon (1990) define DW como "coleção de dados orientada por assunto, integrada, variante no tempo e não-volátil, para apoio às decisões gerenciais". II ✓ — ETL é o backbone do DW: Extract (extrair de CRMs, ERPs, planilhas), Transform (limpar, padronizar, enriquecer), Load (carregar no DW/Data Mart). III ✗ — OLAP é para análise multidimensional e consultas complexas (gerenciais); OLTP (Online Transaction Processing) é para operações de alta frequência (PDV, sistemas bancários). São arquiteturas opostas em granularidade e propósito.',
            [['Apenas I.', false],
             ['Apenas I e II.', true],
             ['Apenas III.', false],
             ['I, II e III.', false],
             ['Apenas II.', false]]
        ),
        $this->q(
            'A gestão de projetos de TI é essencial para a entrega de sistemas dentro do prazo, custo e escopo. Sobre o PMBOK (Project Management Body of Knowledge) e as metodologias ágeis, avalie:

I. O PMBOK organiza o gerenciamento de projetos em 5 grupos de processos: iniciação, planejamento, execução, monitoramento/controle e encerramento.
II. O Scrum é um framework ágil que organiza o trabalho em sprints (iterações) de 1-4 semanas, com cerimônias como daily scrum, sprint review e retrospectiva.
III. As metodologias ágeis e o PMBOK são abordagens completamente incompatíveis, não podendo ser usadas em conjunto em projetos de TI.

Está correto apenas:',
            2023, 'Específico',
            'I ✓ — o PMBoK (7ª ed.) organiza processos em grupos: Iniciação, Planejamento, Execução, Monitoramento e Controle, Encerramento. Há também as 10 áreas de conhecimento (escopo, tempo, custo, qualidade, recursos, comunicações, riscos, aquisições, partes interessadas, integração). II ✓ — Scrum (Schwaber & Sutherland): sprints de 1-4 semanas, backlog do produto, sprint planning, daily scrum (15min), sprint review, sprint retrospective. III ✗ — PMBoK e ágil são complementares; o PMBoK 6ª/7ª ed. incorporou práticas ágeis. Projetos híbridos (waterfall + ágil) são comuns na TI.',
            [['Apenas I.', false],
             ['Apenas I e II.', true],
             ['Apenas III.', false],
             ['I, II e III.', false],
             ['Apenas II e III.', false]]
        ),
        $this->q(
            'A transformação digital impacta profundamente as organizações. Sobre a computação em nuvem (cloud computing) e seus modelos de serviço, assinale a alternativa CORRETA:',
            2023, 'Específico',
            'Os três modelos de serviço da nuvem (NIST): IaaS (Infrastructure as a Service) — fornece recursos de infraestrutura virtualizados (servidores, armazenamento, rede) — ex: AWS EC2, Azure VMs; PaaS (Platform as a Service) — fornece plataforma para desenvolvimento e implantação de aplicações — ex: Heroku, Google App Engine; SaaS (Software as a Service) — aplicações completas via internet — ex: Salesforce, Gmail, Office 365. O cliente tem mais controle no IaaS e menos no SaaS. Os modelos de implantação são: pública, privada, híbrida e comunitária.',
            [['IaaS oferece aplicativos completos prontos para uso via internet, enquanto SaaS oferece infraestrutura virtualizada ao cliente.', false],
             ['No modelo PaaS, o cliente gerencia o sistema operacional, middleware e runtime, mas não a aplicação nem os dados.', false],
             ['IaaS fornece infraestrutura virtualizada, PaaS fornece plataforma de desenvolvimento e SaaS fornece aplicações completas via internet.', true],
             ['A nuvem pública é sempre mais segura que a privada, sendo obrigatória para dados sensíveis de organizações governamentais.', false],
             ['O modelo SaaS exige que o cliente faça instalação e manutenção local do software nos servidores da organização.', false]]
        ),
        $this->q(
            'A segurança da informação é crítica para os Sistemas de Informação. Sobre os ataques cibernéticos e as medidas de proteção, avalie:

I. O ataque de SQL Injection explora a inserção de comandos SQL maliciosos em campos de entrada de aplicações web que não sanitizam adequadamente os dados do usuário.
II. O ataque de Cross-Site Scripting (XSS) injeta scripts maliciosos em páginas web, executando código no navegador de outros usuários.
III. O uso de prepared statements (instruções parametrizadas) é uma medida eficaz para prevenir ataques de SQL Injection.

Está correto o que se afirma em:',
            2021, 'Específico',
            'I ✓ — SQL Injection (OWASP Top 10 #3): inserção de comandos SQL via campos de formulário não sanitizados, permitindo ler/modificar/deletar dados do banco. Ex: input "admin\'--" bypassa autenticação. II ✓ — XSS (OWASP Top 10 #2): injeção de scripts em páginas web que são executados no browser de vítimas — pode roubar cookies de sessão, redirecionar usuários. Tipos: Stored, Reflected, DOM-based. III ✓ — prepared statements separam o código SQL dos dados de entrada, impossibilitando a injeção. ORMs (Eloquent, Hibernate) geralmente utilizam isso automaticamente.',
            [['Apenas I e II.', false],
             ['Apenas I.', false],
             ['I, II e III.', true],
             ['Apenas II e III.', false],
             ['Apenas III.', false]]
        ),
    ]; }

    // ── ANÁLISE E DESENVOLVIMENTO DE SISTEMAS ─────────────────
    private function ads(): array { return [
        $this->q(
            'O desenvolvimento ágil de software é regido pelo Manifesto Ágil (2001). Sobre os 4 valores fundamentais do Manifesto Ágil, assinale a alternativa que os apresenta CORRETAMENTE:',
            2021, 'Específico',
            'Os 4 valores do Manifesto Ágil (Beck, Fowler, Martin et al., 2001): (1) Indivíduos e interações mais que processos e ferramentas; (2) Software em funcionamento mais que documentação abrangente; (3) Colaboração com o cliente mais que negociação de contratos; (4) Responder a mudanças mais que seguir um plano. Os itens da direita têm valor, mas os da esquerda têm mais valor. Os 12 princípios derivam desses valores. Método ágeis: Scrum, XP, Kanban, Lean, Crystal.',
            [['Documentação abrangente, planejamento detalhado, seguir contratos e ferramentas de gestão.', false],
             ['Indivíduos e interações, software funcionando, colaboração com o cliente e resposta a mudanças.', true],
             ['Processos rigorosos, métricas de qualidade, revisões formais e entregas em fases sequenciais.', false],
             ['Especificação completa de requisitos, arquitetura definida, testes automatizados e integração contínua.', false],
             ['Velocidade de entrega, redução de custos, equipes remotas e ferramentas colaborativas.', false]]
        ),
        $this->q(
            'A modelagem de sistemas utiliza a UML (Unified Modeling Language) para representar diferentes aspectos de um sistema. Sobre os diagramas UML, associe corretamente:

I. Diagrama de Casos de Uso — representa a interação entre atores externos e as funcionalidades do sistema.
II. Diagrama de Classes — representa a estrutura estática do sistema, mostrando classes, atributos, métodos e relacionamentos.
III. Diagrama de Sequência — representa a interação dinâmica entre objetos ao longo do tempo, mostrando a troca de mensagens.

Está correto o que se afirma em:',
            2021, 'Específico',
            'I ✓ — Use Case Diagram: captura requisitos funcionais do sistema da perspectiva dos usuários (atores). Define o escopo do sistema. II ✓ — Class Diagram: mostra a estrutura do sistema com classes, seus atributos e métodos, e os relacionamentos (associação, herança, composição, agregação, dependência, realização). III ✓ — Sequence Diagram: mostra a interação entre objetos em um cenário específico, com linhas de vida, mensagens síncronas/assíncronas e ativações. Todos estão corretamente descritos.',
            [['Apenas I e II.', false],
             ['Apenas II.', false],
             ['I, II e III.', true],
             ['Apenas I.', false],
             ['Apenas I e III.', false]]
        ),
        $this->q(
            'O teste de software é uma atividade crítica para garantir a qualidade. Sobre os níveis e tipos de teste, avalie:

I. O teste unitário verifica unidades individuais de código (funções/métodos) de forma isolada, geralmente automatizado pelo desenvolvedor.
II. O teste de integração verifica a interação entre módulos/componentes já testados individualmente.
III. O teste de caixa-branca (white-box) não requer conhecimento do código-fonte, sendo baseado apenas na especificação dos requisitos.

Está correto apenas:',
            2023, 'Específico',
            'I ✓ — testes unitários isolam a menor unidade testável (método/função); usa mocks para dependências externas. Frameworks: JUnit, pytest, PHPUnit. II ✓ — testes de integração verificam se módulos funcionam juntos corretamente: APIs, banco de dados, serviços externos. III ✗ — o teste de caixa-BRANCA (estrutural) REQUER conhecimento do código-fonte — analisa caminhos de execução, cobertura de código (statement, branch, path coverage). O teste de caixa-PRETA (funcional/comportamental) não requer acesso ao código — baseia-se nos requisitos.',
            [['Apenas I.', false],
             ['Apenas I e II.', true],
             ['Apenas III.', false],
             ['I, II e III.', false],
             ['Apenas II e III.', false]]
        ),
        $this->q(
            'As APIs RESTful são o padrão dominante para integração de sistemas na web. Sobre os princípios REST (Representational State Transfer) e boas práticas de design de APIs, assinale a alternativa CORRETA:',
            2023, 'Específico',
            'REST (Fielding, 2000) define 6 constraints: interface uniforme, stateless (sem estado no servidor), cache, sistema em camadas, código sob demanda (opcional) e cliente-servidor. Boas práticas de API RESTful: substantivos no plural para recursos (/users, /orders), verbos HTTP semânticos (GET=leitura, POST=criação, PUT=substituição, PATCH=atualização parcial, DELETE=remoção), códigos HTTP corretos (200 OK, 201 Created, 400 Bad Request, 401 Unauthorized, 404 Not Found, 500 Internal Server Error), versionamento (/api/v1/), paginação, HATEOAS.',
            [['Em REST, todas as operações devem usar o método HTTP POST, diferenciando-se pelo corpo da requisição.', false],
             ['O princípio stateless do REST exige que o servidor mantenha o estado da sessão do cliente entre requisições.', false],
             ['APIs RESTful utilizam verbos HTTP semânticos (GET, POST, PUT, DELETE) e recursos identificados por URIs, sendo stateless por princípio.', true],
             ['REST exige o uso obrigatório do formato JSON, não sendo possível usar XML ou outros formatos de dados.', false],
             ['O versionamento de APIs REST é desnecessário, pois mudanças na API não afetam clientes que já utilizam versões anteriores.', false]]
        ),
        $this->q(
            'O paradigma de Programação Orientada a Objetos (POO) é fundamental para o desenvolvimento moderno. Sobre os princípios SOLID, assinale a alternativa que descreve CORRETAMENTE o Princípio da Responsabilidade Única (Single Responsibility Principle):',
            2019, 'Específico',
            'SOLID (Robert C. Martin): S — Single Responsibility: cada classe deve ter uma única razão para mudar (um único motivo de responsabilidade); O — Open/Closed: aberto para extensão, fechado para modificação; L — Liskov Substitution: subtipos devem ser substituíveis por seus tipos base; I — Interface Segregation: interfaces específicas são melhores que uma interface geral; D — Dependency Inversion: depender de abstrações, não de concreções. O SRP reduz coesão e acoplamento: classes menores, mais focadas e testáveis.',
            [['Uma classe deve implementar todas as funcionalidades do sistema para garantir que o código seja único e centralizado.', false],
             ['Uma classe deve ter apenas uma responsabilidade, ou seja, uma única razão para ser modificada, tornando o código mais coeso e manutenível.', true],
             ['Um método deve ser responsável por realizar apenas uma operação por vez, nunca delegando tarefas a outros objetos.', false],
             ['O sistema deve ter apenas uma classe principal que coordena todas as outras funcionalidades do software.', false],
             ['Cada módulo do sistema deve ser responsável por um único usuário ou tipo de cliente do software.', false]]
        ),
    ]; }

    // ── ENGENHARIA DE SOFTWARE ─────────────────────────────────
    private function engSoftware(): array { return [
        $this->q(
            'Os modelos de processo de software organizam as atividades de desenvolvimento. Sobre o modelo em espiral de Barry Boehm (1988), identifique a característica que o DIFERENCIA dos modelos sequenciais (cascata) e iterativos simples:',
            2021, 'Específico',
            'O modelo espiral de Boehm combina prototipagem (iterativo) com aspectos controlados do cascata. Sua característica distintiva é a análise explícita de riscos a cada ciclo da espiral. Cada volta da espiral passa por 4 quadrantes: (1) Determinar objetivos e restrições; (2) Avaliar alternativas e identificar riscos; (3) Desenvolver e verificar o produto; (4) Planejar a próxima fase. O gerenciamento de risco guia as decisões de desenvolvimento. É indicado para projetos grandes e complexos onde os riscos são significativos e mal compreendidos.',
            [['A entrega incremental de funcionalidades ao cliente a cada iteração de curta duração.', false],
             ['A análise explícita e contínua de riscos a cada ciclo, guiando as decisões de desenvolvimento.', true],
             ['A eliminação completa de documentação em favor da comunicação face a face entre desenvolvedores.', false],
             ['O uso exclusivo de programação em pares para garantir qualidade desde o início do desenvolvimento.', false],
             ['A entrega completa do produto apenas no final do projeto, após todas as fases serem completadas.', false]]
        ),
        $this->q(
            'A engenharia de requisitos é uma das atividades mais críticas do desenvolvimento de software. Sobre os tipos de requisitos e técnicas de elicitação, avalie:

I. Requisitos funcionais descrevem as funções que o sistema deve executar (o que o sistema faz).
II. Requisitos não-funcionais descrevem restrições de qualidade do sistema (como o sistema deve ser), incluindo desempenho, segurança, usabilidade e disponibilidade.
III. A técnica de etnografia (observação do usuário em seu ambiente real de trabalho) é utilizada para elicitar requisitos emergentes e contextuais que os usuários têm dificuldade de articular verbalmente.

Está correto o que se afirma em:',
            2021, 'Específico',
            'I ✓ — requisitos funcionais (RF): descrevem comportamentos/funções do sistema — o que o sistema deve fazer. Ex: "O sistema deve permitir que o usuário cadastre produtos". II ✓ — requisitos não-funcionais (RNF) ou atributos de qualidade: desempenho (tempo de resposta), segurança (autenticação), usabilidade (acessibilidade), disponibilidade (uptime), manutenibilidade. ISO 25010 categoriza qualidade de software. III ✓ — etnografia (observação naturalista) revela requisitos tácitos: o que as pessoas fazem (vs. o que dizem que fazem). Especialmente útil para sistemas de workflow complexo.',
            [['Apenas I e II.', false],
             ['Apenas I.', false],
             ['I, II e III.', true],
             ['Apenas II e III.', false],
             ['Apenas I e III.', false]]
        ),
        $this->q(
            'A qualidade de software é avaliada por normas internacionais. A norma ISO/IEC 25010 (SQuaRE) define características de qualidade do produto de software. Qual das seguintes é uma característica de qualidade em USO, segundo a ISO 25010?',
            2023, 'Específico',
            'A ISO 25010 divide qualidade em: (1) Qualidade do Produto: adequação funcional, eficiência de desempenho, compatibilidade, usabilidade, confiabilidade, segurança, manutenibilidade, portabilidade; (2) Qualidade em Uso: eficácia, eficiência, satisfação, ausência de risco, cobertura do contexto. A qualidade em USO avalia o produto na perspectiva do usuário no contexto real de uso — não as características internas do software, mas os resultados para o usuário. Diferencia-se da qualidade do produto (características técnicas internas).',
            [['Manutenibilidade — facilidade de modificar o software para corrigir defeitos ou adicionar novas funcionalidades.', false],
             ['Portabilidade — capacidade do software de ser transferido de um ambiente para outro.', false],
             ['Eficácia — capacidade do sistema de permitir que os usuários alcancem seus objetivos com precisão e completude no contexto de uso real.', true],
             ['Segurança — proteção de informações e dados contra acesso não autorizado e ataques maliciosos.', false],
             ['Compatibilidade — capacidade do produto coexistir com outros produtos no mesmo ambiente.', false]]
        ),
        $this->q(
            'O DevOps integra desenvolvimento e operações para acelerar a entrega de software. Sobre o conceito de CI/CD (Continuous Integration / Continuous Delivery), avalie:

I. A Integração Contínua (CI) consiste em integrar e testar automaticamente o código de todos os desenvolvedores várias vezes ao dia.
II. A Entrega Contínua (CD - Delivery) garante que o software está sempre em um estado deployável, mas a implantação em produção ainda requer aprovação humana.
III. O Deploy Contínuo (CD - Deployment) implanta automaticamente em produção toda mudança que passa pelo pipeline de testes, sem intervenção humana.

Está correto o que se afirma em:',
            2023, 'Específico',
            'I ✓ — CI (Fowler, 2006): integração frequente no repositório principal + build automatizado + testes automatizados. Ferramentas: Jenkins, GitHub Actions, GitLab CI. II ✓ — Continuous Delivery: pipeline garante que o código é sempre deployável; a decisão de fazer o deploy em produção é humana (botão). III ✓ — Continuous Deployment: cada commit que passa no pipeline de testes é automaticamente implantado em produção. Exige alta maturidade de testes. Netflix, Amazon e Google usam CD para deploys múltiplos por dia.',
            [['Apenas I e II.', false],
             ['Apenas I.', false],
             ['Apenas II.', false],
             ['I, II e III.', true],
             ['Apenas I e III.', false]]
        ),
        $this->q(
            'A refatoração de código é uma prática essencial na engenharia de software. Segundo Martin Fowler, o conceito de "code smell" (mau cheiro de código) refere-se a:',
            2019, 'Específico',
            'Code smells (Fowler, "Refactoring", 1999) são indicadores de problemas estruturais no código que sugerem a necessidade de refatoração, sem necessariamente serem bugs. Exemplos: Long Method (método muito longo), Large Class (classe com muitas responsabilidades — violação do SRP), Duplicate Code (código duplicado), Feature Envy (método que usa mais dados de outra classe que da sua própria), Dead Code (código nunca executado), Long Parameter List. Refatoração é a técnica de melhorar a estrutura interna do código sem alterar seu comportamento externo.',
            [['Erros graves de compilação que impedem a execução do programa, necessitando correção imediata.', false],
             ['Indicadores estruturais no código que sugerem problemas de design e necessidade de refatoração, sem serem necessariamente bugs.', true],
             ['Vulnerabilidades de segurança identificadas por ferramentas de análise estática de código.', false],
             ['Comentários desnecessários e confusos deixados por programadores anteriores no código-fonte.', false],
             ['Falhas de desempenho identificadas em testes de carga e stress do sistema em produção.', false]]
        ),
    ]; }
}
