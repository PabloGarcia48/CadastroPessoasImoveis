document.addEventListener("DOMContentLoaded", () => {

    // TELEFONE
    const phoneInputs = document.querySelectorAll(".phone-mask");

    phoneInputs.forEach(input => {
        input.addEventListener("input", function () {
            let value = this.value.replace(/\D/g, "");

            if (value.length > 11) value = value.slice(0, 11);

            value = value.replace(/^(\d{2})(\d)/g, "($1) $2");
            value = value.replace(/(\d{5})(\d)/, "$1-$2");

            this.value = value;
        });
    });


    // CPF
    const cpfInputs = document.querySelectorAll(".cpf-mask");

    cpfInputs.forEach(input => {
        input.addEventListener("input", function () {

            let value = this.value.replace(/\D/g, "");

            if (value.length > 11) value = value.slice(0, 11);

            value = value.replace(/(\d{3})(\d)/, "$1.$2");
            value = value.replace(/(\d{3})(\d)/, "$1.$2");
            value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

            this.value = value;
        });
    });

});