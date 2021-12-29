const mySelect = () => {
    const header = document.querySelector('.my-select__header');
    const list = document.querySelector('.my-select ul');
    header.addEventListener('click', function () {
        list.classList.toggle('active');
    });
}
module.exports = mySelect;
