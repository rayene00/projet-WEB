document.addEventListener('DOMContentLoaded', function() {
    const starsContainer = document.getElementById('starsContainer');
    const stars = starsContainer.getElementsByTagName('i');
    const noteInput = document.getElementById('noteInput');
    const noteText = document.getElementById('noteText');
    const avisText = document.getElementById('avisText');
    const charCount = document.getElementById('charCount');
    const avisForm = document.getElementById('avisForm');

    // Gestion des étoiles
    starsContainer.addEventListener('mouseover', function(e) {
        if (e.target.tagName === 'I') {
            const value = parseInt(e.target.dataset.value);
            updateStars(value);
        }
    });

    starsContainer.addEventListener('mouseout', function() {
        const currentNote = parseInt(noteInput.value);
        updateStars(currentNote);
    });

    starsContainer.addEventListener('click', function(e) {
        if (e.target.tagName === 'I') {
            const value = parseInt(e.target.dataset.value);
            noteInput.value = value;
            noteText.textContent = value;
            updateStars(value);
        }
    });

    // Compteur de caractères
    avisText.addEventListener('input', function() {
        const count = this.value.length;
        charCount.textContent = count;
        
        // Change la couleur si proche de la limite
        if (count > 400) {
            charCount.style.color = '#ff4444';
        } else {
            charCount.style.color = '#666';
        }
    });

    // Mise à jour visuelle des étoiles
    function updateStars(value) {
        for (let i = 0; i < stars.length; i++) {
            stars[i].className = i < value ? 'fas fa-star' : 'far fa-star';
        }
    }

    // Validation du formulaire
    avisForm.addEventListener('submit', function(e) {
        const note = parseInt(noteInput.value);
        const texte = avisText.value.trim();

        if (note === 0) {
            e.preventDefault();
            alert('Veuillez sélectionner une note');
        } else if (texte.length < 10) {
            e.preventDefault();
            alert('Votre avis doit contenir au moins 10 caractères');
        }
    });
});