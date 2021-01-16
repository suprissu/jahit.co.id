class customPage extends HTMLElement {
    constructor() {
        super();
        this.shadow = this.attachShadow({ mode: "open" });
    }

    get title() {
        return this.getAttribute("title");
    }
    get image() {
        return this.getAttribute("image");
    }
    get message() {
        return this.getAttribute("message");
    }
    get backUrl() {
        return this.getAttribute("backUrl");
    }

    connectedCallback() {
        this.render();
    }

    render() {
        this.shadow.innerHTML = `
            <style>
                .blankPage {
                    min-height: 70vh;
                }

                .blankPage__container {
                    width: 80%;
                    margin: 12vh auto;
                    text-align: center;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                }

                .blankPage__image {
                    width: 420px;
                    height: 420px;
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position: center;
                    clip-path: circle(50% at 50% 50%);
                }

                .blankPage__title {
                    margin-top: 2rem;
                    margin-bottom: 0;
                }

                .blankPage__message {
                    margin-top: 1rem;
                }

                a {
                    color: #d52047;
                    text-decoration: none;
                }

                a:hover {
                    color: black;
                }

            </style>

            <div class="blankPage">
                <div class="blankPage__container">
                    <div class="blankPage__image" style="background-image: url('${this.image}')"></div>
                    <h1 class="blankPage__title">${this.title}</h1>
                    <p class="blankPage__message">${this.message}</p>
                    <a href="${this.backUrl}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        `;
    }
}

window.customElements.define("custom-page", customPage);
