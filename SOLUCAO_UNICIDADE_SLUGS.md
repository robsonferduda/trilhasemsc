# 🎯 Solução de Unicidade de Slugs - Múltiplos Guias

## 📋 O Problema

Diferentes guias podem oferecer o mesmo evento. Por exemplo:
- Guia "Aventura SC" oferece "Trilha da Costa da Lagoa"
- Guia "João Silva Turismo" também oferece "Trilha da Costa da Lagoa"

Se usássemos apenas o nome do evento no slug, teríamos:
- ❌ `trilha-da-costa-da-lagoa` (qual guia?)
- ❌ `trilha-da-costa-da-lagoa` (conflito!)

## ✅ A Solução Implementada

O sistema agora **inclui automaticamente o nome do guia E a data no slug**, criando URLs únicas E descritivas:

```
✅ trilha-da-costa-da-lagoa-aventura-sc-15-mar
✅ trilha-da-costa-da-lagoa-aventura-sc-22-mar
✅ trilha-da-costa-da-lagoa-joao-silva-turismo-15-mar
✅ trilha-da-costa-da-lagoa-guia-montanha-30-abr
```

## 🔧 Como Funciona

### 1. Formato do Slug
```
[nome-do-evento]-[nome-do-guia]-[dia-mes]
```

Exemplo completo:
```
trilha-da-costa-da-lagoa-aventura-sc-15-mar
│                          │             │
└─ Nome do Evento          │             └─ Data (dia-mês)
                           └─ Nome do: `aventura-sc-turismo` → `aventura-sc-turismo`
4. Adiciona a data (dia-mês): `15/03/2026` → `15-mar`
5. Combina tudo: `trilha-da-costa-da-lagoa-aventura-sc-turismo-15-mar`
6. Verifica se já existe, se sim, adiciona número: `...-15-mar
### 2. Geração Automática
Quando um evento é criado, o sistema:

1. Converte o nome do evento para slug: `Trilha da Costa da Lagoa` → `trilha-da-costa-da-lagoa`
2. Converte o nome do guia para slug: `Aventura SC Turismo` → `aventura-sc-turismo`
3. Limita o nome do guia a 3 palavras para não deixar muito longo: `aventura-sc-turismo` → `aventura-sc-turismo`
4. Combina: `trilha-da-costa-da-lagoa-aventura-sc-turismo`
5. Verifica se já existe, se sim, adiciona número: `...-aventura-sc-turismo-1`

### 3. Código Responsável

No modelo `Evento.php`, método `generateUniqueSlug()`:

```php
public function generateUniqueSlug($title)
{
    $slug = Str::slug($title);
    
    // Inclui nome do guia no slug
    if ($this->id_guia_gui) {
        $guia = $this->guia;
        if ($guia && $guia->nm_guia_gui) {
            $guiaSlug = Str::slug($guia->nm_guia_gui);
            // Limita para 3 palavras
            $guiaSlugParts = explode('-', $guiaSlug);
            $guiaSlugShort = implode('-', array_slice($guiaSlugParts, 0, 3));
            $slug = $slug . '-' . $guiaSlugShort;
        }
    }
    Inclui a data no slug
    if ($this->dt_realizacao_eve) {
        $data = date('d-M', strtotime($this->dt_realizacao_eve));
        $slug = $slug . '-' . strtolower($data);
    }
    
    // 
    // Garante unicidade
    $originalSlug = $slug;
    $counter = 1;
    while (static::where('slug_eve', $slug)
                ->where('id_evento_eve', '!=', $this->id_evento_eve)
                ->exists()) {
        $slug = $originalSlug . '-' . $counter;
        $counter++;
    }
    , Mesma Data
```
Evento: Trilha da Costa da Lagoa (15/03/2026)
Guia 1: Aventura SC → trilha-da-costa-da-lagoa-aventura-sc-15-mar
Guia 2: João Silva → trilha-da-costa-da-lagoa-joao-silva-15-mar
Guia 3: Montanha Turismo → trilha-da-costa-da-lagoa-montanha-turismo-15-mar
```

### Cenário 2: Mesmo Guia, Mesmo Evento, Datas Diferentes
```
Evento: Trilha da Costa da Lagoa
Guia: Aventura SC

