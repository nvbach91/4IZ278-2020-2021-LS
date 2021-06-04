(function () {

    let state = {
        // Index of the currently viewed question
        current: 0,

        // References to question containers
        questions: [],

        // Whether the answer is revealed
        revealed: false,
    };

    const bindControls = () => {
        const previous = document.querySelector(".question__control--previous");
        const toggle = document.querySelector(".question__control--toggle");
        const next = document.querySelector(".question__control--next");

        previous.addEventListener("click", () => {
            state.current = state.current === 0
                ? state.questions.length - 1
                : state.current - 1;

            state.revealed = false;
            render(state);
        });

        toggle.addEventListener("click", () => {
            state.revealed = !state.revealed;
            render(state);
        });

        next.addEventListener("click", () => {
            state.current = (state.current + 1) % state.questions.length;
            state.revealed = false;
            render(state);
        });
    };

    const render = (state) => {
        state.questions.forEach(container => container.classList.add("question--hidden"));
        state.questions[state.current].classList.remove("question--hidden");

        const container = state.questions[state.current];
        const question = container.querySelector(".question--question");
        const answer = container.querySelector(".question--answer");

        if (state.revealed) {
            question.classList.add("question__content--hidden");
            answer.classList.remove("question__content--hidden");
            container.classList.add("question--revealed");
        } else {
            answer.classList.add("question__content--hidden");
            question.classList.remove("question__content--hidden");
            container.classList.remove("question--revealed");
        }

    };

    const initialize = () => {
        const questions = document.getElementsByClassName(window.__practice_nonce + "_question");

        // Initialize the state
        state.current = 0;
        state.revealed = false;
        state.questions = Array.from(questions);

        bindControls();

        render(state);
    };

    document.addEventListener('DOMContentLoaded', initialize);
})();
