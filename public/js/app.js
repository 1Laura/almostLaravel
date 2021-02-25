console.log("app.js")

const regFormEl = document.getElementById('registration-form');

console.log('regFormEl');
console.log(regFormEl);


if (regFormEl) {
    console.log('in the if')
    regFormEl.addEventListener('submit', function (e) {
        e.preventDefault();
        console.log('Prevented')
    })
}