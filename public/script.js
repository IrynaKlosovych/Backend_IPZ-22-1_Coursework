'use strict';

const surnameIsInvalid = "Прізвище не вказано";
const nameIsInvalid = "Ім'я не вказано";
const allFieldsAreInvalid = "Не всі поля заповнені";
const emailIsInvalid = "Email не правильний";
const passwordsAreNotEqual = "Паролі не однакові";
const passwordLength = 7;
const invalidLengthPass = `Пароль менший ${passwordLength}`
const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
const successRegistry = "Успішна реєстрація"
const checkYourData = "Перевірте дані"
const thereAreNotAllColors = "Всі значення кольорів повинні бути заповнені";

function alertForRegistry(element, message) {
    let divChild = document.createElement('div');
    divChild.innerHTML = message;
    element.appendChild(divChild);
    element.classList.add("alertBad")
}

function alertForLogin(element, message) {
    let divChild = document.createElement('div');
    divChild.innerHTML = message;
    element.appendChild(divChild);
    element.hidden = false
}

function redirect(redirectUrl) {
    window.location.href = redirectUrl;
}


let registryUser = document.getElementById('registryUser');
let authenticationUser = document.getElementById('loginUser');
let createPage = document.getElementById("createPage")

//registry user
if (registryUser)
    registryUser.addEventListener('click', (event) => {
        if (event.target.id === "SubmitRegistry") {
            event.preventDefault();
            let form = document.getElementById('registryUser');
            let alert = document.getElementById('alertRegistry');
            alert.innerHTML = '';
            if (alert.classList.contains("alertBad"))
                alert.classList.remove("alertBad")

            let errorArray = [];

            const name = document.getElementById('name').value;
            const surname = document.getElementById('surname').value;
            const pass1 = document.getElementById("pass").value;
            const pass2 = document.getElementById("pass2").value;
            const email = document.getElementById('email').value;

            if (!(name && surname && email && pass1 && pass2)) {
                alertForRegistry(alert, allFieldsAreInvalid)
                return;
            }
            if (!name)
                errorArray.push(nameIsInvalid)
            if (!surname)
                errorArray.push(surnameIsInvalid)
            if (!emailPattern.test(email))
                errorArray.push(emailIsInvalid)
            if (pass1.length < passwordLength || pass2.length < passwordLength)
                errorArray.push(invalidLengthPass)
            if (pass1 !== pass2)
                errorArray.push(passwordsAreNotEqual)
            if (errorArray.length > 0) {
                const errorString = errorArray.join('<br/>');
                alertForRegistry(alert, errorString);
                return;
            }
            let formData = {
                name: name,
                surname: surname,
                email: email,
                password: pass1
            };
            fetch('http://backendcoursework/user/registry', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(formData)
            })
                .then(response => {
                    if (response.ok) {
                        return response.text();
                    } else {
                        console.log('Під час реєстрації сталася помилка.');
                    }
                })
                .then(data => {
                    if (data.toString() === "1") {
                        alert.innerHTML = successRegistry;
                        alert.classList.add('alertGood')
                        form.hidden = true;
                        setTimeout(function () {
                            redirect("/");
                        }, 5000);
                    } else {
                        alertForRegistry(alert, checkYourData + "<br/>" + data.toString());
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        }
    })

if (authenticationUser)
    authenticationUser.addEventListener('click', (event) => {
        if (event.target.id === "SubmitLogin") {
            event.preventDefault();

            let alert = document.getElementById('alertLogin');
            alert.innerHTML = '';
            alert.hidden = true
            if (alert.classList.contains("alertBad"))
                alert.classList.remove("alertBad")

            let errorArray = [];

            const pass = document.getElementById("pass").value;
            const email = document.getElementById('email').value;

            if (!(email && pass)) {
                alertForLogin(alert, allFieldsAreInvalid)
                return;
            }
            if (!emailPattern.test(email))
                errorArray.push(emailIsInvalid)
            if (pass.length < passwordLength)
                errorArray.push(invalidLengthPass)
            if (errorArray.length > 0) {
                const errorString = errorArray.join('<br/>');
                alertForLogin(alert, errorString);
                return;
            }
            let formData = {
                email: email,
                password: pass
            };
            fetch('http://backendcoursework/user/login', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(formData)
            })
                .then(response => {
                    if (response.ok) {
                        return response.text();
                    } else {
                        console.log('Під час входу сталася помилка.');
                    }
                })
                .then(data => {
                    if (data.toString() === "1") {
                        redirect("/");
                    } else alertForLogin(alert, checkYourData + "<br/>" + data.toString());
                })
                .catch(error => {
                    console.error(error);
                });
        }
    })

const redRangeBH = document.getElementById('redRangeBH');
const greenRangeBH = document.getElementById('greenRangeBH');
const blueRangeBH = document.getElementById('blueRangeBH');
const redValueBH = document.getElementById('redValueBH');
const greenValueBH = document.getElementById('greenValueBH');
const blueValueBH = document.getElementById('blueValueBH');
const colorDisplayBH = document.getElementById('colorDisplayBH');
const hexValueBH = document.getElementById('hexValueBH');

const redRangeCH = document.getElementById('redRangeCH');
const greenRangeCH = document.getElementById('greenRangeCH');
const blueRangeCH = document.getElementById('blueRangeCH');
const redValueCH = document.getElementById('redValueCH');
const greenValueCH = document.getElementById('greenValueCH');
const blueValueCH = document.getElementById('blueValueCH');
const colorDisplayCH = document.getElementById('colorDisplayCH');
const hexValueCH = document.getElementById('hexValueCH');

const redRangeBF = document.getElementById('redRangeBF');
const greenRangeBF = document.getElementById('greenRangeBF');
const blueRangeBF = document.getElementById('blueRangeBF');
const redValueBF = document.getElementById('redValueBF');
const greenValueBF = document.getElementById('greenValueBF');
const blueValueBF = document.getElementById('blueValueBF');
const colorDisplayBF = document.getElementById('colorDisplayBF');
const hexValueBF = document.getElementById('hexValueBF');

const redRangeCF = document.getElementById('redRangeCF');
const greenRangeCF = document.getElementById('greenRangeCF');
const blueRangeCF = document.getElementById('blueRangeCF');
const redValueCF = document.getElementById('redValueCF');
const greenValueCF = document.getElementById('greenValueCF');
const blueValueCF = document.getElementById('blueValueCF');
const colorDisplayCF = document.getElementById('colorDisplayCF');
const hexValueCF = document.getElementById('hexValueCF');

function updateColor(redRange, greenRange, blueRange, redValue, greenValue, blueValue, colorDisplay, hexValue) {
    const red = parseInt(redRange.value);
    const green = parseInt(greenRange.value);
    const blue = parseInt(blueRange.value);

    redValue.textContent = red;
    greenValue.textContent = green;
    blueValue.textContent = blue;

    colorDisplay.style.backgroundColor = `rgb(${red}, ${green}, ${blue})`;
    hexValue.value = rgbToHex(red, green, blue);
}

function rgbToHex(r, g, b) {
    return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1).toUpperCase();
}

