# Sistema de URLs Amigáveis para Eventos - Trilhas em SC

## 📋 O que foi implementado?

O sistema agora suporta URLs amigáveis (com slugs) para os eventos, mantendo total compatibilidade com as URLs antigas.

### Exemplos de URLs

#### ❌ URL Antiga (ainda funciona):
```
https://trilhasemsc.com.br/eventos/detalhes/17
```

#### ✅ URLs Novas (SEO-friendly com identificação do guia e data):
```
https://trilhasemsc.com.br/eventos/trilha-da-costa-da-lagoa-aventura-sc-15-mar
https://trilhasemsc.com.br/eventos/trilha-da-costa-da-lagoa-aventura-sc-22-mar
https://trilhasemsc.com.br/eventos/trilha-da-costa-da-lagoa-joao-silva-turismo-15-mar
https://trilhasemsc.com.br/eventos/caminhada-morro-do-macaco-guia-trilhas-sul-10-abr
https://trilhasemsc.com.br/eventos/trekking-serra-do-rio-do-rastro-montanha-turismo-25-mai
```

**Nota:** O slug agora inclui o nome do guia E a data para garantir unicidade total, pois:
- Diferentes guias podem oferecer o mesmo evento
- O mesmo guia pode oferecer o mesmo evento em datas diferentes

## 🚀 Como Usar

### 1. Executar a Migration

Primeiro, execute a migration para adicionar o campo slug na tabela:

```bash
php artisan migrate
```

### 2. Gerar Slugs para Eventos Existentes

Execute o comando Artisan para gerar slugs automaticamente para todos os eventos existentes:

```bash
php artisan eventos:gerar-slugs
```

Este comando:
- Gera slugs para todos os eventos que ainda não possuem
- Garante que não haverá slugs duplicados
- Mostra exemplos das URLs geradas

### 3. Usar nas Views

Nos arquivos Blade, você pode usar de duas formas:

#### Forma Recomendada (usa slug automaticamente):
```blade
<a href="{{ $evento->url }}">Ver Detalhes</a>
```

#### Forma Manual:
```blade
<a href="{{ url('eventos/' . ($evento->slug_eve ?: $evento->id_evento_eve)) }}">Ver Detalhes</a>
```

#### Forma Antiga (ainda funciona):
```blade
<a href="{{ url('eventos/detalhes', $evento->id_evento_eve) }}">Ver Detalhes</a>
```

## 🔄 Compatibilidade

### URLs antigas continuam funcionando!

✅ `https://trilhasemsc.com.br/eventos/detalhes/17` → Redireciona automaticamente para a URL com slug  
✅ `https://trilhasemsc.com.br/eventos/17` → Funciona e redireciona para o slug  
✅ `https://trilhasemsc.com.br/eventos/nome-do-evento` → URL nova e bonita!  

**Importante:** O sistema faz redirecionamento 301 (permanente) das URLs antigas para as novas, o que é excelente para SEO!

## 🎯 Funcionamento Técnico

### Modelo (Evento.php)

1. **Geração automática de slug** ao criar evento
2. **Atualização automática** se o nome do evento mudar
3. **Garantia de slugs únicos** (adiciona números se necessário)
4. **Método `findBySlugOrId()`** para buscar por slug ou ID

### Controller (EventoController.php)

- Aceita tanto slug quanto ID no parâmetro
- Redireciona URLs antigas para as novas (SEO 301)
- Retorna 404 se o evento não existir

### Rotas (web.php)

```php
// Nova rota principal (aceita slug ou ID)
Route::get('eventos/{slugOrId}', 'EventoController@detalhes')
    ->name('evento.detalhes');

// Rota antiga mantida para compatibilidade total
Route::get('eventos/detalhes/{id}', 'EventoController@detalhes');
```

## 📝 Criando Novos Eventos

Ao criar um novo evento, o slug será gerado automaticamente a partir do nome:

```php
$evento = Evento::create([
    'nm_evento_eve' => 'Trilha da Costa da Lagoa - Florianópolis',
    // ... outros campos
]);

// Slug gerado automaticamente: "trilha-da-costa-da-lagoa-florianopolis"
echo $evento->slug_eve;
echo $evento->url; // URL completa
```

## 🔧 Slugs Duplicados

O sistema lida automaticamente com eventos de mesmo nome oferecidos por guias diferentes e/ou em datas diferentes:

**Formato do Slug:** `nome-do-evento-nome-do-guia-dia-mes`

