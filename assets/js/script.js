const sb = document.querySelector('#exampleSelect1')
const btn = document.querySelector('#btn');

btn.onclick = (event) => {
    event.preventDefault();
    alert(sb.value);
};