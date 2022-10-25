
import { Controller } from '@hotwired/stimulus';
import { useClickOutside } from 'stimulus-use';

export default class extends Controller {

    connect() {
        useClickOutside(this);
    }


    static values = {
        url: String,
        parentId: String,
        userToAdmin: String,
        parentName: String,
    }

    static targets = ['result'];

    async onSearchInput(event) {
        const params = new URLSearchParams({
            q: event.currentTarget.value,
            preview: 1,
        });
            const response = await fetch(`${this.urlValue}?${params.toString()}&parentId=${this.parentIdValue}&userToAdmin=${this.userToAdminValue}&parentName=${this.parentNameValue}`);
            this.resultTarget.innerHTML = await response.text();
    }

    clickOutside(event) {
        this.resultTarget.innerHTML = '';
    }

}
