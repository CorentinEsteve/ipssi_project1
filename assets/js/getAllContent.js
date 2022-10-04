
// const API_KEY = 'keyVpYYBeW1Ou7uuY';
// const URL = `https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Content?api_key=${API_KEY}`;
          
    fetch(`https://api.airtable.com/v0/appzDJ4jK0bk4k3Q7/Content?api_key=${API_KEY}`).then((response) => {
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
    


