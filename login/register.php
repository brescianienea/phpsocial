<div class="login">
    <div class="container">
        <h1>Create an Account</h1>
        <div id="form">
            <form id="registration_form" novalidate>

                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                </div>

                <div class="tab" id="mail-tab">
                    <h2>What's your email?</h2>
                    <div class="input-container input-value">
                        <input id="mail" type="text" name="mail" required/>
                        <label for="mail">Email</label>
                    </div>
                </div>

                <div class="tab" id="birth-tab">
                    <h2>When were you born?</h2>
                    <div class="input-container input-value">
                        <div class="date-wrapper">
                            <div class="input-container input-value">
                                <input id="day" autocomplete="false" type="number" name="mail" placeholder="GG" min="1"
                                       max="31"
                                       minlength="2"
                                       required/>
                                <label for="day">Day</label>
                            </div>
                            <div class="input-container input-value">
                                <input id="month" autocomplete="false" type="number" name="mail" placeholder="MM"
                                       min="1" max="12"
                                       minlength="2"
                                       required/>
                                <label for="month">Month</label>
                            </div>
                            <div class="input-container input-value">
                                <input id="year" autocomplete="false" type="number" name="mail" placeholder="YYYY"
                                       min="1" max="9999"
                                       minlength="4"
                                       required/>
                                <label for="year">Year</label>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="tab" id="user-tab">
                    <h2>Choose a Username</h2>
                    <div class="input-container input-value">
                        <input type="text" name="username" required/>
                        <label for="username">Username</label>
                    </div>
                </div>

                <div class="tab" id="password-tab">
                    <h2>Choose a Password</h2>
                    <div class="input-container input-value">
                        <input id="password" type="password" name="password" required/>
                        <label for="password">Password</label>
                        <button id="show-password">
                        <span class="not-toggled">
                            <?php include('source/icons/eye-slash-solid.svg') ?>
                        </span>
                            <span class="toggled">
                                <?php include('source/icons/eye-solid.svg') ?>
                        </span>
                        </button>
                    </div>

                    <div class="password-requirements">
                        <p class="requirement" id="length">Min. 8 characters</p>
                        <p class="requirement" id="lowercase">Include lowercase letter</p>
                        <p class="requirement" id="uppercase">Include uppercase letter</p>
                        <p class="requirement" id="number">Include number</p>
                        <p class="requirement" id="characters">Include a special character: #.-?!@$%^&*</p>
                    </div>

                    <div class="input-container input-value">
                        <input id="confirm-password" type="password" name="confirm-password" required/>
                        <label for="confirm-password">Password</label>
                    </div>

                    <div class="password-requirements">
                        <p class="requirement" hidden="hidden" id="match">Passwords must match</p>
                    </div>

                </div>


                <div class="button">
                    <button href="#" disabled id="submit" type="submit" onclick="nextPrev(1); return false;"
                            class="btn"><?php include('source/icons/arrow-right-solid.svg') ?></button>
                </div>

                <div class="bottom-links">
                    <p><a class="switch" href="#">Forgot username?</a></p>
                    <p><a href="/login-page.php?section=login">Login</a></p>
                </div>
            </form>


        </div>
    </div>
