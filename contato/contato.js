document.getElementById("contactForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    var formData = new FormData(this); // Obtém os dados do formulário

    // Usando Fetch API para enviar o formulário via AJAX
    fetch("contatar/submit_form.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json()) // Espera uma resposta em JSON
    .then(data => {
        if (data.success) {
            // Se o envio for bem-sucedido, redireciona o usuário para a página de contato
            alert("Mensagem enviada com sucesso!");
            window.location.href = "/requiem/contato/contato.html"; // Caminho absoluto para o formulário
        } else {
            // Caso contrário, exibe a mensagem de erro
            alert("Erro: " + (data.message || "Houve um erro desconhecido. Tente novamente."));
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert("Houve um erro no envio. Tente novamente.");
    });
});
