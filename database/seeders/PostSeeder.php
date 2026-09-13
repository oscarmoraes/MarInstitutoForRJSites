<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'slug' => 'manifesto-honorarios',
                'titulo' => 'Instituto MAR protocola manifesto nacional pela valorização dos honorários advocatícios',
                'categoria' => 'INSTITUCIONAL',
                'resumo' => 'Documento assinado pela diretoria e representantes estaduais reforça o posicionamento contra o aviltamento dos honorários de sucumbência e contratuais.',
                'conteudo' => '<p>O <strong>Instituto Movimento da Advocacia Renovada (MAR)</strong> protocolou formalmente nesta semana um manifesto nacional voltado à estrita observância das normas do Código de Processo Civil (CPC) referente à fixação dos honorários sucumbenciais e contratuais.</p><p>A iniciativa, liderada pela Presidência Nacional e apoiada pelas coordenações estaduais nos 26 estados e no Distrito Federal, surge em resposta a decisões judiciais recentes que têm fixado honorários por equidade em causas de grande valor econômico, desrespeitando os percentuais mínimos previstos no art. 85 do CPC.</p><h2>Caráter Alimentar e Dignidade Profissional</h2><p>No documento, o Instituto MAR destaca que os honorários advocatícios possuem natureza alimentar reconhecida pelo Supremo Tribunal Federal (STF) e pelo próprio Superior Tribunal de Justiça (STJ). O aviltamento dessas verbas compromete diretamente a subsistência do profissional e a manutenção das estruturas dos escritórios.</p><blockquote>"Honorários dignos não representam privilégio da advocacia, mas sim o reconhecimento do papel indispensável que o advogado exerce na administração da Justiça."<br><small>— Dr. Carlos Eduardo Mendonça, Presidente Nacional do Instituto MAR</small></blockquote><h3>Próximos Passos e Ações em Âmbito Nacional</h3><ul><li><strong>Encaminhamento aos Tribunais Superiores:</strong> Cópias do manifesto foram enviadas às presidências do STF, STJ e TST.</li><li><strong>Assistência aos Coordenadores Regionais:</strong> O MAR disponibilizará suporte técnico parecerístico para advogados associados que enfrentarem redução indevida de honorários.</li><li><strong>Ciclo de Debates:</strong> Realização de webinars e fóruns regionais para discutir estratégias de defesa do art. 85 do CPC.</li></ul><p>O Instituto MAR reforça seu compromisso inabalável de permanecer na vanguarda da defesa das prerrogativas da advocacia brasileira, conclamando todos os profissionais a se unirem em prol da valorização da classe.</p>',
                'imagem_capa' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=1200&q=80',
                'autor' => 'Assessoria de Imprensa MAR',
                'tempo_leitura' => '4 min',
                'publicado_em' => '2026-09-10',
                'destaque' => true,
            ],
            [
                'slug' => 'guia-seguranca-direito-digital',
                'titulo' => 'Comissão de Direito Digital do MAR lança guia de segurança para escritórios de advocacia',
                'categoria' => 'FORMAÇÃO',
                'resumo' => 'Material gratuito aborda proteção de dados de clientes, conformidade com a LGPD e boas práticas no uso de IA.',
                'conteudo' => '<p>A Comissão Especial de Direito Digital do Instituto MAR publicou uma cartilha prática contendo diretrizes essenciais de cibersegurança e governança de dados para bancas de advocacia de pequeno e médio porte.</p><p>Com o aumento de ataques cibernéticos e tentativas de invasão a bancos de dados jurídicos, o guia traz orientações práticas sobre autenticação em dois fatores, armazenamento em nuvem criptografada e rotinas de backup seguro para documentos processuais.</p><h2>Uso Consciente de Inteligência Artificial Generativa</h2><p>O documento também estabelece recomendações para que advogados e equipes jurídicas utilizem ferramentas de IA generativa sem violar o dever ético de sigilo profissional e a proteção de dados pessoais sensíveis regulados pela Lei Geral de Proteção de Dados (LGPD).</p><p>O material completo já está disponível para download gratuito na área do associado e nos canais oficiais do Instituto MAR.</p>',
                'imagem_capa' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=800&q=80',
                'autor' => 'Comissão de Direito Digital',
                'tempo_leitura' => '5 min',
                'publicado_em' => '2026-09-08',
                'destaque' => false,
            ],
            [
                'slug' => 'mar-expansao-coordenacoes-nordeste',
                'titulo' => 'MAR expande coordenações regionais no Nordeste e nomeia novos delegados estaduais',
                'categoria' => 'REPRESENTATIVIDADE',
                'resumo' => 'Acolhimento de demandas locais e estruturação de novos comitês em Salvador, Recife e Fortaleza.',
                'conteudo' => '<p>Em continuidade ao plano de descentralização e interiorização institucional, o Instituto MAR anunciou a criação oficial de três novas coordenações regionais no Nordeste: Bahia, Pernambuco e Ceará.</p><p>A cerimônia de posse virtual reuniu mais de 150 advogados da região e contou com pronunciamento da diretoria nacional, que reforçou a importância da presença do movimento no enfrentamento de problemas locais, como a morosidade no agendamento de audiências e restrições a balcões virtuais.</p><h2>Novos Comitês de Prerrogativas</h2><p>Cada coordenação estadual passará a contar com plantão próprio conectado à Central Nacional 24h de Defesa das Prerrogativas, prestando assistência direta e pareceres a profissionais com direitos violados.</p>',
                'imagem_capa' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80',
                'autor' => 'Coordenação Nacional de Regionais',
                'tempo_leitura' => '3 min',
                'publicado_em' => '2026-09-03',
                'destaque' => false,
            ],
            [
                'slug' => 'resolucao-mentoria-novos-advogados',
                'titulo' => 'Publicada a resolução do Programa Nacional de Mentoria Prática para Novos Advogados',
                'categoria' => 'ATOS OFICIAIS',
                'resumo' => 'Iniciativa visa conectar advogados sêniores e jovens profissionais para transferência de experiência prática.',
                'conteudo' => '<p>O Conselho Consultivo do Instituto MAR aprovou por aclamação a Resolução Normativa nº 02/2026, instituindo o Programa Nacional de Mentoria Prática para profissionais com até cinco anos de inscrição na OAB.</p><p>O programa funcionará por ciclos semestrais, conectando jovens profissionais a mentores experientes em diversas áreas, como contencioso estratégico, direito empresarial, tributário e prerrogativas na prática.</p><h2>Metodologia e Inscrições</h2><p>As inscrições serão abertas a partir do próximo mês através do portal do MAR, sem custos adicionais para advogados associados regulares. O comitê organizador selecionará inicialmente 100 mentorados para o ciclo pioneiro de 2026.</p>',
                'imagem_capa' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80',
                'autor' => 'Conselho Consultivo do MAR',
                'tempo_leitura' => '4 min',
                'publicado_em' => '2026-08-28',
                'destaque' => false,
            ],
            [
                'slug' => 'futuro-advocacia-integridade-algoritmica',
                'titulo' => 'Artigo: O futuro da advocacia e a integridade algorítmica no Judiciário',
                'categoria' => 'FORMAÇÃO',
                'resumo' => 'Análise doutrinária aborda os impactos da inteligência artificial e da automação na independência do advogado.',
                'conteudo' => '<p>A crescente adoção de ferramentas de triagem algorítmica pelos tribunais brasileiros exige vigilância ativa e debate qualificado por parte da comunidade jurídica.</p><p>Neste artigo de análise, examina-se como a padronização decisória pode afetar o princípio da ampla defesa e o contraditório substancial quando argumentos singulares são desconsiderados por filtros automatizados.</p><p>O autor propõe parâmetros de transparência algorítmica e auditoria externa em sistemas judiciais como salvaguardas indispensáveis para o Estado Democrático de Direito.</p>',
                'imagem_capa' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&w=800&q=80',
                'autor' => 'Dr. Carlos Eduardo Mendonça',
                'tempo_leitura' => '6 min',
                'publicado_em' => '2026-08-20',
                'destaque' => false,
            ],
            [
                'slug' => 'forum-direito-publico-brasilia',
                'titulo' => 'Fórum de Direito Público discute reformas processuais e prerrogativas em Brasília',
                'categoria' => 'EVENTOS',
                'resumo' => 'Painel reuniu juristas de renome nacional para debater a eficiência do contencioso e segurança jurídica.',
                'conteudo' => '<p>Especialistas e magistrados reuniram-se na capital federal para debater propostas legislativas voltadas ao aprimoramento do processo administrativo e judicial nas relações com o Estado.</p><p>O Instituto MAR esteve presente na mesa de abertura, ressaltando que qualquer reforma deve preservar integralmente a prerrogativa da sustentação oral e o acesso pleno aos autos pelos procuradores constituídos.</p>',
                'imagem_capa' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=800&q=80',
                'autor' => 'Assessoria de Imprensa MAR',
                'tempo_leitura' => '3 min',
                'publicado_em' => '2026-08-15',
                'destaque' => false,
            ],
        ];

        foreach ($posts as $data) {
            Post::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
