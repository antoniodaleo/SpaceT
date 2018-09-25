// main.js

// Gerar uma pass 
function gerarPassword(numLett) {
    let text_password = document.getElementById('txt_pass'); 
    let caracteres = 'abcdefg1234567';
    let codigo = ''; 
    for(let i=0; i<numLett; i++){
        let r = Math.floor(Math.random()* caracteres.length) +1; 
        codigo += caracteres.substr(r,1);  
    }

    // Coloca o codigo no campo pass
    text_password.value = codigo; 
}


//=====================================================
function checkTodos(){
    $('input:checkbox').prop('checked',true);
}

//======================================
function checkNunhumas(){
    $('input:checkbox').prop('checked',false);
}