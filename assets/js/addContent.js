
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
            fields['Material'] = [form_data.get('Material')];
        }  
        if ((form_data.get('Color') != "selected")) {
            fields['Color'] = [form_data.get('Color')];
        }  
        if ((form_data.get('Category') != "selected")) {
            fields['Category'] = [form_data.get('Category')];
        }        

        let data = {
            records: [{
                fields
             }]
        }

        get_data_from_request('https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Content', 'POST', data)
        .then( (response) => console.log(response))
        .catch( (e) => console.error(e));
       

    })
});