Data 15/03/2026 → trilha-da-costa-da-lagoa-aventura-sc-15-mar
Data 22/03/2026 → trilha-da-costa-da-lagoa-aventura-sc-22-mar
Data 29/03/2026 → trilha-da-costa-da-lagoa-aventura-sc-29-mar
Data 05/04/2026 → trilha-da-costa-da-lagoa-aventura-sc-05-abr
```

### Cenário 3: Mesmo Guia, Mesmo Evento, Mesma Data (improvável, mas tratado)
```
Evento: Tril4: Nomes de Guia Longos
```
Evento: Trilha da Costa da Lagoa (15/03/2026)
Guia: "Associação de Guias de Turismo de Florianópolis"

Nome Completo: associacao-de-guias-de-turismo-de-florianopolis
Limitado (3 palavras): associacao-de-guias

Slug Final: trilha-da-costa-da-lagoa-associacao-de-guias-15-mar
Evento: Trilha da Costa da Lagoa (22/03/2026)
Guia: Aventura SC → trilha-da-costa-da-lagoa-aventura-sc-1

Evento: Trilha da Costa da Lagoa (29/03/2026)
Guia: Aventura SC → trilha-da-costa-da-lagoa-aventura-sc-2
```

### Cenário 3: Nomes de Guia Longos
```
Guia: "Associação de Guias de Turismo de Florianópolis"
Nome Completo: associacao-de-guias-de-turismo-de-florianopolis
Limitado (3 palavras): associacao-de-guias

Slug Final: trilha-da-costa-da-lagoa-associacao-de-guias
```

## 🎨 Benefícios desta Abordagem

### ✅ Para SEO
- URLs únicas para cada guia
- Conteúdo diferente = páginas diferentes
- Melhor indexação pelos buscadores
- Evita conteúdo duplicado

### ✅ Para Usuários
- Clareza sobre qual guia oferece o evento
- Fácil de identificar e compartilhar
- URLs descritivas e profissionais

### ✅ Para o Sistema
- Sem conflitos de slug-15-mar
- Título: Trilha da Costa da Lagoa - Aventura SC - 15 de Março
- Descrição: Evento oferecido por Aventura SC em 15/03/2026
- Conteúdo: Detalhes específicos do guia Aventura SC

Página 2: trilha-da-costa-da-lagoa-aventura-sc-22-mar
- Título: Trilha da Costa da Lagoa - Aventura SC - 22 de Março
- Descrição: Evento oferecido por Aventura SC em 22/03/2026
- Conteúdo: Nova turma em data diferente

Página 3: trilha-da-costa-da-lagoa-joao-silva-15-mar
- Título: Trilha da Costa da Lagoa - João Silva - 15 de Março
- Descrição: Evento oferecido por João Silva em 15/03/2026
- Conteúdo: Detalhes específicos do guia João Silva
```

**Resultado:** Cada evento é indexado separadamente (por guia E por data), melhorando a visibilidade e permitindo que usuários encontrem o evento na data desejada
- Descrição: Evento oferecido por Aventura SC...
- Conteúdo: Detalhes específicos do guia Aventura SC

Página 2: trilha-da-costa-da-lagoa-joao-silva
- Título: Trilha da Costa da Lagoa - João Silva Turismo
- Descrição: Evento oferecido por João Silva...
- Conteúdo: Detalhes específicos do guia João Silva
```

**Resultado:** Cada evento é indexado separadamente, melhorando a visibilidade de todos os guias!

## 🛠️ Alteração no Banco de Dados

### Antes (com UNIQUE):
```sql
slug_eve VARCHAR(255) UNIQUE
```
❌ Problema: Não permite dois eventos com mesmo slug

### Depois (sem UNIQUE):
```sql
slug_eve VARCHAR(255) -- com INDEX para performance
```
✅ Solução: Permite slugs únicos por guia, controlado pela aplicação

## 📝 Migration

