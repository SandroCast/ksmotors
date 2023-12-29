function alternarVisibilidade(event) {
    event.preventDefault();
    var minhaDiv = document.getElementById('config-perfil');

    // Alterna a visibilidade da div
    if (minhaDiv) {
        if (minhaDiv.hasAttribute('hidden')) {
            minhaDiv.removeAttribute('hidden');
        } else {
            minhaDiv.setAttribute('hidden', 'true');
        }
    }

    // Impede a propagação do clique para evitar a execução do evento de fechamento
    event.stopPropagation();
}

document.addEventListener('DOMContentLoaded', function() {
    var minhaDiv = document.getElementById('config-perfil');

    // Adiciona um ouvinte de evento ao documento para cliques fora da div
    document.addEventListener('click', function(event) {
        var clicouDentro = minhaDiv && minhaDiv.contains(event.target);

        // Se o clique ocorreu fora da div e a div está visível, oculta a div
        if (!clicouDentro && minhaDiv && !minhaDiv.hasAttribute('hidden')) {
            minhaDiv.setAttribute('hidden', 'true');
        }
    });

    // Adiciona um ouvinte de evento ao botão para evitar a propagação do clique
    if (minhaDiv) {
        minhaDiv.addEventListener('click', function(event) {
            event.stopPropagation(); // Impede que o clique na div seja propagado para o documento
        });
    }

    // Adiciona um ouvinte de evento de rolagem ao documento
    window.addEventListener('scroll', function() {
        // Oculta a div se ela estiver visível
        if (minhaDiv && !minhaDiv.hasAttribute('hidden')) {
            minhaDiv.setAttribute('hidden', 'true');
        }
    });
});