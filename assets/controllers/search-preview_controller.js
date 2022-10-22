
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['modal'];

    onSearchInput(event) {
        console.log(event);
    }

    openModal(event) {
        const modal = new Modal(this.modalTarget);
        modal.show();
    }
}