</div>
<script>

    const inputs = document.querySelectorAll("input");
    const form = document.getElementById("password-tab");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm-password");
    const showPassword = document.getElementById("show-password");
    const matchPassword = document.getElementById("match");
    const submit = document.getElementById("submit");

    inputs.forEach((input) => {
        input.addEventListener("blur", (event) => {
            if (event.target.value) {
                input.classList.add("is-valid");
            } else {
                input.classList.remove("is-valid");
            }
        });
    });

    showPassword.addEventListener("click", (event) => {
        event.preventDefault();

        if (password.type === 'password') {
            password.type = 'text';
            document.getElementById('show-password').classList.add('toggled');
        } else {
            password.type = 'password';
            document.getElementById('show-password').classList.remove('toggled');
        }
    });

    const updateRequirement = (id, valid) => {
        const requirement = document.getElementById(id);

        if (valid) {
            requirement.classList.add("valid");
        } else {
            requirement.classList.remove("valid");
        }
    };

    password.addEventListener("input", (event) => {
        const value = event.target.value;

        updateRequirement("length", value.length >= 8);
        updateRequirement("lowercase", /[a-z]/.test(value));
        updateRequirement("uppercase", /[A-Z]/.test(value));
        updateRequirement("number", /\d/.test(value));
        updateRequirement("characters", /[#.?!@$%^&*-]/.test(value));
        handleFormValidation();
        confirmPassword.dispatchEvent(new Event('input'));
    });

    confirmPassword.addEventListener("blur", (event) => {
        const value = event.target.value;

        if (value.length && value !== password.value) {
            matchPassword.classList.remove("hidden");
        } else {
            matchPassword.classList.add("hidden");
        }
    });

    confirmPassword.addEventListener("focus", (event) => {
        matchPassword.classList.add("hidden");
    });

    confirmPassword.addEventListener("input", (event) => {
        const value = confirmPassword.value;

        if (value.length !== 0 && value === password.value) {
            matchPassword.removeAttribute("hidden");
            matchPassword.classList.add('valid');
            matchPassword.classList.remove('error');
        } else if (value.length === 0) {
            matchPassword.setAttribute("hidden", "hidden");

        } else {
            matchPassword.removeAttribute("hidden");
            matchPassword.classList.remove('valid');
            matchPassword.classList.add('error');
        }
    });

    const handleFormValidation = () => {
        const value = password.value;
        const confirmValue = confirmPassword.value;

        if (
            value.length >= 8 &&
            /[a-z]/.test(value) &&
            /[A-Z]/.test(value) &&
            /\d/.test(value) &&
            /[#.?!@$%^&*-]/.test(value) &&
            value === confirmValue
        ) {
            submit.removeAttribute("disabled");
            return true;
        }

        submit.setAttribute("disabled", true);
        return false;
    };

    form.addEventListener("change", () => {
        handleFormValidation();
    });

    form.addEventListener("submit", (event) => {
        event.preventDefault();
        const validForm = handleFormValidation();

        if (!validForm) {
            return false;
        }

        alert("Form submitted");
    });


    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form ...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        // ... and run a function that displays the correct step indicator:
        doFirstCheckForm(x[n]);
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form... :
        if (currentTab >= x.length) {
            //...the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false:
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class to the current step:
        x[n].classList.add('active');
    }

    function doFirstCheckForm(form) {
        var allFilled = true;
        $('#' + form.getAttribute('id')).find('input').each(function () {
            if ($(this).val() == '') {
                allFilled = false;
            }
        });

        $('form').find(".btn").prop('disabled', !allFilled);
        if (allFilled) {
            $('form').find(".btn").removeAttr('disabled');
        }
    }

    function doCheckForm(form) {
        var allFilled = true;
        form.find('input').each(function () {
            if ($(this).val() == '') {
                allFilled = false;
            }
        });

        $('form').find(".btn").prop('disabled', !allFilled);
        if (allFilled) {
            $('form').find(".btn").removeAttr('disabled');
        }
    }

    function doMailCheckForm(form) {
        var allFilled = true;
        form.find('input').each(function () {
            if ($(this).val() == '') {
                allFilled = false;
            }
        });

        $('form').find(".btn").prop('disabled', !allFilled);
        if (allFilled) {

            var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

            if ($('#mail').val().match(validRegex)) {

                $('form').find(".btn").removeAttr('disabled');

            } else {

                $('form').find(".btn").prop('disabled', true);

            }

        }
    }

    function isValidDate(date) {
        try {
            let values = date.split('/');
            // Check if the day is valid based on the month and if it's a leap year
            const day = parseInt(values[0]);
            const month = parseInt(values[1]);

            const isLeapYear = (parseInt(values[2]) % 4 === 0 && parseInt(values[2]) % 100 !== 0) || parseInt(values[2]) % 400 === 0;

            switch (month) {
                case 1: // January
                case 2: // February
                    if (isLeapYear && day <= 29) {
                        return true;
                    } else return !isLeapYear && day <= 28;
                case 4:
                case 6:
                case 9:
                case 11:
                    return day <= 30;
                default:
                    return day <= 31;
            }
        } catch (error) {
            // If an error occurs, it means the date is not valid
            return false;
        }
    }

    function checkAge(date) {
        var birthDate = date;
        var today = new Date();

        return today >= new Date(birthDate.getFullYear() + 16, birthDate.getMonth(), birthDate.getDate());
    }

    function doDateCheck(form) {
        var allFilled = true;
        form.find('input').each(function () {
            if ($(this).val() == '') {
                allFilled = false;
            }
        });

        $('form').find(".btn").prop('disabled', !allFilled);
        if (allFilled) {
            /**
             *
             * @param { number | string } day
             * @param { number | string } month
             * @param { number| string } year
             * @returns { boolean }
             */
            function validateDateString(day, month, year) {

                day = Number(day);
                month = Number(month); //bloody 0-indexed month
                year = Number(year);
                let dateString = day + "/" + month + "/" + year
                console.log(dateString);

                const d = new Date(year, month - 1, day);
                const currentDate = new Date();

                if (!isValidDate(dateString)) {
                    return false;
                }

                if (d > currentDate) {
                    return false;
                }

                if (!checkAge(d)) {
                    return false;
                }

                if (year < 1900) {
                    return false;
                }

                return true;
            }

            if (validateDateString($('#day').val(), $('#month').val(), $('#year').val())) {
                $('form').find(".btn").removeAttr('disabled');
            } else {
                $('form').find(".btn").prop('disabled', true);
            }
        }
    }


    $(document).ready(function () {

        $('input').keyup(function () {

            var currentForm = $(this).closest('.tab');
            if (currentForm.attr('id') === 'mail-tab') {
                doMailCheckForm(currentForm);
            } else if (currentForm.attr('id') === 'birth-tab') {
                doDateCheck(currentForm);
            } else if (currentForm.attr('id') === 'user-tab') {
                doDateCheck(currentForm);
            } else if (currentForm.attr('id') === 'password-tab') {
                handleFormValidation();
            }
        });


        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                if (!$('#submit').attr('disabled'))
                    $('#submit').click();
                return false;
            }
        });

        function validateNumberInput(inputElement) {
            const value = inputElement.value;

            const min = parseInt(inputElement.getAttribute('min'));
            const max = parseInt(inputElement.getAttribute('max'));

            if (value < min) {
                inputElement.value = min;
            } else if (value > max) {
                inputElement.value = max;
            }

            // Add leading zeros to reach the minimum length
            const minLength = parseInt(inputElement.getAttribute('minlength'));
            while (inputElement.value.length < minLength) {
                inputElement.value = '0' + inputElement.value;
            }
        }

        $('input[type="number"]').on('change', (event) => {
            validateNumberInput(event.target);
        });

    });

</script>

