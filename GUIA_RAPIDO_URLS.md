# 🚀 Guia Rápido - Implementação de URLs Amigáveis

## ✅ Checklist de Implementação

### Passo 1: Executar Migration
```bash
cd /var/www/html/trilhasemsc
php artisan migrate
```

**Resultado esperado:**
```
Migrating: 2026_01_13_000000_add_slug_to_evento_table
Migrated:  2026_01_13_000000_add_slug_to_evento_table
```

### Passo 2: Gerar Slugs para Eventos Existentes
```bash
php artisan eventos:gerar-slugs
```

**Resultado esperado:**
```
Iniciando geração de slugs para eventos...
Encontrados X eventos sem slug.
✓ Slugs gerados com sucesso para X eventos!

Exemplos de URLs geradas:
  • Trilha da Costa da Lagoa
    Antiga: http://trilhasemsc.com.br/eventos/detalhes/17
    Nova:   http://trilhasemsc.com.br/eventos/trilha-da-costa-da-lagoa
```

### Passo 3: Limpar Cache
```bash
php artisan route:clear
php artisan config:clear
php artisan cache:clear
```

### Passo 4: Verificar Rotas
```bash
php artisan route:list | grep evento
```

**Você deve ver:**
```
GET|HEAD  eventos ........................ EventoController@index
GET|HEAD  eventos/cancelamento/{id} ..... EventoController@confirmacaoCancelamento
GET|HEAD  eventos/confirmacao/{id} ...... EventoController@confirmacao
GET|HEAD  eventos/detalhes/{id} ......... EventoController@detalhes
GET|HEAD  eventos/{slugOrId} ............. evento.detalhes › EventoController@detalhes
```

## 🧪 Testes

### Teste 1: URL Antiga (deve redirecionar)
Acesse: `https://trilhasemsc.com.br/eventos/detalhes/17`

✅ **Esperado:** Redireciona para `https://trilhasemsc.com.br/eventos/[slug-do-evento]`

### Teste 2: URL Nova
Acesse: `https://trilhasemsc.com.br/eventos/[slug-de-um-evento]`

✅ **Esperado:** Mostra a página do evento normalmente

### Teste 3: Criar Novo Evento
Crie um novo evento via admin e verifique se o slug foi gerado automaticamente.

## 📝 Como Usar nas Views

### ✅ Forma Recomendada (Mais Simples)
```blade
<a href="{{ $evento->url }}">{{ $evento->nm_evento_eve }}</a>
```

### ✅ Forma Manual (Mais Controle)
```blade
<a href="{{ url('eventos/' . ($evento->slug_eve ?: $evento->id_evento_eve)) }}">
    {{ $evento->nm_evento_eve }}
</a>
```

### ⚠️ Forma Antiga (Ainda funciona, mas não recomendada)
```blade
<a href="{{ url('eventos/detalhes', $evento->id_evento_eve) }}">
    {{ $evento->nm_evento_eve }}
</a>
```

## 📊 Status das Views

### ✅ Atualizadas:
- [x] `/resources/views/eventos/index.blade.php`
- [x] `/resources/views/admin/eventos/listar.blade.php`
- [x] `/resources/views/admin/eventos/trilheiro.blade.php`

### ⏳ Pendentes (ainda funcionam, mas podem ser atualizadas):
- [ ] `/resources/views/eventos/confirmacao.blade.php`
- [ ] `/resources/views/eventos/cancelamento.blade.php`
- [ ] `/resources/views/layouts/site.blade.php`

**Nota:** As views pendentes continuam funcionando perfeitamente! O redirecionamento automático garante que as URLs antigas ainda funcionem.

## 🔍 Encontrar Views que Precisam Atualização

Execute o script auxiliar:
```bash
chmod +x /var/www/html/trilhasemsc/scripts/buscar-urls-antigas.sh
/var/www/html/trilhasemsc/scripts/buscar-urls-antigas.sh
```

## 🎯 Exemplos de URLs Geradas

| Nome do Evento | Guia | Data | URL Antiga | URL Nova |
|----------------|------|------|------------|----------|
| Trilha da Costa da Lagoa | Aventura SC | 15/03 | `/eventos/detalhes/17` | `/eventos/trilha-da-costa-da-lagoa-aventura-sc-15-mar` |
| Trilha da Costa da Lagoa | Aventura SC | 22/03 | `/eventos/detalhes/18` | `/eventos/trilha-da-costa-da-lagoa-aventura-sc-22-mar` |
| Trilha da Costa da Lagoa | João Silva | 15/03 | `/eventos/detalhes/19` | `/eventos/trilha-da-costa-da-lagoa-joao-silva-15-mar` |
| Caminhada Morro do Macaco | Guia Trilhas | 10/04 | `/eventos/detalhes/20` | `/eventos/caminhada-morro-do-macaco-guia-trilhas-10-abr` |

**Importante:** O slug agora inclui o nome do guia E a data para garantir que:
- Diferentes guias oferecendo o mesmo evento tenham URLs únicas
- O mesmo guia oferecendo o mesmo evento em datas diferentes tenha URLs únicas

## ⚡ Comandos Úteis

### Regenerar slug de um evento específico:
```php
// No tinker
php artisan tinker

$evento = App\Evento::find(17);
$evento->slug_eve = null;
$evento->save(); // Vai gerar o slug automaticamente
```

### Ver todos os eventos com suas URLs:
```php
php artisan tinker

App\Evento::all()->each(function($e) {
    echo $e->id_evento_eve . " - " . $e->nm_evento_eve . "\n";
    echo "   Slug: " . $e->slug_eve . "\n";
    echo "   URL:  " . $e->url . "\n\n";
});
```

### Verificar se há slugs duplicados:
```sql
SELECT slug_eve, COUNT(*) as total 
FROM evento_eve 
WHERE slug_eve IS NOT NULL 
GROUP BY slug_eve 
HAVING COUNT(*) > 1;
```

## 🐛 Troubleshooting

### Problema: "Route [evento.detalhes] not defined"
**Solução:**
```bash
php artisan route:clear
php artisan config:clear
```

### Problema: Slug não está sendo gerado
**Solução:**
```bash
# 1. Verifique se a migration foi executada
php artisan migrate:status

# 2. Execute o comando de geração
php artisan eventos:gerar-slugs

# 3. Verifique no banco
# SELECT id_evento_eve, nm_evento_eve, slug_eve FROM evento_eve LIMIT 5;
```

### Problema: URL antiga não redireciona
**Solução:** Verifique se ambas as rotas estão registradas:
```bash
php artisan route:list | grep evento
```

Deve haver:
- `eventos/{slugOrId}` (nova)
- `eventos/detalhes/{id}` (antiga para compatibilidade)

## 📈 Benefícios Implementados

✅ URLs mais amigáveis e profissionais  
✅ Melhor SEO (indexação por buscadores)  
✅ Redirecionamento 301 automático  
✅ Compatibilidade total com URLs antigas  
✅ Geração automática de slugs  
✅ Slugs únicos garantidos  
✅ Fácil de usar nas views  

## 🎉 Pronto!

Seu sistema agora possui URLs amigáveis para eventos, mantendo total compatibilidade com as URLs antigas já divulgadas!

**URLs antigas:** Continuam funcionando e redirecionam automaticamente  
**URLs novas:** Mais bonitas, profissionais e otimizadas para SEO  

---

**Dúvidas?** Consulte o arquivo [URL_AMIGAVEL_EVENTOS.md](URL_AMIGAVEL_EVENTOS.md) para documentação completa.
