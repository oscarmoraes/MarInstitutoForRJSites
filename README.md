# Instituto MAR — Movimento da Advocacia Renovada

Portal Institucional e Sistema Administrativo Integrado do **Instituto MAR**, desenvolvido em **Laravel 11**, **Filament PHP 3**, **Livewire 3** e **Tailwind CSS**.

---

## 🏛️ Sobre o Projeto

O Instituto MAR tem como missão a representatividade, formação continuada e defesa intransigente das prerrogativas da advocacia brasileira em todo o território nacional.

Este repositório contém a solução digital completa da instituição:
1. **Portal Público**:
   - Página Inicial dinâmica e institucional.
   - Portal de Notícias e Artigos Jurídicos com destaques.
   - Calendário de Cursos, Palestras e Simpósios com inscrição interativa (Livewire).
   - Notas e Atos Oficiais publicados pela diretoria e comissões.
   - Canal Emergencial de Prerrogativas 24h com formulário seguro.
   - Diretoria Executiva, Comissões e Representantes Estaduais com filtro por UF.
   - Formulário de Filiação Institucional (*Seja um Associado*) com emissão de protocolo provisório.
   - Carteirinha Digital do Associado com consulta interativa (Matrícula, CPF, OAB) e suporte a impressão PDF.
   - Validador Público de Certificados.
2. **Painel Administrativo (Filament PHP)**:
   - Configurações do Portal (Logo, Redes Sociais, Contatos, Rótulos de Navegação e Chaves Liga/Desliga de Módulos).
   - Gestão de Notícias, Cursos, Documentos e Inscrições.
   - Gestão de Associados, Diretoria e Representantes.
   - Central de Atendimento e Mensagens de Contato recebidas.
   - Triagem de Chamados Emergenciais de Prerrogativas.

---

## 🚀 Tecnologias Utilizadas

- **PHP**: ^8.2
- **Framework**: Laravel 11
- **Admin Panel**: Filament PHP 3.x
- **Componentes Reativos**: Livewire 3
- **Estilização**: Tailwind CSS & FontAwesome 6
- **Banco de Dados**: MySQL / MariaDB

---

## 💻 Instalação e Execução Local

### 1. Clonar o repositório:
```bash
git clone https://github.com/oscarmoraes/MarInstitutoForRJSites.git
cd MarInstitutoForRJSites
```

### 2. Instalar dependências PHP:
```bash
composer install
```

### 3. Configurar ambiente:
```bash
cp .env.example .env
php artisan key:generate
```

Edite o arquivo `.env` com as configurações do seu banco MySQL local:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mar_rjsites
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Executar migrações e seeders iniciais:
```bash
php artisan migrate --seed
```

### 5. Criar link simbólico do storage:
```bash
php artisan storage:link
```

### 6. Iniciar o servidor local:
```bash
php artisan serve
```

Acesse:
- **Portal**: [http://localhost:8000](http://localhost:8000)
- **Painel Admin**: [http://localhost:8000/admin](http://localhost:8000/admin)
  - **E-mail**: `admin@institutomar.org.br`
  - **Senha**: `admin123`

---

## 🌐 Deploy em Produção

Para subir no domínio de produção **`https://mar-instituto.org.br/`**:
1. Configure o apontamento DNS tipo A e ative o certificado SSL HTTPS.
2. Defina no arquivo `.env`:
   ```ini
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://mar-instituto.org.br
   ```
3. Otimize os caches do Laravel e do Filament:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan filament:cache-components
   ```

---

## ⚖️ Licença

Projeto desenvolvido para o Instituto MAR. Todos os direitos reservados.
