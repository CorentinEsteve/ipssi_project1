let btn_supprimer = document.querySelectorAll('.supprimer');

btn_supprimer.forEach((btn)=>{
    btn.addEventListener('click', (e)=>{
        e.preventDefault();
        // console.log(btn);
        let id = btn.parentNode.getAttribute('data-id');
        console.log(id);

        get_data_from_request(`https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Content/${id}`, 'DELETE')
        .then( (response) => console.log(response))
        .catch( (e) => console.error(e));
    })
});