A migration foi ajustada para **NÃO** ter constraint `UNIQUE`:

```php
Schema::table('evento_eve', function (Blueprint $table) {
    $table->string('slug_eve', 255)->nullable()->after('nm_evento_eve');
    $table->index('slug_eve'); // Índice para performance, mas não UNIQUE
});
```

Isso permite que a aplicação controle a unicidade de forma mais inteligente.

## ⚙️ Configuração

### Se quiser mudar o número de palavras do guia no slug:

No arquivo `app/Evento.php`, linha com `array_slice`:

```php
// Pega 3 primeiras palavras (padrão)
$guiaSlugShort = implode('-', array_slice($guiaSlugParts, 0, 3));

// Para pegar mais ou menos palavras, mude o número:
$guiaSlugShort = implode('-', array_slice($guiaSlugParts, 0, 2)); // 2 palavras
$guiaSlugShort = implode('-', array_slice($guiaSlugParts, 0, 4)); // 4 palavras
```

### Se quiser incluir a data no slug:

```php
// Adicione após o nome do guia:
if ($this->dt_realizacao_eve) {
    $data = date('Y-m', strtotime($this->dt_realizacao_eve));
    $slug = $slug . '-' . $data;
}
```

Resultado: `trilha-da-costa-da-lagoa-aventura-sc-2026-03`

## 🧪 Testando a Unicidade

### Teste 1: Criar eventos com mesmo nome, guias diferentes

```php
php artisan tinker

// Evento 1
$evento1 = App\Evento::create([
    'nm_evento_eve' => 'Trilha da Costa da Lagoa',
    'id_guia_gui' => 1, // Guia "Aventura SC"
    // ... outros campos
]);
echo $evento1->slug_eve; // trilha-da-costa-da-lagoa-aventura-sc

// Evento 2
$evento2 = App\Evento::create([
    'nm_evento_eve' => 'Trilha da Costa da Lagoa',
    'id_guia_gui' => 2, // Guia "João Silva"
    // ... outros campos
]);
echo $evento2->slug_eve; // trilha-da-costa-da-lagoa-joao-silva
```

### Teste 2: Criar eventos com mesmo nome e mesmo guia

```php
// Evento 1
$evento1 = App\Evento::create([
    'nm_evento_eve' => 'Trilha da Costa da Lagoa',
    'id_guia_gui' => 1,
    'dt_realizacao_eve' => '2026-03-15',
]);
echo $evento1->slug_eve; // trilha-da-costa-da-lagoa-aventura-sc

// Evento 2 (mesma trilha, mesmo guia, data diferente)
$evento2 = App\Evento::create([
    'nm_evento_eve' => 'Trilha da Costa da Lagoa',
    'id_guia_gui' => 1,
    'dt_realizacao_eve' => '2026-03-22',
]);
echo $evento2->slug_eve; // trilha-da-costa-da-lagoa-aventura-sc-1
```

## 📈 Performance

O índice no campo `slug_eve` garante que as buscas sejam rápidas:

```sql
-- Criação do índice na migration
$table->index('slug_eve');

-- Busca otimizada
SELECT * FROM evento_eve WHERE slug_eve = 'trilha-da-costa-da-lagoa-aventura-sc';
-- Usa o índice, resposta rápida mesmo com milhares de eventos
```

## 🎯 Resumo

| Aspecto | Solução |
|---------|---------|
| **Problema** | Múltiplos guias oferecendo mesmo evento |
| **Solução** | Incluir nome do guia no slug |
| **Formato** | `nome-evento-nome-guia` |
| **Unicidade** | Garantida por aplicação + contador |
| **SEO** | Cada guia tem página única |
| **Performance** | Índice no campo slug |
| **Manutenção** | Automática no modelo |

---

## ✅ Status

✅ Constraint UNIQUE removida do banco  
✅ Slug inclui nome do guia  
✅ Unicidade garantida pela aplicação  
✅ Comando de migração atualizado  
✅ Documentação completa  
✅ Pronto para produção  

**Esta solução resolve completamente o problema de unicidade mantendo URLs amigáveis e descritivas!**