Exemplos:
```
"Trilha do Morro" (Aventura SC, 15/03) → trilha-do-morro-aventura-sc-15-mar
"Trilha do Morro" (Aventura SC, 22/03) → trilha-do-morro-aventura-sc-22-mar
"Trilha do Morro" (João Silva, 15/03) → trilha-do-morro-joao-silva-15-mar
"Trilha do Morro" (João Silva, 22/03) → trilha-do-morro-joao-silva-22-mar
```

Se mesmo assim houver duplicatas (mesma trilha, mesmo guia, mesma data, mas eventos separados), um número é adicionado:
```
"Trilha do Morro" (Aventura SC, 15/03, Turma Manhã) → trilha-do-morro-aventura-sc-15-mar
"Trilha do Morro" (Aventura SC, 15/03, Turma Tarde) → trilha-do-morro-aventura-sc-15-mar-1
```

**Benefícios:**
- ✅ Cada guia tem seus eventos claramente identificados
- ✅ Cada data tem sua própria URL
- ✅ URLs descritivas mostram evento, guia E data
- ✅ Melhor para SEO (diferentes datas = diferentes páginas)
- ✅ Facilita busca por eventos em datas específicas

## 📊 Atualizando Views Gradualmente

Você pode atualizar as views gradualmente. Enquanto isso, ambas as formas funcionam:

### Arquivos que usam links de eventos:
- `/resources/views/eventos/index.blade.php`
- `/resources/views/admin/eventos/listar.blade.php`
- `/resources/views/admin/eventos/trilheiro.blade.php`
- `/resources/views/eventos/confirmacao.blade.php`
- `/resources/views/eventos/cancelamento.blade.php`
- `/resources/views/layouts/site.blade.php`

### Atualização Recomendada:

Trocar:
```blade
<a href="{{ url('eventos/detalhes', $evento->id_evento_eve) }}">
```

Por:
```blade
<a href="{{ $evento->url }}">
```

Ou:
```blade
<a href="{{ url('eventos/' . ($evento->slug_eve ?: $evento->id_evento_eve)) }}">
```

## 🎨 Benefícios do Sistema

### Para SEO:
✅ URLs descritivas e amigáveis  
✅ Melhor indexação pelos buscadores  
✅ Redirecionamento 301 das URLs antigas  
✅ Slugs únicos e otimizados  

### Para Usuários:
✅ URLs mais fáceis de lembrar  
✅ URLs mais fáceis de compartilhar  
✅ Aparência mais profissional  

### Para Desenvolvedores:
✅ Compatibilidade retroativa garantida  
✅ Geração automática de slugs  
✅ Fácil de usar nas views  
✅ Comando para migração de dados existentes  

## 🧪 Testando

### 1. Testar URL antiga:
```
https://trilhasemsc.com.br/eventos/detalhes/17
```
Deve redirecionar para a URL com slug.

### 2. Testar URL com slug:
```
https://trilhasemsc.com.br/eventos/[slug-do-evento]
```
Deve exibir o evento normalmente.

### 3. Testar criação de novo evento:
Crie um novo evento e verifique se o slug foi gerado automaticamente.

## 📈 Estatísticas

O sistema continua registrando estatísticas normalmente, usando o ID do evento internamente.

## ⚠️ Importante

1. **Execute a migration**: `php artisan migrate`
2. **Gere os slugs**: `php artisan eventos:gerar-slugs`
3. **Limpe o cache**: `php artisan route:clear && php artisan config:clear`
4. **Atualize as views gradualmente** para usar a nova URL

## 🔮 Próximos Passos (Opcional)

Se desejar, você pode:

1. **Atualizar todas as views** para usar `$evento->url`
2. **Adicionar sitemap.xml** com as URLs dos eventos
3. **Adicionar meta tags Open Graph** com as URLs amigáveis
4. **Criar redirects 301** no `.htaccess` se necessário

---

## 🆘 Solução de Problemas

### Slug não está sendo gerado?
```bash
# Limpe o cache
php artisan config:clear
php artisan route:clear

# Execute o comando novamente
php artisan eventos:gerar-slugs
```

### URL antiga não redireciona?
Verifique se a rota está registrada corretamente:
```bash
php artisan route:list | grep evento
```

### Slug com caracteres estranhos?
O sistema usa `Str::slug()` do Laravel, que remove acentos e caracteres especiais automaticamente.

---

**Status**: ✅ Implementado e pronto para uso!
