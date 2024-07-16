document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.header-menu-item').forEach(item => {
        item.addEventListener("mouseover", e => {
            e.target.classList.add("active");
        });

        item.addEventListener("mouseout", e => {
            e.target.classList.remove("active");
        });
    });
    const hamburger_button = document.querySelector("#menu-btn");
    const menu_mobile = document.querySelector("#mobile_menu");
    const header = document.querySelector("#header");
    if (window.innerWidth >= 768) {
        hamburger_button.setAttribute("style", "display:none");
    }

    function openMenuMobile() {
        menu_mobile.setAttribute("style", `opacity:1;top:${header.offsetHeight}px;height: calc(100vh - ${header.offsetHeight}px);`);
        //fa-times

        hamburger_button.classList.remove("fa-bars");
        hamburger_button.classList.add("fa-times", "active");
        document.querySelector("body").setAttribute("style", "overflow-y: hidden;");
    }
    function closeMenuMobile() {
        menu_mobile.setAttribute("style", "");

        hamburger_button.classList.add("fa-bars");
        hamburger_button.classList.remove("fa-times", "active");
        document.querySelector("body").removeAttribute("style");
    }
    hamburger_button.addEventListener("click", e => {
        if (e.target.classList.contains("active")) {
            closeMenuMobile();
        } else {
            openMenuMobile();
        }
    });

    function loginWith() {
        const btns = document.querySelectorAll(".login-with-btn");
        const options = document.querySelectorAll(".login_with_choice");
        const login_with_input = document.querySelector('#login-modal input[name="login_with"]');

        btns.forEach(btn => btn.addEventListener("click", event => {
            btns.forEach(btn => btn.classList.remove("bg-primary"));
            event.target.classList.add("bg-primary");
            const markedInput = event.target;
            const markedInputChoice = markedInput.getAttribute("data-choice");

            login_with_input.setAttribute("value", markedInputChoice);

            options.forEach(option => {
                if (option.getAttribute("data-choice") !== markedInputChoice) {
                    option.classList.add("hidden");
                    option.lastElementChild.removeAttribute("name");
                } else {
                    option.classList.remove("hidden");
                    option.lastElementChild.setAttribute("name", markedInputChoice);
                }
            });
        }));
    }

    function modalSwitcher() {
        const btns = document.querySelectorAll(".open-modal-btn");
        const closeBtns = document.querySelectorAll(".close-modal-btn");
        btns.forEach(btn => {
            btn.addEventListener("click", event => {
                closeMenuMobile();
                const clickedBtn = event.target;
                const modalTarget = document.querySelector(`#${clickedBtn.getAttribute('data-modal')}`);
                modalTarget.classList.remove("hidden");
                modalTarget.classList.add("absolute");
                window.scrollTo({ top: 0, behavior: 'smooth' });
                closeMenuMobile();
            });
        });

        closeBtns.forEach(btn => {
            btn.addEventListener("click", event => {
                const target = document.querySelector(`#${event.target.getAttribute('data-modal')}`);
                target.classList.add("hidden");
            });
        });
    }

    loginWith();
    modalSwitcher();

});

