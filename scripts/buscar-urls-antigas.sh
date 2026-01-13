#!/bin/bash

# Script auxiliar para encontrar e listar todos os arquivos que usam URLs antigas de eventos
# Use este script para identificar quais views ainda precisam ser atualizadas

echo "======================================"
echo "Buscando URLs antigas de eventos..."
echo "======================================"
echo ""

# Busca padrão: url('eventos/detalhes'
echo "📄 Arquivos com padrão: url('eventos/detalhes'"
grep -r "url('eventos/detalhes'" /var/www/html/trilhasemsc/resources/views/ --include="*.blade.php" -n

echo ""
echo "======================================"
echo ""

# Busca padrão: url("eventos/detalhes"
echo "📄 Arquivos com padrão: url(\"eventos/detalhes\""
grep -r 'url("eventos/detalhes"' /var/www/html/trilhasemsc/resources/views/ --include="*.blade.php" -n

echo ""
echo "======================================"
echo ""

# Busca padrão: eventos/detalhes/
echo "📄 Arquivos com padrão: eventos/detalhes/"
grep -r "eventos/detalhes/" /var/www/html/trilhasemsc/resources/views/ --include="*.blade.php" -n

echo ""
echo "======================================"
echo "Busca concluída!"
echo "======================================"
echo ""
echo "💡 Dica: Para cada arquivo encontrado, substitua:"
echo ""
echo "   DE:   {{ url('eventos/detalhes', \$evento->id_evento_eve) }}"
echo "   PARA: {{ url('eventos/' . (\$evento->slug_eve ?: \$evento->id_evento_eve)) }}"
echo ""
echo "   Ou simplesmente use:"
echo "   {{ \$evento->url }}"
echo ""
