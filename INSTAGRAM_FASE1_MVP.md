# Instagram Fase 1 - MVP de Métricas

Fluxo implementado:

Instagram Graph API -> Comando de Extração -> PostgreSQL -> Dashboard Laravel

## 1) Configuração de ambiente

Defina as variáveis abaixo no arquivo .env:

```env
# Credenciais Instagram Graph API
INSTAGRAM_GRAPH_URL=https://graph.facebook.com/v20.0
INSTAGRAM_ACCESS_TOKEN=SEU_TOKEN_DE_LONGA_DURACAO
INSTAGRAM_IG_USER_ID=SEU_INSTAGRAM_USER_ID
INSTAGRAM_DAILY_METRICS=reach,views,profile_views,website_clicks,follower_count
INSTAGRAM_MEDIA_FIELDS=id,caption,media_type,permalink,timestamp
INSTAGRAM_MEDIA_METRICS=reach,views,likes,comments,shares,saves,total_interactions

# Pesos do score de analise (Fase 2.1)
INSTAGRAM_SCORE_WEIGHT_REACH=1
INSTAGRAM_SCORE_WEIGHT_VIEWS=0.5
INSTAGRAM_SCORE_WEIGHT_PROFILE_VIEWS=5
INSTAGRAM_SCORE_WEIGHT_WEBSITE_CLICKS=20

# Banco PostgreSQL dedicado para métricas
INSTAGRAM_DB_HOST=127.0.0.1
INSTAGRAM_DB_PORT=5432
INSTAGRAM_DB_DATABASE=instagram_metrics
INSTAGRAM_DB_USERNAME=postgres
INSTAGRAM_DB_PASSWORD=postgres
INSTAGRAM_DB_SCHEMA=public
INSTAGRAM_DB_SSLMODE=prefer
```

## 2) Criar tabela de snapshots

```bash
php artisan migrate --database=instagram_pgsql
```

Migration criada:
- `database/migrations/2026_06_25_000000_create_instagram_metric_snapshots_table.php`
- `database/migrations/2026_06_25_000001_add_views_to_instagram_metric_snapshots_table.php`
- `database/migrations/2026_06_25_000002_create_instagram_media_metrics_table.php`

## 3) Sincronizar dados do Instagram

Sincronizar 1 dia (ontem):

```bash
php artisan instagram:sync-metrics
```

Sincronizar data específica:

```bash
php artisan instagram:sync-metrics --date=2026-06-24
```

Sincronizar últimos 7 dias a partir da data base:

```bash
php artisan instagram:sync-metrics --date=2026-06-24 --days=7
```

Sincronizar métricas por publicação (base para análise de horários):

```bash
php artisan instagram:sync-media-metrics --days=60 --limit=100
```

## 4) Acessar dashboard

URL no admin:

- `/admin/instagram/metricas`

Tela criada:
- `resources/views/admin/instagram-metrics.blade.php`

## 5) Agendamento automático

Foi adicionado no scheduler diário (06:00):

- `instagram:sync-metrics --days=1`
- `instagram:sync-media-metrics --days=60 --limit=100` (06:20)

Arquivo:
- `app/Console/Kernel.php`

Lembrete: para o agendamento funcionar em produção, configure o cron do Laravel executando `php artisan schedule:run` a cada minuto.
