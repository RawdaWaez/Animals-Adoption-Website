function displayDateTime() {
    var now = new Date();
    var time = now.toLocaleString();
    document.getElementById("datetime").innerHTML = time;
}
displayDateTime();
setInterval(displayDateTime, 1000);

const interestedBtns = document.querySelectorAll('.interested-btn');
interestedBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        btn.textContent = 'Thank you! 🐾';
        btn.disabled = true;
    });
});


function validateForm(event) {
    var petType = document.getElementById("pet-type").value;
    var petBreed = document.getElementById("pet-breed").value;
    var petAge = document.getElementById("pet-age").value;
    var petGender = document.getElementById("pet-gender").value;
    var checkboxes = document.querySelectorAll('input[class = "optionInput" ]:checked');

    if (petType == "" || petBreed == "" || petAge == "" || petGender == "" || checkboxes.length == 0) {
        alert("Please fill out all required fields.");
        return false;
    }
    return true;
}
function validateForm2(event) {

    var type = document.getElementById("pet-type").value;
    var breed = document.getElementById("breed").value;
    var age = document.getElementById("age").value;
    var gender = document.getElementById("gender-male").checked;
    var gender2 = document.getElementById("gender-female").checked;
    var checkbox1 = document.getElementById("gets-along-dogs").checked;
    var checkbox2 = document.getElementById("gets-along-cats").checked;
    var checkbox3 = document.getElementById("suitable-for-kids").checked;
    var checkbox4 = document.getElementById("none").checked;
    var comments = document.getElementById("comments").value;
    var owner = document.getElementById("owner-name").value;
    var email = document.getElementById("owner-email").value;

    let genderCheck = (gender || gender2);
    let checkBoxCheck = (checkbox1 || checkbox2 || checkbox3 || checkbox4);
    let checkEmail2 = checkEmail.test(String(email).toLowerCase());


    if (type == "N/A" || breed == "N/A" || age == "N/A" || comments == "" || owner == "" || email == "" || !genderCheck || !checkBoxCheck || !checkEmail2) {
        alert("Please fill out all required fields.");
        return false;

    }

    return true;
}












