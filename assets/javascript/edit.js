const form_engadir = document.querySelector("#form_engadir"),
    engadir = document.querySelector("#pestana_engadir"),
    form_eliminar = document.querySelector("#form_eliminar"),
    eliminar = document.querySelector("#pestana_eliminar")


engadir.addEventListener("click", e => {
    // e.preventDefault()
    if (eliminar.classList.contains("active")) {
        eliminar.classList.remove("active")
        e.target.classList.add("active")
        form_eliminar.hidden = true
        form_engadir.hidden = false
    }

})

eliminar.addEventListener("click", e => {
    // e.preventDefault()
    // se vuelven a hacer las queries a la bbdd



    if (engadir.classList.contains("active")) {
        engadir.classList.remove("active")
        e.target.classList.add("active")
        form_engadir.hidden = true
        form_eliminar.hidden = false
    }

})