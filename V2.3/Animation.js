window.onload = function () {
    const el = document.getElementsByClassName("Anime")[0];
    if (el) {
        el.addEventListener("animationend", () => {
            console.log("Animation terminée !");
            el.remove();
        });
    } else {
        console.warn("Élément .Anime non trouvé !");
    }
};
