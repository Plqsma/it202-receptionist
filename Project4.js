document.addEventListener("DOMContentLoaded", function () {
    function toggleEmailInput() {
        const emailContainer = document.getElementById("email-container");
        const emailInput = document.getElementById("email-confirmation");
    
        emailContainer.style.display = emailInput.checked ? "block" : "none";
    }

    const emailCheckbox = document.getElementById("email-confirmation");
    emailCheckbox.addEventListener("click", toggleEmailInput);

    const form = document.getElementById("form");
    form.addEventListener("submit", function (event) {
        event.preventDefault(); 

        const firstName = document.getElementById("first-name").value;
        const lastName = document.getElementById("last-name").value;
        const phone = document.getElementById("phone").value;
        const password = document.getElementById("password").value;
        const id = document.getElementById("receptionist-id").value;
        const email = document.getElementById("email").value;
        const emailConfirmation = document.getElementById("email-confirmation").checked;
        const transactionType = document.getElementById("transaction-type").value;

        const isValid = validate(firstName, lastName, phone, password, id, email, emailConfirmation);
        if (isValid) {
            form.submit(); 
        }
    });

   
    const resetButton = document.getElementById("reset");
    resetButton.addEventListener("click", function () {
        form.reset();
    });
});

function validate(firstName, lastName, phone, password, id, email, emailConfirmation) {
    const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&!])[A-Za-z\d@#$%^&!]{8,16}$/;
    const idPattern = /^\d{4}$/;
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,5}$/;
    const phonePattern = /^(\()?\d{3}(\))?(-|\s)?\d{3}(-|\s)\d{4}$/

    if (firstName == "") {
        alert("Receptionist's First Name is required.");
        document.getElementById("first-name").focus();
        return false;
    }
    if (lastName == "") {
        alert("Receptionist's Last Name is required.");
        document.getElementById("last-name").focus();
        return false;
    }

    if (!phonePattern.test(phone)) {
        alert("Phone Number is not valid.");
        document.getElementById("phone").focus();
        return false;
    }

    if (!passwordPattern.test(password)) {
        alert("Password must be 8-16 characters and contain at least 1 uppercase letter, 1 numeric character, and 1 special character.");
        document.getElementById("password").focus();
        return false;
    }
    if (!idPattern.test(id)) {
        alert("Receptionist's ID must be a 4-digit number.");
        document.getElementById("receptionist-id").focus();
        return false;
    }
    if (emailConfirmation && !emailPattern.test(email)) {
        alert("Receptionist's Email Address is not in the correct format.");
        document.getElementById("email").focus();
        return false;
    }
    else {return true;}
}

