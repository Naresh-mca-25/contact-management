document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("contactForm");

    const name = document.getElementById("name");
    const phone = document.getElementById("phone");
    const email = document.getElementById("email");
    const address = document.getElementById("address");

    const nameError = document.getElementById("nameError");
    const phoneError = document.getElementById("phoneError");
    const emailError = document.getElementById("emailError");
    const addressError = document.getElementById("addressError");


    // =========================
    // NAME
    // =========================

    name.addEventListener("input", function () {

        const value = name.value.trim();

        if (value === "") {

            nameError.textContent = "";
            name.classList.remove("input-error");

        }
        else if (!/^[A-Za-z]+(?: [A-Za-z]+)*$/.test(value)) {

            nameError.textContent =
                "(Please enter a valid name)";

            name.classList.add("input-error");

        }
        else {

            nameError.textContent = "";
            name.classList.remove("input-error");

        }

    });


    // =========================
    // MOBILE NUMBER
    // =========================

    phone.addEventListener("input", function () {

        // Remove letters, spaces and special characters
        phone.value = phone.value.replace(/[^0-9]/g, "");

        // Maximum 10 digits
        phone.value = phone.value.substring(0, 10);

        const value = phone.value;


        if (value === "") {

            phoneError.textContent = "";

            phone.classList.remove("input-error");

        }

        else if (!/^[6-9][0-9]{9}$/.test(value)) {

            phoneError.textContent =
                "(Please enter a valid mobile number)";

            phone.classList.add("input-error");

        }

        else {

            phoneError.textContent = "";

            phone.classList.remove("input-error");

        }

    });


    // =========================
    // EMAIL
    // =========================

    email.addEventListener("input", function () {

        const value = email.value.trim();

        const emailPattern =
            /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;


        if (value === "") {

            emailError.textContent = "";

            email.classList.remove("input-error");

        }

        else if (!emailPattern.test(value)) {

            emailError.textContent =
                "(Please enter a valid email address)";

            email.classList.add("input-error");

        }

        else {

            emailError.textContent = "";

            email.classList.remove("input-error");

        }

    });


    // =========================
    // ADDRESS
    // =========================

    address.addEventListener("input", function () {

        const value = address.value.trim();

        if (value === "") {

            addressError.textContent =
                "(Please enter your address)";

            address.classList.add("input-error");

        }

        else {

            addressError.textContent = "";

            address.classList.remove("input-error");

        }

    });


    // =========================
    // FORM SUBMIT
    // =========================

    form.addEventListener("submit", function (event) {

        let valid = true;


        // NAME

        const nameValue = name.value.trim();

        if (
            nameValue === "" ||
            !/^[A-Za-z]+(?: [A-Za-z]+)*$/.test(nameValue)
        ) {

            nameError.textContent =
                "(Please enter a valid name)";

            name.classList.add("input-error");

            valid = false;

        }


        // MOBILE

        const phoneValue = phone.value.trim();

        if (!/^[6-9][0-9]{9}$/.test(phoneValue)) {

            phoneError.textContent =
                "(Please enter a valid mobile number)";

            phone.classList.add("input-error");

            valid = false;

        }


        // EMAIL

        const emailValue = email.value.trim();

        const emailPattern =
            /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;


        if (
            emailValue === "" ||
            !emailPattern.test(emailValue)
        ) {

            emailError.textContent =
                "(Please enter a valid email address)";

            email.classList.add("input-error");

            valid = false;

        }


        // ADDRESS

        const addressValue = address.value.trim();

        if (addressValue === "") {

            addressError.textContent =
                "(Please enter your address)";

            address.classList.add("input-error");

            valid = false;

        }


        // STOP SUBMISSION

        if (!valid) {

            event.preventDefault();

        }

    });

});