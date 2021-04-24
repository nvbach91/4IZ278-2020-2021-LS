(function () {
    document.addEventListener('DOMContentLoaded', () => {

        const token = document.querySelector("meta[name=csrf-token]").getAttribute("content");

        const api = {
            flashcards: {
                add: (collection, flashcard) => `/collections/${collection}/flashcards/${flashcard}/favorite`,
                remove: (collection, flashcard) => `/collections/${collection}/flashcards/${flashcard}/unfavorite`
            },
            collections: {
                add: collection => `/collections/${collection}/favorite`,
                remove: collection => `/collections/${collection}/unfavorite`
            },
        }

        let requestLock = false;

        const performRequest = async (url) => {
            if (requestLock) return;

            requestLock = true;

            return await fetch(url, {
                method: 'POST',
                credentials: "same-origin",
                headers: {
                    "X-CSRF-TOKEN": token
                }
            });
        }

        // TODO: Maybe merge those similar event handlers in some elegant way?

        const flashcards = Array.from(document.getElementsByClassName("favorite--flashcard"));

        flashcards.forEach(link => link.addEventListener("click", async function (event) {
            event.preventDefault();

            const action = this.getAttribute("data-favorite-action");
            const collection = this.getAttribute("data-favorite-collection");
            const flashcard = this.getAttribute("data-favorite-flashcard");

            if (action in Object.keys(api.flashcards)) {
                console.error(`Invalid favorite action ${action}!`);
                return;
            }

            const url = api.flashcards[action](collection, flashcard)

            await performRequest(url);
            await window.location.reload();
        }));

        const collections = Array.from(document.getElementsByClassName("favorite--collection"));

        collections.forEach(link => link.addEventListener("click", async function (event) {
            event.preventDefault();

            const action = this.getAttribute("data-favorite-action");
            const collection = this.getAttribute("data-favorite-collection");

            if (action in Object.keys(api.collections)) {
                console.error(`Invalid favorite action ${action}!`);
                return;
            }

            const url = api.collections[action](collection)

            await performRequest(url);
            await window.location.reload();
        }));
    });
})();
