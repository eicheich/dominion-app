const rating = document.getElementById("rating");
const stars = rating.getElementsByClassName("fa-star");

for (let i = 0; i < stars.length; i++) {
    stars[i].addEventListener("click", function () {
        setRating(i);
    });
}

function setRating(index) {
    for (let i = 0; i < stars.length; i++) {
        if (i <= index) {
            stars[i].classList.add("checked");
        } else {
            stars[i].classList.remove("checked");
        }
    }
}
