<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'slug' => 'simposio-mar-2026',
                'titulo' => 'Simpósio Instituto MAR — Advocacia Renovada 2026',
                'descricao' => 'Grande encontro nacional de juristas e advogados debatendo o futuro da advocacia, honorários, prerrogativas e tecnologia aplicada ao Direito.',
                'data_evento' => '2026-11-11 09:00:00',
                'local' => 'Auditório do Instituto MAR — Brasília/DF (Transmissão On-line HD)',
                'vagas_totais' => 30,
                'formato' => 'Híbrido',
                'carga_horaria' => '10 Horas Acadêmicas',
                'ativo' => true,
            ],
            [
                'slug' => 'congresso-prerrogativas-inovacao-2026',
                'titulo' => 'I Congresso Brasileiro de Prerrogativas e Inovação Jurídica',
                'descricao' => 'Debates de alto nível com lideranças jurídicas abordando prerrogativas da advocacia, segurança nos tribunais e novas tecnologias no processo judicial.',
                'data_evento' => '2026-10-28 09:30:00',
                'local' => 'Brasília / DF',
                'vagas_totais' => 100,
                'formato' => 'Presencial',
                'carga_horaria' => '12 Horas Acadêmicas',
                'ativo' => true,
            ],
            [
                'slug' => 'seminario-ia-etica-profissional',
                'titulo' => 'Seminário: Inteligência Artificial e Ética Profissional',
                'descricao' => 'Análise prática e aprofundada sobre os limites regulatórios da inteligência artificial generativa, produtividade ética e impactos nos escritórios de advocacia.',
                'data_evento' => '2026-11-12 14:00:00',
                'local' => 'Online ao Vivo',
                'vagas_totais' => 250,
                'formato' => 'On-line',
                'carga_horaria' => '6 Horas Acadêmicas',
                'ativo' => true,
            ],
            [
                'slug' => 'encontro-anual-coordenadores-estaduais',
                'titulo' => 'Encontro Anual de Coordenadores Estaduais',
                'descricao' => 'Alinhamento de diretrizes nacionais, planejamento estratégico institucional para o biênio e posse oficial dos membros das novas comissões temáticas do MAR.',
                'data_evento' => '2026-12-05 10:00:00',
                'local' => 'São Paulo / SP',
                'vagas_totais' => 60,
                'formato' => 'Híbrido',
                'carga_horaria' => '8 Horas Acadêmicas',
                'ativo' => true,
            ],
            [
                'slug' => 'curso-pratico-defesa-prerrogativas',
                'titulo' => 'Curso Prático de Atuação Imediata em Violação de Prerrogativas',
                'descricao' => 'Treinamento operacional para advogados sobre providências urgentes diante de recusa de atendimento, retenção indevida de autos ou cerceamento de sustentação.',
                'data_evento' => '2026-12-18 19:00:00',
                'local' => 'Online ao Vivo',
                'vagas_totais' => 150,
                'formato' => 'On-line',
                'carga_horaria' => '4 Horas Acadêmicas',
                'ativo' => true,
            ],
        ];

        foreach ($events as $eventData) {
            $event = Event::updateOrCreate(
                ['slug' => $eventData['slug']],
                $eventData
            );

            // Inscrições simuladas para o Simpósio Principal
            if ($event->slug === 'simposio-mar-2026' && $event->registrations()->count() === 0) {
                for ($i = 1; $i <= 24; $i++) {
                    EventRegistration::create([
                        'event_id' => $event->id,
                        'nome' => "Advogado Participante $i",
                        'email' => "participante$i@oab.org.br",
                        'whatsapp' => '(61) 98888-'.sprintf('%04d', $i),
                        'oab_uf' => sprintf('%05d/DF', $i * 321),
                        'status' => 'confirmado',
                    ]);
                }
            }
        }

        // Certificados Exemplo
        $certificates = [
            [
                'codigo' => 'MAR-2026-98421',
                'participante_nome' => 'Dr. Marcos Vinícius Alencar',
                'oab_uf' => '123.456/SP',
                'evento_titulo' => 'Simpósio Instituto MAR — Advocacia Renovada 2026',
                'carga_horaria' => '10 Horas Acadêmicas',
                'data_emissao' => '2026-03-16',
                'hash_digital' => 'e8f9a7d3-2026-mar-val',
            ],
            [
                'codigo' => 'MAR-2026-77312',
                'participante_nome' => 'Dra. Ana Paula Silveira',
                'oab_uf' => '45.890/DF',
                'evento_titulo' => 'I Congresso Brasileiro de Prerrogativas e Inovação Jurídica',
                'carga_horaria' => '12 Horas Acadêmicas',
                'data_emissao' => '2026-04-10',
                'hash_digital' => 'b4c7d9e1-2026-mar-val',
            ],
            [
                'codigo' => 'MAR-2026-55109',
                'participante_nome' => 'Dr. Roberto Mendes Fonseca',
                'oab_uf' => '189.230/RJ',
                'evento_titulo' => 'Seminário: Inteligência Artificial e Ética Profissional',
                'carga_horaria' => '6 Horas Acadêmicas',
                'data_emissao' => '2026-05-20',
                'hash_digital' => 'c1f2a3e5-2026-mar-val',
            ],
        ];

        foreach ($certificates as $cert) {
            Certificate::updateOrCreate(
                ['codigo' => $cert['codigo']],
                $cert
            );
        }
    }
}
