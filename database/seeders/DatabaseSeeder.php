<?php

namespace Database\Seeders;

use App\Models\BoardMember;
use App\Models\Certificate;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Member;
use App\Models\OfficialDocument;
use App\Models\Post;
use App\Models\PrerogativeClaim;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Administrador Padrão (Configurável via .env)
        User::firstOrCreate(
            ['email' => env('ADMIN_DEFAULT_EMAIL', 'admin@institutomar.org.br')],
            [
                'name' => 'Administrador Instituto MAR',
                'password' => Hash::make(env('ADMIN_DEFAULT_PASSWORD', 'admin123')),
            ]
        );

        // 2. Simpósio Destaque
        $event = Event::create([
            'slug' => 'simposio-mar-2026',
            'titulo' => 'I Simpósio Nacional de Defesa de Prerrogativas e Fixação de Honorários',
            'descricao' => 'Evento máster do Instituto MAR reunindo os maiores juristas do país para debater a valorização dos honorários advocatícios e o combate às violações do Art. 7º do EAOAB.',
            'data_evento' => '2026-11-11 09:00:00',
            'local' => 'Auditório do Instituto MAR — Brasília/DF (Transmissão On-line HD)',
            'vagas_totais' => 30,
            'formato' => 'Híbrido',
            'carga_horaria' => '10 Horas Acadêmicas',
            'ativo' => true,
        ]);

        // 3. Inscritos no Evento (Simulação de 24 vagas preenchidas)
        for ($i = 1; $i <= 24; $i++) {
            EventRegistration::create([
                'event_id' => $event->id,
                'nome' => "Advogado Participant $i",
                'email' => "advogado$i@oab.org.br",
                'oab_uf' => sprintf('%05d/DF', $i * 123),
                'whatsapp' => '(61) 99999-'.sprintf('%04d', $i),
                'status' => 'confirmado',
            ]);
        }

        // 4. Notícias em Destaque
        Post::create([
            'slug' => 'manifesto-honorarios',
            'titulo' => 'Instituto MAR Emite Manifesto em Defesa da Fixação Certa de Honorários de Sucumbência',
            'categoria' => 'HONORARIOS',
            'resumo' => 'O Movimento da Advocacia Renovada reuniu sua diretoria nacional para aprovar o texto de diretrizes contra o aviltamento da verba sucumbencial.',
            'conteudo' => 'A diretoria executiva do Instituto MAR vem a público reafirmar que os honorários advocatícios têm natureza alimentar...',
            'autor' => 'Assessoria de Imprensa MAR',
            'tempo_leitura' => '4 min',
            'publicado_em' => now(),
            'destaque' => true,
        ]);

        Post::create([
            'slug' => 'defesa-prerrogativas-cnj',
            'titulo' => 'Requerimento Institucional no CNJ Pela Garantia de Atendimento Presencial aos Advogados',
            'categoria' => 'PRERROGATIVAS',
            'resumo' => 'Ação visa coibir limitações impostas por tribunais estaduais ao livre acesso dos advogados a magistrados.',
            'conteudo' => 'Foi protocolado junto ao Conselho Nacional de Justiça pedido de providências em benefício de toda a advocacia...',
            'autor' => 'Comissão de Prerrogativas',
            'tempo_leitura' => '3 min',
            'publicado_em' => now()->subDays(2),
            'destaque' => false,
        ]);

        // 5. Atos e Notas Oficiais
        OfficialDocument::create([
            'numero' => 'Nota Oficial Nº 04/2026',
            'titulo' => 'Posicionamento Contra Qualquer Cerceamento de Sustentação Oral nos Tribunais',
            'resumo' => 'Documento aprovado por unanimidade pelo Conselho Consultivo do Instituto MAR.',
            'data_publicacao' => now(),
            'categoria' => 'NOTA_OFICIAL',
        ]);

        // 6. Membro Associado Exemplo
        Member::create([
            'matricula' => '#2026-9842',
            'nome' => 'Dr. Marcos Vinícius Alencar',
            'cpf' => '123.456.789-00',
            'email' => 'marcos.alencar@oab.org.br',
            'oab' => '123456',
            'uf' => 'SP',
            'categoria' => 'Advogado Efetivo',
            'comissao' => 'Prerrogativas & Honorários',
            'status' => 'ATIVO',
            'validade' => '2026-12-31',
            'hash_validacao' => 'A9F2-2026',
        ]);

        // 7. Reclamação Emergencial de Prerrogativa Exemplo
        PrerogativeClaim::create([
            'protocolo' => 'PRE-2026-0001',
            'adv_nome' => 'Dra. Patricia Lima',
            'adv_oab' => '654321',
            'adv_uf' => 'DF',
            'adv_email' => 'patricia@oabdf.org.br',
            'adv_phone' => '(61) 98888-7777',
            'tipo_violacao' => 'Impedimento de Acesso aos Autos',
            'orgao_local' => '2ª Vara Cível de Brasília',
            'descricao_fatos' => 'Cerceamento de vistas dos autos em investigações em andamento.',
            'status' => 'EM_ANALISE',
        ]);

        // 8. Certificado Válido Exemplo
        Certificate::create([
            'codigo' => 'MAR-2026-98421',
            'participante_nome' => 'Dr. Marcos Vinícius Alencar',
            'oab_uf' => '123.456/SP',
            'evento_titulo' => 'I Simpósio Nacional de Defesa de Prerrogativas e Fixação de Honorários',
            'carga_horaria' => '10 Horas Acadêmicas',
            'data_emissao' => '2026-03-16',
            'hash_digital' => 'e8f9a7d3-2026-mar-val',
        ]);

        // 9. Membros da Diretoria
        BoardMember::create([
            'nome' => 'Dr. Guilherme Oliveira',
            'cargo' => 'Presidente Nacional',
            'oab' => '102030',
            'uf' => 'DF',
            'tipo' => 'DIRETORIA',
            'ordem' => 1,
        ]);

        BoardMember::create([
            'nome' => 'Dra. Fernanda Siqueira',
            'cargo' => 'Vice-Presidente Nacional',
            'oab' => '405060',
            'uf' => 'SP',
            'tipo' => 'DIRETORIA',
            'ordem' => 2,
        ]);
    }
}
