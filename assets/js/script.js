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


const formatData = (data) => {
    return { 
        "fields": {
        "Name": data.name,
        "Price": data.price,
        "Quantity" : data.quantity,
        "Price" : data.price,
        }
    }
}

let btn_supprimer = document.querySelectorAll('.supprimer');

btn_supprimer.forEach((btn)=>{
    btn.addEventListener('click', (e)=>{
        e.preventDefault();
        // console.log(btn);
        let id = btn.parentNode.getAttribute('data-id');
        console.log(id);
        
        fetch(`https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Content/${id}?api_key=${API_KEY}`, {
            method: 'DELETE',
            headers: {'Content-Type' : 'application/json'},
        }).then((response)=>{
            console.log(response);
        }).catch((e)=>{
            console.log('Erreur : '+ e.message);
        })
    })
})


let btn_modifier = document.querySelectorAll('.modifier');
var id;

btn_modifier.forEach((btn)=>{
    btn.addEventListener('click', (e)=>{
        e.preventDefault();
        // console.log(btn);
        id = btn.parentNode.getAttribute('data-id');
    })
});

let btn_envoyer = document.querySelectorAll('.envoyer');

btn_envoyer.forEach((btn)=>{
    btn.addEventListener('click', (e)=>{
        e.preventDefault();

        const form = document.getElementById('form');
        const form_data = new FormData(form);
      
        let fields = {};

        if ((form_data.get('Name').length != 0)) {
            fields['Name'] = form_data.get('Name');
        }
        if ((form_data.get('Price').length != 0)) {
            fields['Price'] = parseFloat(form_data.get('Price'));
        } 
        if ((form_data.get('Quantity').length != 0)) {
            fields['Quantity'] = parseInt(form_data.get('Quantity'));
        }
        if ((form_data.get('Status').length != 0)) {
            fields['Status'] = form_data.get('Status');
        }  
        if ((form_data.get('Material') != "selected")) {
            console.log(form_data.get('Material'));
            fields['Material'] = [form_data.get('Material')];
        }  
        if ((form_data.get('Color') != "selected")) {
            console.log(form_data.get('Color'));
            fields['Color'] = [form_data.get('Color')];
        }  
        if ((form_data.get('Category') != "selected")) {
            console.log(form_data.get('Category'));
            fields['Category'] = [form_data.get('Category')];
        }         
           
        let data = {
            'records': [{
                'id' : id,
                'fields' : fields
            }]
        }
           
        console.log(data);
        console.log('id pour modif : '+id);

        fetch(`https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Content?api_key=${API_KEY}`, {
            method: 'PATCH',
            headers: {'Content-Type' : 'application/json'},
            body: JSON.stringify(data)
        }).then((response)=>{
            console.log(response);
        }).catch((e)=>{
            console.log('Erreur : '+ e.message);
        })
    })
})

let btn_ajouter = document.querySelectorAll('.ajouter');

btn_ajouter.forEach((btn)=>{
    btn.addEventListener('click', (e)=>{
        e.preventDefault();

        const form = document.getElementById('form2');
        const form_data = new FormData(form);

        let fields = {};

        if ((form_data.get('Name').length != 0)) {
            fields['Name'] = form_data.get('Name');
        }
        if ((form_data.get('Price').length != 0)) {
            fields['Price'] = parseFloat(form_data.get('Price'));
        } 
        if ((form_data.get('Quantity').length != 0)) {
            fields['Quantity'] = parseInt(form_data.get('Quantity'));
        }
        if ((form_data.get('Status').length != 0)) {
            fields['Status'] = form_data.get('Status');
        }  
        if ((form_data.get('Material') != "selected")) {
            console.log(form_data.get('Material'));
            fields['Material'] = [form_data.get('Material')];
        }  
        if ((form_data.get('Color') != "selected")) {
            console.log(form_data.get('Color'));
            fields['Color'] = [form_data.get('Color')];
        }  
        if ((form_data.get('Category') != "selected")) {
            console.log(form_data.get('Category'));
            fields['Category'] = [form_data.get('Category')];
        }        

        let data = {
            'records': [{
                'fields' : fields
            }]
        }

        fetch(`https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Content?api_key=${API_KEY}`, {
            method: 'POST',
            headers: {'Content-Type' : 'application/json'},
            body: JSON.stringify(data)
        }).then((response)=>{
            console.log(response);
        }).catch((e)=>{
            console.error('Erreur : '+ e.message);
        })


    })
});