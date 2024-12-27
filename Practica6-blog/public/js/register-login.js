let login = document.getElementById("login");
if (login) {
    login.addEventListener("click", function () {
        window.location.href = "http://localhost/2DAW/Practica6-blog/login";
    });
}
let register = document.getElementById("register");
if (register) {
    register.addEventListener("click", function () {
        window.location.href = "http://localhost/2DAW/Practica6-blog/register";
    });
}
let logout = document.getElementById("logout");
if (logout) {
    logout.addEventListener("click", function () {
        window.location.href = "http://localhost/2DAW/Practica6-blog/logout";
    });
}
let home = document.getElementById("home");
if (home) {
    home.addEventListener("click", function () {
        window.location.href = "http://localhost/2DAW/Practica6-blog";
    });
}
let users = document.getElementById("usuarios");
if (users) {
    users.addEventListener("click", function () {
        console.log('x');
        window.location.href = "http://localhost/2DAW/Practica6-blog/users";
    });
}
let posts = document.getElementById("posts");
if (posts) {
    posts.addEventListener("click", function () {
        window.location.href = "http://localhost/2DAW/Practica6-blog/posts";
    });
}