const groups = [
    {
        redRange: redRangeBH,
        greenRange: greenRangeBH,
        blueRange: blueRangeBH,
        redValue: redValueBH,
        greenValue: greenValueBH,
        blueValue: blueValueBH,
        colorDisplay: colorDisplayBH,
        hexValue: hexValueBH
    },
    {
        redRange: redRangeCH,
        greenRange: greenRangeCH,
        blueRange: blueRangeCH,
        redValue: redValueCH,
        greenValue: greenValueCH,
        blueValue: blueValueCH,
        colorDisplay: colorDisplayCH,
        hexValue: hexValueCH
    },
    {
        redRange: redRangeBF,
        greenRange: greenRangeBF,
        blueRange: blueRangeBF,
        redValue: redValueBF,
        greenValue: greenValueBF,
        blueValue: blueValueBF,
        colorDisplay: colorDisplayBF,
        hexValue: hexValueBF
    },
    {
        redRange: redRangeCF,
        greenRange: greenRangeCF,
        blueRange: blueRangeCF,
        redValue: redValueCF,
        greenValue: greenValueCF,
        blueValue: blueValueCF,
        colorDisplay: colorDisplayCF,
        hexValue: hexValueCF
    }
];

function addEventListeners(group) {
    if (group.redRange) {
        group.redRange.addEventListener('input', () => updateColor(group.redRange, group.greenRange, group.blueRange, group.redValue, group.greenValue, group.blueValue, group.colorDisplay, group.hexValue));
    }
    if (group.greenRange) {
        group.greenRange.addEventListener('input', () => updateColor(group.redRange, group.greenRange, group.blueRange, group.redValue, group.greenValue, group.blueValue, group.colorDisplay, group.hexValue));
    }
    if (group.blueRange) {
        group.blueRange.addEventListener('input', () => updateColor(group.redRange, group.greenRange, group.blueRange, group.redValue, group.greenValue, group.blueValue, group.colorDisplay, group.hexValue));
    }
}

groups.forEach(group => addEventListeners(group));


function alertForCreatePage(element, message) {
    let divChild = document.createElement('div');
    divChild.innerHTML = message;
    element.appendChild(divChild);
}

if (createPage) {
    createPage.addEventListener("click", (event) => {
        if (event.target.id === "SubmitCreatePage") {
            event.preventDefault();
            let title = document.getElementById('title').value.trim();
            let description = document.getElementById('description').value.trim();
            let alertCreatePage = document.getElementById('alertCreatePage')
            alertCreatePage.innerHTML = "";
            if (!(title && description)) {
                alertForCreatePage(alertCreatePage, allFieldsAreInvalid)
                return;
            }
            let colorFields = ['BH', 'CH', 'BF', 'CF'];
            for (let i = 0; i < colorFields.length; i++) {
                let hexValue = document.getElementById('hexValue' + colorFields[i]).value;

                if (hexValue === '') {
                    alertForCreatePage(alertCreatePage, thereAreNotAllColors);
                    return;
                }
            }

            let rgbHeaderBackground = `rgb(${redRangeBH.value}, ${greenRangeBH.value}, ${blueRangeBH.value})`
            let rgbHeaderColor = `rgb(${redRangeCH.value}, ${greenRangeCH.value}, ${blueRangeCH.value})`
            let rgbFooterBackground = `rgb(${redRangeBF.value}, ${greenRangeBF.value}, ${blueRangeBF.value})`
            let rgbFooterColor = `rgb(${redRangeCF.value}, ${greenRangeCF.value}, ${blueRangeCF.value})`


            let formData = {
                title: title,
                description: description,
                rgbHeaderBackground: rgbHeaderBackground,
                rgbHeaderColor: rgbHeaderColor,
                rgbFooterBackground: rgbFooterBackground,
                rgbFooterColor: rgbFooterColor
            };
            fetch('http://backendcoursework/page/create', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(formData)
            })


                .then(response => {
                    if (response.ok) {
                        console.log(response)
                        return response.json();
                    } else {
                        console.log('Під час створення сторінки сталася помилка.');
                    }
                })

                .then(data => {
                    let res = data.result;
                    if (res === true) {
                        redirect(`/page/index/${data.title}`);
                    } else {
                        alertForCreatePage(alertCreatePage, "Помилка" + "<br/>" + data.result);
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        }
    })
}
