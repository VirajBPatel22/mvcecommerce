class FormValidator {
    constructor(form) {
        this.form = form;
        this.validationRules = {
            "validate-required": this.validateRequired,
            "validate-email": this.validateEmail,
            "validate-number": this.validatePhone,
            "validate-name": this.validateName,
            "validate-address": this.validateAddress,
            "validate-zipcode": this.validateZipcode
        };
        
        this.observeInputs();
        this.setupFormSubmission();
    }

    validateEmail(input) {
        return /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(input.value) ? "" : "Please enter a valid email";
    }

    validateAddress(input) {
        return /^[a-zA-Z0-9\s\,\''\-]+$/.test(input.value) ? "" : "Invalid address format";
    }

    validateName(input) {
        return /^[A-Za-z]{2,}$/.test(input.value) ? "" : "Please enter a valid name";
    }

    validatePhone(input) {
        return /^[0-9]{10}$/.test(input.value) ? "" : "Please enter a 10-digit phone number";
    }

    validateZipcode(input) {
        return /^[0-9]{6}$/.test(input.value) ? "" : "Please enter a 6-digit zipcode";
    }

    validateRequired(input) {
        return input.value.trim() ? "" : "This field is required";
    }

    validateInput(input) {
        let errorMessage = "";
        Object.keys(this.validationRules).forEach((rule) => {
            if (input.classList.contains(rule)) {
                let error = this.validationRules[rule](input);
                if (error) errorMessage = error;
            }
        });

        this.showError(input, errorMessage);
        this.toggleSubmitButton();
    }

    showError(input, errorMessage) {
        // Get error span by ID based on input ID
        let fieldId = input.id;
        let errorId = fieldId ? fieldId.replace('_', '') + '-error' : null;
        let errorSpan = errorId ? document.getElementById(errorId) : null;
        
        if (errorSpan) {
            errorSpan.textContent = errorMessage;
        }
    }

    toggleSubmitButton() {
        const allInputs = this.form.querySelectorAll("input.validate-required");
        let isValid = true;

        allInputs.forEach((input) => {
            const fieldId = input.id;
            const errorId = fieldId ? fieldId.replace('_', '') + '-error' : null;
            const errorSpan = errorId ? document.getElementById(errorId) : null;
            
            if (errorSpan && errorSpan.textContent !== "") {
                isValid = false;
            }
        });

        const submitButton = this.form.querySelector("button[type='submit']");
        if (submitButton) {
            submitButton.disabled = !isValid;
        }
    }

    observeInputs() {
        this.form.addEventListener("input", (event) => {
            if (event.target.tagName === "INPUT") {
                this.validateInput(event.target);
            }
        });

        // Also validate on initial load
        const allInputs = this.form.querySelectorAll("input");
        allInputs.forEach(input => this.validateInput(input));
    }

    setupFormSubmission() {
        this.form.addEventListener("submit", (event) => {
            let isValid = true;
            const allInputs = this.form.querySelectorAll("input");

            allInputs.forEach((input) => {
                this.validateInput(input);
                const fieldId = input.id;
                const errorId = fieldId ? fieldId.replace('_', '') + '-error' : null;
                const errorSpan = errorId ? document.getElementById(errorId) : null;
                
                if (errorSpan && errorSpan.textContent !== "") {
                    isValid = false;
                }
            });

            if (!isValid) {
                event.preventDefault();
                alert("Please fix validation errors before submitting.");
            }
        });
    }
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("form").forEach((form) => {
        new FormValidator(form);
    });
});