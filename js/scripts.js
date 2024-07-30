document.addEventListener('DOMContentLoaded', function() {
    const triviaContainer = document.getElementById('trivia-container');
    const categoria = document.querySelector('h2').textContent.split(' ')[2];

    fetch(`php/obtener_trivias.php?categoria=${categoria}`)
        .then(response => response.json())
        .then(trivias => {
            if (trivias.error) {
                alert(trivias.error);
                return;
            }
            let rowDiv;
            trivias.forEach((trivia, index) => {
                if (index % 3 === 0) {
                    rowDiv = document.createElement('div');
                    rowDiv.classList.add('trivia-row');
                    triviaContainer.appendChild(rowDiv);
                }

                const triviaDiv = document.createElement('div');
                triviaDiv.classList.add('trivia');

                const pregunta = document.createElement('h3');
                pregunta.textContent = trivia.pregunta;
                triviaDiv.appendChild(pregunta);

                trivia.opciones.forEach(opcion => {
                    const label = document.createElement('label');
                    const input = document.createElement('input');
                    input.type = 'radio';
                    input.name = `trivia-${trivia.id}`;
                    input.value = opcion;
                    input.addEventListener('click', () => {
                        enviarRespuesta(trivia.id, opcion, trivia.respuesta_correcta, trivia.imagen);
                    });
                    label.appendChild(input);
                    label.appendChild(document.createTextNode(opcion));
                    triviaDiv.appendChild(label);
                    triviaDiv.appendChild(document.createElement('br'));
                });

                rowDiv.appendChild(triviaDiv);
            });

            fetch('php/obtener_respuestas.php')
                .then(response => response.json())
                .then(respuestas => {
                    respuestas.forEach(respuesta => {
                        const radioInput = document.querySelector(`input[name="trivia-${respuesta.pregunta_id}"][value="${respuesta.respuesta}"]`);
                        if (radioInput) {
                            radioInput.checked = true;
                            if (respuesta.es_correcta) {
                                const triviaDiv = radioInput.parentNode.parentNode;
                                const barajita = document.createElement('div');
                                barajita.classList.add('barajita');
                                barajita.innerHTML = `<img src="img/${respuesta.imagen}" alt="Barajita"> ¡Felicidades! Has respondido correctamente.`;
                                triviaDiv.appendChild(barajita);
                                barajita.style.display = 'block';
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error al obtener respuestas:', error);
                    alert('Hubo un error al cargar las respuestas. Inténtalo más tarde.');
                });
        })
        .catch(error => {
            console.error('Error al obtener trivias:', error);
            alert('Hubo un error al cargar las trivias. Inténtalo más tarde.');
        });

    function enviarRespuesta(preguntaId, respuesta, respuestaCorrecta, imagen) {
        const respuestaData = {
            pregunta_id: preguntaId,
            respuesta: respuesta,
            imagen: imagen
        };

        fetch('php/trivias.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(respuestaData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            const triviaDiv = document.querySelector(`input[name="trivia-${preguntaId}"]:checked`).parentNode.parentNode;
            if (data.correcta) {
                if (!triviaDiv.querySelector('.barajita')) {
                    const barajita = document.createElement('div');
                    barajita.classList.add('barajita');
                    barajita.innerHTML = `<img src="img/${imagen}" alt="Barajita"> ¡Felicidades! Has respondido correctamente.`;
                    triviaDiv.appendChild(barajita);
                    barajita.style.display = 'block';
                }
            } else {
                alert('Respuesta incorrecta. Inténtalo de nuevo.');
            }
        })
        .catch(error => {
            console.error('Error al enviar respuesta:', error);
            alert('Hubo un error al enviar tu respuesta. Inténtalo más tarde.');
        });
    }
});
