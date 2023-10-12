let profileHead = document.querySelector("#profile .head");
const profile = document.querySelector("#profile");

profileHead.addEventListener("click", () => {
    profile.classList.toggle("expand");

});

