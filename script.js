// Este script usa AJAX para enviar dados para o servidor PHP

function saveNote() {
    var noteContent = document.getElementById("note-input").value;

    // Verifica se o conteúdo da nota não está vazio
    if (noteContent.trim() !== "") {
        // Envia a nota para o servidor PHP usando AJAX
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Atualiza a lista de notas após salvar
                loadNotes();
            }
        };
        xhttp.open("POST", "save_note.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("content=" + noteContent);
    }
}
function loadNotes() {
    // Carrega as notas do servidor e exibe na div notes-container
    var notesContainer = document.getElementById("notes-container");

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Limpa o conteúdo atual
            notesContainer.innerHTML = "";

            // Converte a resposta JSON em um array de objetos
            var notes = JSON.parse(this.responseText);

            // Itera sobre as notas e adiciona ao HTML
            for (var i = 0; i < notes.length; i++) {
                var noteDiv = document.createElement("div");
                noteDiv.id = "note-" + notes[i].id;

                var noteContent = document.createTextNode(notes[i].content);
                noteDiv.appendChild(noteContent);

                // Adiciona o botão de deletar
                var deleteButton = document.createElement("button");
                deleteButton.textContent = "Deletar";
                // Usa uma função anônima para capturar o valor correto de i
                deleteButton.onclick = (function (id) {
                    return function () {
                        deleteNoteButton(id);
                    };
                })(notes[i].id);

                noteDiv.appendChild(deleteButton);

                notesContainer.appendChild(noteDiv);
            }
        }
    };
    xhttp.open("GET", "load_notes.php", true);
    xhttp.send();
}

function deleteNoteButton(noteId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Atualiza a lista de notas após deletar
            loadNotes();
        }
    };
    xhttp.open("POST", "delete_note.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("noteId=" + noteId);
}


// Carrega as notas ao carregar a página
window.onload = loadNotes;
