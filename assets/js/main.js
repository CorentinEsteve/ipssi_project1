const API_KEY = 'keyVpYYBeW1Ou7uuY';

async function get_data_from_request (URL, method='GET', body={}){

    let request = {
        method,
        headers: {'Content-Type' : 'application/json', 'Authorization' : `Bearer ${API_KEY}`},
    }
    
    if (['POST', 'PATCH'].includes(method)){
        request['body'] = JSON.stringify(body);
    };
  
    const response_request = await fetch(URL, request);

    if (response_request.ok){
        return (response_request.json());
    }
    else{
        return (Promise.reject(response_request));
    }

}
