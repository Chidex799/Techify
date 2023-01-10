const fName = document.getElementById("first-name-field");
const lName = document.getElementById("last-name-field");

const emailF = document.getElementById("email-field");
const UniversityF = document.getElementById("University-field");
const departmentF = document.getElementById("department-field");
const matricnumberF = document.getElementById("matricnumber-field");
const durationinweeksF = document.getElementById("duratioinweeks-field");
const passwordF = document.getElementById("password-field");
const confirmpassword = document.getElementById("confirmpassword-field");
const save_btn = document.getElementById("save-btn");
const login_btn = document.getElementById("login-btn");
const signup_btn = document.getElementById("sign up-btn");
const container = document.getElementById("register-container");
const root = document.getElementById("root-container");
 
save_btn.addEventListener('click', event => {

    let first_name = fName.value;
    let last_name = lName.value;
    let email = emailF.value;
    let username = usernameF.value;
    let password = passwordF.value;


    let raw = {
        "first_name": first_name,
        "last_name": last_name,
        "email": email,
        "username": username,
        "password": password
    };

    let requestOptions = {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(raw),
        redirect: 'follow'
    };

    fetch("http://127.0.0.1:8000/accounts/users/", requestOptions)
        .then(response => response.text())
        .then(result => {
            console.log(result);
            alert("User Created");
        })
        .catch(error => console.log('error', error));

});

get_user_btn.addEventListener('click', event => {
    let users;

    let requestOptions = {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        redirect: 'follow'
    };
    
    fetch("http://127.0.0.1:8000/accounts/users/", requestOptions)
        .then(response => response.text())
        .then(result => {
            container.remove();
            users = result;
            //console.log(result);
            let users_list = JSON.parse(users);
            users_list.forEach(element => {
                //let user = JSON.parse(element);
                console.log(element.username);

                username_node = `<h4>${element.username}</h4>`;
                root.innerHTML += username_node;
            });
        })
        .catch(error => console.log('error', error));

   

   


});