
import { Controller } from '@hotwired/stimulus';
import { useClickOutside } from 'stimulus-use';

export default class extends Controller {    

    static values = {
        url: String,
        parentId: String,
        userToAdmin: String,
        parentName: String,
    }

    static targets = ['result'];

    // Requête AJAX
    async onSearchInput(event) {
        const params = new URLSearchParams({
            q: event.currentTarget.value,
            preview: 1,
        });
            // fetch la valeur de l'URL (avec la nouvelle entrée q du formulaire) et la transforme en string puis retourne une prommesse, la réponse va être obtenue avec await qui va attendre que l'appel ajax soit terminé pour donner le résultat du fetch
            const response = await fetch(`${this.urlValue}?${params.toString()}&parentId=${this.parentIdValue}&userToAdmin=${this.userToAdminValue}&parentName=${this.parentNameValue}`);
            // Renvoie au SearchController grace à l'URL contenu dans la réponse
            this.resultTarget.innerHTML = await response.text();
    }

    // un click à l'extérieur de la barre de recherche afiche "rien"
    connect() {useClickOutside(this);}
    clickOutside(event) {this.resultTarget.innerHTML = '';}

}
