import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    // On déclare les "targets" = éléments qu'on veut manipuler
    static targets = ["slide"];

    // Index de la slide actuellement affichée
    currentIndex = 0;

    connect() {
        // Méthode appelée quand le controller se connecte au HTML
        console.log("Slideshow connecté !");
        console.log("Nombre de slides :", this.slideTargets.length);

        // Affiche uniquement la première slide au démarrage
        this.showSlide(0);
    }

    // Méthode pour afficher une slide spécifique
    showSlide(index) {
        // Parcourt toutes les slides
        this.slideTargets.forEach((slide, i) => {
            if (i === index) {
                slide.style.display = "block"; // Affiche
            } else {
                slide.style.display = "none"; // Cache
            }
        });
        this.currentIndex = index;
    }

    // Méthode appelée quand on clique sur "Suivant"
    next() {
        let newIndex = this.currentIndex + 1;
        // Si on dépasse la dernière slide, on revient à la première
        if (newIndex >= this.slideTargets.length) {
            newIndex = 0;
        }
        this.showSlide(newIndex);
    }

    // Méthode appelée quand on clique sur "Précédent"
    previous() {
        let newIndex = this.currentIndex - 1;
        // Si on est avant la première slide, on va à la dernière
        if (newIndex < 0) {
            newIndex = this.slideTargets.length - 1;
        }
        this.showSlide(newIndex);
    }
}
