<?php

namespace Database\Seeders;

use App\Models\OfficialDocument;
use Illuminate\Database\Seeder;

class OfficialDocumentSeeder extends Seeder
{
    public function run(): void
    {
        $documents = [
            [
                'numero' => 'Nota Oficial Nº 04/2026',
                'titulo' => 'Manifesto em Defesa do Cumprimento Estrito dos Honorários de Sucumbência pelo Poder Judiciário',
                'resumo' => 'Pronunciamento técnico encaminhado aos Conselhos de Justiça reforçando os critérios legais do CPC para fixação de honorários.',
                'data_publicacao' => '2026-09-10',
                'categoria' => 'NOTA_OFICIAL',
                'arquivo_url' => '#',
            ],
            [
                'numero' => 'Portaria Nº 02/2026',
                'titulo' => 'Instituição da Comissão Especial de Estudos sobre Inteligência Artificial e Advocacia',
                'resumo' => 'Ato da Presidência que define a composição e os objetivos do novo comitê técnico permanente.',
                'data_publicacao' => '2026-09-01',
                'categoria' => 'PORTARIA',
                'arquivo_url' => '#',
            ],
            [
                'numero' => 'Manifesto Nº 01/2026',
                'titulo' => 'Manifesto de Repúdio ao Cerceamento de Prerrogativas em Sustentações Orais',
                'resumo' => 'Documento público exigindo o cumprimento do Estatuto da Advocacia e o direito inafastável de sustentação em sessões de julgamento.',
                'data_publicacao' => '2026-08-15',
                'categoria' => 'MANIFESTO',
                'arquivo_url' => '#',
            ],
            [
                'numero' => 'Resolução Nº 01/2025',
                'titulo' => 'Diretrizes Gerais do Programa Nacional de Mentoria Jurídica e Acompanhamento de Jovens Advogados',
                'resumo' => 'Regulamentação interna da concessão de mentorias gratuitas e apoio ao início da carreira jurídica.',
                'data_publicacao' => '2025-12-10',
                'categoria' => 'RESOLUCAO',
                'arquivo_url' => '#',
            ],
            [
                'numero' => 'Nota Oficial Nº 03/2026',
                'titulo' => 'Nota Pública sobre a Inviolabilidade dos Escritórios de Advocacia e Sigilo dos Clientes',
                'resumo' => 'Reafirmação das garantias constitucionais e prerrogativas contidas no Estatuto da Advocacia frente a medidas de busca desmedidas.',
                'data_publicacao' => '2026-08-28',
                'categoria' => 'NOTA_OFICIAL',
                'arquivo_url' => '#',
            ],
            [
                'numero' => 'Ato Institucional Nº 02/2026',
                'titulo' => 'Criação das Comissões Especiais de Equidade e Prerrogativas no Nordeste',
                'resumo' => 'Regulamenta a estrutura de apoio e nomeação dos membros dos núcleos seccionais do MAR.',
                'data_publicacao' => '2026-08-20',
                'categoria' => 'ATO_INSTITUCIONAL',
                'arquivo_url' => '#',
            ],
            [
                'numero' => 'Manifesto Nº 02/2026',
                'titulo' => 'Manifesto Nacional pela Valorização da Remuneração da Advocacia Dativa no Brasil',
                'resumo' => 'Proposição de tabela mínima unificada e pagamento tempestivo aos defensores dativos em todas as Unidades da Federação.',
                'data_publicacao' => '2026-07-15',
                'categoria' => 'MANIFESTO',
                'arquivo_url' => '#',
            ],
        ];

        foreach ($documents as $doc) {
            OfficialDocument::updateOrCreate(
                ['numero' => $doc['numero']],
                $doc
            );
        }
    }
}
