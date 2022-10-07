let btn_modifier = document.querySelectorAll('.modifier');
var id;

btn_modifier.forEach((btn)=>{
    btn.addEventListener('click', (e)=>{
        e.preventDefault();

        let card = btn.parentNode;
        id = card.getAttribute('data-id');

        // let properties = {};

        // card.querySelectorAll('.product_property').forEach((span) => {
        //     const data_product_property = span.getAttribute('data_product_property')
        //     properties[data_product_property] = span.innerText;
        // })

        // const modal = document.querySelector('#exampleModal');

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
        fields['Status'] = form_data.get('Status');
        if ((form_data.get('Material') != "selected")) {
            fields['Material'] = [form_data.get('Material')];
        }  
        if ((form_data.get('Color') != "selected")) {
            fields['Color'] = [form_data.get('Color')];
        }  
        if ((form_data.get('Category') != "selected")) {
            fields['Category'] = [form_data.get('Category')];
        }         
           
        let data = {
            'records': [{
                id,
                fields
            }]
        }

        get_data_from_request('https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Content', 'PATCH', data)
        .then( (response) => console.log(response))
        .catch( (e) => console.error(e));
       
    })
})
