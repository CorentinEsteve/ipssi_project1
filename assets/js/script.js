// const sb = document.querySelector('#exampleSelect1')
// const btn = document.querySelector('#btn');
// const card = document.querySelectorAll('.card');

// btn.onclick = (event) => {
//     event.preventDefault();
//     alert(sb.value);
//     card.forEach(element => element.style.display = "none");

// };

// const API_KEY = 'keyVpYYBeW1Ou7uuY';
// const URL = `https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Content/reczs38CmX9xvWuO?api_key=${API_KEY}`;


    // const btn_modify = document.querySelector('.modifier');
    // const btn_delete = document.querySelector('.supprimer');


let btn_modifier = document.querySelectorAll('.supprimer');
let card = document.querySelector('.card-unavailable');
let id = card.getAttribute('data-id');
console.log(id);
btn_modifier.forEach((btn)=>{
    btn.addEventListener('click', (e)=>{
        e.preventDefault();

        let data = {
            'records' : [{
                "id": "reczs38CmX9xvWuOn",
            }]
        }
        
        fetch(`https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Content/${id}?api_key=${API_KEY}`, {
            method: 'DELETE',
            headers: {'Content-Type' : 'application/json'},
            // body: JSON.stringify(data)
        }).then((response)=>{
            console.log(response);
        }).catch((e)=>{
            console.log('Erreur : '+ e.message);
        })
        
        fetch(URL).then((response) => {
            console.log(response);
            if(response.ok){
                response.json().then((data) => {
                    console.log(data);
                })
            }
            else{
                console.log('Erreur status !=200');
            }
        }).catch((error) => {
            console.log(`Erreur : ${error.message}`);
        })
        
    })
})

