const overlay = document.getElementById('overlay')
const modal = document.getElementById('modal')
const login = document.getElementById('modal-login')
const register = document.getElementById('modal-register')
const change = document.getElementById('modal-change')

function openLogin() {
    if (modal) {
        modal.style.display = "block"
        overlay.classList.add('active')
        login.style.display = "block"
        register.style.display = "none"
        change.style.display = "none"
    }
}

function closeLogin() {
    modal.style.display = "none"
    overlay.classList.remove('active')
}

function openRegister() {
    if (modal) {
        modal.style.display = "block"
        overlay.classList.add('active')
        login.style.display = "none"
        register.style.display = "block"
        change.style.display = "none"
    }
}

function closeRegister() {
    modal.style.display = "none"
    overlay.classList.remove('active')
}

function openChange() {
    if (modal) {
        modal.style.display = "block"
        overlay.classList.add('active')
        login.style.display = "none"
        register.style.display = "none"
        change.style.display = "block"
    }
}

function closeChange() {
    modal.style.display = "none"
    overlay.classList.remove('active')
}